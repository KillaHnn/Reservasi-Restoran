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
                                @forelse($payments as $payment)
                                <tr id="row-{{ $payment->reservation_id }}">
                                    <td class="fw-bold">#RSV-{{ str_pad($payment->reservation_id, 5, '0', STR_PAD_LEFT) }}</td>
                                    <td>
                                        <div class="fw-bold text-dark">{{ $payment->reservation->user->name }}</div>
                                        <small class="text-muted">Table {{ $payment->reservation->table->table_number }} • {{ $payment->reservation->start_time->format('H:i') }} WIB</small>
                                    </td>
                                    <td><span class="badge bg-info-subtle text-info px-2">{{ ucfirst($payment->payment_method) }} Transfer</span></td>
                                    <td class="fw-bold text-success">Rp {{ number_format($payment->nominal_deposit, 0, ',', '.') }}</td>
                                    <td>
                                        @if($payment->status_payment == 'paid')
                                            <span class="badge bg-success-subtle text-success px-3 py-2 status-label">
                                                <i class="fas fa-check-circle me-1"></i> Paid
                                            </span>
                                        @elseif($payment->status_payment == 'expired')
                                            <span class="badge bg-danger-subtle text-danger px-3 py-2 status-label">
                                                <i class="fas fa-times-circle me-1"></i> Expired
                                            </span>
                                        @else
                                            <span class="badge bg-warning text-dark px-3 py-2 status-label">Unpaid</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <button class="btn btn-success btn-sm px-4 rounded-pill fw-bold btn-confirm"
                                            onclick="confirmPayment('{{ $payment->reservation_id }}', '{{ $payment->reservation->user->name }}')">
                                            Konfirmasi Lunas
                                        </button>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td class="text-center py-4" colspan="6">
                                        <div class="text-muted">
                                            <i class="fas fa-inbox fa-2x mb-2"></i>
                                            <p>Tidak ada pembayaran yang perlu dikonfirmasi</p>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
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

                    // AJAX call to confirm payment
                    $.ajax({
                        url: '{{ route("cashier.payments.confirm") }}',
                        method: 'POST',
                        data: {
                            reservation_id: bookingId,
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            if (response.success) {
                                Swal.fire({
                                    title: 'Berhasil!',
                                    text: 'Pembayaran #' + bookingId + ' telah diverifikasi.',
                                    icon: 'success',
                                    timer: 2000,
                                    showConfirmButton: false
                                });

                                // Update tampilan UI
                                const row = document.getElementById('row-' + bookingId);
                                row.querySelector('.status-label').className =
                                    'badge bg-success-subtle text-success px-3 py-2';
                                row.querySelector('.status-label').innerHTML =
                                    '<i class="fas fa-check-circle me-1"></i> Paid';
                                row.querySelector('.btn-confirm').className =
                                    'btn btn-outline-secondary btn-sm px-4 rounded-pill disabled';
                                row.querySelector('.btn-confirm').innerText = 'Verified';
                            } else {
                                Swal.fire({
                                    title: 'Error!',
                                    text: response.message,
                                    icon: 'error'
                                });
                            }
                        },
                        error: function(xhr) {
                            Swal.fire({
                                title: 'Error!',
                                text: 'Terjadi kesalahan saat memproses pembayaran.',
                                icon: 'error'
                            });
                        }
                    });
                }
            })
        }
    </script>
@endpush
