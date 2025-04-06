@extends('layouts.app')

@section('title', "Register")

<link rel="stylesheet" href="{{ asset('css/register.css') }}">
@section('content')

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


    <script src="{{ asset('js/register/register.js') }}"></script>

@endsection
