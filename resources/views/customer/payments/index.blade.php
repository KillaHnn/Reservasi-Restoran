@extends('layouts.app')

@section('title', 'Payment Instruction')
@section('page_title', 'Payment Instruction')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card card-custom border-0 shadow-sm p-4 overflow-hidden">
                <div class="text-center mb-4">
                    <div class="badge bg-warning-subtle text-warning px-3 py-2 mb-3">PENDING PAYMENT</div>
                    <h6 class="text-muted small text-uppercase fw-bold mb-1">Total Deposit</h6>
                    <h2 class="fw-bold" style="color: var(--primary)">Rp 50.000</h2>
                    <p class="small text-muted">Reservation ID: <span class="fw-bold text-dark">#RSV-20231012</span></p>
                </div>

                <hr class="border-dashed mb-4">

                <div class="mb-4 bg-light p-3 rounded-3">
                    <h6 class="fw-bold small mb-3"><i class="fas fa-info-circle me-2"></i> Reservation Summary</h6>
                    <div class="d-flex justify-content-between mb-2 small">
                        <span class="text-muted">Table</span>
                        <span class="fw-bold">Table 05 (4 Seats)</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2 small">
                        <span class="text-muted">Date & Time</span>
                        <span class="fw-bold">15 Dec 2023 | 18:00 - 20:00</span>
                    </div>
                </div>

                <div class="mb-4">
                    <h6 class="fw-bold small mb-3 text-uppercase"><i class="fas fa-university me-2"></i> Payment Method</h6>

                    <div class="d-flex align-items-center p-3 border rounded-3 mb-3 bg-white shadow-sm">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/5c/Bank_Central_Asia.svg/1200px-Bank_Central_Asia.svg.png"
                            alt="BCA" width="60" class="me-3">
                        <div>
                            <div class="small fw-bold">BCA Virtual Account</div>
                            <div class="h5 fw-bold text-dark mb-0" id="vaNumber">8801 2345 6789 001</div>
                        </div>
                        <button class="btn btn-sm btn-outline-resto ms-auto" onclick="copyVA()">Copy</button>
                    </div>

                    <div class="accordion accordion-flush" id="paymentInstruction">
                        <div class="accordion-item border-0">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed px-0 bg-transparent small fw-bold shadow-none"
                                    type="button" data-bs-toggle="collapse" data-bs-target="#instrMbanking">
                                    How to Pay via M-Banking
                                </button>
                            </h2>
                            <div id="instrMbanking" class="accordion-collapse collapse"
                                data-bs-parent="#paymentInstruction">
                                <div class="accordion-body px-0 pt-0">
                                    <ol class="small text-muted mb-0">
                                        <li>Login ke aplikasi M-Banking Anda.</li>
                                        <li>Pilih menu <b>m-Transfer > Virtual Account</b>.</li>
                                        <li>Masukkan Nomor VA di atas.</li>
                                        <li>Pastikan nominal yang muncul adalah <b>Rp 50.000</b>.</li>
                                        <li>Masukkan PIN dan simpan bukti transfer.</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="alert alert-danger border-0 small d-flex align-items-start mb-4">
                    <i class="fas fa-exclamation-circle me-2 mt-1"></i>
                    <div>
                        Segera lakukan pembayaran dalam waktu <b>15 menit</b> atau reservasi Anda akan dibatalkan secara
                        otomatis oleh sistem.
                    </div>
                </div>

                <div class="row g-2">
                    <div class="col-12">
                        <button type="button" class="btn btn-resto w-100 py-3 fw-bold shadow-sm" onclick="checkStatus()">
                            Check Payment Status
                        </button>
                    </div>
                    <div class="col-12 text-center">
                        <a href="#" class="btn btn-link btn-sm text-decoration-none text-muted">Back to
                            Reservations</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .border-dashed {
            border-top: 2px dashed #dee2e6;
        }

        .btn-outline-resto {
            color: var(--primary);
            border-color: var(--primary);
        }

        .btn-outline-resto:hover {
            background-color: var(--primary);
            color: white;
        }

        .accordion-button:not(.collapsed) {
            color: var(--primary);
            background-color: transparent;
        }
    </style>
@endsection

@push('scripts')
    <script>
        function copyVA() {
            var copyText = document.getElementById("vaNumber").innerText;
            navigator.clipboard.writeText(copyText);
            Swal.fire({
                icon: 'success',
                title: 'Copied!',
                text: 'Virtual Account number copied to clipboard',
                timer: 1500,
                showConfirmButton: false
            });
        }

        function checkStatus() {
            Swal.fire({
                title: 'Checking Payment...',
                timer: 2000,
                didOpen: () => {
                    Swal.showLoading()
                }
            }).then(() => {
                Swal.fire({
                    icon: 'info',
                    title: 'Still Waiting',
                    text: 'We haven\'t received your payment yet. Please wait a few moments.',
                });
            });
        }
    </script>
@endpush
