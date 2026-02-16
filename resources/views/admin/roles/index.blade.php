@extends('admin.layouts.app')

@section('title', 'Manage Roles')
@section('page_title', 'Role Management')

    @section('content')
        <div class="card p-0">
            <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
                <h5 class="fw-bold mb-0">Existing Roles</h5>
                <a href="{{ route('admin.roles.create') }}" class="btn btn-primary btn-sm">Create New Role</a>
            </div>

            <div class="card-body bg-light border-bottom p-3">
                <form id="filterForm" action="{{ route('admin.roles.index') }}" method="GET" class="row g-2">
                    <div class="col-md-5">
                        <div class="input-group input-group-sm">
                            <span class="input-group-text bg-white border-end-0"><i class="bi bi-search"></i></span>
                            <input type="text" name="search" id="searchInput" class="form-control border-start-0"
                                placeholder="Search by Name, Slug or Description..." value="{{ request('search') }}">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary btn-sm px-4">Filter</button>
                        <a href="{{ route('admin.roles.index') }}" id="clearBtn"
                            class="btn btn-outline-secondary btn-sm {{ !request('search') ? 'd-none' : '' }}">
                            Clear
                        </a>
                    </div>
                </form>
            </div>

            <div class="card-body p-0" id="tableContainer">
                @include('admin.roles._table')
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
@endsection