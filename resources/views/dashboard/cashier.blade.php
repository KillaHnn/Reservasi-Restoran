@extends('layouts.app')

@section('title', 'Premium Cashier Dashboard')

@section('content')
    <div class="container-fluid py-4">

        <div class="row mb-4">
            <div class="col-12">
                <div class="card border-0 shadow-lg overflow-hidden animate__animated animate__fadeIn"
                    style="border-radius: 25px; background: linear-gradient(135deg, #e3342f 0%, #9b1c1c 100%);">
                    <div class="card-body p-5 position-relative">
                        <div class="row align-items-center">
                            <div class="col-md-8 text-white" style="z-index: 2;">
                                <h1 class="display-5 fw-bold mb-2">Selamat Datang, {{ Auth::user()->name ?? 'Super Kasir' }}!</h1>
                                <p class="lead opacity-75 mb-4">Semangat melayani! Mari buat setiap transaksi menjadi luar
                                    biasa hari ini.</p>
                                <div class="d-flex gap-3">
                                    <span class="badge bg-white bg-opacity-25 p-2 px-3 rounded-pill">
                                        <i class="fas fa-clock me-1"></i> <span id="real-clock">00:00:00</span>
                                    </span>
                                    <span class="badge bg-white bg-opacity-25 p-2 px-3 rounded-pill">
                                        <i class="fas fa-calendar-alt me-1"></i> {{ date('d M Y') }}
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-4 text-end d-none d-md-block">
                                <i class="fas fa-fire fa-8x text-white opacity-25 float-animation"></i>
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
                            <small class="text-muted fw-bold">RESERVASI HARI INI</small>
                            <h2 class="fw-bold mt-1 mb-0 text-dark">24</h2>
                        </div>
                        <div class="icon-box bg-danger-gradient shadow-danger">
                            <i class="fas fa-calendar-check text-white"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card border-0 shadow-sm card-hover h-100 p-3" style="border-radius: 20px;">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <small class="text-muted fw-bold">STATUS PAID</small>
                            <h2 class="fw-bold mt-1 mb-0 text-dark">18</h2>
                        </div>
                        <div class="icon-box bg-success-gradient shadow-success">
                            <i class="fas fa-check-double text-white"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card border-0 shadow-sm card-hover h-100 p-3" style="border-radius: 20px;">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <small class="text-muted fw-bold">MEJA TERISI</small>
                            <h2 class="fw-bold mt-1 mb-0 text-dark">12</h2>
                        </div>
                        <div class="icon-box bg-info-gradient shadow-info">
                            <i class="fas fa-chair text-white"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card border-0 shadow-sm card-hover h-100 p-3" style="border-radius: 20px;">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <small class="text-muted fw-bold">WAITING LIST</small>
                            <h2 class="fw-bold mt-1 mb-0 text-dark">6</h2>
                        </div>
                        <div class="icon-box bg-warning-gradient shadow-warning">
                            <i class="fas fa-user-clock text-white"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-4">
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm p-4 h-100" style="border-radius: 25px;">
                    <div class="d-flex align-items-center mb-4">
                        <div class="p-2 bg-danger-subtle rounded-3 me-3">
                            <i class="fas fa-bolt text-danger"></i>
                        </div>
                        <h5 class="fw-bold mb-0 text-dark">Antrean Check-in Terdekat</h5>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-middle">
                            <tbody>
                                <tr>
                                    <td style="width: 50px;">
                                        <img src="https://ui-avatars.com/api/?name=Rizky&background=e3342f&color=fff"
                                            class="rounded-circle" width="45">
                                    </td>
                                    <td>
                                        <h6 class="fw-bold mb-0">Rizky Perdana</h6>
                                        <small class="text-muted">Table M-01 • 4 Pax</small>
                                    </td>
                                    <td class="text-end">
                                        <span
                                            class="badge bg-light text-dark rounded-pill border mb-2 d-inline-block px-3">19:00</span>
                                        <button
                                            class="btn btn-danger btn-sm rounded-pill px-4 shadow-sm fw-bold d-block ms-auto">Process
                                            Check-in</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card border-0 shadow-sm p-4" style="border-radius: 25px; background-color: #fff5f5;">
                    <h5 class="fw-bold mb-4 text-center text-dark">Menu Navigasi</h5>
                    <div class="row g-3">
                        <div class="col-6">
                            <a href="#" class="btn btn-white w-100 py-4 border-0 shadow-sm shortcut-card">
                                <i class="fas fa-user-check d-block fa-2x text-danger mb-2"></i>
                                <span class="fw-bold small d-block">Check-in</span>
                            </a>
                        </div>
                        <div class="col-6">
                            <button class="btn btn-white w-100 py-4 border-0 shadow-sm shortcut-card">
                                <i class="fas fa-table d-block fa-2x text-danger mb-2"></i>
                                <span class="fw-bold small d-block">Peta Meja</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .bg-danger-gradient {
            background: linear-gradient(45deg, #e3342f, #9b1c1c);
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

        .bg-danger-subtle {
            background-color: #ffe5e5;
        }

        .shadow-danger {
            box-shadow: 0 4px 15px rgba(227, 52, 47, 0.4);
        }

        .shadow-success {
            box-shadow: 0 4px 15px rgba(28, 200, 138, 0.4);
        }

        .shadow-info {
            box-shadow: 0 4px 15px rgba(54, 185, 204, 0.4);
        }

        .shadow-warning {
            box-shadow: 0 4px 15px rgba(246, 194, 62, 0.4);
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
                transform: translateY(-20px);
            }
        }

        .card-hover {
            transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        .card-hover:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1) !important;
        }

        .shortcut-card {
            background: white;
            border-radius: 20px;
            transition: all 0.3s ease;
            text-decoration: none;
            color: #333;
        }

        .shortcut-card:hover {
            background: #e3342f !important;
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

        .table-responsive::-webkit-scrollbar {
            height: 5px;
        }

        .table-responsive::-webkit-scrollbar-thumb {
            background: #e3342f;
            border-radius: 10px;
        }
    </style>
@endsection

@push('scripts')
    <script>
        function updateClock() {
            const now = new Date();
            const hours = String(now.getHours()).padStart(2, '0');
            const minutes = String(now.getMinutes()).padStart(2, '0');
            const seconds = String(now.getSeconds()).padStart(2, '0');
            document.getElementById('real-clock').innerText = `${hours}:${minutes}:${seconds}`;
        }
        setInterval(updateClock, 1000);
        updateClock();
    </script>
@endpush
