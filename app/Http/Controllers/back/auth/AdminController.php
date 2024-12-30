<?php

namespace App\Http\Controllers\back\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Reservation;
use App\Models\RoomType;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function dashboard()
    {
        $today = Carbon::today();
        $totalusers = User::where('role','user')->count();
        $reservationscount = Reservation::count();

        $reservations = Reservation::with('user', 'room')
        ->orderBy('created_at', 'desc')
        ->get();
        foreach ($reservations as $reservation) {
            $reservation->room_type = RoomType::find($reservation->room->room_type_id);
        }
        return view('back.dashboard',compact('totalusers','reservationscount','reservations'));
    }
}
