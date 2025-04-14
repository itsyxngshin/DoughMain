@extends('components.layouts.registration')

@section('title', 'Sign Up - DoughMain')

@section('content')
<main class="bg-white shadow-lg rounded-xl overflow-hidden flex max-w-4xl w-full">
    <div class="w-1/2 p-8 flex flex-col justify-center">
        <h1 class="text-3xl font-bold text-gray-800 mb-2">Welcome!</h1>
        <p class="text-gray-600 mb-6">Register to continue.</p>
        <form class="space-y-4" method="POST" action="{{route('passRegister')}}">
            @csrf
            <div class="w-full max-w-2xl">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="text" class="block text-gray-700 font-medium mb-1">First Name</label>
                        <input type="text" id="first_name" name="first_name" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Henry" required>
                    </div>
                    <div>
                        <label for="text" class="block text-gray-700 font-medium mb-1">Last Name</label>
                        <input type="text" id="last_name" name="last_name" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Sy" required>
                    </div>
                    
                </div>
            </div>
            <div>
                <label for="text" class="block text-gray-700 font-medium">Username</label>
                <input type="text" id="username" name="username" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Enter your username here" required>
            </div>
            <div>
                <label for="email" class="block text-gray-700 font-medium">Email</label>
                <input type="email" id="email" name="email" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Enter your email here" required>
            </div>
            <div>
                <label for="nationality" class="block text-gray-700 font-medium">Citizenship</label>
                <select id="nationality" name="nationality" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    <option value="" disabled selected>Select your citizenship</option>
                    <option value="United States">United States</option>
                    <option value="Canada">Canada</option>
                    <option value="United Kingdom">United Kingdom</option>
                    <option value="Philippines" selected>Philippines</option>
                    <option value="Australia">Australia</option>
                </select>
            </div>
            <div>
                <label for="phone" class="block text-gray-700 font-medium">Phone Number</label>
                <div class="flex items-center border rounded-md px-3 py-2 focus-within:ring-2 focus-within:ring-blue-500">
                    <span class="flag-icon flag-icon-ph w-5 h-5 mr-2"></span>
                    <input type="tel" id="phone_number" name="phone_number" class="flex-1 outline-none" placeholder="+63XXX-XXXX-XXX" required>
                </div>
            </div>
            <div>
                <label for="password" class="block text-gray-700 font-medium">Password</label>
                <input type="password" id="password" name="password" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Enter password" required>
            </div>
            <div>
                <label for="confirm-password" class="block text-gray-700 font-medium">Confirm Password</label>
                <input type="password" id="confirm-password" name="confirm-password" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Confirm password" required>
            </div>
            <button type="submit" class="w-full bg-gray-800 text-white py-2 rounded-md hover:bg-gray-700">Register</button>
        </form>
        <form class="space-y-4" method="POST" action="{{route('register')}}">
            @csrf
            <div class="w-full max-w-2xl">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="text" class="block text-gray-700 font-medium mb-1">First Name</label>
                        <input type="text" id="first_name" name="first_name" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Henry" required>
                    </div>
                    <div>
                        <label for="text" class="block text-gray-700 font-medium mb-1">Last Name</label>
                        <input type="text" id="last_name" name="last_name" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Sy" required>
                    </div>
                    
                </div>
            </div>
            <div>
                <label for="text" class="block text-gray-700 font-medium">Username</label>
                <input type="text" id="username" name="username" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Enter your username here" required>
            </div>
            <div>
                <label for="email" class="block text-gray-700 font-medium">Email</label>
                <input type="email" id="email" name="email" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Enter your email here" required>
            </div>
            <div>
                <label for="nationality" class="block text-gray-700 font-medium">Citizenship</label>
                <select id="nationality" name="nationality" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    <option value="" disabled selected>Select your citizenship</option>
                    <option value="United States">United States</option>
                    <option value="Canada">Canada</option>
                    <option value="United Kingdom">United Kingdom</option>
                    <option value="Philippines" selected>Philippines</option>
                    <option value="Australia">Australia</option>
                </select>
            </div>
            <div>
                <label for="phone" class="block text-gray-700 font-medium">Phone Number</label>
                <div class="flex items-center border rounded-md px-3 py-2 focus-within:ring-2 focus-within:ring-blue-500">
                    <span class="flag-icon flag-icon-ph w-5 h-5 mr-2"></span>
                    <input type="tel" id="phone_number" name="phone_number" class="flex-1 outline-none" placeholder="+63XXX-XXXX-XXX" required>
                </div>
            </div>
            <div>
                <label for="password" class="block text-gray-700 font-medium">Password</label>
                <input type="password" id="password" name="password" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Enter password" required>
            </div>
            <div>
                <label for="confirm-password" class="block text-gray-700 font-medium">Confirm Password</label>
                <input type="password" id="confirm-password" name="confirm-password" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Confirm password" required>
            </div>
            <button type="submit" class="w-full bg-gray-800 text-white py-2 rounded-md hover:bg-gray-700">Register</button>
        </form>
        <p class="text-gray-600 text-sm text-center mt-4">
            By continuing, you agree to our <a href="#" class="text-blue-500">Terms Of Service</a> and
            <a href="#" class="text-blue-500">Privacy Policy</a>.
        </p>
        <button class="flex items-center justify-center w-full border py-2 rounded-md mt-4 hover:bg-gray-100">
            <img src="{{ asset('img/google-icon-colour.png') }}" alt="Google icon" class="w-5 h-5 mr-2">
            <span>Continue with Google</span>
        </button>
        <p class="text-gray-600 text-sm text-center mt-4">
            Already have an account? <a href="{{ route('login') }}" class="text-blue-500">Log in here.</a>
        </p>
    </div>
    <div class="w-1/2">
        <img src="{{ asset('img/image 9.png') }}" alt="Decorative side image" class="w-full h-full object-cover">
    </div>
</main>
@endsection
