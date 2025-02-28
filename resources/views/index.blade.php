
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
            <button class="primary-btn">READ MORE</button>
            <button class="secondary-btn">CONTACT US</button>
          </div>
        </div>
      </div>
      <div class="item">
        <img src="{{ asset('storage/images/index/banner-2.png') }}" alt="Banner 2">
        <div class="text">
          <h1>Explore New Destinations</h1>
          <p>Experience the beauty of the world with our exclusive holiday packages.</p>
          <div class="flex">
            <button class="secondary-btn">CONTACT US</button>
          </div>
        </div>
      </div>
      <div class="item">
        <img src="{{ asset('storage/images/index/banner-3.png') }}" alt="Banner 3">
        <div class="text">
          <h1>Your Dream Vacation Awaits</h1>
          <p>Enjoy unforgettable moments and memories with our customized holiday offers.</p>
          <div class="flex">
            <button class="primary-btn">READ MORE</button>
            <button class="secondary-btn">CONTACT US</button>
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



{{-- ===================== Start Modal (Popup)  ========================= --}}
<section class="about top">
    <div class="container flex">
      <div class="left">
        <div class="heading">
          <h1>WELCOME</h1>
          <h2>Modern Apartments in Jordan</h2>
        </div>
        <p>Discover our luxurious and fully-equipped apartments in the heart of Jordan. Whether you're looking for a short-term stay or a long-term residence, our apartments offer comfort, convenience, and privacy. Enjoy spacious living areas, modern amenities, and breathtaking views. With various locations across the country, we provide the perfect home away from home for you.</p>
        <button class="primary-btn" id="learnMoreBtn">LEARN MORE</button>
      </div>
      <div class="right">
        <img src="{{ asset('storage/images/index/about.png') }}" alt="About Image">
      </div>
    </div>
  </section>

  <!-- Modal (Popup) -->
  <div id="learnMoreModal" class="modal">
    <div class="modal-content">
      <span class="close-btn">&times;</span>
      <h2>More About Our Apartments</h2>
      <p>Our apartments are fully equipped with all the necessary amenities for a comfortable stay. They are located in prime locations in Jordan, with easy access to restaurants, shopping malls,
        and tourist attractions. Each apartment offers a spacious living area, modern kitchen, high-speed internet, and more. Whether you're staying for a few days or months, we ensure that your
        experience will be unforgettable.</p>
    </div>
  </div>

  <script>
    // Get the modal and button
    var modal = document.getElementById("learnMoreModal");
    var btn = document.getElementById("learnMoreBtn");
    var span = document.getElementsByClassName("close-btn")[0];

    // When the user clicks the button, open the modal
    btn.onclick = function() {
      modal.style.display = "block";
    }

    // When the user clicks the close button, close the modal
    span.onclick = function() {
      modal.style.display = "none";
    }

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
      if (event.target == modal) {
        modal.style.display = "none";
      }
    }
  </script>
{{-- ===================== End Modal (Popup)  ========================= --}}



{{-- ===================== Start counter top ========================= --}}
{{-- <section class="counter top">
    <div class="container grid">
      <div class="box">
        <h1>2500</h1>
        <hr>
        <span>Customer</span>
      </div>
      <div class="box">
        <h1>1250</h1>
        <hr>
        <span>Happy Customer</span>
      </div>
      <div class="box">
        <h1>150</h1>
        <hr>
        <span>Expert Technicians</span>
      </div>
      <div class="box">
        <h1>3550</h1>
        <hr>
        <span>Desktop Repaired</span>
      </div>
    </div>
  </section> --}}
{{-- ===================== End counter top ========================= --}}


{{-- ===================== Start ٍsection Room ========================= --}}

<section class="rooms">
    <div class="container top">
      <div class="heading">
        <h1>EXPLORE</h1>
        <h2>Our Rooms</h2>
        <p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt</p>
      </div>

      <div class="content mtop">
        <div class="owl-carousel owl-carousel1 owl-theme">
          @foreach($properties as $property)
          <div class="item">
            <div class="card" style="width: 100%; height: 100%; display: flex; flex-direction: column;">
              <div class="image">
                <img src="{{ asset('storage/images/properties/' . $property->image) }}" class="card-img-top" alt="{{ $property->title }}">
              </div>
              <div class="card-body d-flex flex-column justify-content-between">
                <h2 class="card-title">{{ $property->title }}</h2>
                <div class="rate d-flex">
                  @for ($i = 0; $i < 5; $i++)
                    <i class="fa fa-star"></i>
                  @endfor
                </div>
                <p class="card-text" style="flex-grow: 1;">{{ $property->description }}</p>
                <div class="button d-flex justify-content-between align-items-center">
                  <a href="#" class="primary-btn btn btn-primary">BOOK NOW</a>
                  <h3 class="price">${{ $property->price_per_day }} <span class="text-muted">Per Night</span></h3>
                </div>
              </div>
            </div>
          </div>
          @endforeach
        </div>
      </div>
    </div>
  </section>

<script>
  $('.owl-carousel1').owlCarousel({
    loop: true,
    margin: 40,
    nav: true,
    dots: false,
    navText: ["<i class = 'fa fa-chevron-left'></i>", "<i class = 'fa fa-chevron-right'></i>"],
    responsive: {
      0: { items: 1 },
      768: { items: 2, margin: 10 },
      1000: { items: 3 }
    }
  });
</script>
{{-- ===================== End section Room ========================= --}}

    @endsection
