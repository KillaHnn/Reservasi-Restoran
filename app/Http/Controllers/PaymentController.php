<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    public function showInstructions($method, $reservation_id)
    {
        $reservation = Reservation::findOrFail($reservation_id);

        return view('customer.payments.instructions', compact('method', 'reservation'));
    }

    public function paymentProcess(Request $request)
    {
        $request->validate([
            'reservation_id' => 'required|exists:reservations,id',
            'payment_method' => 'required|in:bca,mandiri,qris',
        ]);

        DB::beginTransaction();
        try {
            Payment::updateOrCreate(
                ['reservation_id' => $request->reservation_id], 
                [
                    'nominal_deposit' => 50000,
                    'payment_method'  => $request->payment_method,
                    'status_payment'  => 'unpaid',
                ]
            );

            DB::commit();

            return redirect()->route('payment.instructions', [
                'reservation_id' => $request->reservation_id,
                'method'         => $request->payment_method
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Gagal memproses metode pembayaran.']);
        }
    }

    public function confirmPayment()
    {
        return view('cashier.payments.confirmation');
    }
}
