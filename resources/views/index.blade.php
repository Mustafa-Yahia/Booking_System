
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
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
          <div class="flex">
            <button class="primary-btn">BooK</button>

          </div>
        </div>
      </div>
      <div class="item">
        <img src="{{ asset('storage/images/index/banner-2.png') }}" alt="Banner 2">
        <div class="text">
          <h1>Explore New Destinations</h1>
          <p>Experience the beauty of the world with our exclusive holiday packages.</p>
          <div class="flex">
            <button class="primary-btn">BooK</button>
          </div>
        </div>
      </div>
      <div class="item">
        <img src="{{ asset('storage/images/index/banner-3.png') }}" alt="Banner 3">
        <div class="text">
          <h1>Your Dream Vacation Awaits</h1>
          <p>Enjoy unforgettable moments and memories with our customized holiday offers.</p>
          <div class="flex">
            <button class="primary-btn">BooK</button>
          </div>
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


<section class="featured-properties top">
    <div class="container">
        <div class="heading text-center">
            <h2>Featured Properties</h2>
            <p>Discover the finest real estate options in prime locations.</p>
        </div>


        <div class="property-categories d-flex flex-wrap justify-content-center gap-4">
            <div class="property-category">
                <h3>Luxury Condos</h3>
                <p>Experience premium living with high-end amenities and stunning city views.</p>
            </div>

            <div class="property-category">
                <h3>Waterfront Villas</h3>
                <p>Relax by the sea in these luxurious and serene villas.</p>
            </div>

            <div class="property-category">
                <h3>City Center Apartments</h3>
                <p>Enjoy urban living with convenience and modern design.</p>
            </div>
        </div>
    </div>
</section>


{{-- <section class="featured-properties top">
    <div class="container">
        <div class="heading text-center">
            <h2>Featured Properties</h2>
            <p>Discover the finest real estate options in prime locations.</p>
        </div>

        <div class="property-categories d-flex flex-wrap justify-content-center gap-4">
            <!-- Luxury Condos -->
            <div class="property-category card shadow-sm border-3 rounded-3" style="width: 300px; height: 400px; cursor: pointer;">
                <div class="image" style="width: 100%; height: 200px; overflow: hidden;">
                    <img src="{{ asset('storage/images/properties/luxury-condo.jpg') }}" alt="Luxury Condos" class="card-img-top rounded-top" style="width: 100%; height: 100%; object-fit: cover;">
                </div>
                <div class="card-body text-center">
                    <h5 class="fw-bold">Luxury Condos</h5>
                    <p>Experience premium living with high-end amenities and stunning city views.</p>
                    <a href="#" class="btn" style="background-color: #7fc142; color: white;">View Listings</a>
                </div>
            </div>

            <!-- Waterfront Villas -->
            <div class="property-category card shadow-sm border-3 rounded-3" style="width: 300px; height: 400px; cursor: pointer;">
                <div class="image" style="width: 100%; height: 200px; overflow: hidden;">
                    <img src="{{ asset('storage/images/properties/waterfront-villa.jpg') }}" alt="Waterfront Villas" class="card-img-top rounded-top" style="width: 100%; height: 100%; object-fit: cover;">
                </div>
                <div class="card-body text-center">
                    <h5 class="fw-bold">Waterfront Villas</h5>
                    <p>Relax by the sea in these luxurious and serene villas.</p>
                    <a href="#" class="btn" style="background-color: #7fc142; color: white;">View Listings</a>
                </div>
            </div>

            <!-- City Center Apartments -->
            <div class="property-category card shadow-sm border-3 rounded-3" style="width: 300px; height: 400px; cursor: pointer;">
                <div class="image" style="width: 100%; height: 200px; overflow: hidden;">
                    <img src="{{ asset('storage/images/properties/city-center-apartment.jpg') }}" alt="City Center Apartments" class="card-img-top rounded-top" style="width: 100%; height: 100%; object-fit: cover;">
                </div>
                <div class="card-body text-center">
                    <h5 class="fw-bold">City Center Apartments</h5>
                    <p>Enjoy urban living with convenience and modern design.</p>
                    <a href="#" class="btn" style="background-color: #7fc142; color: white;">View Listings</a>
                </div>
            </div>
        </div>
    </div>
</section> --}}

<section class="featured-properties top">
    <div class="container">
        <div class="heading text-center">
            <h2>Featured Properties</h2>
            <p>Discover our premium properties and special deals to find your dream home.</p>
        </div>

        <div class="property-categories d-flex flex-wrap justify-content-center gap-4">
            <div class="property-category text-center" onclick="showDetails('luxury-condos')">
                <h3>Luxury Condos</h3>
                <p>Experience luxury living in our exclusive condominiums.</p>
            </div>

            <div class="property-category text-center" onclick="showDetails('waterfront-villas')">
                <h3>Waterfront Villas</h3>
                <p>Wake up to stunning waterfront views in our luxurious villas.</p>
            </div>

            <div class="property-category text-center" onclick="showDetails('city-center-apartments')">
                <h3>City Center Apartments</h3>
                <p>Live in the heart of the city with our modern and convenient apartments.</p>
            </div>
        </div>
    </div>
</section>

<script>
    function showDetails(category) {
        alert("More details about " + category.replace('-', ' '));
    }
</script>




{{-- ===================== Start ٍsection Room ========================= --}}
<section class="rooms">
    <div class="container top">
        <div class="heading text-center">
            <h2>Real State Category</h2>
            <p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt</p>
        </div>

        <div class="content mtop">
            <div class="owl-carousel owl-carousel1 owl-theme d-flex flex-wrap justify-content-center gap-3">
                @foreach($properties as $property)
                <div class="item gap-5">
                    <a href="" class="text-decoration-none text-dark">
                        <div class="card shadow-sm border-3 rounded-3" style="width: 300px; height: 400px; display: flex; flex-direction: column; cursor: pointer;">
                            <!-- Image-->
                            <div class="image" style="width: 100%; height: 150px; display: flex; align-items: center; justify-content: center; overflow: hidden;">
                                <img src="{{ asset('storage/' . $property->images->first()->image_path) }}"
                                     class="card-img-top rounded-top"
                                     alt="{{ $property->title }}"
                                     style="max-width: 100%; max-height: 100%; object-fit: fill;">
                            </div>


                            <!-- card Contant-->
                            <div class="card-body d-flex flex-column justify-content-between p-3">
                                <h5 class="card-title fw-bold  text-center" style="color: #000;">{{ $property->title }}</h5>

                                <!--.....-->
                                <div class="mb-2">
                                    <p class="mb-1"><i class="fa fa-map-marker-alt" style="color: #000"></i> <span class="fw-bold">Location:</span> {{ $property->location }}</p>
                                    <p class="mb-1"><i class="fa fa-home" style="color:#000"></i> <span class="fw-bold">Type:</span> {{ $property->type }}</p>
                                    <p class="mb-1">
                                        <i class="fa fa-info-circle"></i> <span class="fw-bold">Status:</span>
                                        <span class="badge {{ strtolower($property->status) == 'available' ? 'bg-success' : 'bg-danger' }}">
                                            {{ ucfirst($property->status) }}
                                        </span>
                                    </p>
                                </div>

                                <!-- التقييم -->
                                <div class="rate d-flex mb-2">
                                    @for ($i = 0; $i < 5; $i++)
                                        <i class="fa fa-star text-warning"></i>
                                    @endfor
                                </div>

                                <!-- السعر و الزر -->
                                <div class="d-flex justify-content-between align-items-center">
                                    <h6 class="price text-dark fw-bold mb-0">${{ $property->price_per_day }} <span class="text-muted">/ Night</span></h6>
                                    {{-- <a href="{{ route('book.show', $property->id) }}" class="btn" style="background-color: #7fc142; color: white;">Book Now</a> --}}
                                    <a href="" class="btn" style="background-color: #7fc142; color: white;">Book Now</a>
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
