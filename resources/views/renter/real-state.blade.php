<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Defining character encoding and viewport for responsive design -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Our Rooms</title>

    <!-- Loading Bootstrap CSS from CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Including custom CSS files for the site -->
    <link rel="stylesheet" href="{{ asset('css/real-state.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <!-- Adding Font Awesome library for icons -->
    <script src="https://kit.fontawesome.com/032d11eac3.js" crossorigin="anonymous"></script>
</head>

<!-- Custom CSS for button styling -->
<style>
    /* Change button color when clicked */
    .primary-btn:active, .primary-btn:focus {
        background-color: #81c408;
        border-color: #81c408;
        box-shadow: 0 0 0 0.2rem rgba(129, 196, 8, 0.5); /* Add shadow effect */
    }

    /* Change button color when hovered */
    .primary-btn:hover {
        background-color: #66a305; /* Darker green on hover */
        border-color: #66a305;
    }
</style>

<body>

    <!-- Include header from layout -->
    @include('layouts.header')

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

                            <!-- Amenities filter -->
                            <div class="mb-3">
                                <label class="form-check-label">Amenities</label><br>
                                <!-- Amenities checkboxes -->
                               

                            </div>

                            <!-- Apply Filters button -->
                            <button type="submit" class="btn btn-primary w-100">Apply Filters</button>
                        </form>
                    </div>
                </div>

                <!-- Property listing section -->
                <div class="col-md-9 mb-4">
                    <div class="row">
                        <!-- Loop through each property and display details -->
                        @foreach($properties as $property)
                        <div class="col-md-4 mb-4">
                            <div class="card" style="width: 100%; height: 100%; display: flex; flex-direction: column;">
                                <!-- Property image -->
                                <div class="image">
                                    <img src="{{ asset('storage/images/properties/' . $property->image) }}" class="card-img-top" alt="{{ $property->title }}" style="object-fit: cover; height: 250px;">
                                </div>
                                <div class="card-body d-flex flex-column justify-content-between">
                                    <!-- Property title -->
                                    <h2 class="card-title" style="font-size: 1.25rem; font-weight: bold; margin-bottom: 0.5rem;">{{ $property->title }}</h2>

                                    <!-- Property rating -->
                                    <div class="rate d-flex mb-2">
                                        @for ($i = 0; $i < 5; $i++)
                                            <i class="fa fa-star" style="color: #ff9800; font-size: 1rem;"></i>
                                        @endfor
                                    </div>

                                    <!-- Property description -->
                                    <p class="card-text" style="font-size: 0.875rem; color: #555; flex-grow: 1; margin-bottom: 1rem;">{{ $property->description }}</p>

                                    <!-- Price and booking button -->
                                    <div class="button d-flex justify-content-between align-items-center">
                                        <!-- Book Now button -->
                                        <a href="#" class="primary-btn btn primary-btn" style="font-size: 0.875rem; padding: 0.5rem 1rem; width: 45%; background-color: #81c408; border-color: #81c408; transition: background-color 0.3s, border-color 0.3s;">
                                            BOOK NOW
                                        </a>

                                        <!-- Price per night -->
                                        <h3 class="price" style="font-size: 1rem; font-weight: bold; margin: 0; display: flex; align-items: center; white-space: nowrap;">
                                            ${{ $property->price_per_day }}
                                            <span class="text-muted" style="font-size: 0.875rem; margin-left: 5px;">Per Night</span>
                                        </h3>
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

    <!-- Loading Bootstrap JS from CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
