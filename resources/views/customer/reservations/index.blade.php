@extends('layouts.app')

@section('title', 'Book a Table')
@section('page_title', 'Table Reservation')

@section('content')
    <div class="row g-4">
        <div class="col-lg-4">
            <div class="card card-custom border-0 shadow-sm p-4">
                <h5 class="fw-bold mb-4" style="color: var(--primary)">
                    <i class="fas fa-calendar-alt me-2"></i> Reservation Detail
                </h5>
                <form action="" method="POST">
                    <div class="mb-3">
                        <label class="small fw-bold mb-2">RESERVATION DATE</label>
                        <input type="date" class="form-control bg-light border-0 p-3" value="{{ date('Y-m-d') }}">
                    </div>

                    <div class="row">
                        <div class="col-6 mb-3">
                            <label class="small fw-bold mb-2">START TIME</label>
                            <input type="time" class="form-control bg-light border-0 p-3" value="18:00">
                        </div>
                        <div class="col-6 mb-3">
                            <label class="small fw-bold mb-2">END TIME</label>
                            <input type="time" class="form-control bg-light border-0 p-3" value="20:00">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="small fw-bold mb-2">GUEST COUNT</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-0"><i class="fas fa-users"></i></span>
                            <input type="number" class="form-control bg-light border-0 p-3" placeholder="How many people?"
                                min="1">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="small fw-bold mb-2">SPECIAL NOTE (OPTIONAL)</label>
                        <textarea class="form-control bg-light border-0 p-3" rows="3" placeholder="Eg: Birthday celebration..."></textarea>
                    </div>

                    <div class="p-3 mb-4 rounded-3 shadow-sm border-start border-4"
                        style="background: #fffcf5; border-color: var(--secondary) !important;">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <span class="small fw-bold text-muted text-uppercase">Reservation Deposit</span>
                            <span class="fw-bold" style="color: var(--primary)">Rp 50.000</span>
                        </div>
                        <p class="small text-muted mb-0" style="font-size: 0.75rem;">
                            *Deposit ini akan memotong total tagihan Anda saat di kasir.
                        </p>
                    </div>

                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" id="agreeTerms" required>
                        <label class="form-check-label small" for="agreeTerms">
                            I agree to the <a href="#" data-bs-toggle="modal" data-bs-target="#termsModal"
                                class="text-decoration-none fw-bold" style="color: var(--primary)">Terms & Conditions</a>
                        </label>
                    </div>

                    <form action="{{ route('reservations.review') }}">
                        @csrf
                        <button type="submit" class="btn btn-resto w-100 py-3 fw-bold shadow-sm">
                            Review Reservation Details
                        </button>
                    </form>
                </form>
            </div>
        </div>

        <div class="col-lg-8">
            <div class="card card-custom border-0 shadow-sm p-4 h-100">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h5 class="fw-bold mb-0" style="color: var(--primary)">
                        <i class="fas fa-chair me-2"></i> Select Available Table
                    </h5>
                    <span class="badge bg-success-subtle text-success px-3">8 Tables Available</span>
                </div>

                <div class="row g-3">
                    @for ($i = 1; $i <= 8; $i++)
                        <div class="col-md-4 col-6">
                            <input type="radio" class="btn-check" name="table_id" id="table{{ $i }}"
                                autocomplete="off">
                            <label class="btn btn-outline-light w-100 p-4 border-0 shadow-sm table-card"
                                for="table{{ $i }}" style="background: #f8f9fa; border-radius: 15px;">
                                <i class="fas fa-utensils mb-3 d-block text-muted fa-2x"></i>
                                <span class="d-block fw-bold text-dark">Table {{ $i }}</span>
                                <small class="text-muted">4 Seats</small>
                            </label>
                        </div>
                    @endfor
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="termsModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered shadow-lg">
            <div class="modal-content" style="border-radius: 20px; border: none;">
                <div class="modal-header border-0 pt-4 px-4">
                    <h5 class="fw-bold" style="color: var(--primary)">Reservation Terms</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body px-4 pb-4">
                    <div class="mb-3 p-3 rounded-3 bg-light border">
                        <h6 class="fw-bold small mb-2"><i class="fas fa-wallet me-2 text-warning"></i> Deposit Guarantee
                            System</h6>
                        <p class="small text-muted mb-0">
                            Pemesanan meja memerlukan deposit sebesar <strong>Rp 50.000</strong> sebagai jaminan kehadiran.
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
                                    Deposit dianggap hangus (kompensasi operasional) jika tamu tidak datang tanpa pembatalan
                                    minimal 1 jam sebelumnya.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0 px-4 pb-4">
                    <button type="button" class="btn btn-resto w-100 py-2 fw-bold" data-bs-dismiss="modal">I
                        Understand</button>
                </div>
            </div>
        </div>
    </div>

    <style>
        .table-card:hover {
            background: #fff0f0 !important;
            transform: translateY(-5px);
            transition: all 0.3s;
        }

        .btn-check:checked+.table-card {
            background: var(--primary) !important;
            color: white !important;
        }

        .btn-check:checked+.table-card i,
        .btn-check:checked+.table-card span,
        .btn-check:checked+.table-card small {
            color: white !important;
        }

        .list-group-item {
            line-height: 1.5;
        }
    </style>
@endsection
