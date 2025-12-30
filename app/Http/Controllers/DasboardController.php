<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DasboardController extends Controller
{
    public function admin()
    {
        return view('dashboard.admin');
    }

    public function cashier()
    {
        return view('dashboard.cashier');
    }

    public function customer()
    {
        return view('dashboard.customer');
    }
}
