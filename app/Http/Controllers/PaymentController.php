<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function indexCustomer()
    {
        return view('customer.payments.index');
    }
}