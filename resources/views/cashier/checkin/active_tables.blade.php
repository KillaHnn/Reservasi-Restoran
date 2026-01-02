@extends('layouts.app')

@section('title', 'Monitor Meja Aktif')

@section('content')
    <div class="container-fluid py-4">
        <div class="card card-custom border-0 shadow-sm p-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h5 class="fw-bold mb-0" style="color: var(--primary)">
                        <i class="fas fa-utensils me-2"></i> Status Meja Aktif
                    </h5>
                    <p class="text-muted small mb-0">Daftar tamu yang sedang menempati meja saat ini.</p>
                </div>
                <a href="{{ route('cashier.checkin.index') }}" class="btn btn-outline-dark rounded-pill px-4 fw-bold">
                    <i class="fas fa-arrow-left me-2"></i> Kembali ke Antrean
                </a>
            </div>

            <div class="table-responsive">
                <table class="table table-hover align-middle" id="activeTablesTable">
                    <thead class="bg-light">
                        <tr>
                            <th class="border-0 px-3 py-3 small fw-bold">MEJA</th>
                            <th class="border-0 py-3 small fw-bold">NAMA PELANGGAN</th>
                            <th class="border-0 py-3 small fw-bold text-center">PAX</th>
                            <th class="border-0 py-3 small fw-bold">WAKTU MASUK</th>
                            <th class="border-0 py-3 small fw-bold">ESTIMASI SELESAI</th>
                            <th class="border-0 py-3 small fw-bold text-center">AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($reservations as $res)
                            <tr>
                                <td class="px-3">
                                    <div class="table-badge-number">
                                        {{ $res->table->table_number ?? $res->table->name }}
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="https://ui-avatars.com/api/?name={{ urlencode($res->user->name) }}&background=800000&color=fff"
                                            class="rounded-circle me-2" width="30">
                                        <div>
                                            <span class="fw-bold d-block">{{ $res->user->name }}</span>
                                            <small
                                                class="text-muted small">#RSV-{{ str_pad($res->id, 5, '0', STR_PAD_LEFT) }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <span class="badge bg-light text-dark border px-2 py-1">{{ $res->guest_count }}
                                        Pax</span>
                                </td>
                                <td>
                                    <span class="fw-bold text-dark">{{ $res->updated_at->format('H:i') }}</span>
                                    <small class="text-muted d-block small">WIB</small>
                                </td>
                                <td>
                                    <span
                                        class="fw-bold text-maroon">{{ $res->end_time ? date('H:i', strtotime($res->end_time)) : '-' }}</span>
                                    <small class="text-muted d-block small">Estimasi Selesai</small>
                                </td>
                                <td class="text-center">
                                    <button class="btn btn-danger btn-sm px-3 fw-bold shadow-sm rounded-pill"
                                        onclick="handleCheckOut('{{ $res->id }}', '{{ $res->table->table_number ?? $res->table->name }}')">
                                        Check-out <i class="fas fa-sign-out-alt ms-1"></i>
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

        .table-badge-number {
            width: 40px;
            height: 40px;
            background-color: var(--primary);
            color: white;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 800;
            box-shadow: 0 4px 8px rgba(128, 0, 0, 0.15);
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
        }

        .badge {
            font-weight: 600;
            letter-spacing: 0.3px;
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
        $(document).ready(function() {
            $('#activeTablesTable').DataTable({
                "pageLength": 10,
                "language": {
                    "search": "",
                    "searchPlaceholder": "Cari meja atau pelanggan...",
                    "lengthMenu": "_MENU_",
                    "paginate": {
                        "previous": "<i class='fas fa-chevron-left'></i>",
                        "next": "<i class='fas fa-chevron-right'></i>"
                    }
                },
                "dom": '<"d-flex justify-content-between align-items-center mb-3"f l>rt<"d-flex justify-content-between align-items-center mt-3"i p>'
            });
        });

        function handleCheckOut(id, tableName) {
            Swal.fire({
                title: 'Selesaikan Pesanan?',
                html: `Konfirmasi Check-out untuk <b>Meja ${tableName}</b>? Meja akan tersedia kembali setelah ini.`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#800000',
                cancelButtonColor: '#94a3b8',
                confirmButtonText: 'Ya, Selesai',
                cancelButtonText: 'Batal',
                borderRadius: '15px'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: 'Memproses...',
                        didOpen: () => {
                            Swal.showLoading()
                        },
                        allowOutsideClick: false,
                        showConfirmButton: false
                    });

                    fetch(`/checkout/process/${id}`, {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Content-Type': 'application/json'
                            }
                        })
                        .then(res => res.json())
                        .then(data => {
                            if (data.success) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil!',
                                    text: `Tamu di Meja ${tableName} telah check-out.`,
                                    timer: 2000,
                                    showConfirmButton: false
                                }).then(() => location.reload());
                            } else {
                                Swal.fire('Gagal', data.message || 'Terjadi kesalahan', 'error');
                            }
                        })
                        .catch(() => Swal.fire('Error', 'Masalah koneksi server', 'error'));
                }
            });
        }
    </script>
@endpush
