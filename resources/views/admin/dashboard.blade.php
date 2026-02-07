@extends('admin.layouts.app')

@section('title', 'Dashboard')
@section('page_title', 'Admin Dashboard Overview')

@section('content')
    <div class="row g-4">
        <div class="col-12 col-md-6 col-lg-3">
            <div class="card p-3">
                <div class="d-flex align-items-center">
                    <div class="bg-primary text-white p-3 rounded-3 me-3">
                        <i class="bi bi-file-earmark-text fs-4"></i>
                    </div>
                    <div>
                        <h6 class="mb-0 text-muted">Pages</h6>
                        <h4 class="mb-0 fw-bold">12</h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 col-lg-3">
            <div class="card p-3">
                <div class="d-flex align-items-center">
                    <div class="bg-success text-white p-3 rounded-3 me-3">
                        <i class="bi bi-people fs-4"></i>
                    </div>
                    <div>
                        <h6 class="mb-0 text-muted">Therapists</h6>
                        <h4 class="mb-0 fw-bold">8</h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 col-lg-3">
            <div class="card p-3">
                <div class="d-flex align-items-center">
                    <div class="bg-warning text-white p-3 rounded-3 me-3">
                        <i class="bi bi-journal-check fs-4"></i>
                    </div>
                    <div>
                        <h6 class="mb-0 text-muted">Bookings</h6>
                        <h4 class="mb-0 fw-bold">45</h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 col-lg-3">
            <div class="card p-3">
                <div class="d-flex align-items-center">
                    <div class="bg-info text-white p-3 rounded-3 me-3">
                        <i class="bi bi-heart fs-4"></i>
                    </div>
                    <div>
                        <h6 class="mb-0 text-muted">Donations</h6>
                        <h4 class="mb-0 fw-bold">₹12,400</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-5">
        <div class="col-lg-8">
            <div class="card p-4">
                <h5 class="fw-bold mb-4">Quick Page Management</h5>
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Page Name</th>
                                <th>Last Updated</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><strong>Home Page</strong></td>
                                <td>Feb 07, 2026</td>
                                <td><span class="badge bg-success">Live</span></td>
                                <td><a href="{{ route('admin.pages.edit', 'home') }}"
                                        class="btn btn-sm btn-primary">Edit</a></td>
                            </tr>
                            <tr>
                                <td><strong>About Us</strong></td>
                                <td>Feb 06, 2026</td>
                                <td><span class="badge bg-success">Live</span></td>
                                <td><a href="{{ route('admin.pages.edit', 'about') }}"
                                        class="btn btn-sm btn-primary">Edit</a></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card p-4 h-100">
                <h5 class="fw-bold mb-4">System Alerts</h5>
                <div class="alert alert-info py-2 small">
                    <i class="bi bi-info-circle me-1"></i> New booking received for 10:00 AM tomorrow.
                </div>
                <div class="alert alert-warning py-2 small">
                    <i class="bi bi-exclamation-triangle me-1"></i> Razorpay API keys not configured.
                </div>
            </div>
        </div>
    </div>
@endsection