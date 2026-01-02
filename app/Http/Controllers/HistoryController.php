<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Request;

class HistoryController extends Controller
{
    public function historyCustomer()
    {
        $reservations = Reservation::with('table')
            ->where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('customer.history.index', compact('reservations'));
    }

    public function historyAdmin(Request $request)
    {
        $query = Reservation::with(['user', 'table', 'payment'])->latest();
        $reservations = $query->paginate(15);
        $stats = [
            'total_income' => \App\Models\Payment::where('status_payment', 'paid')->sum('nominal_deposit'),
            'total_completed' => Reservation::where('status', 'completed')->count(),
            'total_cancelled' => Reservation::where('status', 'cancelled')->count(),
        ];

        return view('admin.history.index', compact('reservations', 'stats'));
    }

    public function historyCashier()
    {
        $reservations = Reservation::with(['user', 'table', 'payment'])->latest()->get();
        return view('cashier.history.index', compact('reservations'));
    }
}
