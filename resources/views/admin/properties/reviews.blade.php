@extends('layouts.admin')

@section('content')
<div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
    <div class="card" style="width: 80%; max-width: 900px;">
        <div class="card-header text-center">
            <h4 class="fw-bold text-primary">Reviews for: {{ $property->title }}</h4>
        </div>
        <div class="card-body">
            <h1 class="text-center">Property Reviews</h1>

            <div class="text-center mb-4">
                <a href="{{ route('admin.properties.index') }}" class="btn btn-secondary">Back to Properties</a>
            </div>

            @if($reviews->count() > 0)
                <table class="table">
                    <thead>
                        <tr>
                            <th>User</th>
                            <th>Rating</th>
                            <th>Comment</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($reviews as $review)
                            <tr>
                                <td>{{ $review->user->name }}</td>
                                <td>
                                    @for ($i = 1; $i <= 5; $i++)
                                        <span class="text-warning {{ $i <= $review->rating ? 'fas fa-star' : 'far fa-star' }}"></span>
                                    @endfor
                                </td>
                                <td>{{ $review->comment }}</td>
                                <td>
                                    <form action="{{ route('admin.reviews.delete', $review->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this review?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <!-- Pagination links -->
                <div class="d-flex justify-content-center mt-3">
                    <nav aria-label="Page navigation">
                        <ul class="pagination pagination-sm">
                            <!-- Previous page link -->
                            <li class="page-item {{ $reviews->onFirstPage() ? 'disabled' : '' }}">
                                <a class="page-link" href="{{ $reviews->previousPageUrl() }}" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                </a>
                            </li>

                            <!-- Page number links -->
                            @foreach ($reviews->getUrlRange(1, $reviews->lastPage()) as $page => $url)
                                <li class="page-item {{ $reviews->currentPage() == $page ? 'active' : '' }}">
                                    <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                </li>
                            @endforeach

                            <!-- Next page link -->
                            <li class="page-item {{ $reviews->hasMorePages() ? '' : 'disabled' }}">
                                <a class="page-link" href="{{ $reviews->nextPageUrl() }}" aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>

            @else
                <p class="text-muted text-center">No reviews found for this property.</p>
            @endif
        </div>
    </div>
</div>
@endsection
