@extends('layouts.lessor')

@section('title', 'Manage Properties')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4 text-center fw-bold">🏠 Manage Properties</h1>

    <div class="text-center mb-4">
        <a href="{{ route('lessor.properties.create') }}" class="btn btn-primary btn-lg">
            <i class="fas fa-plus"></i> Add New Property
        </a>
    </div>

    <form action="{{ route('lessor.properties.index') }}" method="GET" class="mb-4">
        <div class="row g-2">
            <div class="col-md-4">
                <input type="text" name="search" class="form-control" placeholder="Search by title..." value="{{ request('search') }}">
            </div>
            <div class="col-md-4">
                <select name="status" class="form-select">
                    <option value="" {{ request('status') == '' ? 'selected' : '' }}>All Statuses</option>
                    <option value="available" {{ request('status') == 'available' ? 'selected' : '' }}>Available</option>
                    <option value="rented" {{ request('status') == 'rented' ? 'selected' : '' }}>Rented</option>
                </select>
            </div>
            <div class="col-md-4">
                <button type="submit" class="btn btn-outline-secondary w-100">
                    <i class="fas fa-search"></i> Search
                </button>
            </div>
        </div>
    </form>

    @if($properties->isEmpty())
        <div class="alert alert-info text-center">
            <p class="mb-0">No properties found. Add a new one!</p>
        </div>
    @else

        <div class="row g-4">
            @foreach($properties as $property)
                <div class="col-md-4">
                    <div class="card shadow-sm border-0 rounded-lg">

                        @if($property->images->isNotEmpty())
                            <div id="carousel{{ $property->id }}" class="carousel slide" data-bs-ride="carousel">
                                <div class="carousel-inner">
                                    @foreach($property->images as $key => $image)
                                        <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                            <img src="{{ asset('storage/' . $image->image_path) }}" class="d-block w-100" alt="Property Image" style="height: 200px; object-fit: cover;">
                                        </div>
                                    @endforeach
                                </div>
                                <button class="carousel-control-prev" type="button" data-bs-target="#carousel{{ $property->id }}" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#carousel{{ $property->id }}" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>
                            </div>
                        @else
                            <div class="text-center py-4 bg-light">
                                <p class="mb-0 text-muted">No images available</p>
                            </div>
                        @endif

                        <div class="card-body">
                            <h5 class="card-title fw-bold">{{ $property->title }}</h5>
                            <p class="card-text">{{ Str::limit($property->description, 100) }}</p>

                            <div class="d-grid gap-2">
                                <a href="{{ route('lessor.properties.show', $property->id) }}" class="btn btn-info btn-sm">
                                    <i class="fas fa-eye"></i> View Details
                                </a>
                                <a href="{{ route('lessor.properties.edit', $property->id) }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <a href="{{ route('lessor.properties.bookings.index', $property->id) }}" class="btn btn-success btn-sm">
                                    <i class="fas fa-calendar-check"></i> View Bookings
                                </a>
                                <form action="{{ route('lessor.properties.destroy', $property->id) }}" method="POST" class="d-grid">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">
                                        <i class="fas fa-trash"></i> Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
