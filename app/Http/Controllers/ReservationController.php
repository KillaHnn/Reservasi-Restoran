<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Table;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReservationController extends Controller
{
    public function index(Request $request)
    {
        $date = $request->input('reservation_date', date('Y-m-d'));
        $start = $request->input('start_time', '18:00');
        $end = $request->input('end_time', '20:00');

        $bookedTableIds = Reservation::where('reservation_date', $date)
            ->whereIn('status', ['pending', 'confirmed', 'seated'])
            ->where(function ($q) use ($start, $end) {
                $q->where('start_time', '<', $end)
                    ->where('end_time', '>', $start);
            })
            ->pluck('table_id')
            ->toArray();

        $tables = Table::all();

        return view('customer.reservations.index', compact('tables', 'bookedTableIds', 'date', 'start', 'end'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'reservation_date' => 'required|date|after_or_equal:today',
            'start_time'       => 'required',
            'end_time'         => 'required|after:start_time',
            'guest_count'      => 'required|integer|min:1',
            'table_id'         => 'required|exists:tables,id',
            'special_note'     => 'nullable|string',
        ], [
            'end_time.after' => 'Jam selesai harus lebih besar dari jam mulai.',
            'reservation_date.after_or_equal' => 'Tanggal reservasi tidak boleh tanggal yang sudah lewat.',
        ]);

        $start = Carbon::parse($request->start_time)->format('H:i');
        $end = Carbon::parse($request->end_time)->format('H:i');

        $table = Table::find($request->table_id);
        if (!$table || $table->status !== 'active') {
            return back()->withErrors(['table' => 'Maaf, meja ini sedang tidak aktif.'])->withInput();
        }

        if ($table->capacity < $request->guest_count) {
            return back()->withErrors(['guest' => "Meja ini hanya untuk maksimal {$table->capacity} orang."])->withInput();
        }

        $conflictingReservation = Reservation::where('table_id', $table->id)
            ->where('reservation_date', $request->reservation_date)
            ->whereIn('status', ['pending', 'confirmed'])
            ->where(function ($q) use ($start, $end) {
                $q->where('start_time', '<', $end)
                    ->where('end_time', '>', $start);
            })->exists();

        if ($conflictingReservation) {
            return back()->withErrors(['conflict' => 'Meja sudah dipesan pada jam tersebut. Silakan pilih jam atau meja lain.'])->withInput();
        }

        try {
            $reservation = Reservation::create([
                'user_id'          => Auth::id(),
                'table_id'         => $table->id,
                'reservation_date' => $request->reservation_date,
                'start_time'       => $start,
                'end_time'         => $end,
                'guest_count'      => $request->guest_count,
                'special_note'     => $request->special_note,
                'status'           => 'pending'
            ]);

            return redirect()->route('reservations.review', $reservation->id)
                ->with('success', 'Reservasi berhasil dibuat! Silakan lakukan pembayaran deposit.');
        } catch (\Exception $e) {
            return back()->withErrors(['system' => 'Terjadi kesalahan sistem, silakan coba lagi.'])->withInput();
        }
    }

    public function cancel($id)
    {
        $reservation = Reservation::findOrFail($id);

        if ($reservation->user_id !== Auth::id()) {
            return back()->with('error', 'Anda tidak memiliki akses untuk aksi ini.');
        }

        if (in_array(strtolower($reservation->status), ['confirmed', 'completed', 'cancelled'])) {
            return back()->with('error', 'Reservasi ini sudah tidak dapat dibatalkan.');
        }

        try {
            DB::transaction(function () use ($reservation) {

                $reservation->update([
                    'status' => 'cancelled'
                ]);

                $reservation->table->update([
                    'status' => 'active'
                ]);
            });

            return back()->with('success', 'Reservasi berhasil dibatalkan.');
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan saat membatalkan reservasi.');
        }
    }
    
    public function review(Request $request, $id = null)
    {
        if ($id) {
            $reservation = Reservation::findOrFail($id);
            return view('customer.reservations.review', compact('reservation'));
        }
        return view('customer.reservations.review');
    }
}
