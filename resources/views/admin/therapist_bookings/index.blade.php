@extends('admin.layouts.app')

@section('title', 'Therapist Bookings')
@section('page_title', 'Therapist Session Bookings')

@section('content')
    <div class="card">
        <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
            <h5 class="mb-0 fw-bold">All Session Bookings</h5>
            <div class="d-flex gap-2">
                <a href="{{ route('admin.therapist-bookings.export', request()->query()) }}" class="btn btn-success btn-sm">
                    <i class="bi bi-file-earmark-spreadsheet me-1"></i> Download CSV
                </a>
            </div>
        </div>
        <div class="card-body bg-light border-bottom p-3">
            <form id="filterForm" action="{{ route('admin.therapist-bookings.index') }}" method="GET" class="row g-2">
                <div class="col-md-4">
                    <input type="text" name="search" id="searchInput" class="form-control form-control-sm"
                        placeholder="Search by Patient Name..." value="{{ request('search') }}">
                </div>
                <div class="col-md-4">
                    <select name="therapist_id" id="therapistSelect" class="form-select form-select-sm">
                        <option value="">-- All Therapists --</option>
                        @foreach($therapists as $t)
                            <option value="{{ $t->id }}" {{ request('therapist_id') == $t->id ? 'selected' : '' }}>
                                {{ $t->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4 d-flex gap-2">
                    <button type="submit" class="btn btn-primary btn-sm px-4">
                        <i class="bi bi-search me-1"></i> Filter
                    </button>
                    <a href="{{ route('admin.therapist-bookings.index') }}" id="clearBtn"
                        class="btn btn-outline-secondary btn-sm {{ !request()->anyFilled(['search', 'therapist_id']) ? 'd-none' : '' }}">
                        Clear
                    </a>
                </div>
            </form>
        </div>
        <div class="card-body p-0" id="tableContainer">
            @include('admin.therapist_bookings._table')
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function () {
            const tableContainer = $('#tableContainer');
            const filterForm = $('#filterForm');
            const searchInput = $('#searchInput');
            const therapistSelect = $('#therapistSelect');
            const csvBtn = $('.btn-success');
            const clearBtn = $('#clearBtn');

            function updateTable(url) {
                tableContainer.css('opacity', '0.5');

                $.ajax({
                    url: url,
                    method: 'GET',
                    success: function (response) {
                        tableContainer.html(response);
                        tableContainer.css('opacity', '1');

                        // Update CSV link
                        const params = filterForm.serialize();
                        const baseUrl = "{{ route('admin.therapist-bookings.export') }}";
                        csvBtn.attr('href', baseUrl + '?' + params);

                        // Show/Hide Clear button
                        if (searchInput.val() || therapistSelect.val()) {
                            clearBtn.removeClass('d-none');
                        } else {
                            clearBtn.addClass('d-none');
                        }
                    }
                });
            }

            // Handle form changes (for instant filtering)
            let timeout = null;
            searchInput.on('keyup', function () {
                clearTimeout(timeout);
                timeout = setTimeout(() => {
                    updateTable(filterForm.attr('action') + '?' + filterForm.serialize());
                }, 500);
            });

            therapistSelect.on('change', function () {
                updateTable(filterForm.attr('action') + '?' + filterForm.serialize());
            });

            // Handle form submit
            filterForm.on('submit', function (e) {
                e.preventDefault();
                updateTable(filterForm.attr('action') + '?' + filterForm.serialize());
            });

            // Handle pagination clicks
            $(document).on('click', '.pagination a', function (e) {
                e.preventDefault();
                updateTable($(this).attr('href'));
                $('html, body').animate({ scrollTop: $(".card").offset().top - 100 }, 100);
            });
        });
    </script>
@endpush