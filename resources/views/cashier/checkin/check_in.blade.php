@extends('layouts.app')

@section('title', 'Manajemen Kedatangan Tamu')

@section('content')
    <div class="container-fluid py-4">
        <div class="row mb-4">
            <div class="col-12">
                <div class="card border-0 shadow-sm p-4" style="border-radius: 20px;">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div>
                            <h4 class="fw-bold mb-1">Check-in Pelanggan</h4>
                            <p class="text-muted small">Daftar tamu hari ini yang sudah menyelesaikan pembayaran deposit.</p>
                        </div>
                        <div class="text-end">
                            <span class="badge bg-primary px-3 py-2">Total Antrean: {{ $reservations->count() }}</span>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="bg-light">
                                <tr>
                                    <th class="py-3 border-0">ID BOOKING</th>
                                    <th class="py-3 border-0">PELANGGAN</th>
                                    <th class="py-3 border-0 text-center">MEJA</th>
                                    <th class="py-3 border-0 text-center">JUMLAH TAMU</th>
                                    <th class="py-3 border-0">JADWAL</th>
                                    <th class="py-3 border-0">STATUS BAYAR</th>
                                    <th class="py-3 border-0 text-center">AKSI</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($reservations as $res)
                                    <tr id="row-{{ $res->id }}">
                                        <td class="fw-bold text-primary">#{{ str_pad($res->id, 5, '0', STR_PAD_LEFT) }}</td>
                                        <td>
                                            <div class="fw-bold">{{ $res->user->name }}</div>
                                            <small class="text-muted">{{ $res->user->email }}</small>
                                        </td>
                                        <td class="text-center">
                                            <span class="badge bg-dark px-3 py-2">Meja {{ $res->table->name }}</span>
                                        </td>
                                        <td class="text-center">{{ $res->guest_count }} Orang</td>
                                        <td>
                                            <div class="fw-bold">
                                                {{ \Carbon\Carbon::parse($res->start_time)->format('H:i') }}</div>
                                            <small class="text-muted">s/d
                                                {{ \Carbon\Carbon::parse($res->end_time)->format('H:i') }}</small>
                                        </td>
                                        <td>
                                            @if ($res->payment && $res->payment->status_payment == 'paid')
                                                <span class="badge bg-success px-3 py-2"><i
                                                        class="fas fa-check-circle me-1"></i> Paid</span>
                                            @else
                                                <span class="badge bg-warning px-3 py-2">Pending</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if ($res->status !== 'completed')
                                                <button class="btn btn-primary btn-sm px-4 rounded-pill fw-bold shadow-sm"
                                                    onclick="handleCheckIn('{{ $res->id }}', '{{ $res->user->name }}', '{{ $res->table->name }}')">
                                                    Check-in
                                                </button>
                                            @else
                                                <button class="btn btn-outline-danger btn-sm px-4 rounded-pill fw-bold"
                                                    onclick="handleCheckOut('{{ $res->id }}')">
                                                    Check-out
                                                </button>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center py-5">
                                            <div class="text-muted">
                                                <i class="fas fa-calendar-times fa-3x mb-3"></i>
                                                <p>Tidak ada jadwal check-in untuk hari ini.</p>
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
        .table thead th {
            font-size: 0.8rem;
            letter-spacing: 1px;
        }

        .card {
            transition: all 0.3s ease;
        }

        .btn-primary {
            background: #0d6efd;
            border: none;
        }

        .btn-primary:hover {
            background: #0a58ca;
        }
    </style>
@endsection
@push('scripts')
    <script>
        function handleCheckIn(id, name, table) {
            Swal.fire({
                title: 'Konfirmasi Kedatangan',
                html: `Tamu <b>${name}</b> sudah tiba?<br>Status <b>Meja ${table}</b> akan menjadi <b>Terisi</b>.`,
                icon: 'info',
                showCancelButton: true,
                confirmButtonColor: '#0d6efd',
                confirmButtonText: 'Ya, Check-in Sekarang',
                cancelButtonText: 'Batal',
                showLoaderOnConfirm: true,
                preConfirm: () => {
                    return fetch(`/cashier/checkin/${id}`, {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Content-Type': 'application/json'
                            }
                        })
                        .then(response => {
                            if (!response.ok) throw new Error('Gagal memproses data');
                            return response.json();
                        })
                        .catch(error => {
                            Swal.showValidationMessage(`Request failed: ${error}`);
                        });
                }
            }).then((result) => {
                if (result.isConfirmed && result.value.success) {
                    Swal.fire('Berhasil!', result.value.message, 'success')
                        .then(() => location.reload());
                }
            });
        }

        function handleCheckOut(id) {
            Swal.fire({
                title: 'Tamu Selesai?',
                text: "Meja akan dikosongkan dan status menjadi Selesai.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc3545',
                confirmButtonText: 'Ya, Check-out',
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch(`/cashier/checkout/${id}`, {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            }
                        })
                        .then(res => res.json())
                        .then(data => {
                            if (data.success) {
                                Swal.fire('Selesai', data.message, 'success').then(() => location.reload());
                            }
                        });
                        
                }
            });
        }
    </script>
@endpush
