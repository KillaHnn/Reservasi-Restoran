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

                <div class="p-3 rounded-4 bg-white shadow-sm d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <small class="text-muted d-block fw-bold small">STATUS</small>
                        @php $status = strtolower($res->payment->status_payment ?? 'unpaid'); @endphp
                        @if ($status == 'paid')
                            <span class="text-success fw-bold"><i class="fas fa-check-circle"></i> Paid</span>
                        @else
                            <span class="text-danger fw-bold"><i class="fas fa-exclamation-circle"></i> Unpaid</span>
                        @endif
                    </div>
                    <div class="text-end">
                        <small class="text-muted d-block fw-bold small">NOMINAL</small>
                        <span class="fw-bold text-dark fs-5">Rp
                            {{ number_format($res->payment->nominal_deposit ?? 0, 0, ',', '.') }}</span>
                    </div>
                </div>

                <div class="cancel-container">
                    @if (!in_array(strtolower($res->status), ['confirmed', 'completed', 'cancelled']))
                        <button type="button"
                            class="btn btn-outline-danger w-100 py-2 rounded-pill fw-bold border-2 mb-2"
                            id="btn-confirm-{{ $res->id }}" onclick="showConfirm('{{ $res->id }}')">
                            <i class="fas fa-times-circle me-1"></i> Batalkan Reservasi
                        </button>

                        <div id="wrapper-confirm-{{ $res->id }}" class="d-none mb-3">
                            <p class="small text-danger text-center mb-2 fw-bold">Yakin ingin membatalkan?</p>
                            <div class="d-flex gap-2">
                                <button type="button" class="btn btn-light w-50 py-2 rounded-pill fw-bold small border"
                                    onclick="hideConfirm('{{ $res->id }}')">Gak jadi</button>

                                <form action="{{ route('reservations.cancel', $res->id) }}" method="POST"
                                    class="w-50">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit"
                                        class="btn btn-danger w-100 py-2 rounded-pill fw-bold small">Ya, Batal</button>
                                </form>
                            </div>
                        </div>
                    @endif
                </div>

                <button type="button" class="btn btn-dark w-100 py-3 rounded-pill fw-bold shadow-sm"
                    data-bs-dismiss="modal">
                    Tutup Detail
                </button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        function showConfirm(id) {
            document.getElementById('btn-confirm-' + id).classList.add('d-none');
            document.getElementById('wrapper-confirm-' + id).classList.remove('d-none');
        }

        function hideConfirm(id) {
            document.getElementById('wrapper-confirm-' + id).classList.add('d-none');
            document.getElementById('btn-confirm-' + id).classList.remove('d-none');
        }
    </script>
@endpush
