@extends('admin.layouts.app')

@section('title', 'Manage Reviews')
@section('page_title', 'Therapist Reviews')

@section('content')
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
            <h5 class="mb-0 fw-bold">Review Management</h5>
        </div>

        <div class="card-body bg-light border-bottom p-3">
            <form id="filterForm" action="{{ route('admin.reviews.index') }}" method="GET" class="row g-2">
                <div class="col-md-5">
                    <div class="input-group input-group-sm">
                        <span class="input-group-text bg-white border-end-0"><i class="bi bi-search"></i></span>
                        <input type="text" name="search" id="searchInput" class="form-control border-start-0"
                            placeholder="Search Reviewer, Therapist or Comment..." value="{{ request('search') }}">
                    </div>
                </div>
                <div class="col-md-3">
                    <select name="status" id="statusFilter" class="form-select form-select-sm">
                        <option value="">All Status</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Approved</option>
                        <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary btn-sm px-3">Filter</button>
                        <a href="{{ route('admin.reviews.index') }}" id="clearBtn"
                            class="btn btn-outline-secondary btn-sm {{ !request('search') && !request('status') ? 'd-none' : '' }}">
                            Clear
                        </a>
                    </div>
                </div>
            </form>
        </div>

        <div class="card-body p-0" id="tableContainer">
            @include('admin.reviews._table')
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function () {
            const tableContainer = $('#tableContainer');
            const filterForm = $('#filterForm');
            const searchInput = $('#searchInput');
            const statusFilter = $('#statusFilter');
            const clearBtn = $('#clearBtn');

            function updateTable(url) {
                tableContainer.css('opacity', '0.5');

                $.ajax({
                    url: url,
                    method: 'GET',
                    success: function (response) {
                        tableContainer.html(response);
                        tableContainer.css('opacity', '1');

                        if (searchInput.val() || statusFilter.val()) {
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

            statusFilter.on('change', function () {
                updateTable(filterForm.attr('action') + '?' + filterForm.serialize());
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