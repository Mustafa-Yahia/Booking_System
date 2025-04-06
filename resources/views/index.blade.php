
<link rel="stylesheet" href="{{ asset('css/style.css') }}">

@extends('layouts.app')


@section('title', 'Crowny Hotel')

@section('content')

<section class="home">
  <div class="content">
    <div class="owl-carousel owl-theme">
      <div class="item">
        <img src="{{ asset('storage/images/index/banner-1.png') }}" alt="Banner 1">
        <div class="text">
          <h1>Spend Your Holiday</h1>
          <p>Find your next stay</p>
          <p> Search deals on hotels, homes, and much more...</p>
          <a href="#rooms" class="primary-btn">Check out our rooms</a>

        </div>
      </div>
      <div class="item">
        <img src="{{ asset('storage/images/index/banner-2.png') }}" alt="Banner 2">
        <div class="text">
          <h1>Start listing your properties</h1>
          <p>DO you have a property that u want to rent? sign up and start listing</p>
          <a href="{{ route('register') }}" class="primary-btn">Sign Up</a>
        </div>
      </div>
    </div>
  </div>
</section>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js" integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
  $('.owl-carousel').owlCarousel({
    loop: true,
    margin: 10,
    nav: true,
    dots: false,
    navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
    responsive: {
      0: { items: 1 },
      768: { items: 1 },
      1000: { items: 1 }
    }
  });
  $(".primary-btn, .secondary-btn").hover(
    function() {
      $(this).css("background-color", "#81c408");
      $(this).css("color", "#fff");
    },
    function() {
      $(this).css("background-color", "");
      $(this).css("color", "");
    }
  );
</script>




<!-- About Real Estate Section -->
<section class="about-real-estate top">
    <div class="container text-center">
        <div class="heading">
            <h2>Why Choose Our Real Estate Services?</h2>
        </div>
        <p>We provide top-notch real estate solutions with a wide range of properties to choose from. Whether you are looking for a luxury condo, a waterfront villa, or a city-center apartment, we have the perfect option for you. Our team ensures seamless transactions, verified listings, and excellent customer support.</p>
        <p>With years of experience in the real estate market, we guarantee the best deals, professional guidance, and properties that match your expectations. Explore our featured listings and find your dream home today!</p>
    </div>
</section>


{{-- ===================== Start ٍsection Room ========================= --}}
<section class="rooms" id="rooms">
    <div class="container mt-5">
        <div class="heading text-center mb-4">
            <h2>Real Estate Category</h2>
            <p>Explore our amazing properties from different lessors</p>
        </div>

        <div class="content">
            <div class="owl-carousel owl-carousel1 owl-theme d-flex flex-wrap justify-content-center gap-4">
                @foreach($properties as $property)
                <div class="item">
                    <a href="#" class="text-decoration-none text-dark">
                        <div class="card shadow-sm border-3 rounded-3" style="max-width: 350px; height: 480px; display: flex; flex-direction: column; cursor: pointer;">


                            <div class="image" style="width: 100%; height: 200px; overflow: hidden;">
                                <img src="{{ asset('storage/' . $property->images->first()->image_path) }}"
                                     class="card-img-top rounded-top"
                                     alt="{{ $property->title }}"
                                     style="width: 100%; height: 100%; object-fit: cover;">
                            </div>

                            <div class="card-body d-flex flex-column justify-content-between p-3">
                                <h5 class="card-title fw-bold text-center text-dark">{{ $property->title }}</h5>

                                <div class="mb-2">
                                    <p class="mb-1"><i class="fa fa-map-marker-alt text-dark"></i> <span class="fw-bold">Location:</span> {{ $property->location }}</p>
                                    <p class="mb-1"><i class="fa fa-home text-dark"></i> <span class="fw-bold">Type:</span> {{ $property->type }}</p>
                                    <p class="mb-1">
                                        <i class="fa fa-info-circle"></i> <span class="fw-bold">Status:</span>
                                        <span class="badge {{ strtolower($property->status) == 'available' ? 'bg-success' : 'bg-danger' }}">
                                            {{ ucfirst($property->status) }}
                                        </span>
                                    </p>
                                </div>

                                <div class="rate d-flex mb-2">
                                    @php
                                        $averageRating = $property->reviews->avg('rating'); // Calculate the average rating
                                    @endphp

                                    @for ($i = 0; $i < 5; $i++)
                                        @if ($i < $averageRating)
                                            <i class="fa fa-star text-warning"></i> <!-- Filled star -->
                                        @else
                                            <i class="fa fa-star text-secondary"></i> <!-- Empty star -->
                                        @endif
                                    @endfor

                                    <p class="ms-2">{{ number_format($averageRating, 1) }} / 5</p> <!-- Display the average rating -->
                                </div>

                                <div class="d-flex justify-content-between align-items-center">
                                    <h6 class="price text-dark fw-bold mb-0">${{ $property->price_per_day }} <span class="text-muted">/ Night</span></h6>
                                    <a href="{{route('properties.show', $property->id)}}" class="btn "  style="Background-color: #81c408; color:#fff">Book Now</a>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>


{{-- ===================== End section Room ========================= --}}

    @endsection
