@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="my-4">{{ $property->title }}</h2>
    <p>{{ $property->description }}</p>
    <p><strong>Location:</strong> {{ $property->location }}</p>
    <p><strong>Price per day:</strong> ${{ $property->price_per_day }}</p>
    <p><strong>Type:</strong> {{ $property->type }}</p>

    <h4>Property Images</h4>
    <div class="row">
        @if($property->images->isNotEmpty())
            @foreach($property->images as $image)
                <div class="col-md-4 mb-3">
                    <img src="{{ asset('storage/' . $image->image_path) }}" class="img-fluid rounded" alt="Property Image">
                </div>
            @endforeach
        @else
            <p>No images available for this property.</p>
        @endif
    </div>

    <a href="{{ route('lessor.properties.index') }}" class="btn btn-secondary">Back to Properties</a>
</div>
@endsection
