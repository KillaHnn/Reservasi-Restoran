<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;
use Carbon\Carbon;

class CashierController extends Controller
{
    public function checkinIndex()
    {
        date_default_timezone_set('Asia/Jakarta');
        $today = date('Y-m-d');

        // Menampilkan tamu yang SUDAH BAYAR tapi statusnya masih PENDING (belum masuk)
        $reservations = Reservation::with(['user', 'table', 'payment'])
            ->whereDate('reservation_date', $today)
            ->where('status', 'pending')
            ->whereHas('payment', function ($q) {
                $q->where('status_payment', 'paid');
            })
            ->get();

        return view('cashier.checkin.check_in', compact('reservations'));
    }

    public function activeTablesIndex()
    {
        date_default_timezone_set('Asia/Jakarta');
        $today = date('Y-m-d');

        // Menampilkan tamu yang SUDAH MASUK (status confirmed/seated) dan mejanya occupied
        $reservations = Reservation::with(['user', 'table', 'payment'])
            ->whereDate('reservation_date', $today)
            ->where('status', 'confirmed')
            ->get();

        return view('cashier.checkin.active_tables', compact('reservations'));
    }

    public function checkIn($id)
    {
        try {
            $reservation = Reservation::whereHas('payment', function ($q) {
                $q->where('status_payment', 'paid');
            })->findOrFail($id);

            $reservation->update(['status' => 'confirmed']);

            if ($reservation->table) {
                $reservation->table->update(['status' => 'inactive']);
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
            $reservation->update(['status' => 'completed']);

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
