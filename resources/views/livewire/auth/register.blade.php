@extends('components.layouts.registration')

@section('title', 'Sign Up - DoughMain')

@section('content')
<main class="bg-white shadow-lg rounded-xl overflow-hidden flex flex-col lg:flex-row max-w-screen-lg w-full mx-auto my-9 h-[90vh]">
     <!-- Left (Form Side) -->
     <div class="flex-1 p-6 md:p-8 overflow-y-auto max-h-screen">
        <h1 class="text-3xl font-bold text-gray-800 mb-2">Welcome!</h1>
        <p class="text-gray-600 mb-6">Register to continue.</p>

        <!-- Tabs -->
        <div class="flex space-x-4 mb-6 justify-center items-center text">
            <button id="userTab" class="tab-button text-gray-700 font-semibold px-4 py-2 relative focus:outline-none">
                User
                <span id="userIndicator" class="absolute bottom-0 left-0 w-full h-1 bg-blue-500 transition-all duration-300 transform scale-x-0"></span>
            </button>
            <button id="sellerTab" class="tab-button text-gray-500 font-semibold px-4 py-2 relative focus:outline-none">
                Seller
                <span id="sellerIndicator" class="absolute bottom-0 left-0 w-full h-1 bg-green-500 transition-all duration-300 transform scale-x-0"></span>
            </button>
        </div>

        <!-- User Registration Form -->
        <form id="userForm" class="space-y-4 w-full max-w-md transition-all opacity-100 transform" method="POST" action="{{ route('passRegister') }}">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-gray-700 font-medium mb-1">First Name</label>
                    <input type="text" name="first_name" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Enter your first name" required>
                </div>
                <div>
                    <label class="block text-gray-700 font-medium mb-1">Last Name</label>
                    <input type="text" name="last_name" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Enter your last name" required>
                </div>
            </div>
            <div>
                <label class="block text-gray-700 font-medium">Username</label>
                <input type="text" name="username" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Choose a username" required>
            </div>
            <div>
                <label class="block text-gray-700 font-medium">Email</label>
                <input type="email" name="email" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Enter your email" required>
            </div>
            <div>
                <label class="block text-gray-700 font-medium">Citizenship</label>
                <select name="nationality" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    <option value="" disabled selected>Select your citizenship</option>
                    <option value="United States">United States</option>
                    <option value="Canada">Canada</option>
                    <option value="United Kingdom">United Kingdom</option>
                    <option value="Philippines" selected>Philippines</option>
                    <option value="Australia">Australia</option>
                </select>
            </div>
            <div>
                <label class="block text-gray-700 font-medium">Phone Number</label>
                <div class="flex items-center border rounded-md px-3 py-2 focus-within:ring-2 focus-within:ring-blue-500">
                    <span class="flag-icon flag-icon-ph w-5 h-5 mr-2"></span>
                    <input type="tel" name="phone_number" class="flex-1 outline-none" placeholder="+63XXX-XXXX-XXX" required>
                </div>
            </div>
            <div>
                <label class="block text-gray-700 font-medium">Password</label>
                <input type="password" name="password" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Create a password" required>
            </div>
            <div>
                <label class="block text-gray-700 font-medium">Confirm Password</label>
                <input type="password" name="confirm-password" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Confirm your password" required>
            </div>
            <button type="submit" class="w-full bg-gray-800 text-white py-2 rounded-md hover:bg-gray-700">Register as User</button>
        </form>

        <!-- Seller Registration Form -->
        <form id="sellerForm" class="space-y-4 w-full max-w-md hidden transition-all opacity-100 transform" method="POST" action="{{ route('register') }}">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-gray-700 font-medium mb-1">First Name</label>
                    <input type="text" name="first_name" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Enter your first name" required>
                </div>
                <div>
                    <label class="block text-gray-700 font-medium mb-1">Last Name</label>
                    <input type="text" name="last_name" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Enter your last name" required>
                </div>
            </div>
            <div>
                <label class="block text-gray-700 font-medium">Username</label>
                <input type="text" name="username" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Choose a username" required>
            </div>
            <div>
                <label class="block text-gray-700 font-medium">Email</label>
                <input type="email" name="email" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Enter your email" required>
            </div>
            <div>
                <label class="block text-gray-700 font-medium">Citizenship</label>
                <select name="nationality" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    <option value="" disabled selected>Select your citizenship</option>
                    <option value="United States">United States</option>
                    <option value="Canada">Canada</option>
                    <option value="United Kingdom">United Kingdom</option>
                    <option value="Philippines" selected>Philippines</option>
                    <option value="Australia">Australia</option>
                </select>
            </div>
            <div>
                <label class="block text-gray-700 font-medium">Phone Number</label>
                <div class="flex items-center border rounded-md px-3 py-2 focus-within:ring-2 focus-within:ring-blue-500">
                    <span class="flag-icon flag-icon-ph w-5 h-5 mr-2"></span>
                    <input type="tel" name="phone_number" class="flex-1 outline-none" placeholder="+63XXX-XXXX-XXX" required>
                </div>
            </div>
            <div>
                <label class="block text-gray-700 font-medium">Password</label>
                <input type="password" name="password" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Create a password" required>
            </div>
            <div>
                <label class="block text-gray-700 font-medium">Confirm Password</label>
                <input type="password" name="confirm-password" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Confirm your password" required>
            </div>
            <button type="submit" class="w-full bg-gray-800 text-white py-2 rounded-md hover:bg-gray-700">Register as Seller</button>
        </form>

        <!-- Shared Elements -->
        <p class="text-gray-600 text-sm text-center mt-4">
            By continuing, you agree to our <a href="#" class="text-blue-500">Terms Of Service</a> and
            <a href="#" class="text-blue-500">Privacy Policy</a>.
        </p>
        <button class="flex items-center justify-center w-full border py-2 rounded-md mt-4 hover:bg-gray-800 hover:text-white">
            <img src="{{ asset('img/google-icon-colour.png') }}" alt="Google icon" class="w-5 h-5 mr-2">
            <span>Continue with Google</span>
        </button>

        <p class="text-gray-600 text-sm text-center mt-4">
            Already have an account? <a href="{{ route('login') }}" class="text-blue-500">Log in here.</a>
        </p>
    </div>

    <!-- Right (Image Side) -->
    <div class="hidden lg:block lg:w-1/2 h-full">
        <img src="{{ asset('img/image 9.png') }}" alt="Decorative side image" class="w-full h-full object-cover">
    </div>
</main>

<!-- Tab Toggle Script -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const userTab = document.getElementById('userTab');
        const sellerTab = document.getElementById('sellerTab');
        const userForm = document.getElementById('userForm');
        const sellerForm = document.getElementById('sellerForm');
        const userIndicator = document.getElementById('userIndicator');
        const sellerIndicator = document.getElementById('sellerIndicator');

        function switchForm(showForm, hideForm, activeTab, inactiveTab, activeIndicator, inactiveIndicator) {
            hideForm.classList.add('opacity-0', 'translate-x-4'); 
            hideForm.classList.remove('opacity-100', 'translate-x-0');

            setTimeout(() => {
                hideForm.classList.add('hidden');

                showForm.classList.remove('hidden');
                showForm.classList.add('opacity-0', 'translate-x-4');

                setTimeout(() => {
                    showForm.classList.remove('opacity-0', 'translate-x-4');
                    showForm.classList.add('opacity-100', 'translate-x-0');
                }, 20);
            }, 300); 

            activeTab.classList.add('text-gray-700');
            inactiveTab.classList.remove('text-gray-700');
            inactiveTab.classList.add('text-gray-500');

            activeIndicator.classList.add('scale-x-100');
            inactiveIndicator.classList.remove('scale-x-100');
        }

        userTab.addEventListener('click', () => {
            switchForm(userForm, sellerForm, userTab, sellerTab, userIndicator, sellerIndicator);
        });

        sellerTab.addEventListener('click', () => {
            switchForm(sellerForm, userForm, sellerTab, userTab, sellerIndicator, userIndicator);
        });

        userTab.classList.add('text-gray-700');
        sellerTab.classList.add('text-gray-500');
    });
</script>

@endsection
