@extends('admin.layouts.app')

@section('title', 'Manage Team')
@section('page_title', 'Our Experts & Team')

@section('content')
    <!-- Global Booking Settings -->
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-header bg-white py-3">
            <h5 class="mb-0 fw-bold"><i class="bi bi-gear-fill me-2 text-primary"></i>Global Booking Settings</h5>
        </div>
        <div class="card-body p-4">
            <form action="{{ route('admin.settings.update') }}" method="POST">
                @csrf
                <div class="row g-3">
                    <div class="col-md-8">
                        <label class="form-label fw-bold">In-Person Booking Address</label>
                        <textarea name="booking_address" class="form-control" rows="2"
                            required>{{ $bookingSettings['booking_address'] ?? '' }}</textarea>
                        <small class="text-muted">This address will only be shown when "In-person" mode is selected.</small>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-bold">Session Duration</label>
                        <input type="text" name="session_duration" class="form-control"
                            value="{{ $bookingSettings['session_duration'] ?? '' }}" required placeholder="e.g. 50 mins">
                        <small class="text-muted">Global duration shown for all sessions.</small>
                        <div class="mt-3 text-end">
                            <button type="submit" class="btn btn-primary px-4">Save Booking Settings</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
            <h5 class="mb-0 fw-bold">Team Members</h5>
            <a href="{{ route('admin.teams.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-lg me-1"></i> Add New Member
            </a>
        </div>
        <div class="card-body bg-light border-bottom p-3">
            <form id="filterForm" action="{{ route('admin.teams.index') }}" method="GET" class="row g-2">
                <div class="col-md-5">
                    <div class="input-group input-group-sm">
                        <span class="input-group-text bg-white border-end-0"><i class="bi bi-search"></i></span>
                        <input type="text" name="search" id="searchInput" class="form-control border-start-0"
                            placeholder="Search by Name, Designation or Email..." value="{{ request('search') }}">
                    </div>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary btn-sm px-4">Filter</button>
                    <a href="{{ route('admin.teams.index') }}" id="clearBtn"
                        class="btn btn-outline-secondary btn-sm {{ !request('search') ? 'd-none' : '' }}">
                        Clear
                    </a>
                </div>
            </form>
        </div>
        <div class="card-body p-0" id="tableContainer">
            @include('admin.teams._table')
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function () {
            const tableContainer = $('#tableContainer');
            const filterForm = $('#filterForm');
            const searchInput = $('#searchInput');
            const clearBtn = $('#clearBtn');

            function updateTable(url) {
                tableContainer.css('opacity', '0.5');

                $.ajax({
                    url: url,
                    method: 'GET',
                    success: function (response) {
                        tableContainer.html(response);
                        tableContainer.css('opacity', '1');

                        if (searchInput.val()) {
                            clearBtn.removeClass('d-none');
                        } else {
                            clearBtn.addClass('d-none');
                        }
                    }
                });
            }

            let timeout = null;
            searchInput.on('keyup', function () {
                clearTimeout(timeout);
                timeout = setTimeout(() => {
                    updateTable(filterForm.attr('action') + '?' + filterForm.serialize());
                }, 500);
            });

            filterForm.on('submit', function (e) {
                e.preventDefault();
                updateTable(filterForm.attr('action') + '?' + filterForm.serialize());
            });

            $(document).on('click', '.pagination a', function (e) {
                e.preventDefault();
                updateTable($(this).attr('href'));
                $('html, body').animate({ scrollTop: $(".card").offset().top - 100 }, 100);
            });
        });
    </script>
@endpush