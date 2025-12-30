@extends('layouts.app')

@section('title', 'My Reservations')
@section('page_title', 'My Reservations')

@section('content')
    <div class="card card-custom border-0 shadow-sm p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h5 class="fw-bold mb-0" style="color: var(--primary)">
                <i class="fas fa-history me-2"></i> Reservation History
            </h5>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="bg-light">
                    <tr>
                        <th class="border-0 px-3 py-3 small fw-bold">BOOKING ID</th>
                        <th class="border-0 py-3 small fw-bold">DATE & TIME</th>
                        <th class="border-0 py-3 small fw-bold">TABLE</th>
                        <th class="border-0 py-3 small fw-bold">GUESTS</th>
                        <th class="border-0 py-3 small fw-bold">STATUS</th>
                        <th class="border-0 py-3 small fw-bold text-center">ACTION</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="px-3 fw-bold text-dark">#RSV-99021</td>
                        <td>
                            <div class="fw-bold">15 Dec 2023</div>
                            <small class="text-muted">18:00 - 20:00</small>
                        </td>
                        <td><span class="badge bg-light text-dark border">Table 05</span></td>
                        <td>4 People</td>
                        <td><span class="badge bg-warning-subtle text-warning px-3 py-2">Pending</span></td>
                        <td class="text-center">
                            <button class="btn btn-sm btn-resto px-3 shadow-sm" data-bs-toggle="modal"
                                data-bs-target="#detailModal">
                                <i class="fas fa-eye me-1"></i> Detail
                            </button>
                        </td>
                    </tr>

                    <tr>
                        <td class="px-3 fw-bold text-dark">#RSV-98772</td>
                        <td>
                            <div class="fw-bold">12 Dec 2023</div>
                            <small class="text-muted">19:00 - 21:00</small>
                        </td>
                        <td><span class="badge bg-light text-dark border">Table 02</span></td>
                        <td>2 People</td>
                        <td><span class="badge bg-success-subtle text-success px-3 py-2">Confirmed</span></td>
                        <td class="text-center">
                            <button class="btn btn-sm btn-resto px-3 shadow-sm" data-bs-toggle="modal"
                                data-bs-target="#detailModal">
                                <i class="fas fa-eye me-1"></i> Detail
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="modal fade" id="detailModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border-radius: 20px; border: none;">
                <div class="modal-body p-0">
                    <div class="text-center p-4 text-white"
                        style="background: var(--primary); border-radius: 20px 20px 0 0;">
                        <h6 class="text-uppercase small mb-3 opacity-75">Booking Confirmation</h6>
                        <div class="bg-white p-3 d-inline-block rounded-3 mb-3">
                            <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=RSV-98772"
                                alt="QR Code" width="130">
                        </div>
                        <h5 class="fw-bold mb-0">#RSV-98772</h5>
                        <small class="opacity-75">Show this QR to our receptionist</small>
                    </div>

                    <div class="p-4">
                        <div class="row g-3 mb-4">
                            <div class="col-6">
                                <label class="text-muted small d-block">Customer Name</label>
                                <span class="fw-bold">John Doe</span>
                            </div>
                            <div class="col-6">
                                <label class="text-muted small d-block">Table Number</label>
                                <span class="fw-bold text-maroon">Table 02 (VIP)</span>
                            </div>
                            <div class="col-6">
                                <label class="text-muted small d-block">Date</label>
                                <span class="fw-bold">12 Dec 2023</span>
                            </div>
                            <div class="col-6">
                                <label class="text-muted small d-block">Time</label>
                                <span class="fw-bold">19:00 - 21:00</span>
                            </div>
                            <div class="col-12">
                                <label class="text-muted small d-block">Special Note</label>
                                <span class="fw-bold italic text-muted">"Birthday celebration, need a quiet corner."</span>
                            </div>
                        </div>

                        <div class="p-3 rounded-3 mb-3" style="background: #f8f9fa; border: 1px dashed #ddd;">
                            <div class="d-flex justify-content-between small mb-1">
                                <span class="text-muted">Deposit Paid</span>
                                <span class="fw-bold text-success">Rp 50.000</span>
                            </div>
                            <div class="d-flex justify-content-between small">
                                <span class="text-muted">Payment Status</span>
                                <span class="badge bg-success px-2">Lunas</span>
                            </div>
                        </div>

                        <button type="button" class="btn btn-secondary w-100 py-2 fw-bold shadow-sm"
                            data-bs-dismiss="modal" style="border-radius: 10px;">
                            Close Detail
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .text-maroon {
            color: var(--primary);
        }

        .table thead th {
            letter-spacing: 0.5px;
        }

        .btn-resto {
            background-color: var(--primary);
            color: white;
            border-radius: 8px;
        }

        .btn-resto:hover {
            background-color: #600000;
            color: white;
        }
    </style>
@endsection
