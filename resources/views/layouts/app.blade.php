<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="user-authenticated" content="{{ auth()->check() ? 'true' : '' }}">
  <title>@yield('title', 'Crowny Hotel')</title>

  <!-- CSS Links -->
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
  <script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ=" crossorigin="anonymous"></script>
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />
    {{-- sweet alert --}}
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>



  <!-- Header Section -->
  @include('layouts.header')



  <!-- Main Content Section -->
  <main>
    @yield('content')
  </main>



  <!-- Footer Section -->
  @include('layouts.footer')




  
  <!-- Script links -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ=" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js" integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <!-- Custom Script -->
  <script>
    $(document).ready(function() {
      // Owl Carousel Initialization
      $('.owl-carousel1').owlCarousel({
  loop: false,
  margin: 10,
  nav: true,
  dots: false,
  navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
  responsive: {
    0: { items: 1 },
    576: { items: 2 },
    768: { items: 3 },
    992: { items: 4 }
  }
});


      // Mobile menu toggle
      var menulist = document.getElementById('menulist');
      menulist.style.maxHeight = "0px";

      function menutoggle() {
        if (menulist.style.maxHeight == "0px") {
          menulist.style.maxHeight = "100vh";
        } else {
          menulist.style.maxHeight = "0px";
        }
      }

      // Button hover effect
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
    });
  </script>


<script>

</script>

</body>

</html>
