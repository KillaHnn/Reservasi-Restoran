@extends('layouts.app')

@section('title', 'Cashier Dashboard')

@section('content')
    <div class="container-fluid py-4">
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card border-0 shadow-sm p-3 bg-primary text-white" style="border-radius: 15px;">
                    <small class="opacity-75">Perlu Konfirmasi</small>
                    <h3 class="fw-bold mb-0">5 <span class="fs-6 fw-normal">Pembayaran</span></h3>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-0 shadow-sm p-3 bg-success text-white" style="border-radius: 15px;">
                    <small class="opacity-75">Dikonfirmasi Hari Ini</small>
                    <h3 class="fw-bold mb-0">12 <span class="fs-6 fw-normal">Reservasi</span></h3>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-0 shadow-sm p-3 bg-dark text-white" style="border-radius: 15px;">
                    <small class="opacity-75">Total Deposit Masuk</small>
                    <h3 class="fw-bold mb-0">Rp 600.000</h3>
                </div>
            </div>

            <div class="col-12">
                <div class="card border-0 shadow-sm p-4" style="border-radius: 20px;">
                    <h5 class="fw-bold mb-4"><i class="fas fa-cash-register me-2 text-primary"></i> Verifikasi Pembayaran
                    </h5>

                    <div class="table-responsive">
                        <table class="table table-hover align-middle" id="paymentsTable">
                            <thead class="bg-light">
                                <tr>
                                    <th class="py-3 border-0">BOOKING ID</th>
                                    <th class="py-3 border-0">PELANGGAN</th>
                                    <th class="py-3 border-0">METODE</th>
                                    <th class="py-3 border-0">NOMINAL</th>
                                    <th class="py-3 border-0">STATUS</th>
                                    <th class="py-3 border-0 text-center">AKSI</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr id="row-124">
                                    <td class="fw-bold">#RSV-00124</td>
                                    <td>
                                        <div class="fw-bold text-dark">Budi Santoso</div>
                                        <small class="text-muted">Table 05 • 19:00 WIB</small>
                                    </td>
                                    <td><span class="badge bg-info-subtle text-info px-2">BCA Transfer</span></td>
                                    <td class="fw-bold text-success">Rp 50.000</td>
                                    <td><span class="badge bg-warning text-dark px-3 py-2 status-label">Waiting</span></td>
                                    <td class="text-center">
                                        <button class="btn btn-success btn-sm px-4 rounded-pill fw-bold btn-confirm"
                                            onclick="confirmPayment('00124', 'Budi Santoso')">
                                            Konfirmasi Lunas
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <style>
        :root {
            --primary: #800000;
        }

        .bg-primary {
            background-color: var(--primary) !important;
        }

        .text-primary {
            color: var(--primary) !important;
        }

        .badge {
            font-weight: 600;
            border-radius: 8px;
        }

        .bg-info-subtle {
            background-color: #e0f7ff;
            color: #0dcaf0;
        }

        .bg-success-subtle {
            background-color: #d1e7dd;
            color: #0f5132;
        }

        .card {
            border-radius: 15px;
        }
    </style>
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            $('#paymentsTable').DataTable({
                "pageLength": 10,
                "language": {
                    "search": "",
                    "searchPlaceholder": "Search tables...",
                    "lengthMenu": "_MENU_",
                    "paginate": {
                        "previous": "<i class='fas fa-chevron-left'></i>",
                        "next": "<i class='fas fa-chevron-right'></i>"
                    }
                },
                "dom": '<"d-flex justify-content-between align-items-center mb-3"f l>rt<"d-flex justify-content-between align-items-center mt-3"i p>'
            });
        });

        function confirmPayment(bookingId, customerName) {
            Swal.fire({
                title: 'Konfirmasi Pembayaran?',
                text: "Apakah Anda yakin dana dari " + customerName + " (#RSV-" + bookingId +
                    ") sudah masuk ke rekening?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#28a745',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Sudah Lunas!',
                cancelButtonText: 'Batal',
                reverseButtons: true,
                borderRadius: '15px'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Simulasi Proses Loading
                    Swal.fire({
                        title: 'Memproses...',
                        text: 'Sedang memperbarui status reservasi',
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading()
                        }
                    });

                    // Di sini nanti tempat integrasi AJAX ke Controller
                    setTimeout(() => {
                        Swal.fire({
                            title: 'Berhasil!',
                            text: 'Pembayaran #' + bookingId +
                                ' telah diverifikasi. Status reservasi kini: CONFIRMED.',
                            icon: 'success',
                            timer: 2000,
                            showConfirmButton: false
                        });

                        // Update tampilan UI secara dummy
                        const row = document.getElementById('row-' + bookingId);
                        row.querySelector('.status-label').className =
                            'badge bg-success-subtle text-success px-3 py-2';
                        row.querySelector('.status-label').innerHTML =
                            '<i class="fas fa-check-circle me-1"></i> Paid';
                        row.querySelector('.btn-confirm').className =
                            'btn btn-outline-secondary btn-sm px-4 rounded-pill disabled';
                        row.querySelector('.btn-confirm').innerText = 'Verified';
                    }, 1500);
                }
            })
        }
    </script>
@endpush
