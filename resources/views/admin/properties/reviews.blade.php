@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h1>Property Reviews</h1>

    <a href="{{ route('admin.properties.index') }}" class="btn btn-secondary mb-3">Back to Properties</a>

    <div class="card">
        <div class="card-header">
            <h4>Reviews for: {{ $property->title }}</h4>
        </div>
        <div class="card-body">
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
            @else
                <p class="text-muted">No reviews found for this property.</p>
            @endif
        </div>
    </div>
</div>
@endsection
