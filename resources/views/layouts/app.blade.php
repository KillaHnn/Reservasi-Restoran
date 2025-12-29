<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') | Luxury Resto</title>

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;700&display=swap"
        rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/template.css') }}">
</head>

<body>

    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <nav class="mobile-nav d-lg-none">
        <a href="#" class="brand-text">LUXE RESTO</a>
        <button class="btn border-0 text-white" id="toggleSidebar">
            <i class="fas fa-bars fa-lg"></i>
        </button>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <nav class="col-md-2 sidebar shadow" id="mainSidebar">
                <div class="text-center mb-5 d-none d-lg-block">
                    <h3 class="fw-bold" style="color: var(--accent)">LUXE <span class="text-white">RESTO</span></h3>
                    <hr style="border-color: var(--accent)">
                </div>

                <div class="text-center mb-4 d-lg-none">
                    <h4 class="fw-bold text-white">LUXE <span style="color: var(--accent)">RESTO</span></h4>
                </div>

                <div class="nav flex-column h-100">
                    <a class="nav-link {{ request()->is('*/dashboard') ? 'active' : '' }}" href="#">
                        <i class="fas fa-chart-line"></i> Dashboard
                    </a>

                    @if (Auth::user()->role == 'admin')
                        <div class="small fw-bold text-uppercase mt-4 mb-2" style="color: var(--accent); opacity: 0.6">
                            Management</div>
                        <a class="nav-link" href="#"><i class="fas fa-users"></i> Manage Users</a>
                        <a class="nav-link" href="#"><i class="fas fa-utensils"></i> Manage Menu</a>
                        <a class="nav-link" href="#"><i class="fas fa-file-invoice-dollar"></i> Reports</a>
                    @elseif(Auth::user()->role == 'cashier')
                        <div class="small fw-bold text-uppercase mt-4 mb-2" style="color: var(--accent); opacity: 0.6">
                            Transaction</div>
                        <a class="nav-link" href="#"><i class="fas fa-cash-register"></i> Point of Sale</a>
                        <a class="nav-link" href="#"><i class="fas fa-list-check"></i> Orders List</a>
                    @elseif(Auth::user()->role == 'customer')
                        <div class="small fw-bold text-uppercase mt-4 mb-2" style="color: var(--accent); opacity: 0.6">
                            Reservation</div>
                        <a class="nav-link" href="#"><i class="fas fa-calendar-plus"></i> Book Table</a>
                        <a class="nav-link" href="#"><i class="fas fa-history"></i> My History</a>
                    @endif

                    <div class="mt-auto pb-4">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn w-100 fw-bold"
                                style="color: var(--accent); border: 1px solid var(--accent)">
                                <i class="fas fa-sign-out-alt"></i> Logout
                            </button>
                        </form>
                    </div>
                </div>
            </nav>

            <main class="col-md-10 main-content">
                <header class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
                    <h2 class="fw-bold" style="color: var(--primary)">@yield('page_title')</h2>

                    <div class="d-flex align-items-center gap-3 bg-white p-2 rounded-pill shadow-sm px-4">
                        <span
                            class="badge badge-status text-uppercase d-none d-sm-inline">{{ Auth::user()->role }}</span>
                        <span class="fw-bold small">{{ Auth::user()->name }}</span>
                        <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}&background=A31B31&color=FFC069"
                            class="rounded-circle" width="35">
                    </div>
                </header>

                @yield('content')
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const toggleBtn = document.getElementById('toggleSidebar');
            const sidebar = document.getElementById('mainSidebar');
            const overlay = document.getElementById('sidebarOverlay');

            if (toggleBtn && sidebar && overlay) {
                toggleBtn.addEventListener('click', function() {
                    sidebar.classList.toggle('show');
                    overlay.classList.toggle('show');
                });

                overlay.addEventListener('click', function() {
                    sidebar.classList.remove('show');
                    overlay.classList.remove('show');
                });
            }
        });
    </script>
</body>

</html>
