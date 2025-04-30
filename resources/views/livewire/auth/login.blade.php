@extends('components.layouts.app')

@section('content')
<div class="container-fluid min-vh-80 pt-4 d-flex align-items-center justify-content-center">
    <div class="row w-55 shadow-lg rounded overflow-hidden mt-4">
        <!-- Left Side: Image (Hidden on small screens) -->
        <div class="col-lg-6 d-none d-lg-block p-0">
            <img src="{{ asset('img/image 10.png') }}" class="img-fluid w-100 h-100 animated-image" style="object-fit: cover;" alt="Ube Cheese Pandesal">
        </div>

        <!-- Right Side: Login Form -->
        <div class="col-md-6 p-5 bg-white animated-form">
            <h1 class="fw-bold text-4xl pb-1">Welcome back!</h1>
            <p class="text-muted pb-4">Login to continue</p>

            <form method="POST" action="{{ route('passLogin') }}">
                @csrf

                <!-- Email Field -->
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Enter your email" value="{{ old('email') }}" required>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Password Field -->
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Enter your password" required autocomplete="current-password">
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Remember Me -->
                <div class="mb-3 form-check">
                    <input type="checkbox" id="remember" wire:model.defer="remember" name="remember" class="form-check-input">
                    <label for="remember" class="form-check-label">Remember me</label>
                </div>

                <!-- Login Button -->
                <button type="submit" class="btn btn-dark w-100">Login</button>

                <!-- Forgot Password -->
                <div class="text-center mt-3">
                    <a href="javascript:void(0);" class="text-decoration-none text-muted" id="forgotPasswordLink">Forgot Password?</a>
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

<!-- Forgot Password Modal -->
<div id="forgotPasswordModal" class="position-fixed top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center bg-dark bg-opacity-50 d-none" style="z-index: 1050;">
    <div class="bg-white p-4 p-md-5 rounded-4 shadow-lg" style="width: 100%; max-width: 420px;">
        <div class="mb-4 text-center">
            <h4 class="fw-bold mb-1">Forgot Password</h4>
            <p class="text-muted mb-0">Enter your email and we'll send you a reset link.</p>
        </div>

        <!-- Displaying errors inside the modal only -->
        @if(session('forgot_password_error'))
            <div class="alert alert-danger mt-3" role="alert">
                {{ session('forgot_password_error') }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
            @csrf
            <div class="mb-3">
                <label for="resetEmail" class="form-label">Email Address</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" id="resetEmail" name="email" placeholder="example@example.com" required>
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-flex justify-content-end mt-4">
                <button type="button" class="btn btn-outline-secondary me-2" id="closeModalBtn">Cancel</button>
                <button type="submit" class="btn btn-dark">Send Reset Link</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Script -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const forgotPasswordLink = document.getElementById('forgotPasswordLink');
        const forgotPasswordModal = document.getElementById('forgotPasswordModal');
        const closeModalBtn = document.getElementById('closeModalBtn');

        forgotPasswordLink.addEventListener('click', () => {
            forgotPasswordModal.classList.remove('d-none');
        });

        closeModalBtn.addEventListener('click', () => {
            forgotPasswordModal.classList.add('d-none');
        });

        window.addEventListener('click', (e) => {
            if (e.target === forgotPasswordModal) {
            }
        });
    });
</script>
@endsection
