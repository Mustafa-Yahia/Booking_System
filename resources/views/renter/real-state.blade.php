

@extends('layouts.app')

@section('title', 'Our Rooms')

@section('content')
    <section class="real-state">
        <div class="container top">
            <!-- Heading and description for the content -->
            <div class="heading text-center mb-5">
                <h2>Real State</h2>
                <p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt</p>
            </div>

            <div class="row">
                <!-- Sidebar Filters Section -->
                <div class="col-md-3 mb-4">
                    <div class="sidebar p-3 border rounded">
                        <h4 class="mb-4">Filters</h4>
                        <!-- Filter form -->
                        <form action="{{ route('properties.index') }}" method="GET">
                            <!-- Search by name -->
                            <div class="mb-3">
                                <input type="text" name="name" class="form-control" placeholder="Search by name" value="{{ request('name') }}">
                            </div>

                            <!-- Max price filter -->
                            <div class="mb-3">
                                <input type="number" name="price" class="form-control" placeholder="Max price" value="{{ request('price') }}">
                            </div>

                            <!-- Location filter -->
                            <div class="mb-3">
                                <select name="location" class="form-select">
                                    <option value="">Select Location</option>
                                    <option value="city1">City 1</option>
                                    <option value="city2">City 2</option>
                                    <option value="city3">City 3</option>
                                </select>
                            </div>

                            <!-- Property type filter -->
                            <div class="mb-3">
                                <select name="type" class="form-select">
                                    <option value="">Select Type</option>
                                    <option value="apartment">Apartment</option>
                                    <option value="house">House</option>
                                    <option value="villa">Villa</option>
                                </select>
                            </div>

                            <!-- Apply Filters button -->
                            <button type="submit" class="btn btn-primary w-100">Apply Filters</button>
                        </form>
                    </div>
                </div>
                @php
                use Illuminate\Support\Str;
            @endphp

            <div class="col-md-9 mb-4">
                <div class="row">
                    <!-- Loop through each property and display details -->
                    @foreach($properties as $property)
                    <div class="col-md-4 mb-4">
                        <div class="card shadow-sm border-0 rounded-3" style="width: 100%; height: 100%; display: flex; flex-direction: column; cursor: pointer;">
                            <!-- Property image -->
                            <div class="image">
                                <img src="{{ asset('storage/' . $property->images->first()->image_path) }}"
                                     class="card-img-top rounded-top"
                                     alt="{{ $property->title }}"
                                     style="height: 150px; object-fit: contain;">
                            </div>

                            <div class="card-body d-flex flex-column justify-content-between p-3">
                                <!-- Property title -->
                                <h5 class="card-title text-primary fw-bold text-center" style="font-size: 1.25rem;">
                                    {{ $property->title }}
                                </h5>

                                <!-- Property location, status, and type -->
                                <p class="mb-1"><i class="fa fa-map-marker-alt" style="color: #000"></i>
                                    <span class="fw-bold">Location:</span> {{ $property->location }}
                                </p>
                                <p class="mb-1">
                                    <i class="fa fa-info-circle"></i>
                                    <span class="fw-bold">Status:</span>
                                    <span class="badge {{ strtolower($property->status) == 'available' ? 'bg-success' : 'bg-danger' }}">
                                        {{ ucfirst($property->status) }}
                                    </span>
                                </p>
                                <p class="mb-1"><i class="fa fa-home" style="color:#000"></i>
                                    <span class="fw-bold">Type:</span> {{ $property->type }}
                                </p>

                                <!-- Property rating -->
                                <div class="rate d-flex mb-2">
                                    @for ($i = 0; $i < 5; $i++)
                                        <i class="fa fa-star text-warning"></i>
                                    @endfor
                                </div>

                                <!-- Property description (excluding first 20 words) -->
                                @php
                                    $first_20_words = Str::words($property->description, 20, '');
                                    $remaining_description = Str::replaceFirst($first_20_words, '', $property->description);
                                @endphp

                                <p class="card-text" style="font-size: 0.875rem; color: #555; flex-grow: 1; margin-bottom: 1rem;">
                                    {{ trim($remaining_description) }}
                                </p>

                                <!-- Price and booking button -->
                                <div class="d-flex justify-content-between align-items-center">
                                    <a href="" class="btn" style="background-color: #7fc142; color: white;">Book Now</a>
                                    <h6 class="price text-dark fw-bold mb-0">${{ $property->price_per_day }}
                                        <span class="text-muted">/ Night</span>
                                    </h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>


            </div>
        </div>
    </section>
@endsection

@section('styles')
    <!-- You can include custom styles specific to this page -->
    <link rel="stylesheet" href="{{ asset('css/real-state.css') }}">
@endsection

@section('scripts')
    <!-- You can add custom scripts for this page -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
@endsection
