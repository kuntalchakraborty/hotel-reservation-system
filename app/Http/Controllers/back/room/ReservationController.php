<?php

namespace App\Http\Controllers\back\room;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\RoomType;
class ReservationController extends Controller
{

    public function index()
    {
        $reservations = Reservation::with('user', 'room')->get();
        foreach ($reservations as $reservation) {
            $reservation->room_type = RoomType::find($reservation->room->room_type_id);
        }
        return view('back.reservations.index', compact('reservations'));
    }

    public function updateStatus(Request $request, $id)
    {
        $reservation = Reservation::find($id);

        if ($reservation) {
            $reservation->status = $request->status;
            $reservation->save();
        }

        return redirect()->back()->with('success', 'Reservation status updated successfully.');
    }
}
