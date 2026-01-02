<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Reservation;
use App\Models\Table;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth as FacadesAuth;

class DasboardController extends Controller
{
    public function admin()
    {
        $rawRevenue = Payment::where('status_payment', 'paid')->sum('nominal_deposit');
        $totalRevenue = $this->formatNumber($rawRevenue);

        $customerToday = Reservation::whereDate('reservation_date', Carbon::today())
            ->whereIn('status', ['confirmed', 'completed'])
            ->count();

        $pendingReservations = Reservation::where('status', 'pending')->count();

        $totalTables = Table::count();
        $occupiedTables = Table::where('status', 'inactive')->count();
        $availableTables = Table::where('status', 'active')->count();

        $occupancyRate = ($totalTables > 0) ? round(($occupiedTables / $totalTables) * 100) : 0;

        $days = [];
        $values = [];

        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::today()->subDays($i);
            $days[] = $date->format('d M');

            $count = Reservation::whereDate('reservation_date', $date)->count();
            $values[] = $count;
        }

        $labels = $days;

        return view('dashboard.admin', compact(
            'totalRevenue',
            'customerToday',
            'pendingReservations',
            'availableTables',
            'occupancyRate',
            'labels',
            'values'
        ));
    }

    private function formatNumber($number)
    {
        if ($number >= 1000000000) {
            return round($number / 1000000000, 1) . 'B';
        } elseif ($number >= 1000000) {
            return round($number / 1000000, 1) . 'M';
        } elseif ($number >= 1000) {
            return round($number / 1000, 1) . 'K';
        }
        return number_format($number, 0, ',', '.');
    }


    public function cashier()
    {
        $today = today();
        $todayReservationsCount = Reservation::whereDate('start_time', $today)
            ->where('status', '!=', 'cancelled')
            ->count();

        $paidCount = Reservation::whereDate('start_time', $today)
            ->whereHas('payment', function ($query) {
                $query->where('status_payment', 'paid');
            })
            ->count();

        $activeTablesCount = Reservation::where('status', 'confirmed')
            ->whereDate('start_time', $today)
            ->count();

        $waitingCount = Reservation::where('status', 'pending')
            ->whereDate('start_time', $today)
            ->count();

        $upcomingCheckins = Reservation::with(['user', 'table'])
            ->whereDate('start_time', $today)
            ->whereIn('status', ['pending'])
            ->orderBy('start_time', 'asc')
            ->take(5)
            ->get();

        $todayRevenue = Payment::where('status_payment', 'paid')
            ->whereDate('created_at', $today)
            ->sum('nominal_deposit');

        return view('dashboard.cashier', compact(
            'todayReservationsCount',
            'paidCount',
            'activeTablesCount',
            'waitingCount',
            'upcomingCheckins',
            'todayRevenue'
        ));
    }

    public function customer()
    {
        $userId = FacadesAuth::id();

        $totalBookings = Reservation::where('user_id', $userId)->count();

        $pendingPayments = Reservation::where('user_id', $userId)
            ->whereHas('payment', function ($query) {
                $query->where('status_payment', 'unpaid');
            })->count();

        $visitsThisMonth = Reservation::where('user_id', $userId)
            ->whereIn('status', ['confirmed', 'completed'])
            ->whereMonth('reservation_date', Carbon::now()->month)
            ->whereYear('reservation_date', Carbon::now()->year)
            ->count();

        $recentReservations = Reservation::with(['table', 'payment'])
            ->where('user_id', $userId)
            ->orderBy('reservation_date', 'desc')
            ->orderBy('start_time', 'desc')
            ->limit(5)
            ->get();

        return view('dashboard.customer', compact(
            'totalBookings',
            'pendingPayments',
            'visitsThisMonth',
            'recentReservations'
        ));
    }
}
