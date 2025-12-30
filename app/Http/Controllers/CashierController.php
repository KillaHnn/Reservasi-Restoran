<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;
use Carbon\Carbon;

class CashierController extends Controller
{
    public function cashierIndex()
    {
        $today = now()->toDateString();

        // Mengambil reservasi yang SUDAH PAID di tabel payments
        $reservations = Reservation::with(['user', 'table', 'payment'])
            ->where('reservation_date', $today)
            // Filter: Hanya yang memiliki payment dengan status 'paid'
            ->whereHas('payment', function ($query) {
                $query->where('status_payment', 'paid');
            })
            // Filter: Hanya yang belum selesai/batal (masih confirmed atau pending)
            ->whereIn('status', ['confirmed', 'pending'])
            ->orderBy('start_time', 'asc')
            ->get();

        return view('cashier.checkin.check_in', compact('reservations'));
    }

    public function checkIn($id)
    {
        try {
            // Validasi ulang untuk memastikan memang sudah dibayar
            $reservation = Reservation::whereHas('payment', function ($q) {
                $q->where('status_payment', 'paid');
            })->findOrFail($id);

            // Update status reservasi menjadi 'confirmed' (atau 'seated' jika Anda menambahkannya di enum)
            $reservation->update(['status' => 'confirmed']);

            // Update status meja menjadi terisi
            if ($reservation->table) {
                $reservation->table->update(['status' => 'occupied']);
            }

            return response()->json([
                'success' => true,
                'message' => 'Tamu berhasil check-in. Meja ' . $reservation->table->name . ' telah dipesan.'
            ]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Gagal check-in atau pembayaran belum lunas.'], 403);
        }
    }

    public function checkOut($id)
    {
        try {
            $reservation = Reservation::findOrFail($id);
            
            // Set status menjadi completed (selesai)
            $reservation->update(['status' => 'completed']);
            
            // Kembalikan status meja menjadi active (kosong)
            if ($reservation->table) {
                $reservation->table->update(['status' => 'active']);
            }

            return response()->json([
                'success' => true,
                'message' => 'Check-out berhasil. Meja sekarang kosong.'
            ]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Gagal proses check-out'], 500);
        }
    }
}