@extends('layouts.app')

@section('content')
    <div class="container-fluid py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="fw-bold text-dark mb-0">Riwayat Reservasi</h4>
        </div>

        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-body">
                <table id="cashierTable" class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th>CUSTOMER</th>
                            <th>MEJA</th>
                            <th>JADWAL</th>
                            <th>STATUS</th>
                            <th>AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($reservations as $res)
                            <tr>
                                <td>
                                    <div class="fw-bold">{{ $res->user->name }}</div>
                                    <small class="text-muted">ID: #{{ $res->id }}</small>
                                </td>
                                <td><span class="badge bg-light text-dark border">Meja {{ $res->table->table_number }}</span></td>
                                <td>{{ $res->start_time->format('H:i') }} WIB</td>
                                <td>
                                    @php
                                        $statusClass = [
                                            'pending' => 'bg-warning',
                                            'confirmed' => 'bg-primary',
                                            'completed' => 'bg-success',
                                            'cancelled' => 'bg-danger',
                                        ];
                                    @endphp
                                    <span class="badge {{ $statusClass[strtolower($res->status)] ?? 'bg-secondary' }}">
                                        {{ strtoupper($res->status) }}
                                    </span>
                                </td>
                                <td>
                                    <button class="btn btn-dark btn-sm rounded-pill px-3 fw-bold" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#detailModal{{ $res->id }}">
                                        <i class="fas fa-eye me-1"></i> Detail
                                    </button>
                                </td>
                            </tr>

                            @include('cashier.history.modal.detail', ['res' => $res])
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection