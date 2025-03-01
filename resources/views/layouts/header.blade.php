
<link rel="stylesheet" href="{{ asset('css/style.css') }}">

<header>
    <div class="content flex_space">
      <div class="logo">
        <img src="{{ asset('storage/images/index/logo.png') }}" alt="Logo">
      </div>
      <div class="navlinks">
        <ul id="menulist">
          <li><a href={{ route('home') }}>home</a> </li>
          <li><a href="#about">about</a> </li>
          <li><a href={{ route('properties.index')}}>Real-State</a> </li>
          <li><a href="#pages">pages</a> </li>
          <li><a href="#news">news</a> </li>
          <li><a href="{{ route('contact-us') }}">contact</a> </li>
          <li> <i class="fa fa-search"></i> </li>

          @guest
             <li><a href="{{ route('login') }}" class="primary-btn">Login</a></li>
            <li><a href="{{ route('register') }}" class="primary-btn">Sign Up</a></li>
          @else
           <li class="user-name">Hello, {{ Auth::user()->name }}</li>
            <li><a href="" class="primary-btn" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a></li>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            <form id="logout-form" action="" method="POST" style="display: none;">
              @csrf
            </form>
          @endguest
        </ul>
        <span class="fa fa-bars" onclick="menutoggle()"></span>
      </div>
    </div>
  </header>
