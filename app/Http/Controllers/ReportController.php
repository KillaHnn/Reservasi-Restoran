<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ReportController extends Controller
{
    public function reportAdmin(Request $request)
    {
        $query = Reservation::with(['user', 'table', 'payment'])->latest();

        if ($request->filled('date')) {
            $query->whereDate('reservation_date', $request->date);
        }

        if ($request->filled('month')) {
            $query->whereMonth('reservation_date', $request->month);
        }

        if ($request->filled('year')) {
            $query->whereYear('reservation_date', $request->year);
        }

        $reservations = $query->get();

        return view('admin.report.index', compact('reservations'));
    }

    public function reportCashier(Request $request)
    {
        $today = today();

        $query = Reservation::with(['user', 'payment', 'table']);

        if ($request->filled('date')) {
            $query->whereDate('start_time', $request->date);
        } elseif ($request->filled('month') && $request->filled('year')) {
            $query->whereMonth('start_time', $request->month)
                ->whereYear('start_time', $request->year);
        } elseif ($request->filled('year')) {
            $query->whereYear('start_time', $request->year);
        } else {
            $query->whereDate('start_time', $today);
        }

        $todayLogs = $query->latest()->get();

        return view('cashier.report.index', compact('todayLogs'));
    }

    public function exportExcel(Request $request): StreamedResponse
    {
        $reservations = Reservation::with(['user', 'table', 'payment'])
            ->when($request->date, fn($q) => $q->whereDate('reservation_date', $request->date))
            ->when($request->month, fn($q) => $q->whereMonth('reservation_date', $request->month))
            ->when($request->year, fn($q) => $q->whereYear('reservation_date', $request->year))
            ->latest()
            ->get();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->fromArray(['ID', 'TANGGAL', 'CUSTOMER', 'MEJA', 'STATUS', 'DEPOSIT', 'METODE'], NULL, 'A1');
        $sheet->getStyle('A1:G1')->getFont()->setBold(true);

        $row = 2;

        foreach ($reservations as $res) {
            $sheet->setCellValue("A$row", $res->id);
            $sheet->setCellValue("B$row", $res->reservation_date);

            $sheet->setCellValue("C$row", $res->user?->name ?? 'Guest');
            $sheet->setCellValue("D$row", "Meja " . ($res->table?->table_number ?? '-'));
            $sheet->setCellValue("E$row", strtoupper($res->status ?? 'PENDING'));
            $sheet->setCellValue("F$row", $res->payment?->nominal_deposit ?? 0);
            $sheet->setCellValue("G$row", $res->payment?->payment_method ?? '-');

            $row++;
        }

        foreach (range('A', 'G') as $col) $sheet->getColumnDimension($col)->setAutoSize(true);

        $fileName = 'Laporan-' . now()->format('Y-m-d') . '.xlsx';
        $writer = new Xlsx($spreadsheet);

        return response()->stream(function () use ($writer) {
            $writer->save('php://output');
        }, 200, [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
        ]);
    }
}
