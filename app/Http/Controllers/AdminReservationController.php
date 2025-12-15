<?php

namespace App\Http\Controllers;

use App\Models\Reservation;

class AdminReservationController extends Controller
{
    public function approve($id)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->update(['status' => 'confirmed']);


        return back();
    }


    public function cancel($id)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->update(['status' => 'canceled']);


        return back();
    }
}
