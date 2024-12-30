<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\RoomType;
use App\Models\Room;
use App\Models\Reservation;
use Carbon\Carbon;

class FrontController extends Controller
{
    public function index()
    {
        $roomTypes = RoomType::all();
        return view('front.home.home',compact('roomTypes'));
    }

    public function rooms($id)
    {
        try {
            $decryptedId = Crypt::decrypt($id);
            $roomType = RoomType::findOrFail($decryptedId);
            $rooms = Room::with(['roomType', 'images'])
                ->where('room_type_id', $decryptedId)
                ->where('room_status', 'available')
                ->get();
            // dd($rooms);
            return view('front.rooms.ourroom', compact('roomType', 'rooms','decryptedId'));
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            abort(404);
        }
    }

    public function roomsfilter(Request $request, $id)
    {
        try {
            $decryptedId = Crypt::decrypt($id);
            $roomType = RoomType::findOrFail($decryptedId);
            $checkInDate = $request->input('check_in');
            $checkOutDate = $request->input('check_out');

            $rooms = Room::with(['roomType', 'images'])
                ->where('room_type_id', $decryptedId)
                ->where('room_status', 'available')
                ->where(function($query) use ($checkInDate, $checkOutDate) {
                    $query->where(function($q) use ($checkInDate, $checkOutDate) {
                        $q->where('available_from', '<=', $checkOutDate)
                        ->where('available_until', '>=', $checkInDate);
                    })
                    ->orWhere(function($q) {
                        $q->whereNull('available_from')
                        ->orWhereNull('available_until');
                    });
                })
                ->get();

            return view('front.rooms.ourroom', compact('roomType', 'rooms', 'decryptedId'));
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            abort(404);
        }
    }

    public function reserveRoom(Request $request)
    {
        $validated = $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'check_in' => 'required|date|after_or_equal:today',
            'check_out' => 'required|date|after:check_in',
            'number_of_guests' => 'required|integer|min:1',
        ]);
        $room = Room::findOrFail($request->room_id);
        $checkIn = Carbon::parse($request->check_in);
        $checkOut = Carbon::parse($request->check_out);
        $days = $checkIn->diffInDays($checkOut);
        $totalPrice = $room->price * $days;
        $reservation = Reservation::create([
            'user_id' => Auth::id(),
            'room_id' => $request->room_id,
            'check_in' => $request->check_in,
            'check_out' => $request->check_out,
            'number_of_guests' => $request->number_of_guests,
            'total_price' => $totalPrice,
        ]);

        $room->update([
            'available_until' => $checkIn->subDay()->format('Y-m-d'),
            'available_from' =>$checkOut->addDay()->format('Y-m-d')

        ]);

        return redirect()->route('home')->with('success', 'Your booking was successful!');
    }

    public function userdashboard()
    {
        $reservations = Reservation::with('user', 'room')->where('user_id', auth()->id())->get();
        foreach ($reservations as $reservation) {
            $reservation->room_type = RoomType::find($reservation->room->room_type_id);
        }
        // dd($reservations);
        return view('front.user.dashboard', compact('reservations'));
    }

    public function cancelReservation($id)
    {
        $decryptedId = Crypt::decrypt($id);
        $reservation = Reservation::findOrFail($decryptedId);
        if ($reservation->status != 'canceled') {
            $reservation->status = 'canceled';
            $reservation->save();
            return redirect()->back()->with('success', 'Reservation canceled successfully.');
        }
        return redirect()->back()->with('error', 'This reservation has already been canceled.');
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:15',
            'email' => 'required|email|max:255',
            'user_img' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);
        $user->name = $data['name'];
        $user->phone = $data['phone'];
        $user->email = $data['email'];
        if ($request->hasFile('user_img')) {
            if ($user->user_img) {
                Storage::delete('public/storage' . $user->user_img);
            }
            $imagePath = $request->file('user_img')->store('profile_images', 'public');
            $user->user_img = $imagePath;
        }
        $user->save();

        return redirect()->back()->with('success', 'Profile updated successfully');
    }

    public function getRoomAvailability()
    {
        $rooms = Room::with('roomType')->get();

        $events = $rooms->map(function ($room) {
            return [
                'title' => $room->roomType->name . ' (' . $room->room_number . ')',
                'start' => $room->available_from,
                'end' => $room->available_until,
                'backgroundColor' => $room->room_status == 'available' ? '#28a745' : ($room->room_status == 'unavailable' ? '#dc3545' : '#ffc107'),
                'textColor' => '#fff',
            ];
        });

        return response()->json($events);
    }


}
