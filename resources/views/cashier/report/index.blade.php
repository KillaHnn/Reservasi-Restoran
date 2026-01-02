@extends('layouts.app')

@section('title', 'Cashier Report')
@section('page_title', 'Laporan Kasir')

@section('content')
    <div class="container-fluid py-4">

        {{-- Filter Card --}}
        <div class="card border-0 shadow-sm rounded-4 mb-4">
            <div class="card-header bg-white py-3 border-0">
                <h5 class="fw-bold mb-0 text-dark"><i class="fas fa-filter me-2 text-muted"></i>Filter Laporan</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('cashier.report.index') }}" method="GET" class="row g-3">
                    <div class="col-md-3">
                        <label class="small fw-bold text-muted text-uppercase mb-1">Berdasarkan Tanggal</label>
                        <input type="date" name="date" class="form-control rounded-pill"
                            value="{{ request('date') }}">
                    </div>

                    <div class="col-md-3">
                        <label class="small fw-bold text-muted text-uppercase mb-1">Berdasarkan Bulan</label>
                        <select name="month" class="form-select rounded-pill">
                            <option value="">Pilih Bulan</option>
                            @for ($m = 1; $m <= 12; $m++)
                                <option value="{{ $m }}" {{ request('month') == $m ? 'selected' : '' }}>
                                    {{ date('F', mktime(0, 0, 0, $m, 1)) }}
                                </option>
                            @endfor
                        </select>
                    </div>

                    <div class="col-md-2">
                        <label class="small fw-bold text-muted text-uppercase mb-1">Tahun</label>
                        <select name="year" class="form-select rounded-pill">
                            @for ($y = date('Y'); $y >= 2023; $y--)
                                <option value="{{ $y }}"
                                    {{ request('year', date('Y')) == $y ? 'selected' : '' }}>{{ $y }}</option>
                            @endfor
                        </select>
                    </div>

                    <div class="col-md-4 d-flex align-items-end gap-2">
                        <button type="submit" class="btn btn-dark rounded-pill px-4 flex-grow-1">
                            <i class="fas fa-search me-1"></i> Terapkan Filter
                        </button>
                        <a href="{{ route('cashier.report.index') }}" class="btn btn-outline-secondary rounded-pill">
                            <i class="fas fa-undo"></i>
                        </a>
                    </div>
                </form>
            </div>
        </div>

        {{-- Data Table Card --}}
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-header bg-white py-3 border-0 d-flex justify-content-between align-items-center">
                <h5 class="fw-bold mb-0 text-dark">Data Transaksi</h5>
                {{-- Tambahkan Export jika route tersedia --}}
                @if (Route::has('cashier.report.export'))
                    <form action="{{ route('cashier.report.export') }}" method="GET">
                        <input type="hidden" name="date" value="{{ request('date') }}">
                        <input type="hidden" name="month" value="{{ request('month') }}">
                        <input type="hidden" name="year" value="{{ request('year') }}">
                        <button type="submit" class="btn btn-success rounded-pill px-4 fw-bold">
                            <i class="fas fa-file-excel me-2"></i> Export Excel
                        </button>
                    </form>
                @endif
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="reportTable" class="table table-hover align-middle">
                        <thead class="bg-light text-muted">
                            <tr>
                                <th class="small fw-bold">WAKTU / TANGGAL</th>
                                <th class="small fw-bold">CUSTOMER</th>
                                <th class="small fw-bold">MEJA</th>
                                <th class="small fw-bold">STATUS</th>
                                <th class="small fw-bold">DEPOSIT</th>
                                <th class="small fw-bold">PAYMENT</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($todayLogs as $log)
                                <tr>
                                    <td>
                                        <div class="fw-bold text-dark">
                                            {{ \Carbon\Carbon::parse($log->start_time)->format('H:i') }}</div>
                                        <small
                                            class="text-muted">{{ \Carbon\Carbon::parse($log->start_time)->format('d/m/Y') }}</small>
                                    </td>
                                    <td>
                                        <div class="fw-bold">{{ $log->user->name ?? 'Guest' }}</div>
                                        <small class="text-muted">{{ $log->reservation_code ?? '#REV-' . $log->id }}</small>
                                    </td>
                                    <td>
                                        <span class="badge bg-secondary-subtle text-secondary rounded-pill px-3">
                                            Meja {{ $log->table->table_number ?? $log->table_id }}
                                        </span>
                                    </td>
                                    <td>
                                        @php
                                            $statusClass =
                                                [
                                                    'completed' => 'bg-success',
                                                    'pending' => 'bg-warning text-dark',
                                                    'confirmed' => 'bg-info text-white',
                                                    'cancelled' => 'bg-danger',
                                                ][$log->status] ?? 'bg-secondary';
                                        @endphp
                                        <span class="badge rounded-pill {{ $statusClass }} px-3">
                                            {{ strtoupper($log->status) }}
                                        </span>
                                    </td>
                                    <td class="fw-bold text-dark">
                                        Rp {{ number_format($log->payment->nominal_deposit ?? 0, 0, ',', '.') }}
                                    </td>
                                    <td>
                                        @if (($log->payment->status_payment ?? '') == 'paid')
                                            <span class="text-success small fw-bold"><i
                                                    class="fas fa-check-circle me-1"></i>LUNAS
                                                ({{ $log->payment->payment_method ?? '-' }})</span>
                                        @else
                                            <span class="text-danger small fw-bold"><i
                                                    class="fas fa-times-circle me-1"></i>PENDING</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#reportTable').DataTable({
                "order": [
                    [0, "desc"]
                ],
                "language": {
                    "search": "Cari data:",
                    "zeroRecords": "Data tidak ditemukan",
                    "paginate": {
                        "next": "<i class='fas fa-chevron-right'></i>",
                        "previous": "<i class='fas fa-chevron-left'></i>"
                    }
                }
            });
        });
    </script>
@endpush
