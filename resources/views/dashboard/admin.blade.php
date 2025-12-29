@extends('layouts.app')

@section('title', 'Admin Dashboard')
@section('page_title', 'Analytics Overview')

@section('content')
<div class="row g-4">
    <div class="col-md-4">
        <div class="card card-custom p-4 text-center">
            <h6 class="text-muted">TOTAL RESERVATIONS</h6>
            <h2 class="fw-bold" style="color: var(--primary)">1,284</h2>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card card-custom p-4">
            <h5 class="fw-bold mb-3">Admin Action Panel</h5>
            <p>Selamat datang di panel kontrol Luxe Resto.</p>
            <button class="btn btn-resto">Generate Monthly Report</button>
        </div>
    </div>
</div>
@endsection