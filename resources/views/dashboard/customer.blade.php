@extends('layouts.app')

@section('title', 'Customer Dashboard')
@section('page_title', 'Welcome back, ' . Auth::user()->nama . '!')

@section('content')
    <div class="row g-4">
        <div class="col-lg-12">
            <div class="row g-3 mb-4">
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm p-3 text-center" style="border-radius: 12px;">
                        <span class="text-muted small fw-bold">TOTAL BOOKINGS</span>
                        <h3 class="fw-bold mt-1" style="color: var(--primary-color)">{{ $totalBookings }}</h3>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm p-3 text-center" style="border-radius: 12px;">
                        <span class="text-muted small fw-bold">PENDING PAYMENT</span>
                        <h3 class="fw-bold mt-1 text-warning">{{ $pendingPayments }}</h3>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm p-3 text-center" style="border-radius: 12px;">
                        <span class="text-muted small fw-bold">VISITS THIS MONTH</span>
                        <h3 class="fw-bold mt-1" style="color: var(--secondary-color)">{{ $visitsThisMonth }}</h3>
                    </div>
                </div>
            </div>

            <div class="card border-0 shadow-sm" style="border-radius: 15px;">
                <div class="card-header bg-white border-0 pt-4 px-4 d-flex justify-content-between align-items-center">
                    <h5 class="fw-bold mb-0">Recent Reservations</h5>
                    <a href="{{ route('history.index') }}" class="small text-decoration-none fw-bold"
                        style="color: var(--primary-color)">View All</a>
                </div>
                <div class="card-body p-5">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0" id="datatable">
                            <thead class="bg-light">
                                <tr>
                                    <th class="ps-4 border-0 py-3">Date</th>
                                    <th class="border-0 py-3">Table</th>
                                    <th class="border-0 py-3">Time</th>
                                    <th class="border-0 py-3">Status</th>
                                    <th class="pe-4 border-0 py-3">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recentReservations as $res)
                                    <tr>
                                        <td class="ps-4 fw-bold">
                                            {{ \Carbon\Carbon::parse($res->reservation_date)->format('d M, Y') }}
                                        </td>

                                        <td>
                                            {{ $res->table->nomor_meja }} ({{ ucfirst($res->table->area) }})
                                        </td>

                                        <td>
                                            {{ \Carbon\Carbon::parse($res->start_time)->format('H:i') }} -
                                            {{ \Carbon\Carbon::parse($res->end_time)->format('H:i') }}
                                        </td>

                                        <td>
                                            @if ($res->status == 'confirmed')
                                                <span
                                                    class="badge bg-success-subtle text-success border border-success px-3 py-2 rounded-pill">Confirmed</span>
                                            @elseif($res->status == 'pending')
                                                <span
                                                    class="badge bg-warning-subtle text-warning border border-warning px-3 py-2 rounded-pill">Pending</span>
                                            @else
                                                <span
                                                    class="badge bg-secondary-subtle text-secondary border border-secondary px-3 py-2 rounded-pill">{{ ucfirst($res->status) }}</span>
                                            @endif
                                        </td>

                                        <td class="text-center align-middle">
                                            <div class="d-flex justify-content-center">
                                                @if ($res->payment)
                                                    @if ($res->payment->status_payment == 'unpaid')
                                                        <a href="{{ route('payment.instructions', [
                                                            'method' => $res->payment->payment_method,
                                                            'reservation_id' => $res->id,
                                                        ]) }}"
                                                            class="btn btn-sm btn-danger px-4 rounded-pill fw-bold shadow-sm">
                                                            Pay Now
                                                        </a>
                                                    @else
                                                        <a href="{{ route('history.index') }}"
                                                            class="btn btn-sm btn-outline-primary px-4 rounded-pill fw-bold"
                                                            style="min-width: 120px;">
                                                            View Detail
                                                        </a>
                                                    @endif
                                                @else
                                                    <span
                                                        class="badge bg-dark-subtle text-dark border border-dark px-3 py-2 rounded-pill">
                                                        No Invoice
                                                    </span>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center py-4 text-muted">No reservations found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            $('#datatable').DataTable({
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
