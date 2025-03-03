
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

          </div>
        </div>
      </div>
      <div class="item">
        <img src="{{ asset('storage/images/index/banner-2.png') }}" alt="Banner 2">
        <div class="text">
          <h1>Explore New Destinations</h1>
          <p>Experience the beauty of the world with our exclusive holiday packages.</p>
          <div class="flex">
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
                        <div class="card shadow-sm border-3 rounded-3" style="width: 300px;  display: flex; flex-direction: column;">
                            <!-- Image-->
                            @if($property->images->isNotEmpty())
                            <div class="image" style="width: 100%; height: 150px; display: flex; align-items: center; justify-content: center; overflow: hidden;">
                                <img src="{{ asset('storage/' . $property->images->first()->image_path) }}"
                                     class="card-img-top rounded-top"
                                     alt="{{ $property->title }}"
                                     style="max-width: 100%; max-height: 100%; object-fit: fill;">
                            </div>
                            @endif


                            <!-- card Contant-->
                            <div class="card-body d-flex flex-column justify-content-between p-3">
                                <h5 class="card-title fw-bold  text-center" style="color: #000;">{{ $property->title }}</h5>

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

                                <div class="rate d-flex mb-2">
                                    @for ($i = 0; $i < 5; $i++)
                                        <i class="fa fa-star text-warning"></i>
                                    @endfor
                                </div>

                                <div class="d-flex justify-content-between align-items-center">
                                    <h6 class="price text-dark fw-bold mb-0">{{ $property->price_per_day }} JOD <span class="text-muted">/ Night</span></h6>
                                    <a href="{{ route('properties.show', $property->id) }}" class="btn" style="background-color: #7fc142; color: white;">Book Now</a>
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
