@extends('layouts.app')

@section('title', 'Review & Payment')

@section('content')
    <div class="container-fluid py-4">
        <div class="row justify-content-center g-4">

            <div class="col-lg-5 col-md-12">
                <div class="card card-custom border-0 shadow-sm h-100 p-4">
                    <h5 class="fw-bold mb-4" style="color: var(--primary)">
                        <i class="fas fa-clipboard-check me-2"></i> Review Reservation
                    </h5>

                    <div class="reservation-summary bg-light rounded-4 p-4 mb-4">
                        <div class="row g-4">
                            <div class="col-6">
                                <small class="text-muted d-block text-uppercase small-8 fw-bold">Table</small>
                                <span class="fw-bold text-dark">Table 05 (VIP Area)</span>
                            </div>
                            <div class="col-6">
                                <small class="text-muted d-block text-uppercase small-8 fw-bold">Date</small>
                                <span class="fw-bold text-dark">30 December 2025</span>
                            </div>
                            <div class="col-6">
                                <small class="text-muted d-block text-uppercase small-8 fw-bold">Time Slot</small>
                                <span class="fw-bold text-dark">19:00 - 21:00</span>
                            </div>
                            <div class="col-6">
                                <small class="text-muted d-block text-uppercase small-8 fw-bold">Total Guest</small>
                                <span class="fw-bold text-dark">4 People</span>
                            </div>
                        </div>
                    </div>

                    <div class="special-note p-3 border-start border-4 border-warning bg-light rounded-2">
                        <small class="text-muted d-block text-uppercase small-8 fw-bold mb-1">Special Note</small>
                        <span class="text-dark small italic">"Window seat and birthday decoration, please."</span>
                    </div>

                    <div class="d-none d-lg-block mt-5 pt-5 text-center">
                        <img src="https://cdn-icons-png.flaticon.com/512/1532/1532688.png" width="120"
                            style="opacity: 0.1; filter: grayscale(1);">
                    </div>
                </div>
            </div>

            <div class="col-lg-6 col-md-12">
                <form id="payForm" action="#" method="GET">
                    @csrf

                    <div class="card card-custom border-0 shadow-sm p-4 mb-4">
                        <h5 class="fw-bold mb-4" style="color: var(--primary)">
                            <i class="fas fa-wallet me-2"></i> Select Payment Method
                        </h5>

                        <div class="payment-options">
                            <p class="small fw-bold text-muted mb-2 text-uppercase" style="font-size: 0.7rem;">Virtual
                                Account</p>
                            <div class="row g-2 mb-3">
                                <div class="col-6">
                                    <input type="radio" class="btn-check" name="payment_method" id="bca"
                                        value="bca">
                                    <label
                                        class="btn btn-outline-light w-100 p-3 text-start d-flex align-items-center method-card shadow-sm"
                                        for="bca">
                                        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/5c/Bank_Central_Asia.svg/1200px-Bank_Central_Asia.svg.png"
                                            width="40" class="me-2">
                                        <span class="fw-bold text-dark small">BCA</span>
                                        <i class="fas fa-check-circle ms-auto text-success check-icon"></i>
                                    </label>
                                </div>
                                <div class="col-6">
                                    <input type="radio" class="btn-check" name="payment_method" id="mandiri"
                                        value="mandiri">
                                    <label
                                        class="btn btn-outline-light w-100 p-3 text-start d-flex align-items-center method-card shadow-sm"
                                        for="mandiri">
                                        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/ad/Bank_Mandiri_logo_2016.svg/1200px-Bank_Mandiri_logo_2016.svg.png"
                                            width="40" class="me-2">
                                        <span class="fw-bold text-dark small">Mandiri</span>
                                        <i class="fas fa-check-circle ms-auto text-success check-icon"></i>
                                    </label>
                                </div>
                            </div>

                            <p class="small fw-bold text-muted mb-2 text-uppercase" style="font-size: 0.7rem;">Digital
                                Payment</p>
                            <div class="mb-4">
                                <input type="radio" class="btn-check" name="payment_method" id="qris" value="qris">
                                <label
                                    class="btn btn-outline-light w-100 p-3 text-start d-flex align-items-center method-card shadow-sm"
                                    for="qris">
                                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/a2/Logo_QRIS.svg/1200px-Logo_QRIS.svg.png"
                                        width="50" class="me-3">
                                    <span class="fw-bold text-dark">QRIS (Gopay, OVO, Shopee)</span>
                                    <i class="fas fa-check-circle ms-auto text-success check-icon"></i>
                                </label>
                            </div>
                        </div>

                        <div class="amount-box p-3 rounded-4 mb-4 text-center"
                            style="background: #fff8f8; border: 1px dashed var(--primary);">
                            <span class="text-muted fw-bold small d-block">DEPOSIT AMOUNT</span>
                            <h3 class="fw-bold mb-0" style="color: var(--primary)">Rp 50.000</h3>
                            <small class="text-muted italic" style="font-size: 0.7rem;">Deductible from final bill</small>
                        </div>

                        <div class="row g-2">
                            <div class="col-5">
                                <button type="button" onclick="window.history.back()"
                                    class="btn btn-light w-100 py-3 fw-bold text-muted border">
                                    Back
                                </button>
                            </div>
                            <div class="col-7">
                                <button type="button" onclick="processPayment()"
                                    class="btn btn-resto w-100 py-3 fw-bold shadow-sm">
                                    Pay Now
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <style>
        :root {
            --primary: #800000;
            --secondary: #d4af37;
        }

        .card-custom {
            border-radius: 20px !important;
        }

        .method-card {
            background: #ffffff;
            border: 1px solid #eee !important;
            border-radius: 12px;
            transition: all 0.2s ease-in-out;
        }

        .method-card:hover {
            background: #fffafa;
        }

        .check-icon {
            display: none;
        }

        .btn-check:checked+.method-card {
            border-color: var(--primary) !important;
            background: #fffcfc;
            box-shadow: 0 4px 12px rgba(128, 0, 0, 0.1) !important;
        }

        .btn-check:checked+.method-card .check-icon {
            display: block;
        }

        .small-8 {
            font-size: 0.75rem;
            letter-spacing: 0.5px;
        }

        .btn-resto {
            background-color: var(--primary);
            color: white;
            border: none;
            border-radius: 12px;
        }

        .btn-resto:hover {
            background-color: #600000;
            color: white;
            transform: translateY(-2px);
        }
    </style>

    <script>
        function processPayment() {
            const method = document.querySelector('input[name="payment_method"]:checked');

            if (!method) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Opps!',
                    text: 'Please select a payment method.',
                    confirmButtonColor: '#800000'
                });
                return;
            }

            Swal.fire({
                title: 'Connecting...',
                text: 'Opening ' + method.value.toUpperCase() + ' Payment',
                timer: 2000,
                timerProgressBar: true,
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading()
                }
            }).then(() => {
                Swal.fire({
                    icon: 'success',
                    title: 'Invoice Ready',
                    text: 'Please follow the payment instructions on the next page.',
                    confirmButtonColor: '#800000'
                });
            });
        }
    </script>
@endsection
