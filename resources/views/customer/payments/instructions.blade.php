@extends('layouts.app')

@section('title', 'Payment Instructions')

@section('content')
    <div class="container py-8">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-12">
                <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                    <div class="row g-0">
                        <div class="col-md-5 bg-light border-end">
                            <div class="p-4 p-lg-5 text-center h-100 d-flex flex-column justify-content-center">
                                <div class="mb-4">
                                    <span class="badge bg-dark mb-2 fw-normal px-3 py-2 rounded-pill">Metode:
                                        {{ strtoupper($method) }}</span>
                                    <h4 class="fw-bold d-block">Detail Pembayaran</h4>
                                </div>

                                @if ($method == 'qris')
                                    <div class="qris-box p-3 bg-white rounded-4 shadow-sm border d-inline-block mb-3">
                                        <img src="{{ asset('image/qr-code.png') }}" class="img-fluid"
                                            style="max-height: 220px;" alt="QRIS Code">
                                    </div>
                                    <div class="d-flex justify-content-center gap-2">
                                        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/a2/Logo_QRIS.svg/1200px-Logo_QRIS.svg.png"
                                            height="15">
                                    </div>
                                @else
                                    <div class="bank-card p-4 rounded-4 bg-white shadow-sm mb-3">
                                        <img src="{{ $method == 'bca' ? 'https://upload.wikimedia.org/wikipedia/commons/thumb/5/5c/Bank_Central_Asia.svg/1200px-Bank_Central_Asia.svg.png' : 'https://upload.wikimedia.org/wikipedia/commons/thumb/a/ad/Bank_Mandiri_logo_2016.svg/1200px-Bank_Mandiri_logo_2016.svg.png' }}"
                                            height="30" class="mb-4">

                                        <p class="text-muted small mb-1 text-uppercase fw-bold">Nomor Rekening</p>
                                        <div class="d-flex align-items-center justify-content-center mb-3">
                                            <h3 class="fw-bold mb-0 me-2 text-primary" id="accNumber">
                                                {{ $method == 'bca' ? '1234567890' : '0987654321' }}
                                            </h3>
                                            <button class="btn btn-sm btn-light rounded-circle" type="button"
                                                onclick="copyToClipboard('#accNumber')">
                                                <i class="fas fa-copy"></i>
                                            </button>
                                        </div>
                                        <hr class="w-25 mx-auto">
                                        <p class="text-muted small mb-0 fw-bold text-uppercase">A.N. Resto Sedap Malam</p>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-7">
                            <div class="p-4 p-lg-5">
                                <div class="d-flex justify-content-between align-items-start mb-4">
                                    <div>
                                        <h5 class="fw-bold mb-1 text-primary">ID Reservasi #{{ $reservation->id }}</h5>
                                        <p class="text-muted small mb-0">Atas Nama: {{ auth()->user()->name }}</p>
                                    </div>
                                    <div class="text-end text-success fw-bold fs-5">
                                        Rp 50.000
                                    </div>
                                </div>

                                <div
                                    class="instruction-box p-4 rounded-4 bg-primary bg-opacity-10 border border-primary border-opacity-25 mb-5">
                                    <h6 class="fw-bold mb-3"><i class="fas fa-list-check me-2"></i> Instruksi Terakhir:</h6>
                                    <ul class="small text-muted mb-0 ps-3">
                                        <li class="mb-2">Pastikan nominal transfer sesuai (tidak kurang/lebih).</li>
                                        <li class="mb-2">Gunakan fitur <b>Salin Nomor</b> untuk menghindari kesalahan.
                                        </li>
                                        <li>Kirim bukti transfer via WhatsApp agar pesanan segera dikonfirmasi.</li>
                                    </ul>
                                </div>

                                <div class="row g-3">
                                    <div class="col-sm-7">
                                        <a href="https://wa.me/6281212537279?text={{ urlencode(
                                            "Halo Admin, saya ingin konfirmasi pembayaran reservasi.\n\n" .
                                                "--- DETAIL RESERVASI ---\n" .
                                                'ID Reservasi : #' .
                                                $reservation->id .
                                                "\n" .
                                                'Atas Nama    : ' .
                                                auth()->user()->name .
                                                "\n" .
                                                'Meja         : ' .
                                                $reservation->table->table_number .
                                                "\n" .
                                                'Tanggal      : ' .
                                                \Carbon\Carbon::parse($reservation->reservation_date)->format('d M Y') .
                                                "\n" .
                                                'Jam          : ' .
                                                $reservation->start_time .
                                                "\n" .
                                                "------------------------\n" .
                                                'Metode Bayar : ' .
                                                strtoupper($method) .
                                                "\n" .
                                                "Total Deposit: Rp 50.000\n\n" .
                                                'Berikut saya lampirkan bukti transfernya. Mohon segera dikonfirmasi. Terima kasih!',
                                        ) }}"
                                            class="btn btn-success btn-lg w-100 py-3 rounded-3 fw-bold shadow-sm btn-wa"
                                            target="_blank">
                                            <i class="fab fa-whatsapp me-2"></i> Konfirmasi WA
                                        </a>
                                    </div>
                                    <div class="col-sm-5">
                                        <a href="{{ route('history.index') }}"
                                            class="btn btn-outline-secondary btn-lg w-100 py-3 rounded-3 fw-bold small text-nowrap">
                                            Lihat Riwayat
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <p class="text-center mt-4 text-muted small">&copy; {{ date('Y') }} Resto Nama Sedap Malam.</p>
            </div>
        </div>
    </div>
    <style>
        body {
            background-color: #f4f7f6;
            font-family: 'Inter', sans-serif;
        }

        .card {
            border-radius: 24px;
            border: none;
        }

        .rounded-4 {
            border-radius: 1rem !important;
        }

        .btn-wa {
            background-color: #25D366;
            border: none;
            transition: 0.3s;
        }

        .btn-wa:hover {
            background-color: #128C7E;
            transform: translateY(-2px);
        }

        .bank-card {
            border: 1px solid #eee;
        }

        .qris-box img {
            border-radius: 12px;
        }
    </style>
@endsection
@push('scripts')
    <script>
        function copyToClipboard(element) {
            var text = document.querySelector(element).innerText;
            navigator.clipboard.writeText(text);
            Swal.fire({
                icon: 'success',
                title: 'Tersalin!',
                text: text,
                timer: 1000,
                showConfirmButton: false
            });
        }
    </script>
@endpush
