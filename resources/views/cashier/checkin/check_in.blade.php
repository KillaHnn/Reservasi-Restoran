@extends('layouts.app')

@section('title', 'Check-in Terminal')

@section('content')
    <div class="container-fluid py-4">
        <div class="card card-custom border-0 shadow-sm p-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h5 class="fw-bold mb-0" style="color: var(--primary)">
                    <i class="fas fa-clipboard-check me-2"></i> Antrean Kedatangan Tamu
                </h5>
                <div class="d-flex gap-2">
                    <a href="{{ route('cashier.checkin.active_tables') }}" class="btn btn-resto shadow-sm fw-bold px-4">
                        <i class="fas fa-chair me-2"></i> Meja Aktif
                    </a>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-hover align-middle" id="checkinTable">
                    <thead class="bg-light">
                        <tr>
                            <th class="border-0 px-3 py-3 small fw-bold">BOOKING ID</th>
                            <th class="border-0 py-3 small fw-bold">WAKTU TIBA</th>
                            <th class="border-0 py-3 small fw-bold">NAMA PELANGGAN</th>
                            <th class="border-0 py-3 small fw-bold">MEJA</th>
                            <th class="border-0 py-3 small fw-bold">PEMBAYARAN</th>
                            <th class="border-0 py-3 small fw-bold text-center">AKSI KASIR</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($reservations as $res)
                            <tr>
                                <td class="px-3 fw-bold text-muted">#RSV-{{ str_pad($res->id, 5, '0', STR_PAD_LEFT) }}</td>
                                <td>
                                    <span class="fw-bold">{{ date('H:i', strtotime($res->start_time)) }}</span>
                                    <small class="text-muted d-block">WIB</small>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="https://ui-avatars.com/api/?name={{ urlencode($res->user->name) }}&background=800000&color=fff"
                                            class="rounded-circle me-2" width="30">
                                        <span class="fw-bold">{{ $res->user->name }}</span>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge bg-dark px-3">Meja
                                        {{ $res->table->table_number ?? $res->table->name }}</span>
                                </td>
                                <td>
                                    <span class="badge bg-success-subtle text-success border-success border">
                                        <i class="fas fa-check-circle me-1"></i> Paid
                                    </span>
                                </td>
                                <td class="text-center">
                                    <button class="btn btn-resto btn-sm px-4 fw-bold shadow-sm rounded-pill"
                                        onclick="confirmCheckIn('{{ $res->id }}', '{{ $res->user->name }}', '{{ $res->table->table_number ?? $res->table->name }}')">
                                        Check-in <i class="fas fa-sign-in-alt ms-1"></i>
                                    </button>
                                </td>
                            </tr>
                        @empty
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <style>
        :root {
            --primary: #800000;
        }

        .text-maroon {
            color: var(--primary);
        }

        .card-custom {
            border-radius: 15px;
            background: #ffffff;
        }

        .btn-resto {
            background-color: var(--primary);
            color: white;
            border-radius: 8px;
            transition: 0.3s;
            border: none;
        }

        .btn-resto:hover {
            background-color: #600000;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(128, 0, 0, 0.3);
        }

        .badge {
            font-weight: 600;
            letter-spacing: 0.3px;
        }

        .table thead th {
            color: #6c757d;
            letter-spacing: 0.5px;
        }

        .bg-success-subtle {
            background-color: #d1e7dd !important;
        }

        .page-item.active .page-link {
            background-color: var(--primary) !important;
            border-color: var(--primary) !important;
        }

        .dataTables_wrapper .dataTables_filter input {
            border-radius: 20px;
            padding: 5px 15px;
            border: 1px solid #dee2e6;
        }
    </style>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function confirmCheckIn(id, name, table) {
            Swal.fire({
                title: 'Konfirmasi Check-in',
                html: `Tamu <b>${name}</b> di <b>Meja ${table}</b> sudah siap masuk?`,
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#800000',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, Masuk!',
                cancelButtonText: 'Batal',
                borderRadius: '15px',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: 'Memproses...',
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading()
                        }
                    });

                    let url = "{{ route('checkin.process', ':id') }}".replace(':id', id);

                    fetch(url, {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Content-Type': 'application/json',
                                'Accept': 'application/json'
                            }
                        })
                        .then(async res => {
                            const data = await res.json();
                            if (!res.ok) throw new Error(data.message || 'Gagal memproses check-in');
                            return data;
                        })
                        .then(data => {
                            if (data.success) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil!',
                                    text: data.message,
                                    timer: 1500,
                                    showConfirmButton: false
                                }).then(() => location.reload());
                            }
                        })
                        .catch(error => {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: error.message
                            });
                        });
                }
            });
        }
    </script>
@endpush
