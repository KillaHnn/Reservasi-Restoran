@extends('layouts.app')

@section('title', 'Cashier Dashboard')
@section('page_title', 'Point of Sale & Orders')

@section('content')
    <div class="row g-4">
        <div class="col-md-3">
            <div class="card card-custom p-3 border-start border-4" style="border-color: var(--accent) !important;">
                <div class="d-flex align-items-center">
                    <div class="p-3 rounded-circle bg-opacity-10 bg-danger me-3">
                        <i class="fas fa-wallet" style="color: var(--primary)"></i>
                    </div>
                    <div>
                        <p class="small text-muted mb-0">Today's Income</p>
                        <h5 class="fw-bold mb-0">Rp 4.500.000</h5>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card card-custom p-3 border-start border-4" style="border-color: var(--primary) !important;">
                <div class="d-flex align-items-center">
                    <div class="p-3 rounded-circle bg-opacity-10 bg-warning me-3">
                        <i class="fas fa-shopping-bag" style="color: var(--secondary)"></i>
                    </div>
                    <div>
                        <p class="small text-muted mb-0">Active Orders</p>
                        <h5 class="fw-bold mb-0">12 Orders</h5>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-8">
            <div class="card card-custom h-100">
                <div
                    class="card-header bg-transparent border-0 pt-4 px-4 d-flex justify-content-between align-items-center">
                    <h5 class="fw-bold mb-0" style="color: var(--primary)">Current Orders</h5>
                    <button class="btn btn-sm btn-resto"><i class="fas fa-sync-alt"></i> Refresh</button>
                </div>
                <div class="card-body px-4">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead>
                                <tr class="text-muted small">
                                    <th>ORDER ID</th>
                                    <th>TABLE</th>
                                    <th>CUSTOMER</th>
                                    <th>ITEMS</th>
                                    <th>TOTAL</th>
                                    <th>ACTION</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="fw-bold">#ORD-00124</td>
                                    <td><span class="badge bg-light text-dark p-2">Table 05</span></td>
                                    <td>Budi Santoso</td>
                                    <td>3 Items</td>
                                    <td class="fw-bold text-danger">Rp 350.000</td>
                                    <td>
                                        <button class="btn btn-sm btn-resto py-1 px-3">Process Payment</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">#ORD-00125</td>
                                    <td><span class="badge bg-light text-dark p-2">Table 12</span></td>
                                    <td>Siti Aminah</td>
                                    <td>1 Items</td>
                                    <td class="fw-bold text-danger">Rp 85.000</td>
                                    <td>
                                        <button class="btn btn-sm btn-resto py-1 px-3">Process Payment</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card card-custom mb-4">
                <div class="card-body text-center py-4">
                    <div class="bg-light p-4 rounded-4 mb-3">
                        <i class="fas fa-cash-register fa-3x" style="color: var(--primary)"></i>
                    </div>
                    <h5 class="fw-bold">New Transaction</h5>
                    <p class="small text-muted">Click below to start a new walk-in order or billing.</p>
                    <a href="#" class="btn btn-resto w-100 py-3 mt-2 shadow-sm">
                        <i class="fas fa-plus-circle me-2"></i> CREATE NEW INVOICE
                    </a>
                </div>
            </div>

            <div class="card card-custom p-4 bg-dark text-white">
                <h6 class="fw-bold mb-3" style="color: var(--accent)">Cashier Shift Info</h6>
                <div class="d-flex justify-content-between mb-2">
                    <span class="small opacity-75">Start Time:</span>
                    <span class="small fw-bold">08:00 AM</span>
                </div>
                <div class="d-flex justify-content-between mb-2">
                    <span class="small opacity-75">Current Cash:</span>
                    <span class="small fw-bold">Rp 500.000</span>
                </div>
                <hr class="border-secondary">
                <button class="btn btn-outline-warning btn-sm w-100">End My Shift</button>
            </div>
        </div>
    </div>
@endsection
