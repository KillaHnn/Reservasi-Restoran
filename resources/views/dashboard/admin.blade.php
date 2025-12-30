@extends('layouts.app')

@section('title', 'Admin Strategy Dashboard')

@section('content')
    <div class="container-fluid py-4">

        <div class="row mb-4">
            <div class="col-12">
                <div class="card border-0 shadow-lg overflow-hidden animate__animated animate__fadeIn"
                    style="border-radius: 25px; background: linear-gradient(135deg, #1a202c 0%, #2d3748 100%);">
                    <div class="card-body p-5 position-relative">
                        <div class="row align-items-center">
                            <div class="col-md-8 text-white" style="z-index: 2;">
                                <h1 class="display-5 fw-bold mb-2">Ringkasan Eksekutif</h1>
                                <p class="lead opacity-75 mb-4">Pantau performa bisnis dan kelola operasional sistem dalam
                                    satu kendali.</p>
                                <div class="d-flex gap-3">
                                    <span
                                        class="badge bg-white bg-opacity-10 p-2 px-3 rounded-pill border border-white border-opacity-25">
                                        <i class="fas fa-user-shield me-1"></i> Admin Mode
                                    </span>
                                    <span
                                        class="badge bg-white bg-opacity-10 p-2 px-3 rounded-pill border border-white border-opacity-25">
                                        <i class="fas fa-calendar-alt me-1"></i> {{ date('l, d M Y') }}
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-4 text-end d-none d-md-block">
                                <i class="fas fa-chart-line fa-8x text-white opacity-25 float-animation"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-4 mb-5">
            <div class="col-md-3">
                <div class="card border-0 shadow-sm card-hover h-100 p-3" style="border-radius: 20px;">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <small class="text-muted fw-bold">TOTAL PENDAPATAN</small>
                            <h2 class="fw-bold mt-1 mb-0 text-dark">Rp 12.8M</h2>
                            <small class="text-success fw-bold"><i class="fas fa-arrow-up"></i> 12%</small>
                        </div>
                        <div class="icon-box bg-primary-gradient shadow-primary">
                            <i class="fas fa-wallet text-white"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card border-0 shadow-sm card-hover h-100 p-3" style="border-radius: 20px;">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <small class="text-muted fw-bold">TOTAL PELANGGAN</small>
                            <h2 class="fw-bold mt-1 mb-0 text-dark">482</h2>
                            <small class="text-primary fw-bold">Orang hari ini</small>
                        </div>
                        <div class="icon-box bg-primary-gradient shadow-primary">
                            <i class="fas fa-users text-white"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card border-0 shadow-sm card-hover h-100 p-3" style="border-radius: 20px;">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <small class="text-muted fw-bold">TOTAL STAF</small>
                            <h2 class="fw-bold mt-1 mb-0 text-dark">32</h2>
                            <small class="text-info fw-bold">8 Aktif Shift</small>
                        </div>
                        <div class="icon-box bg-info-gradient shadow-info">
                            <i class="fas fa-users text-white"></i>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-3">
                <div class="card border-0 shadow-sm card-hover h-100 p-3" style="border-radius: 20px;">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <small class="text-muted fw-bold">OKUPANSI MEJA</small>
                            <h2 class="fw-bold mt-1 mb-0 text-dark">85%</h2>
                            <small class="text-danger fw-bold">Jam Sibuk</small>
                        </div>
                        <div class="icon-box bg-danger-gradient shadow-danger">
                            <i class="fas fa-percentage text-white"></i>
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
                            <div class="p-2 bg-primary-subtle rounded-3 me-3">
                                <i class="fas fa-chart-area text-primary"></i>
                            </div>
                            <h5 class="fw-bold mb-0 text-dark">Tren Kunjungan Mingguan</h5>
                        </div>
                        <select class="form-select form-select-sm rounded-pill w-auto">
                            <option>7 Hari Terakhir</option>
                            <option>30 Hari Terakhir</option>
                        </select>
                    </div>
                    <div
                        class="d-flex align-items-center justify-content-center flex-column py-5 bg-light rounded-4 border-2 border-dashed">
                        <i class="fas fa-chart-bar fa-4x text-muted opacity-25 mb-3"></i>
                        <p class="text-muted mb-0">Grafik data real-time akan muncul di sini</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card border-0 shadow-sm p-4" style="border-radius: 25px; background-color: #f8fafc;">
                    <h5 class="fw-bold mb-4 text-dark">Kontrol Manajemen</h5>
                    <div class="row g-3">
                        <div class="col-6">
                            <a href="#" class="btn btn-white w-100 py-4 border-0 shadow-sm shortcut-card text-center">
                                <i class="fas fa-utensils d-block fa-2x text-primary mb-2"></i>
                                <span class="fw-bold small d-block">Kelola Menu</span>
                            </a>
                        </div>
                        <div class="col-6">
                            <a href="#" class="btn btn-white w-100 py-4 border-0 shadow-sm shortcut-card text-center">
                                <i class="fas fa-chair d-block fa-2x text-success mb-2"></i>
                                <span class="fw-bold small d-block">Denah Meja</span>
                            </a>
                        </div>
                        <div class="col-6">
                            <a href="#" class="btn btn-white w-100 py-4 border-0 shadow-sm shortcut-card text-center">
                                <i class="fas fa-user-cog d-block fa-2x text-info mb-2"></i>
                                <span class="fw-bold small d-block">Data Staf</span>
                            </a>
                        </div>
                        <div class="col-6">
                            <a href="#" class="btn btn-white w-100 py-4 border-0 shadow-sm shortcut-card text-center">
                                <i class="fas fa-cogs d-block fa-2x text-secondary mb-2"></i>
                                <span class="fw-bold small d-block">Pengaturan</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        /* Gradient Colors */
        .bg-primary-gradient {
            background: linear-gradient(45deg, #4e73df, #224abe);
        }

        .bg-success-gradient {
            background: linear-gradient(45deg, #1cc88a, #13855c);
        }

        .bg-info-gradient {
            background: linear-gradient(45deg, #36b9cc, #258391);
        }

        .bg-warning-gradient {
            background: linear-gradient(45deg, #f6c23e, #dda20a);
        }

        .bg-danger-gradient {
            background: linear-gradient(45deg, #e74a3b, #be2617);
        }

        /* Subtle Backgrounds */
        .bg-primary-subtle {
            background-color: #e0e7ff;
        }

        /* Shadows */
        .shadow-primary {
            box-shadow: 0 4px 15px rgba(78, 115, 223, 0.4);
        }

        .shadow-warning {
            box-shadow: 0 4px 15px rgba(246, 194, 62, 0.4);
        }

        .shadow-info {
            box-shadow: 0 4px 15px rgba(54, 185, 204, 0.4);
        }

        .shadow-danger {
            box-shadow: 0 4px 15px rgba(231, 74, 59, 0.4);
        }

        .icon-box {
            width: 54px;
            height: 54px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
        }

        .float-animation {
            animation: floating 3s ease-in-out infinite;
        }

        @keyframes floating {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-15px);
            }
        }

        .card-hover {
            transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        .card-hover:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1) !important;
        }

        .shortcut-card {
            background: white;
            border-radius: 20px;
            transition: all 0.3s ease;
            text-decoration: none;
            color: #333;
            display: block;
        }

        .shortcut-card:hover {
            background: #1a202c !important;
            color: white !important;
            transform: scale(1.05);
        }

        .shortcut-card:hover i {
            color: white !important;
        }

        .btn-white {
            background: white;
            color: #333;
        }

        .border-dashed {
            border-style: dashed !important;
        }
    </style>
@endsection
