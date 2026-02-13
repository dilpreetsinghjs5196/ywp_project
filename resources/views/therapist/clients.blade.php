@extends('layouts.therapist')

@section('title', 'My Clients')
@section('page_title', 'Client History & Records')

@section('content')
    <div class="card p-4 shadow-sm border-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Client Name</th>
                        <th>Contact Info</th>
                        <th>Session Details</th>
                        <th>Mode</th>
                        <th>Amount</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($clients as $client)
                        <tr>
                            <td>{{ ($clients->currentPage() - 1) * $clients->perPage() + $loop->iteration }}</td>
                            <td>
                                <div class="fw-bold">{{ $client->name }}</div>
                                @if($client->message)
                                    <button class="btn btn-link btn-sm p-0 text-decoration-none text-muted"
                                        data-bs-toggle="collapse" data-bs-target="#note-{{ $client->id }}">
                                        <i class="bi bi-chat-left-text me-1"></i> View Client Note
                                    </button>
                                    <div class="collapse mt-2" id="note-{{ $client->id }}">
                                        <div class="card card-body bg-light border-0 small text-dark">
                                            {{ $client->message }}
                                        </div>
                                    </div>
                                @endif
                            </td>
                            <td>
                                <div class="small"><i class="bi bi-envelope me-1"></i> {{ $client->email }}</div>
                                <div class="small"><i class="bi bi-telephone me-1"></i> {{ $client->phone }}</div>
                            </td>
                            <td>
                                <div class="small fw-bold">
                                    {{ \Carbon\Carbon::parse($client->booking_date)->format('D, d M Y') }}</div>
                                <div class="small text-muted">{{ $client->booking_time }}</div>
                            </td>
                            <td>
                                <span class="badge bg-light text-dark border">{{ $client->mode }}</span>
                            </td>
                            <td>₹{{ number_format($client->amount, 2) }}</td>
                            <td>
                                @if($client->payment_status === 'paid')
                                    <span class="badge bg-success shadow-sm px-3">PAID</span>
                                @else
                                    <span class="badge bg-warning text-dark px-3">PENDING</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-5 text-muted">
                                No clients or sessions found in your history.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-4">
            {{ $clients->links() }}
        </div>
    </div>
@endsection