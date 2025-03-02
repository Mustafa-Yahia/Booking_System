
<link rel="stylesheet" href="{{ asset('css/style.css') }}">

<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <!-- Logo -->
            <a class="navbar-brand" href="#">
                <img src="{{ asset('storage/images/index/logo.png') }}" alt="Logo" width="150">
            </a>

            <!-- Button to toggle navbar on small screens -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Navbar links -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#about">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('properties.index') }}">Real Estate</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#pages">Pages</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#news">News</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('contact-us') }}">Contact</a>
                    </li>
                </ul>

                <!-- Notifications & User section -->
                <ul class="navbar-nav ms-auto">
                    @auth
                        <!-- Notification Icon -->
                        <li class="nav-item">
                            <a class="nav-link" href="#" id="notificationDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa fa-bell"></i>
                                <span class="badge" style="background-color: #81c408">{{ auth()->user()->unreadNotifications->count() }}</span>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="notificationDropdown">
                                @forelse(auth()->user()->unreadNotifications as $notification)
                                    <a class="dropdown-item" href="{{ route('notifications.read', $notification->id) }}">
                                        {{ $notification->data['message'] }}
                                    </a>
                                @empty
                                    <a class="dropdown-item" href="#">No new notifications</a>
                                @endforelse
                            </div>
                        </li>

                        <!-- User profile section -->
                        <li class="nav-item">
                            <span class="nav-link">Hello, {{ Auth::user()->name }}</span>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link btn btn-logout" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                        </li>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    @else
                        <!-- Login & Signup buttons for guests -->
                        <li class="nav-item">
                            <a class="nav-link btn btn-logout" href="{{ route('login') }}">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link btn btn-outline-success" href="{{ route('register') }}">Sign Up</a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>
</header>
    <div class="content flex_space">
      <div class="logo">
        <img src="{{ asset('storage/images/index/logo.png') }}" alt="Logo">
      </div>
      <div class="navlinks">
        <ul id="menulist">
            <li><a href={{ route('index') }}>home</a> </li>
            <li><a href={{ route('properties.index')}}>Real-State</a> </li>
            <li><a href="{{ route('contact-us') }}">contact</a> </li>
            @if(Auth::check())
                <li class="dropdown">
                    <button class="dropbtn">
                        <img src="{{ asset('storage/' . Auth::user()->image) }}" alt="Profile Picture" class="profile-pic">
                        Hello, {{ Auth::user()->name }}</button>
                    <div class="dropdown-content">
                        <a class="drplin" href="{{ route('profile', Auth::user()->id) }}">View Profile</a>
                        <form  id="logout-form" action="{{ route('logout') }}" method="POST" >
                            @csrf
                            <button type="submit" class="logout-btn drplin">Logout</button>
                        </form>
                    </div>
                </li>
            @endif

            @guest
                <li><a href="{{ route('login') }}" class="primary-btn">Login</a></li>
                <li><a href="{{ route('register') }}" class="primary-btn">Sign Up</a></li>
            @endguest
        </ul>
        <span class="fa fa-bars" onclick="menutoggle()"></span>
      </div>
    </div>


    <script>
        // Toggle dropdown on button click
        document.querySelector('.dropbtn').addEventListener('click', function(event) {
            const dropdownContent = document.querySelector('.dropdown-content');

            // Toggle dropdown visibility
            if (dropdownContent.style.display === 'block') {
                dropdownContent.style.display = 'none';
            } else {
                dropdownContent.style.display = 'block';
                // Set z-index and position to make it appear above other elements
                dropdownContent.style.zIndex = '1000';
            }

            event.stopPropagation(); // Prevent the click event from closing the dropdown immediately
        });

        // Close the dropdown if the user clicks outside
        document.addEventListener('click', function(event) {
            if (!event.target.closest('.dropdown')) {
                document.querySelector('.dropdown-content').style.display = 'none';
            }
        });
    </script>


  </header>
