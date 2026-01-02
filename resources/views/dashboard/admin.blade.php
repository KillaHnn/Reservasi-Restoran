@extends('layouts.app')

@section('title', 'Admin Strategy Dashboard')

@section('content')
    <div class="container-fluid py-4">

        {{-- Header --}}
        <div class="row mb-4">
            <div class="col-12">
                <div class="card border-0 shadow-lg overflow-hidden animate__animated animate__fadeIn"
                    style="border-radius: 25px; background: linear-gradient(135deg, #1a202c 0%, #2d3748 100%);">
                    <div class="card-body p-5">
                        <div class="row align-items-center text-white">
                            <div class="col-md-8">
                                <h1 class="display-5 fw-bold mb-2">Ringkasan Eksekutif</h1>
                                <p class="lead opacity-75 mb-4">Analisis data reservasi dan performa restoran dalam satu dashboard.</p>
                                <div class="d-flex gap-2">
                                    <span class="badge bg-white bg-opacity-10 p-2 px-3 rounded-pill border border-white border-opacity-25 small">
                                        <i class="fas fa-calendar-alt me-1"></i> {{ date('l, d M Y') }}
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-4 text-end d-none d-md-block">
                                <i class="fas fa-chart-line fa-7x opacity-25 float-animation"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Stats Cards --}}
        <div class="row g-4 mb-5">
            {{-- Revenue --}}
            <div class="col-md-3">
                <div class="card border-0 shadow-sm card-hover h-100 p-3" style="border-radius: 20px;">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <small class="text-muted fw-bold">TOTAL PENDAPATAN</small>
                            <h2 class="fw-bold mt-1 mb-0 text-dark">Rp {{ $totalRevenue }}</h2>
                            <small class="text-success fw-bold"><i class="fas fa-check-circle"></i> Terverifikasi</small>
                        </div>
                        <div class="icon-box bg-primary-gradient shadow-primary">
                            <i class="fas fa-wallet text-white"></i>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Pelanggan --}}
            <div class="col-md-3">
                <div class="card border-0 shadow-sm card-hover h-100 p-3" style="border-radius: 20px;">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <small class="text-muted fw-bold">PELANGGAN</small>
                            <h2 class="fw-bold mt-1 mb-0 text-dark">{{ $customerToday }}</h2>
                            <small class="text-primary fw-bold">Tamu hari ini</small>
                        </div>
                        <div class="icon-box bg-primary-gradient shadow-primary">
                            <i class="fas fa-users text-white"></i>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Reservasi Pending --}}
            <div class="col-md-3">
                <div class="card border-0 shadow-sm card-hover h-100 p-3" style="border-radius: 20px;">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <small class="text-muted fw-bold">BUTUH KONFIRMASI</small>
                            <h2 class="fw-bold mt-1 mb-0 text-warning">{{ $pendingReservations }}</h2>
                            <small class="text-muted fw-bold">Reservasi pending</small>
                        </div>
                        <div class="icon-box bg-warning-gradient shadow-warning">
                            <i class="fas fa-clock text-white"></i>
                        </div>
                    </div>
                </div>
            </div>
            
            {{-- Okupansi Meja --}}
            <div class="col-md-3">
                <div class="card border-0 shadow-sm card-hover h-100 p-3" style="border-radius: 20px;">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <small class="text-muted fw-bold">OKUPANSI MEJA</small>
                            <h2 class="fw-bold mt-1 mb-0 text-dark">{{ $occupancyRate }}%</h2>
                            <small class="text-info fw-bold">{{ $availableTables }} Meja Kosong</small>
                        </div>
                        <div class="icon-box bg-danger-gradient shadow-danger">
                            <i class="fas fa-chair text-white"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-4">
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm p-4 h-100" style="border-radius: 25px;">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div class="d-flex align-items-center">
                            <div class="p-2 bg-primary-subtle rounded-3 me-3 text-primary">
                                <i class="fas fa-chart-area"></i>
                            </div>
                            <h5 class="fw-bold mb-0 text-dark">Tren Kunjungan Mingguan</h5>
                        </div>
                    </div>
                    <div style="height: 300px;">
                        <canvas id="visitorChart"></canvas>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card border-0 shadow-sm p-4" style="border-radius: 25px; background-color: #f8fafc;">
                    <h5 class="fw-bold mb-4 text-dark text-center">Kontrol Manajemen</h5>
                    <div class="row g-3">
                       
                        <div class="col-6">
                            <a href="{{ route('admin.tables.index') }}" class="btn btn-white w-100 py-4 border-0 shadow-sm shortcut-card text-center">
                                <i class="fas fa-table d-block fa-2x text-success mb-2"></i>
                                <span class="fw-bold small d-block">Meja</span>
                            </a>
                        </div>
                        <div class="col-6">
                            <a href="{{ route('admin.report.index') }}" class="btn btn-white w-100 py-4 border-0 shadow-sm shortcut-card text-center">
                                <i class="fas fa-file-invoice-dollar d-block fa-2x text-info mb-2"></i>
                                <span class="fw-bold small d-block">Laporan</span>
                            </a>
                        </div>
                        <div class="col-6">
                            <a href="{{ route('admin.users.index') }}" class="btn btn-white w-100 py-4 border-0 shadow-sm shortcut-card text-center">
                                <i class="fas fa-user-cog d-block fa-2x text-secondary mb-2"></i>
                                <span class="fw-bold small d-block">User</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .bg-primary-gradient { background: linear-gradient(45deg, #4e73df, #224abe); }
        .bg-warning-gradient { background: linear-gradient(45deg, #f6c23e, #dda20a); }
        .bg-danger-gradient { background: linear-gradient(45deg, #e74a3b, #be2617); }
        .icon-box { width: 50px; height: 50px; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 1.2rem; }
        .card-hover { transition: transform 0.2s ease; }
        .card-hover:hover { transform: translateY(-5px); }
        .shortcut-card { text-decoration: none; }
        .shortcut-card:hover { background: #1a202c !important; color: white !important; }
        .shortcut-card:hover i { color: white !important; }
        .btn-white { background: white; }
    </style>
@endsection
@push('scripts')
        <script>
        const ctx = document.getElementById('visitorChart').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: {!! json_encode($labels) !!},
                datasets: [{
                    label: 'Reservasi',
                    data: {!! json_encode($values) !!},
                    borderColor: '#4e73df',
                    backgroundColor: 'rgba(78, 115, 223, 0.05)',
                    fill: true,
                    tension: 0.4,
                    pointRadius: 4,
                    pointBackgroundColor: '#4e73df',
                    borderWidth: 3
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: {
                    y: { 
                        beginAtZero: true, 
                        ticks: { stepSize: 1, precision: 0 } 
                    },
                    x: { grid: { display: false } }
                }
            }
        });
    </script>
@endpush