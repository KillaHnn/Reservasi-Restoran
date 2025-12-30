@extends('layouts.app')

@section('title', 'My Reservations')
@section('page_title', 'My Reservations')

@section('content')
    <div class="container-fluid">
        <div class="card card-custom border-0 shadow-sm p-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h5 class="fw-bold mb-0" style="color: var(--primary)">
                    <i class="fas fa-history me-2"></i> Reservation History
                </h5>
            </div>

            <div class="table-responsive">
                <table class="table table-hover align-middle" id="historyTable">
                    <thead class="bg-light">
                        <tr>
                            <th class="border-0 px-3 py-3 small fw-bold">BOOKING ID</th>
                            <th class="border-0 py-3 small fw-bold">DATE & TIME</th>
                            <th class="border-0 py-3 small fw-bold">TABLE</th>
                            <th class="border-0 py-3 small fw-bold">PAYMENT STATUS</th>
                            <th class="border-0 py-3 small fw-bold">RESERVATION</th>
                            <th class="border-0 py-3 small fw-bold text-center">ACTION</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($reservations as $res)
                            @php
                                $payment = $res->payment;
                                $statusPayment = $payment->status_payment ?? 'unpaid';
                            @endphp
                            <tr>
                                <td class="px-3 fw-bold text-dark">#RSV-{{ str_pad($res->id, 5, '0', STR_PAD_LEFT) }}</td>
                                <td>
                                    <div class="fw-bold">
                                        {{ \Carbon\Carbon::parse($res->reservation_date)->format('d M Y') }}</div>
                                    <small class="text-muted">{{ date('H:i', strtotime($res->start_time)) }}</small>
                                </td>
                                <td>
                                    <span class="badge bg-light text-dark border">
                                        {{ $res->table->name ?? 'Table ' . $res->table_id }}
                                    </span>
                                </td>
                                <td>
                                    @if ($statusPayment == 'paid')
                                        <span class="badge bg-success-subtle text-success px-3 py-2"><i
                                                class="fas fa-check-circle me-1"></i> Paid</span>
                                    @elseif($statusPayment == 'expired')
                                        <span class="badge bg-secondary-subtle text-secondary px-3 py-2">Expired</span>
                                    @else
                                        <span class="badge bg-danger-subtle text-danger px-3 py-2"><i
                                                class="fas fa-clock me-1"></i> Unpaid</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($res->status == 'pending')
                                        <span
                                            class="badge bg-warning-subtle text-warning px-3 py-2 text-capitalize">Pending</span>
                                    @elseif($res->status == 'confirmed')
                                        <span
                                            class="badge bg-success-subtle text-success px-3 py-2 text-capitalize">Confirmed</span>
                                    @else
                                        <span
                                            class="badge bg-danger-subtle text-danger px-3 py-2 text-capitalize">{{ $res->status }}</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-2">
                                        <button class="btn btn-sm btn-outline-dark px-3" data-bs-toggle="modal"
                                            data-bs-target="#detailModal{{ $res->id }}">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        @if ($statusPayment == 'unpaid')
                                            <a href="{{ route('payment.instructions', ['method' => $payment->payment_method ?? 'bca', 'reservation_id' => $res->id]) }}"
                                                class="btn btn-sm btn-success px-3 shadow-sm fw-bold">
                                                <i class="fas fa-wallet me-1"></i> Bayar
                                            </a>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                        @endforelse
                    </tbody>
                </table>
            </div>

            @foreach ($reservations as $res)
                @php
                    $payment = $res->payment;
                    $statusPayment = $payment->status_payment ?? 'unpaid';
                @endphp
                <div class="modal fade" id="detailModal{{ $res->id }}" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content overflow-hidden"
                            style="border-radius: 25px; border: none; box-shadow: 0 15px 35px rgba(0,0,0,0.2);">

                            <div class="text-center p-4 text-white position-relative"
                                style="background: linear-gradient(135deg, #800000 0%, #4a0000 100%);">
                                <button type="button" class="btn-close btn-close-white position-absolute end-0 top-0 m-3"
                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                <i class="fas fa- receipt fa-3x mb-2 opacity-50"></i>
                                <h5 class="fw-bold mb-0">Rincian Reservasi</h5>
                                <span
                                    class="badge bg-white bg-opacity-25 rounded-pill mt-2">#RSV-{{ str_pad($res->id, 5, '0', STR_PAD_LEFT) }}</span>
                            </div>

                            <div class="modal-body p-4 bg-light">
                                <div class="text-center mb-4">
                                    <div class="bg-white d-inline-block p-3 shadow-sm mb-3"
                                        style="border-radius: 20px; border: 2px dashed #dee2e6;">
                                        {{-- Menggunakan API QR Server untuk QR Code --}}
                                        <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data={{ $res->id }}"
                                            alt="QR Code" class="img-fluid" style="width: 140px;">
                                    </div>
                                    <h6 class="text-muted small mb-0 uppercase fw-bold">Scan QR untuk Verifikasi</h6>
                                </div>

                                <div class="card border-0 shadow-sm rounded-4 mb-3">
                                    <div class="card-body d-flex align-items-center">
                                        <img src="https://ui-avatars.com/api/?name={{ urlencode($res->user->name) }}&background=800000&color=fff"
                                            class="rounded-circle me-3" width="50">
                                        <div>
                                            <h6 class="fw-bold mb-0 text-dark">{{ $res->user->name }}</h6>
                                            <small class="text-muted">{{ $res->user->email }}</small>
                                        </div>
                                    </div>
                                </div>

                                <div class="row g-2 mb-3">
                                    <div class="col-6">
                                        <div class="p-3 bg-white rounded-4 shadow-sm border-start border-4 border-danger">
                                            <small class="text-muted d-block fw-bold small">NOMOR MEJA</small>
                                            <span class="fw-bold text-dark fs-5">{{ $res->table->table_number }}</span>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="p-3 bg-white rounded-4 shadow-sm border-start border-4 border-primary">
                                            <small class="text-muted d-block fw-bold small">KAPASITAS</small>
                                            <span class="fw-bold text-dark fs-5">{{ $res->table->capacity }} Pax</span>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="p-3 bg-white rounded-4 shadow-sm">
                                            <small class="text-muted d-block fw-bold small text-uppercase">Waktu
                                                Kedatangan</small>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <span class="fw-bold text-dark">
                                                    <i class="fas fa-calendar-alt me-1 text-danger"></i>
                                                    {{ $res->start_time->format('d M Y') }}
                                                </span>
                                                <span class="fw-bold text-dark">
                                                    <i class="fas fa-clock me-1 text-danger"></i>
                                                    {{ $res->start_time->format('H:i') }} WIB
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div
                                    class="p-3 rounded-4 bg-white shadow-sm d-flex justify-content-between align-items-center mb-4">
                                    <div>
                                        <small class="text-muted d-block fw-bold small">STATUS</small>
                                        @php $status = strtolower($res->payment->status_payment ?? 'unpaid'); @endphp
                                        @if ($status == 'paid')
                                            <span class="text-success fw-bold"><i class="fas fa-check-circle"></i>
                                                Paid</span>
                                        @else
                                            <span class="text-warning fw-bold"><i class="fas fa-exclamation-circle"></i>
                                                Unpaid</span>
                                        @endif
                                    </div>
                                    <div class="text-end">
                                        <small class="text-muted d-block fw-bold small">NOMINAL</small>
                                        <span class="fw-bold text-dark fs-5">Rp
                                            {{ number_format($res->payment->nominal_deposit ?? 0, 0, ',', '.') }}</span>
                                    </div>
                                </div>

                                <button type="button" class="btn btn-dark w-100 py-3 rounded-pill fw-bold shadow-sm"
                                    data-bs-dismiss="modal">
                                    Tutup Detail
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <style>
        :root {
            --primary: #800000;
        }

        .text-maroon {
            color: var(--primary);
        }

        .btn-resto {
            background-color: var(--primary);
            color: white;
            border-radius: 8px;
            transition: 0.3s;
        }

        .btn-resto:hover {
            background-color: #600000;
            color: white;
            transform: translateY(-2px);
        }

        .badge {
            font-weight: 600;
            letter-spacing: 0.3px;
        }

        .table thead th {
            border-bottom: 2px solid #eee;
        }

        .card-custom {
            border-radius: 15px;
        }

        .bg-success-subtle {
            background-color: #d1e7dd;
        }

        .bg-warning-subtle {
            background-color: #fff3cd;
        }

        .bg-danger-subtle {
            background-color: #f8d7da;
        }
    </style>
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            $('#historyTable').DataTable({
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
    </script>
@endpush
