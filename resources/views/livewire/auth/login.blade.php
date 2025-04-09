@extends('components.layouts.app')

@section('log_screen')
<div class="container-fluid min-vh-80 pt-4 d-flex align-items-center justify-content-center">
    <div class="row w-55 shadow-lg rounded overflow-hidden mt-4">
        <!-- Left Side: Image (Hidden on small screens) -->
        <div class="col-lg-6 d-none d-lg-block p-0">
            <img src="{{ asset('img/image 10.png') }}" class="img-fluid w-100 h-100" style="object-fit: cover;" alt="Ube Cheese Pandesal">
        </div>

        <!-- Right Side: Login Form -->
        <div class="col-md-6 p-5 bg-white">
            <h1 class="fw-bold text-4xl pb-1">Welcome back!</h1>
            <p class="text-muted pb-4">Login to continue</p>

            <form wire:submit.prevent="login">
                @csrf

                <!-- Email Field -->
                <div class="mb-3">
                    <label for="email" class="form-label" >Email</label>
                    <input type="email" wire:model.lazy="email" id="email" name="email" class="form-control" placeholder="Enter your email" value="{{ old('email') }}" required>
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
                    Don't have an account? <a href="{{ route('register') }}" class="fw-bold">Sign up here.</a>
                </p>
                @if(session('error'))
                    <p style="color:red;">{{ session('error') }}</p>
                @endif
            </form>
        </div>
    </div>
</div>
@endsection
