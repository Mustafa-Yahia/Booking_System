<link rel="stylesheet" href="{{ asset('css/style.css') }}">

<header>
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


    @if(Auth::check())
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
    @endif


  </header>
