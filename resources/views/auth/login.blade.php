@extends('layouts.app')

@section('title', "Login")

<link rel="stylesheet" href="{{ asset('css/login.css') }}">
@section('content')

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

                <!-- Forgot Password Link -->
                {{-- <div>
                    <a href="{{ route('password.request') }}" style="color: #000;">Forgot Password?</a>
                </div> --}}
            </div>

            <div class="input-group">
                <button style="background-color: #6fa007;color:white" type="submit" class="btn  w-100">
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

@endsection
