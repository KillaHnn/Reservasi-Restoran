<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Table;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('customer.reservations.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'reservation_date' => 'required|date',
            'start_time' => 'required',
            'guest_count' => 'required|integer|min:1',
        ]);


        $start = Carbon::parse($request->start_time);
        $end = $start->copy()->addHours(2);


        $table = Table::where('status', 'active')
            ->where('capacity', '>=', $request->guest_count)
            ->get()
            ->first(function ($table) use ($request, $start, $end) {
                return !Reservation::where('table_id', $table->id)
                    ->where('reservation_date', $request->reservation_date)
                    ->whereIn('status', ['pending', 'confirmed'])
                    ->where(function ($q) use ($start, $end) {
                        $q->where('start_time', '<', $end)
                            ->where('end_time', '>', $start);
                    })->exists();
            });


        if (!$table) {
            return back()->withErrors('Meja tidak tersedia');
        }


        Reservation::create([
            'user_id' => Auth::id(),
            'table_id' => $table->id,
            'reservation_date' => $request->reservation_date,
            'phone_number' => $request->phone_number,
            'start_time' => $start,
            'end_time' => $end,
            'guest_count' => $request->guest_count,
            'special_note' => $request->special_note,
            'status' => 'pending'
        ]);


        return redirect()->route('customer.dashboard')->with('success', 'Reservation created successfully');
    }

    public function history() 
    {
        return view ('history.index');
    }

    public function review (Request $request)
    {
        return view('customer.reservations.review');
    }
}
