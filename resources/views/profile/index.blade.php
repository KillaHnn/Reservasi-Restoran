@extends('layouts.app')

@section('title', 'My Profile')
@section('page_title', 'User Profile')

@section('content')
    @if (session('success'))
        <div class="alert alert-success border-0 shadow-sm mb-4" style="border-radius: 15px;">
            <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
        </div>
    @endif

    <div class="row g-4">
        <div class="col-lg-4">
            <div class="card card-custom border-0 shadow-sm text-center p-4">
                <div class="position-relative d-inline-block mx-auto mb-3">
                    <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}&background=A31B31&color=FFC069&size=150"
                        class="rounded-circle shadow-sm border border-4 border-white" alt="User Avatar">
                    <button class="btn btn-sm btn-resto position-absolute bottom-0 end-0 rounded-circle p-2"
                        style="width: 35px; height: 35px;">
                        <i class="fas fa-camera"></i>
                    </button>
                </div>
                <h4 class="fw-bold mb-1">{{ Auth::user()->name }}</h4>
                <span class="badge badge-status text-uppercase mb-3">{{ Auth::user()->role }}</span>
                <p class="text-muted small">Member since {{ Auth::user()->created_at->format('M Y') }}</p>

                <hr class="my-4 opacity-50">

                <div class="text-start px-2">
                    <div class="d-flex align-items-center mb-3">
                        <div class="bg-light p-2 rounded-3 me-3 text-center" style="width: 40px;">
                            <i class="fas fa-envelope text-danger"></i>
                        </div>
                        <div>
                            <p class="small text-muted mb-0">Email Address</p>
                            <p class="fw-bold mb-0 small">{{ Auth::user()->email }}</p>
                        </div>
                    </div>
                    <div class="d-flex align-items-center mb-3">
                        <div class="bg-light p-2 rounded-3 me-3 text-center" style="width: 40px;">
                            <i class="fas fa-phone text-danger"></i>
                        </div>
                        <div>
                            <p class="small text-muted mb-0">Phone Number</p>
                            <p class="fw-bold mb-0 small">{{ Auth::user()->phone_number ?? '-' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-8">
            <div class="card card-custom border-0 shadow-sm p-4 mb-4">
                <h5 class="fw-bold mb-4" style="color: var(--primary)">
                    <i class="fas fa-user-edit me-2"></i> Personal Information
                </h5>

                <form action="{{ route('profile.update') }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label class="small fw-bold mb-2">FULL NAME</label>
                            <input type="text" name="name"
                                class="form-control bg-light border-0 p-3 @error('name') is-invalid @enderror"
                                value="{{ old('name', Auth::user()->name) }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="small fw-bold mb-2">EMAIL ADDRESS</label>
                            <input type="email" name="email"
                                class="form-control bg-light border-0 p-3 @error('email') is-invalid @enderror"
                                value="{{ old('email', Auth::user()->email) }}" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="small fw-bold mb-2">PHONE NUMBER</label>
                            <input type="text" name="phone_number"
                                class="form-control bg-light border-0 p-3 @error('phone_number') is-invalid @enderror"
                                value="{{ old('phone_number', Auth::user()->phone_number) }}"
                                placeholder="e.g. 08123456789" required>
                            @error('phone_number')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="text-end mt-3">
                        <button type="submit" class="btn btn-resto px-5 py-2">Save Changes</button>
                    </div>
                </form>
            </div>

            <div class="card card-custom border-0 shadow-sm p-4 text-dark">
                <h5 class="fw-bold mb-4" style="color: var(--secondary)">
                    <i class="fas fa-lock me-2"></i> Change Password
                </h5>
                <form action="{{ route('profile.password') }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="small fw-bold mb-2">CURRENT PASSWORD</label>
                        <input type="password" name="current_password"
                            class="form-control bg-light border-0 p-3 @error('current_password') is-invalid @enderror"
                            placeholder="Confirm current password" required>
                        @error('current_password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="small fw-bold mb-2">NEW PASSWORD</label>
                            <input type="password" name="new_password"
                                class="form-control bg-light border-0 p-3 @error('new_password') is-invalid @enderror"
                                placeholder="Min. 8 characters" required>
                            @error('new_password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="small fw-bold mb-2">CONFIRM NEW PASSWORD</label>
                            <input type="password" name="new_password_confirmation"
                                class="form-control bg-light border-0 p-3" placeholder="Repeat new password" required>
                        </div>
                    </div>
                    <div class="text-end mt-3">
                        <button type="submit" class="btn btn-outline-danger px-5 py-2 fw-bold">Update Password</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
