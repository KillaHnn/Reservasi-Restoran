@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="card border-0 shadow-sm rounded-4 mb-4">
        <div class="card-header bg-white py-3 border-0">
            <h5 class="fw-bold mb-0 text-dark"><i class="fas fa-filter me-2"></i>Filter Laporan</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.report.index') }}" method="GET" class="row g-3">
                <div class="col-md-3">
                    <label class="small fw-bold text-muted">BERDASARKAN TANGGAL</label>
                    <input type="date" name="date" class="form-control rounded-pill" value="{{ request('date') }}">
                </div>

                <div class="col-md-3">
                    <label class="small fw-bold text-muted">BERDASARKAN BULAN</label>
                    <select name="month" class="form-select rounded-pill">
                        <option value="">Pilih Bulan</option>
                        @for($m=1; $m<=12; $m++)
                            <option value="{{ $m }}" {{ request('month') == $m ? 'selected' : '' }}>
                                {{ date('F', mktime(0, 0, 0, $m, 1)) }}
                            </option>
                        @endfor
                    </select>
                </div>

                <div class="col-md-2">
                    <label class="small fw-bold text-muted">TAHUN</label>
                    <select name="year" class="form-select rounded-pill">
                        @for($y=date('Y'); $y>=2023; $y--)
                            <option value="{{ $y }}" {{ request('year', date('Y')) == $y ? 'selected' : '' }}>{{ $y }}</option>
                        @endfor
                    </select>
                </div>

                <div class="col-md-4 d-flex align-items-end gap-2">
                    <button type="submit" class="btn btn-dark rounded-pill px-4 flex-grow-1">
                        <i class="fas fa-search me-1"></i> Terapkan Filter
                    </button>
                    <a href="{{ route('admin.report.index') }}" class="btn btn-outline-secondary rounded-pill">
                        <i class="fas fa-undo"></i>
                    </a>
                </div>
            </form>
        </div>
    </div>

    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-header bg-white py-3 border-0 d-flex justify-content-between align-items-center">
            <h5 class="fw-bold mb-0 text-dark">Data Transaksi</h5>
            <form action="{{ route('admin.report.export') }}" method="GET">
                <input type="hidden" name="date" value="{{ request('date') }}">
                <input type="hidden" name="month" value="{{ request('month') }}">
                <input type="hidden" name="year" value="{{ request('year') }}">
                <button type="submit" class="btn btn-success rounded-pill px-4 fw-bold">
                    <i class="fas fa-file-excel me-2"></i> Export Excel
                </button>
            </form>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="reportTable" class="table table-hover align-middle">
                    <thead class="bg-light">
                        <tr>
                            <th>TANGGAL</th>
                            <th>CUSTOMER</th>
                            <th>MEJA</th>
                            <th>STATUS</th>
                            <th>DEPOSIT</th>
                            <th>PAYMENT</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($reservations as $res)
                        <tr>
                            <td>{{ \Carbon\Carbon::parse($res->reservation_date)->format('d/m/Y') }}</td>
                            <td class="fw-bold">{{ $res->user->name }}</td>
                            <td>Meja {{ $res->table->table_number }}</td>
                            <td>
                                <span class="badge rounded-pill {{ $res->status == 'completed' ? 'bg-success' : ($res->status == 'cancelled' ? 'bg-danger' : 'bg-primary') }}">
                                    {{ strtoupper($res->status) }}
                                </span>
                            </td>
                            <td class="fw-bold">Rp {{ number_format($res->payment->nominal_deposit ?? 0, 0, ',', '.') }}</td>
                            <td>{{ $res->payment->payment_method ?? '-' }}</td>
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
            "order": [[ 0, "desc" ]],
            "language": {
                "search": "Cari data di tabel:",
                "zeroRecords": "Data tidak ditemukan berdasarkan filter ini"
            }
        });
    });
</script>
@endpush