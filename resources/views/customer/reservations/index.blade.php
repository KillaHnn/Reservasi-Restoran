@extends('layouts.app')

@section('title', 'Book a Table')
@section('page_title', 'Table Reservation')

@section('content')
    <div class="container py-4">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-4" role="alert"
                style="border-radius: 15px;">
                <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm mb-4" role="alert"
                style="border-radius: 15px;">
                <h6 class="fw-bold"><i class="fas fa-exclamation-circle me-2"></i> Terjadi Kesalahan:</h6>
                <ul class="mb-0 small">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <form action="{{ route('reservations.store') }}" method="POST" id="reservationForm">
            @csrf
            <div class="row g-4">
                <div class="col-lg-4">
                    <div class="card card-custom border-0 shadow-sm p-4">
                        <h5 class="fw-bold mb-4" style="color: var(--primary-color)">
                            <i class="fas fa-calendar-alt me-2"></i> Reservation Detail
                        </h5>

                        <div class="mb-3">
                            <label class="small fw-bold mb-2">RESERVATION DATE</label>
                            <input type="date" name="reservation_date" id="reservation_date"
                                class="form-control bg-light border-0 p-3 @error('reservation_date') is-invalid @enderror"
                                min="{{ date('Y-m-d') }}" required>
                        </div>

                        <div class="row">
                            <div class="col-6 mb-3">
                                <label class="small fw-bold mb-2">START TIME</label>
                                <input type="time" name="start_time" class="form-control bg-light border-0 p-3" required>
                            </div>
                            <div class="col-6 mb-3">
                                <label class="small fw-bold mb-2">END TIME</label>
                                <input type="time" name="end_time" class="form-control bg-light border-0 p-3" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="small fw-bold mb-2">GUEST COUNT</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-0"><i class="fas fa-users"></i></span>
                                <input type="number" name="guest_count"
                                    class="form-control bg-light border-0 p-3 @error('guest_count') is-invalid @enderror"
                                    placeholder="How many people?" min="1" value="{{ old('guest_count') }}" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="small fw-bold mb-2">SPECIAL NOTE (OPTIONAL)</label>
                            <textarea name="special_note" class="form-control bg-light border-0 p-3" rows="3"
                                placeholder="Eg: Birthday celebration...">{{ old('special_note') }}</textarea>
                        </div>

                        <div class="p-3 mb-3 rounded-3 shadow-sm border-start border-4"
                            style="background: #fffcf5; border-color: #ffc107 !important;">
                            <div class="d-flex justify-content-between align-items-center mb-1">
                                <span class="small fw-bold text-muted text-uppercase">Reservation Deposit</span>
                                <span class="fw-bold text-danger">Rp 50.000</span>
                            </div>
                            <p class="small text-muted mb-0" style="font-size: 0.75rem;">
                                *Deposit akan memotong total tagihan Anda nanti.
                            </p>
                        </div>

                        <div class="alert alert-info border-0 small py-2 mb-3"
                            style="border-radius: 10px; background-color: #e3f2fd;">
                            <i class="fas fa-info-circle me-1"></i> Pembayaran dilakukan di halaman berikutnya.
                        </div>

                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" id="agreeTerms" required>
                            <label class="form-check-label small" for="agreeTerms">
                                I agree to the <a href="#" data-bs-toggle="modal" data-bs-target="#termsModal"
                                    class="text-decoration-none fw-bold" style="color: var(--primary-color)">Terms &
                                    Conditions</a>
                            </label>
                        </div>

                        <div class="mt-2">
                            <button type="submit" class="btn btn-resto w-100 py-3 fw-bold shadow-sm text-white"
                                style="background-color: var(--primary-color); border-radius: 12px;">
                                Create Reservation
                            </button>
                        </div>
                    </div>
                </div>

                <div class="col-lg-8">
                    <div class="card card-custom border-0 shadow-sm p-4 h-100">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h5 class="fw-bold mb-0" style="color: var(--primary-color)">
                                <i class="fas fa-chair me-2"></i> Select Available Table
                            </h5>
                            <span class="badge bg-success-subtle text-success px-3 py-2 rounded-pill">
                                {{ $tables->where('status', 'active')->count() }} Meja Tersedia
                            </span>
                        </div>

                        <div id="selection-alert"
                            class="alert alert-warning border-0 small py-2 mb-3 d-none animate__animated animate__fadeIn"
                            style="border-radius: 10px;">
                            <i class="fas fa-thumbtack me-2"></i> Meja terpilih: <strong id="selected-table-name">-</strong>
                        </div>

                        <ul class="nav nav-pills mb-4 bg-light p-1 rounded-pill" id="pills-tab" role="tablist"
                            style="width: fit-content;">
                            <li class="nav-item"><button class="nav-link active rounded-pill px-4 small fw-bold"
                                    data-bs-toggle="pill" data-bs-target="#tab-all" type="button"
                                    role="tab">ALL</button></li>
                            <li class="nav-item"><button class="nav-link rounded-pill px-4 small fw-bold"
                                    data-bs-toggle="pill" data-bs-target="#tab-indoor" type="button"
                                    role="tab">INDOOR</button></li>
                            <li class="nav-item"><button class="nav-link rounded-pill px-4 small fw-bold"
                                    data-bs-toggle="pill" data-bs-target="#tab-outdoor" type="button"
                                    role="tab">OUTDOOR</button></li>
                            <li class="nav-item"><button class="nav-link rounded-pill px-4 small fw-bold"
                                    data-bs-toggle="pill" data-bs-target="#tab-vip" type="button"
                                    role="tab">VIP</button></li>
                        </ul>

                        <div class="tab-content" id="pills-tabContent">
                            @php $areas = ['all', 'indoor', 'outdoor', 'vip']; @endphp
                            @foreach ($areas as $area)
                                <div class="tab-pane fade {{ $area == 'all' ? 'show active' : '' }}"
                                    id="tab-{{ $area }}" role="tabpanel">
                                    <div class="table-scroll-container">
                                        <div class="row g-2">
                                            @php
                                                $filteredTables =
                                                    $area == 'all' ? $tables : $tables->where('area', $area);
                                            @endphp

                                            @forelse ($filteredTables as $table)
                                                <div class="col-md-3 col-6">
                                                    <input type="radio" class="btn-check" name="table_id"
                                                        id="table-{{ $table->id }}" value="{{ $table->id }}"
                                                        {{ $table->status != 'active' ? 'disabled' : '' }} required>
                                                    <label
                                                        class="table-node w-100 {{ $table->status != 'active' ? 'node-booked' : '' }}"
                                                        for="table-{{ $table->id }}">
                                                        <i class="fas fa-chair"></i>
                                                        <span class="fw-bold d-block">{{ $table->table_number }}</span>
                                                        <small class="text-muted">{{ $table->capacity }} Seats</small>
                                                    </label>
                                                </div>
                                            @empty
                                                <div class="col-12 text-center py-5">
                                                    <p class="text-muted">Tidak ada meja di area ini.</p>
                                                </div>
                                            @endforelse
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="d-flex gap-3 mt-4 pt-3 border-top justify-content-center">
                            <div class="small text-muted"><span class="legend-box border me-1"></span> Tersedia</div>
                            <div class="small text-muted"><span class="legend-box bg-light border me-1"></span> Terisi
                            </div>
                            <div class="small text-muted"><span class="legend-box me-1"
                                    style="background-color: var(--primary-color)"></span> Dipilih</div>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <div class="modal fade" id="termsModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content" style="border-radius: 20px; border: none;">
                    <div class="modal-header border-0 pt-4 px-4">
                        <h5 class="fw-bold" style="color: var(--primary-color)">Reservation Terms</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body px-4 pb-4">
                        <div class="mb-3 p-3 rounded-3 bg-light border">
                            <h6 class="fw-bold small mb-2"><i class="fas fa-wallet me-2 text-warning"></i> Deposit
                                Guarantee
                                System</h6>
                            <p class="small text-muted mb-0">
                                Pemesanan meja memerlukan deposit sebesar <strong>Rp 50.000</strong> sebagai jaminan
                                kehadiran.
                            </p>
                        </div>

                        <div class="list-group list-group-flush small">
                            <div class="list-group-item bg-transparent px-0 py-3">
                                <div class="d-flex">
                                    <i class="fas fa-check-circle text-success me-3 mt-1"></i>
                                    <div>
                                        <span class="fw-bold d-block">Pemotongan Tagihan</span>
                                        Deposit Anda akan langsung memotong total tagihan makan di kasir (Contoh: Total Rp
                                        300.000, Anda cukup bayar sisanya Rp 250.000).
                                    </div>
                                </div>
                            </div>
                            <div class="list-group-item bg-transparent px-0 py-3">
                                <div class="d-flex">
                                    <i class="fas fa-clock text-danger me-3 mt-1"></i>
                                    <div>
                                        <span class="fw-bold d-block">Toleransi Keterlambatan</span>
                                        Batas waktu keterlambatan adalah 15 menit. Jika melebihi waktu tersebut, meja akan
                                        diberikan kepada pelanggan lain.
                                    </div>
                                </div>
                            </div>
                            <div class="list-group-item bg-transparent px-0 py-3 border-0">
                                <div class="d-flex">
                                    <i class="fas fa-exclamation-triangle text-danger me-3 mt-1"></i>
                                    <div>
                                        <span class="fw-bold d-block">Kebijakan Hangus</span>
                                        Deposit dianggap hangus (kompensasi operasional) jika tamu tidak datang tanpa
                                        pembatalan
                                        minimal 1 jam sebelumnya.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-0 px-4 pb-4">
                        <button type="button" class="btn btn-resto w-100 py-2 fw-bold text-white"
                            style="background-color: var(--primary-color)" data-bs-dismiss="modal">I Understand</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        :root {
            --primary-color: #8B0000;
            --available-bg: #ffffff;
            --booked-bg: #f8f9fa;
        }

        .card-custom {
            border-radius: 20px;
        }

        .table-scroll-container {
            max-height: 420px;
            overflow-y: auto;
            padding: 15px;
            border-radius: 15px;
            background-color: #fafafa;
            border: 1px solid #eee;
        }

        .table-node {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 15px;
            border-radius: 15px;
            border: 2px solid #e9ecef;
            background: var(--available-bg);
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .table-node:hover {
            border-color: var(--primary-color);
            transform: translateY(-3px);
        }

        .table-node i {
            color: var(--primary-color);
            margin-bottom: 5px;
        }

        .node-booked {
            background-color: #eee !important;
            cursor: not-allowed;
            opacity: 0.5;
        }

        .btn-check:checked+.table-node {
            background-color: var(--primary-color) !important;
            border-color: var(--primary-color) !important;
            color: white !important;
        }

        .btn-check:checked+.table-node i,
        .btn-check:checked+.table-node small {
            color: white !important;
        }

        .legend-box {
            width: 12px;
            height: 12px;
            display: inline-block;
            border-radius: 3px;
        }

        .nav-pills .nav-link.active {
            background-color: var(--primary-color) !important;
        }

        .nav-pills .nav-link {
            color: #666;
        }
    </style>
@endsection
@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const tableInputs = document.querySelectorAll('.btn-check');
            const alertBox = document.getElementById('selection-alert');
            const nameSpan = document.getElementById('selected-table-name');

            tableInputs.forEach(input => {
                input.addEventListener('change', function() {
                    if (this.checked) {
                        const tableName = this.nextElementSibling.querySelector('span').innerText;
                        alertBox.classList.remove('d-none');
                        nameSpan.innerText = tableName;

                        if (window.innerWidth < 992) {
                            document.querySelector('.col-lg-4').scrollIntoView({
                                behavior: 'smooth'
                            });
                        }
                    }
                });
            });

            const dateInput = document.getElementById('reservation_date');

            dateInput.addEventListener('change', function() {
                const inputVal = this.value;
                if (!inputVal) return;

                const selectedDate = new Date(inputVal);
                const today = new Date();

                today.setHours(0, 0, 0, 0);
                selectedDate.setHours(0, 0, 0, 0);

                if (selectedDate < today) {
                    Swal.fire({
                        title: 'Tanggal Tidak Valid',
                        text: 'Maaf, Anda tidak bisa memilih tanggal yang sudah lewat.',
                        icon: 'error',
                        confirmButtonColor: '#8B0000',
                        confirmButtonText: 'Oke, Saya Mengerti',
                        background: '#ffffff',
                        backdrop: `rgba(139, 0, 0, 0.1)`,
                        showClass: {
                            popup: 'animate__animated animate__fadeInDown'
                        },
                        hideClass: {
                            popup: 'animate__animated animate__fadeOutUp'
                        }
                    });

                    const now = new Date();
                    const year = now.getFullYear();
                    const month = String(now.getMonth() + 1).padStart(2, '0');
                    const day = String(now.getDate()).padStart(2, '0');
                    this.value = `${year}-${month}-${day}`;
                }
            });
        });
    </script>
@endpush
