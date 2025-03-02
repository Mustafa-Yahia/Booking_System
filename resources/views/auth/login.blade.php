<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- FontAwesome for icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        body {
            margin: 0;
            padding: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: #f4f4f4;
            overflow: hidden;
        }

        /* Animation for background */
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

        .login-container {
            max-width: 400px;
            width: 100%;
            padding: 30px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .login-container .form-header {
            text-align: center;
            margin-bottom: 20px;
        }

        .form-header h2 {
            color: #81c408;
            font-weight: bold;
        }



        .form-control:focus {
            border-color: #81c408;
            box-shadow: 0 0 5px rgba(129, 196, 8, 0.5);
        }

        .btn-primary {
            background-color: #81c408;
            border-color: #81c408;
        }

        .btn-primary:hover {
            background-color: #6fa007;
        }


.btn-primary:focus {
    outline: none;
    box-shadow: 0 0 5px rgba(129, 196, 8, 0.5);
}

.btn-primary:active {
    background-color: #6fa007;
    border-color: #6fa007;
}


        .text-login {
            color: #81c408;
            font-weight: bold;
            text-decoration: none;
        }

        .text-login:hover {
            color: #6fa007;
            text-decoration: underline;
        }

        .text-primary a{
            color: #81c408
        }

        /* Loading Screen Styles */
.loading-screen {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(255, 255, 255, 0.8);
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 9999;
}

.spinner {
    border: 4px solid rgba(255, 255, 255, 0.3);
    border-top: 4px solid #81c408;
    border-radius: 50%;
    width: 50px;
    height: 50px;
    animation: spin 1s linear infinite;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

    </style>
</head>
<body>


    <div class="login-container">
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="form-header">
                <h2><i class="fa-solid fa-building"></i> Login</h2>
            </div>

            <div class="mb-3">
                <label class="form-label">Email:</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                    <input name="email" type="email" id="email" class="form-control">
                </div>
                @error('email') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Password:</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                    <input name="password" type="password" id="password" class="form-control">
                </div>
                @error('password') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <!-- Forgot Password & Remember Me in the same row -->
            <div class="d-flex justify-content-between mb-3">
                <!-- Remember Me Checkbox -->
                <div class="form-check">
                    <input name="remember" type="checkbox" class="form-check-input" id="remember">
                    <label class="form-check-label" for="remember" style="color: #000;">Remember Me</label>
                </div>

                <!-- Forgot Password Link -->
                <div>
                    <a href="{{ route('password.request') }}" style="color: #000;">Forgot Password?</a>
                </div>
            </div>

            <div class="input-group">
                <button type="submit" class="btn btn-primary w-100">
                    <i class="fas fa-sign-in-alt"></i> Login
                </button>
            </div>

            <p class="text-center mt-3">Don't have an account? <a href="{{ route('register') }}" class="text-login">Register</a></p>
        </form>


    </div>

    <!-- Loading Screen -->
<div id="loadingScreen" class="loading-screen" style="display: none;">
    <div class="spinner"></div>
</div>





<script src="{{ asset('js/login/localstorage.js') }}"></script>
<script src="{{ asset('js/login/login.js') }}"></script>

</body>
</script>

</html>
