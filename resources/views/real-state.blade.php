<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Our Rooms</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/real-state.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <script src="https://kit.fontawesome.com/032d11eac3.js" crossorigin="anonymous"></script>
</head>
<body>

    @include('layouts.header')

    <section class="real-state">
        <div class="container top">
            <div class="heading text-center mb-5">
                <h2>Real State</h2>
                <p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt</p>
            </div>

            <div class="filters mb-5">
                <form action="{{ route('properties.index') }}" method="GET" class="d-flex justify-content-center">
                    <input type="text" name="name" class="form-control me-2" placeholder="Search by name" value="{{ request('name') }}">

                    <input type="number" name="price" class="form-control me-2" placeholder="Max price" value="{{ request('price') }}">

                    <button type="submit" class="btn btn-primary">Search</button>
                </form>
            </div>

            <!-- عرض العقارات -->
            <div class="row">
                @foreach($properties as $property)
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <img src="{{ asset('storage/images/properties/' . $property->image) }}" class="card-img-top" alt="{{ $property->title }}">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ $property->title }}</h5>
                            <div class="rate mb-3">
                                @for ($i = 0; $i < 5; $i++)
                                    <i class="fa fa-star"></i>
                                @endfor
                            </div>
                            <p class="card-text flex-grow-1">{{ $property->description }}</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <a href="#" class="btn btn-primary">BOOK NOW</a>
                                <h5 class="price">${{ $property->price_per_day }} <span class="text-muted">Per Night</span></h5>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
