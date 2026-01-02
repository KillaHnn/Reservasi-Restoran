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

    public function showConfirmation()
    {
        $payments = Payment::with(['reservation.user', 'reservation.table'])
            ->where('status_payment', 'unpaid')
            ->get();

        return view('cashier.payments.confirmation', compact('payments'));
    }

    public function confirmPayment(Request $request)
    {
        $request->validate([
            'reservation_id' => 'required|exists:reservations,id',
        ]);

        $payment = Payment::where('reservation_id', $request->reservation_id)->first();

        if ($payment) {
            $payment->update(['status_payment' => 'paid']);
            return response()->json(['success' => true, 'message' => 'Payment confirmed successfully.']);
        }

        return response()->json(['success' => false, 'message' => 'Payment not found.'], 404);
    }
}
