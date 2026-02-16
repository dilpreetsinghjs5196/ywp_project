@extends('layouts.therapist')

@section('title', 'My Clients')
@section('page_title', 'Client History & Records')

@section('content')
    <div class="card p-4 shadow-sm border-0 mb-4">
        <form id="searchForm" action="{{ route('therapist.clients') }}" method="GET" class="row g-3">
            <div class="col-md-8">
                <div class="input-group">
                    <span class="input-group-text bg-white border-end-0"><i class="bi bi-search"></i></span>
                    <input type="text" name="search" id="searchInput" class="form-control border-start-0" placeholder="Search by name, email or phone..." value="{{ request('search') }}">
                </div>
            </div>
            <div class="col-md-4 text-end">
                <a href="{{ route('therapist.clients') }}" id="clearBtn" class="btn btn-outline-secondary px-4 {{ !request('search') ? 'd-none' : '' }}">Clear</a>
            </div>
        </form>
    </div>

    <div class="card p-0 shadow-sm border-0" id="tableContainer">
        @include('therapist.clients._table')
    </div>
@endsection

@push('js')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        const tableContainer = $('#tableContainer');
        const searchForm = $('#searchForm');
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
                updateTable(searchForm.attr('action') + '?' + searchForm.serialize());
            }, 500);
        });

        searchForm.on('submit', function (e) {
            e.preventDefault();
            updateTable(searchForm.attr('action') + '?' + searchForm.serialize());
        });

        $(document).on('click', '.pagination a', function (e) {
            e.preventDefault();
            updateTable($(this).attr('href'));
            $('html, body').animate({ scrollTop: $(".card").first().offset().top - 100 }, 100);
        });
    });
</script>
@endpush