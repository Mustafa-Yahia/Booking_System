<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body {
            background-color: #f4f4f4;
        }
        .profile-header {
            background: linear-gradient(135deg, #4CAF50, #81c408);
            color: white;
            padding: 30px;
            text-align: center;
        }
        .profile-container {
            max-width: 500px;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-top: 50px;
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
    </style>
</head>
<body>
    <div class="profile-header">
        <h2>Create a New Account</h2>
    </div>

    <div class="profile-container" >
  
        <form method="POST" id="registerForm" action="{{ route('register') }}">
            @csrf

            <div class="mb-3">
                <label class="form-label">Full Name:</label>
                <input name="name" type="text" id="name" class="form-control">
                <small id="nameError" class="text-danger d-none">Invalid name use letters only, no extra spaces.</small>
                @error('name') <small class="text-danger">{{ $message }}</small> @enderror

            </div>
            
            <div class="mb-3">
                <label class="form-label">Email:</label>
                <input  name="email" type="email" id="email" class="form-control">
                <small id="emailError" class="text-danger d-none">Invalid email format.</small>
                @error('email') <small class="text-danger">{{ $message }}</small> @enderror

            </div>
            
            <div class="mb-3">
                <label class="form-label">Phone:</label>
                <input name="phone" type="tel" id="phone" class="form-control">
                <small id="phoneError" class="text-danger d-none">Phone must start with 079, 078, or 077 and be 10 digits.</small>
                @error('phone') <small class="text-danger">{{ $message }}</small> @enderror

            </div>
            
            <div class="mb-3">
                <label class="form-label">Password:</label>
                <input   name="password"   type="password" id="password" class="form-control">
                <small id="passwordError" class="text-danger d-none">Password must be at least 8 characters, include uppercase, lowercase, number, and special character.</small>
                @error('password') <small class="text-danger">{{ $message }}</small> @enderror

            </div>
            
            <div class="mb-3">
                <label class="form-label">Confirm Password:</label>
                <input name="password_confirmation" type="password" id="confirmPassword" class="form-control">
                <small id="confirmPasswordError" class="text-danger d-none">Passwords do not match.</small>
                @error('password_confirmation') <small class="text-danger">{{ $message }}</small> @enderror

            </div>
            
            <div class="mb-3">
                <label class="form-label">Address:</label>
                <input name="address" type="text" id="address" class="form-control">
                <small id="addressError" class="text-danger d-none">Address should only contain letters and spaces.</small>
                @error('address') <small class="text-danger">{{ $message }}</small> @enderror

            </div>
            
            <button type="submit" class="btn btn-primary w-100">Register</button>
            <p class=" text-center mt-3">I already have an account? <a href="{{ route('login') }}">Login here</a></p>
        </form>
    </div>

    <script>
        document.getElementById("registerForm").addEventListener("submit", function(event) {
            event.preventDefault(); 

            let isValid = true;

            let name = document.getElementById("name").value.trim();
            let namePattern = /^[A-Za-z\s]+$/;
            let nameError = document.getElementById("nameError");
            if (!namePattern.test(name) || name.startsWith(" ") || name.endsWith(" ")) {
                nameError.classList.remove("d-none");
                isValid = false;
            } else {
                nameError.classList.add("d-none");
            }

            let email = document.getElementById("email").value.trim();
            let emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
            let emailError = document.getElementById("emailError");
            if (!emailPattern.test(email)) {
                emailError.classList.remove("d-none");
                isValid = false;
            } else {
                emailError.classList.add("d-none");
            }

            let phone = document.getElementById("phone").value.trim();
            let phonePattern = /^(079|078|077)[0-9]{7}$/;
            let phoneError = document.getElementById("phoneError");
            if (phone !== "" && !phonePattern.test(phone)) {
                phoneError.classList.remove("d-none");
                isValid = false;
            } else {
                phoneError.classList.add("d-none");
            }

            let password = document.getElementById("password").value;
            let passwordPattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
            let passwordError = document.getElementById("passwordError");
            if (!passwordPattern.test(password)) {
                passwordError.classList.remove("d-none");
                isValid = false;
            } else {
                passwordError.classList.add("d-none");
            }

            let confirmPassword = document.getElementById("confirmPassword").value;
            let confirmPasswordError = document.getElementById("confirmPasswordError");
            if (confirmPassword !== password) {
                confirmPasswordError.classList.remove("d-none");
                isValid = false;
            } else {
                confirmPasswordError.classList.add("d-none");
            }

            let address = document.getElementById("address").value.trim();
            let addressPattern = /^[A-Za-z\s]+$/;
            let addressError = document.getElementById("addressError");
            if (address !== "" && !addressPattern.test(address)) {
                addressError.classList.remove("d-none");
                isValid = false;
            } else {
                addressError.classList.add("d-none");
            }

            if (isValid) {
                Swal.fire({
                    title: "Success!",
                    text: "Registration successful!",
                    icon: "success",
                    confirmButtonText: "OK"
                }).then(() => {
                    document.getElementById("registerForm").submit();
                });
            }
        });
    </script>
</body>
</html>
