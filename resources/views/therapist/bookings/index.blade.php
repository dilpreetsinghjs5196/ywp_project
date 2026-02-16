@extends('layouts.therapist')

@section('title', 'My Bookings')
@section('page_title', 'Manage Session Bookings')

@section('content')
    <div class="card p-4 shadow-sm border-0 mb-4">
        <form id="filterForm" action="{{ route('therapist.bookings') }}" method="GET" class="row g-3">
            <div class="col-md-5">
                <div class="input-group">
                    <span class="input-group-text bg-white border-end-0"><i class="bi bi-search"></i></span>
                    <input type="text" name="search" id="searchInput" class="form-control border-start-0" placeholder="Search by name, email or phone..." value="{{ request('search') }}">
                </div>
            </div>
            <div class="col-md-3">
                <select name="status" id="statusSelect" class="form-select">
                    <option value="">All Statuses</option>
                    <option value="paid" {{ request('status') == 'paid' ? 'selected' : '' }}>Paid</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                </select>
            </div>
            <div class="col-md-4">
                <button type="submit" class="btn btn-primary px-4">Filter</button>
                <a href="{{ route('therapist.bookings') }}" id="clearBtn" class="btn btn-outline-secondary px-4 {{ !request('search') && !request('status') ? 'd-none' : '' }}">Clear</a>
            </div>
        </form>
    </div>

    <div class="card p-0 shadow-sm border-0" id="tableContainer">
        @include('therapist.bookings._table')
    </div>
@endsection

@push('js')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        const tableContainer = $('#tableContainer');
        const filterForm = $('#filterForm');
        const searchInput = $('#searchInput');
        const statusSelect = $('#statusSelect');
        const clearBtn = $('#clearBtn');

        function updateTable(url) {
            tableContainer.css('opacity', '0.5');

            $.ajax({
                url: url,
                method: 'GET',
                success: function (response) {
                    tableContainer.html(response);
                    tableContainer.css('opacity', '1');

                    if (searchInput.val() || statusSelect.val()) {
                        clearBtn.removeClass('d-none');
                    } else {
                        clearBtn.addClass('d-none');
                    }
                },
                error: function() {
                    tableContainer.css('opacity', '1');
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

        statusSelect.on('change', function () {
            updateTable(filterForm.attr('action') + '?' + filterForm.serialize());
        });

        filterForm.on('submit', function (e) {
            e.preventDefault();
            updateTable(filterForm.attr('action') + '?' + filterForm.serialize());
        });

        $(document).on('click', '.pagination a', function (e) {
            e.preventDefault();
            updateTable($(this).attr('href'));
            $('html, body').animate({ scrollTop: $(".card").first().offset().top - 100 }, 100);
        });
    });
</script>
@endpush
