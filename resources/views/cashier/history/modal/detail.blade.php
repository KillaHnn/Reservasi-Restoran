<div class="modal fade" id="detailModal{{ $res->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content overflow-hidden" style="border-radius: 25px; border: none; box-shadow: 0 15px 35px rgba(0,0,0,0.2);">
            
            <div class="text-center p-4 text-white position-relative" style="background: linear-gradient(135deg, #800000 0%, #4a0000 100%);">
                <button type="button" class="btn-close btn-close-white position-absolute end-0 top-0 m-3" data-bs-dismiss="modal" aria-label="Close"></button>
                <i class="fas fa-file-invoice fa-3x mb-2 opacity-50"></i>
                <h5 class="fw-bold mb-0">Detail Reservasi</h5>
                <span class="badge bg-white bg-opacity-25 rounded-pill mt-2">#RSV-{{ str_pad($res->id, 5, '0', STR_PAD_LEFT) }}</span>
            </div>

            <div class="modal-body p-4 bg-light">
                <div class="card border-0 shadow-sm rounded-4 mb-3">
                    <div class="card-body d-flex align-items-center">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode($res->user->name) }}&background=800000&color=fff" class="rounded-circle me-3" width="50">
                        <div>
                            <h6 class="fw-bold mb-0 text-dark">{{ $res->user->name }}</h6>
                            <small class="text-muted">{{ $res->user->phone_number ?? 'No Phone' }}</small>
                        </div>
                    </div>
                </div>

                <div class="row g-2 mb-3">
                    <div class="col-6">
                        <div class="p-3 bg-white rounded-4 shadow-sm border-start border-4 border-danger">
                            <small class="text-muted d-block fw-bold small text-uppercase">Nomor Meja</small>
                            <span class="fw-bold text-dark fs-5">{{ $res->table->table_number }}</span>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="p-3 bg-white rounded-4 shadow-sm border-start border-4 border-primary">
                            <small class="text-muted d-block fw-bold small text-uppercase">Kapasitas</small>
                            <span class="fw-bold text-dark fs-5">{{ $res->table->capacity }} Pax</span>
                        </div>
                    </div>
                </div>

                <div class="p-3 rounded-4 bg-white shadow-sm mb-4">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <small class="text-muted fw-bold small text-uppercase">Status Bayar</small>
                        @php $payStatus = strtolower($res->payment->status_payment ?? 'unpaid'); @endphp
                        <span class="badge {{ $payStatus == 'paid' ? 'bg-success' : 'bg-warning' }} rounded-pill">
                            {{ strtoupper($payStatus) }}
                        </span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <small class="text-muted fw-bold small text-uppercase">Deposit</small>
                        <span class="fw-bold text-dark fs-5">Rp {{ number_format($res->payment->nominal_deposit ?? 0, 0, ',', '.') }}</span>
                    </div>
                </div>

                <div class="d-grid gap-2">


                    <button type="button" class="btn btn-outline-secondary w-100 py-2 rounded-pill fw-bold small" data-bs-dismiss="modal">
                        Tutup
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>