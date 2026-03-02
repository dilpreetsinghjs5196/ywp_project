@extends('layouts.therapist')

@section('title', 'Patient Reviews')
@section('page_title', 'Patient Reviews & Feedback')

@section('content')
    <div class="card p-4 shadow-sm border-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Patient Name</th>
                        <th>Rating</th>
                        <th style="width: 40%;">Comment</th>
                        <th>Date</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($reviews as $review)
                        <tr>
                            <td>{{ ($reviews->currentPage() - 1) * $reviews->perPage() + $loop->iteration }}</td>
                            <td>
                                <div class="fw-bold">{{ $review->is_anonymous ? 'Verified Patient' : $review->name }}</div>
                                <div class="small text-muted">{{ $review->email }}</div>
                            </td>
                            <td>
                                <div class="text-warning">
                                    @for($i = 1; $i <= 5; $i++)
                                        <i class="bi bi-star{{ $i <= $review->rating ? '-fill' : '' }}"></i>
                                    @endfor
                                </div>
                            </td>
                            <td>
                                <div class="small text-dark italic">"{{ $review->comment }}"</div>
                            </td>
                            <td>
                                <div class="small fw-bold">{{ $review->created_at->format('d M Y') }}</div>
                                <div class="small text-muted">{{ $review->created_at->format('h:i A') }}</div>
                            </td>
                            <td>
                                @if($review->status === 'approved')
                                    <span class="badge bg-success shadow-sm px-3">APPROVED</span>
                                @elseif($review->status === 'pending')
                                    <span class="badge bg-warning text-dark px-3">PENDING</span>
                                @else
                                    <span class="badge bg-danger shadow-sm px-3">REJECTED</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-5 text-muted">
                                No reviews or feedback found from your patients yet.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-4">
            {{ $reviews->links() }}
        </div>
    </div>
@endsection