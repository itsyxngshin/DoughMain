@extends('layouts.app')

@section('log_screen')
<div class="container-fluid min-vh-100 d-flex align-items-center justify-content-center">
    <div class="row w-75 shadow-lg rounded overflow-hidden">
        <!-- Left Side: Image -->
        <div class="col-md-6 p-0">
            <img src="{{ asset('img/image 10.png') }}" class="img-fluid w-100 h-100" style="object-fit: cover;" alt="Ube Cheese Pandesal">
        </div>

        <!-- Right Side: Login Form -->
        <div class="col-md-6 p-5 bg-white">
            <h1 class="fw-bold">Welcome back!</h1>
            <p class="text-muted">Login to continue</p>

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email Field -->
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" id="email" name="email" class="form-control" placeholder="Enter your email" required>
                </div>

                <!-- Password Field -->
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" id="password" name="password" class="form-control" placeholder="Enter your password" required>
                </div>

                <!-- Remember Me -->
                <div class="mb-3 form-check">
                    <input type="checkbox" id="remember" name="remember" class="form-check-input">
                    <label for="remember" class="form-check-label">Remember me</label>
                </div>

                <!-- Login Button -->
                <button type="submit" class="btn btn-dark w-100">Login</button>

                <!-- Forgot Password -->
                <div class="text-center mt-3">
                    <a href="#" class="text-decoration-none text-muted">Forgot Password?</a>
                </div>

                <!-- Divider -->
                <div class="text-center my-3 text-muted">Or login with</div>

                <!-- Google Login -->
                <a href="#" class="btn btn-outline-dark w-100 d-flex align-items-center justify-content-center">
                    <img src="{{ asset('img/google-icon-colour.png') }}" alt="Google" class="me-2" width="20">
                    Continue with Google
                </a>

                <!-- Sign Up -->
                <p class="text-center mt-3">
                    Don't have an account? <a href="#" class="fw-bold">Sign up here.</a>
                </p>
            </form>
        </div>
    </div>
</div>
@endsection