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
            'end_time' => 'required',
            'guest_count' => 'required|integer|min:1',
            'table_id' => 'required|exists:tables,id',
            'special_note' => 'nullable|string',
        ]);

        $start = Carbon::parse($request->start_time);
        $end = Carbon::parse($request->end_time);

        // Check if the selected table is available
        $table = Table::find($request->table_id);
        if (!$table || $table->status !== 'active' || $table->capacity < $request->guest_count) {
            return back()->withErrors('Meja tidak tersedia atau tidak sesuai kapasitas');
        }

        // Check for conflicting reservations
        $conflictingReservation = Reservation::where('table_id', $table->id)
            ->where('reservation_date', $request->reservation_date)
            ->whereIn('status', ['pending', 'confirmed'])
            ->where(function ($q) use ($start, $end) {
                $q->where('start_time', '<', $end)
                    ->where('end_time', '>', $start);
            })->exists();

        if ($conflictingReservation) {
            return back()->withErrors('Meja sudah dipesan pada waktu tersebut');
        }

        $reservation = Reservation::create([
            'user_id' => Auth::id(),
            'table_id' => $table->id,
            'reservation_date' => $request->reservation_date,
            'start_time' => $start->format('H'),
            'end_time' => $end->format('H'),
            'guest_count' => $request->guest_count,
            'special_note' => $request->special_note,
            'status' => 'pending'
        ]);

        return redirect()->route('reservations.review', $reservation->id)->with('success', 'Reservasi berhasil dibuat');
    }

    public function history() 
    {
        return view ('history.index');
    }

    public function review (Request $request, $id = null)
    {
        if ($id) {
            $reservation = Reservation::findOrFail($id);
            return view('customer.reservations.review', compact('reservation'));
        }
        return view('customer.reservations.review');
    }
}
