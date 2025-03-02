@extends('layouts.lessor')
@include('layouts.header')

@section('content')
<div class="container">
    <h2 class="my-4">Lessor Dashboard</h2>
    <a href="{{ route('lessor.properties.create') }}" class="btn btn-primary mb-3">Add New Property</a>

    <div class="row">
        @foreach($properties as $property)
            <div class="col-md-4">
                <div class="card mb-4 shadow-sm">
                    @if($property->images->isNotEmpty())
                        <div id="propertyCarousel{{ $property->id }}" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-inner">
                                @foreach($property->images as $key => $image)
                                    <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                        <img src="{{ asset('storage/' . $image->image_path) }}" class="d-block w-100" alt="Property Image">
                                    </div>
                                @endforeach
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#propertyCarousel{{ $property->id }}" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#propertyCarousel{{ $property->id }}" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                    @else
                        <p>No images available</p>
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $property->title }}</h5>
                        <p class="card-text">{{ $property->description }}</p>
                        <a href="{{ route('lessor.properties.show', $property->id) }}" class="btn btn-info">View Details</a>
                        <a href="{{ route('lessor.properties.edit', $property->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('lessor.properties.destroy', $property->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    </div>
</div>
@endsection
