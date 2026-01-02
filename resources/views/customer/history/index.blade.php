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
                @include('customer.history.modal.detail')
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
