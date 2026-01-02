@extends('layouts.app') {{-- Sesuaikan dengan layout admin kamu --}}

@section('content')
<div class="container-fluid py-4">
    <div class="row g-3 mb-4">
        <div class="col-md-4">
            <div class="card border-0 shadow-sm p-3 text-white" style="background: linear-gradient(135deg, #800000, #b22222); border-radius: 15px;">
                <small class="opacity-75 fw-bold">TOTAL PENDAPATAN (PAID)</small>
                <h3 class="fw-bold mb-0">Rp {{ number_format($stats['total_income'], 0, ',', '.') }}</h3>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm p-3 bg-white" style="border-radius: 15px;">
                <small class="text-muted fw-bold">RESERVASI SELESAI</small>
                <h3 class="fw-bold mb-0 text-success">{{ $stats['total_completed'] }}</h3>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm p-3 bg-white" style="border-radius: 15px;">
                <small class="text-muted fw-bold">RESERVASI BATAL</small>
                <h3 class="fw-bold mb-0 text-danger">{{ $stats['total_cancelled'] }}</h3>
            </div>
        </div>
    </div>

    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-header bg-white py-3 border-0">
            <h5 class="fw-bold mb-0 text-dark">Riwayat Seluruh Reservasi</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="historyTable" class="table table-hover align-middle w-100">
                    <thead class="bg-light">
                        <tr>
                            <th class="text-secondary small">ID</th>
                            <th class="text-secondary small">CUSTOMER</th>
                            <th class="text-secondary small">MEJA</th>
                            <th class="text-secondary small">WAKTU</th>
                            <th class="text-secondary small">STATUS</th>
                            <th class="text-secondary small">PEMBAYARAN</th>
                            <th class="text-secondary small">TOTAL</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($reservations as $res)
                        <tr>
                            <td class="fw-bold text-muted small">#RSV-{{ str_pad($res->id, 5, '0', STR_PAD_LEFT) }}</td>
                            <td>
                                <div class="fw-bold">{{ $res->user->name }}</div>
                                <small class="text-muted">{{ $res->user->email }}</small>
                            </td>
                            <td><span class="badge bg-dark rounded-pill">Meja {{ $res->table->table_number }}</span></td>
                            <td>
                                <div class="small">{{ $res->start_time->format('d/m/Y') }}</div>
                                <div class="fw-bold small">{{ $res->start_time->format('H:i') }} WIB</div>
                            </td>
                            <td>
                                @php
                                    $statusColor = [
                                        'pending' => 'warning',
                                        'confirmed' => 'primary',
                                        'completed' => 'success',
                                        'cancelled' => 'danger'
                                    ];
                                    $st = strtolower($res->status);
                                @endphp
                                <span class="badge bg-{{ $statusColor[$st] ?? 'secondary' }} text-capitalize">
                                    {{ $st }}
                                </span>
                            </td>
                            <td>
                                @if(($res->payment->status_payment ?? '') == 'paid')
                                    <span class="text-success small fw-bold"><i class="fas fa-check-circle"></i> Paid</span>
                                @else
                                    <span class="text-muted small fw-bold"><i class="fas fa-clock"></i> Unpaid</span>
                                @endif
                            </td>
                            <td class="fw-bold text-dark">
                                Rp {{ number_format($res->payment->nominal_deposit ?? 0, 0, ',', '.') }}
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
@push('styles')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
<style>
    .dataTables_wrapper .dataTables_paginate .paginate_button.current {
        background: #800000 !important;
        color: white !important;
        border: none;
    }
    table.dataTable thead th { border-bottom: 1px solid #eee !important; }
</style>
@endpush

@push('scripts')
<script>
    $(document).ready(function() {
        $('#historyTable').DataTable({
                "pageLength": 10,
                "language": {
                    "search": "",
                    "searchPlaceholder": "Search tables...",
                    "lengthMenu": "_MENU_",
                    "paginate": {
                        "previous": "<i class='fas fa-chevron-left'></i>",
                        "next": "<i class='fas fa-chevron-right'></i>"
                    }
                },
                "dom": '<"d-flex justify-content-between align-items-center mb-3"f l>rt<"d-flex justify-content-between align-items-center mt-3"i p>'
            });
    });
</script>
@endpush