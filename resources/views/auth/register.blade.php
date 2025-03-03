<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- FontAwesome for icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        body {
            margin: 0;
    padding: 0;
    margin-top: 100px;
    /* height: 100vh;  */
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    background: #f4f4f4;
        }

        @keyframes backgroundMove {
            0% {
                background-position: 0% 0%;
            }
            50% {
                background-position: 100% 100%;
            }
            100% {
                background-position: 0% 0%;
            }
        }




         .form-header {
            text-align: center;
            margin-bottom: 20px;
        }

        .form-header h2 {
            color: #81c408;
            font-weight: bold;
        }


        @keyframes slideIn {
            0% { transform: translateY(-50px); opacity: 0; }
            100% { transform: translateY(0); opacity: 1; }
        }

        .profile-container {
            max-width: 900px;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-top: 50px;
            animation: bounceIn 1s ease-out;
        }

        @keyframes bounceIn {
            0% { transform: scale(0.8); opacity: 0; }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); opacity: 1; }
        }

        .form-control:focus {
            border-color: #81c408;
            box-shadow: 0 0 5px rgba(129, 196, 8, 0.5);
            animation: focusEffect 0.3s ease-in-out;
        }

        @keyframes focusEffect {
            0% { border-color: #ccc; }
            100% { border-color: #81c408; }
        }


        .btn-primary:focus {
    outline: none;
    box-shadow: 0 0 5px rgba(129, 196, 8, 0.5);
}

.btn-primary:active {
    background-color: #6fa007;
    border-color: #6fa007;
}

        .btn-primary {
            background-color: #81c408;
            border-color: #81c408;
            transition: background-color 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #6fa007;
        }






        .text-login {
            color: #81c408;
            font-weight: bold;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .text-login:hover {
            color: #6fa007;
            text-decoration: underline;
        }

        .input-group {
            animation: fadeInUp 0.5s ease-in-out;
        }

        @keyframes fadeInUp {
            0% { transform: translateY(20px); opacity: 0; }
            100% { transform: translateY(0); opacity: 1; }
        }

        /* Make the form fields horizontal */
        .form-row {
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
        }

        .form-row .form-group {
            flex: 1 1 calc(33.333% - 20px);
            margin-bottom: 1rem;
        }

        @media (max-width: 768px) {
            .form-row .form-group {
                flex: 1 1 100%;
            }
        }
    </style>
      <style>
        footer {
      width: 100%;
      color: white;
      text-align: center;
      padding: 10px 0;
      margin-top: auto;

  }


          footer  a {
              color: black;
      text-decoration: none;
      font-size: 16px;
      transition: color 0.3s;
      padding-right: 30px;
            }


            </style>
</head>
<body>
    <nav style=" background-color: #f8f9fa;position: relative; top: -100px;width:100%;text-align: center;">
        <a href="{{ route("index") }}" style=" font-size: 40px;text-decoration: none;color:#000">hellow</a>
    </nav>
    <div class="profile-container">
        <form method="POST" id="registerForm" action="{{ route('register') }}">
            @csrf

            <div class="form-header">
                <h2><i class="fa-solid fa-building"></i> Register</h2>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Full Name:</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                        <input name="name" type="text" id="name" class="form-control">
                    </div>
                    <small id="nameError" class="text-danger d-none">Invalid name use letters only, no extra spaces.</small>
                    @error('name') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Email:</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                        <input name="email" type="email" id="email" class="form-control">
                    </div>
                    <small id="emailError" class="text-danger d-none">Invalid email format.</small>
                    @error('email') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Phone:</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-phone-alt"></i></span>
                        <input name="phone" type="tel" id="phone" class="form-control">
                    </div>
                    <small id="phoneError" class="text-danger d-none">Phone must start with 079, 078, or 077 and be 10 digits.</small>
                    @error('phone') <small class="text-danger">{{ $message }}</small> @enderror
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Password:</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-lock"></i></span>
                        <input name="password" type="password" id="password" class="form-control">
                    </div>
                    <small id="passwordError" class="text-danger d-none">Password must be at least 8 characters, include uppercase, lowercase, number, and special character.</small>
                    @error('password') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Confirm Password:</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-lock"></i></span>
                        <input name="password_confirmation" type="password" id="confirmPassword" class="form-control">
                    </div>
                    <small id="confirmPasswordError" class="text-danger d-none">Passwords do not match.</small>
                    @error('password_confirmation') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Address:</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-home"></i></span>
                        <input name="address" type="text" id="address" class="form-control">
                    </div>
                    <small id="addressError" class="text-danger d-none">Address should only contain letters and spaces.</small>
                    @error('address') <small class="text-danger">{{ $message }}</small> @enderror
                </div>
            </div>

            <!-- Register Button with Icon -->
            <div class="input-group">
                <button style="background-color: #6fa007;color:white" type="submit" class="btn w-100">
                    <i class="fas fa-user-plus"></i> Register
                </button>
            </div>

            <p class="text-center mt-3">I already have an account? <a href="{{ route('login') }}" class="text-login">Login</a></p>
        </form>
    </div>

    <footer>
        <div class="container grid">


          <div class="box">
                <a href="#">Company History</a>
                <a href="#">About Us</a>
                <a href="{{ route("contact-us") }}">Contact Us</a>
                <a href="#">Services</a>
                <a href="#">Privacy Policy</a>
          </div>


        </div>
      </footer>


    <script src="{{ asset('js/register/register.js') }}"></script>

</body>

</html>
