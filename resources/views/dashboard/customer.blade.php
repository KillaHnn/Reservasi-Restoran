@extends('layouts.app')

@section('title', 'My Reservation')
@section('page_title', 'Welcome back!')

@section('content')
<div class="row g-4">
    <div class="col-lg-4">
        <div class="card card-custom p-4">
            <h5 class="fw-bold mb-4" style="color: var(--primary)">Reserve a Table</h5>
            <form>
                <div class="mb-3">
                    <label class="form-label small fw-bold">DATE</label>
                    <input type="date" class="form-control border-0 bg-light p-3">
                </div>
                <button class="btn btn-resto w-100 p-3 mt-2">BOOK NOW</button>
            </form>
        </div>
    </div>
</div>
@endsection