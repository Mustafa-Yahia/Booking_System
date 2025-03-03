{{--
<style>
footer ul li a {
    color: #fff;
    text-decoration: none;
    font-size: 16px;
    transition: color 0.3s;
  }

   footer ul li a:hover {
    color: #81c408;
  }
  </style>

<footer>
    <div class="container grid">
      <div class="box">
        <img src="{{ asset('images/logo-2.png') }}" alt="Logo">
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit...</p>
        <div class="icon">
          <i class="fa fa-facebook-f"></i>
          <i class="fa fa-instagram"></i>
          <i class="fa fa-twitter"></i>
          <i class="fa fa-youtube"></i>
        </div>
      </div>

      <div class="box">
        <h2>Links</h2>
        <ul>
          <li><a href="#">Contact Us</a></li>
          <li><a href="#">Privacy Policy</a></li>
        </ul>
      </div>

      <div class="box">
        <h2>Contact Us</h2>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit...</p>
        <i class="fa fa-location-dot"></i>
        <label>1201 Park Street, Avenue, Dhanmondy, Dhaka</label><br>
        <i class="fa fa-phone"></i>
        <label>[88] 657 524 332</label><br>
        <i class="fa fa-envelope"></i>
        <label>info@dentar.com</label><br>
      </div>
    </div>
  </footer>

  <div class="containser">
    <p>&copy; 2025 Modern Apartments in Jordan. All rights reserved.</p>
  </div> --}}

  <style>
    /* Footer Styles */
    .footer {
        background: #282834;
        color: #b6b7b9;
        padding: 1rem 0;
        margin-top: 2rem;
    }

    /* Grid Layout */
    .footer-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 3rem;
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 1rem;
    }

    /* Footer Sections */
    .footer-section {
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }

    /* Footer Links */
    .footer-links {
        display: grid;
        gap: 1rem;
    }

    .footer-links a {
        color: #b6b7b9;
        text-decoration: none;
        font-size: 0.9rem;
        transition: color 0.3s ease;
    }

    .footer-links a:hover {
        color: #7fc142;
    }

    /* Social Links */
    .social-links {
        display: flex;
        gap: 1.5rem;
        margin-top: 1.5rem;
    }

    .social-links a {
        color: #b6b7b9;
        text-decoration: none;
        font-size: 1.2rem;
        transition: color 0.3s ease;
    }

    .social-links a:hover {
        color: #7fc142;
    }

    /* Copyright Section */
    .copyright {
        text-align: center;
        padding-top: 2rem;
        border-top: 1px solid rgba(182, 183, 185, 0.2);
        margin-top: 2rem;
        font-size: 0.9rem;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .footer-grid {
            grid-template-columns: 1fr;
            text-align: center;
        }

        .social-links {
            justify-content: center;
        }
    }
    </style>


        <footer class="footer">
            <div class="footer-grid">
                <!-- Left Section -->
                <div class="footer-section">
                    <h3>Quick Links</h3>
                    <div class="footer-links">
                        <a href="{{route('index')}}">Home</a>
                        <a href="#">Contact Us</a>
                        <a href="{{route('privacy')}}">Terms & Conditions</a>
                        <a href="{{route('terms')}}">Privacy Policy</a>
                    </div>
                </div>

                <!-- Right Section -->
                <div class="footer-section">
                    <h3>Get Connected</h3>
                    <div class="social-links">
                        <a href="https://github.com/Mustafa-Yahia/Booking_System/tree/main" target="_blank" title="LinkedIn">LinkedIn</a>
                        <a href="https://github.com/Mustafa-Yahia/Booking_System/tree/main" target="_blank" title="GitHub">GitHub</a>
                    </div>
                </div>
            </div>

            <!-- Copyright Section -->
            <div class="copyright">
                © 2025 Crowny Hotel. All rights reserved.
            </div>
        </footer>
