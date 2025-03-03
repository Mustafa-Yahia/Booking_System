@extends('layouts.lessor')

@section('title', 'Property Details')

@section('content')
<div class="container mt-4">
    <div class="mb-4">
        <a href="{{ route('lessor.properties.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Back to Properties
        </a>
    </div>
    <h1 class="mb-4 text-center fw-bold">🏠 {{ $property->title }}</h1>

    <div class="card shadow-sm border-0 rounded-lg">
        <div class="card-header bg-primary text-white fw-bold">
            <i class="fas fa-info-circle"></i> Property Details
        </div>
        <div class="card-body">
            <p class="card-text">{{ $property->description }}</p>
            <p><strong>Location:</strong> {{ $property->location }}</p>
            <p><strong>Price per day:</strong> ${{ number_format($property->price_per_day, 2) }}</p>
            <p><strong>Type:</strong> {{ $property->type }}</p>
            <p><strong>Guests Limit:</strong> {{ $property->guest_limit }}</p>
        </div>
    </div>

    <div class="card shadow-sm border-0 rounded-lg mt-4">
        <div class="card-header bg-success text-white fw-bold">
            <i class="fas fa-images"></i> Property Images
        </div>
        <div class="card-body">
            <div class="row">
                @if($property->images->isNotEmpty())
                    @foreach($property->images as $image)
                        <div class="col-md-4 mb-3">
                            <img src="{{ asset('storage/' . $image->image_path) }}" class="img-fluid rounded" alt="Property Image">
                        </div>
                    @endforeach
                @else
                    <p class="text-center text-muted">No images available for this property.</p>
                @endif
            </div>
        </div>
    </div>

    <div class="card shadow-sm border-0 rounded-lg mt-4">
        <div class="card-header bg-danger text-white fw-bold">
            <i class="fas fa-star"></i> Reviews
        </div>
        <div class="card-body">
            @if($property->reviews->isNotEmpty())
                @foreach($property->reviews as $review)
                    <div class="card mb-3 shadow-sm border-0 rounded-lg">
                        <div class="card-body">
                            <h5 class="card-title fw-bold">{{ $review->user->name }}</h5>
                            <p class="card-text"><strong>Rating:</strong> {{ $review->rating }}/5</p>
                            <p class="card-text">{{ $review->comment }}</p>
                        </div>
                    </div>
                @endforeach
            @else
                <p class="text-center text-muted">No reviews available for this property.</p>
            @endif
        </div>
    </div>
</div>
@endsection
