@extends('components.layouts.registration')

@section('title', 'Sign Up - DoughMain')

@section('content')
<main class="bg-white shadow-lg rounded-xl overflow-hidden flex flex-col lg:flex-row max-w-screen-lg w-full mx-auto h-screen">
    <!-- Left (Form Side) -->
    <div class="flex-1 p-6 md:p-8 overflow-y-auto max-h-screen">
        <h1 class="text-3xl font-bold text-gray-800 mb-2">Welcome!</h1>
        <p class="text-gray-600 mb-6">Register to continue.</p>

        <!-- Tabs -->
        <div class="flex space-x-4 mb-6 justify-center items-center text">
            <button id="userTab" class="tab-button text-gray-700 font-semibold px-4 py-2 border-b-2 border-blue-500 focus:outline-none">User</button>
            <button id="sellerTab" class="tab-button text-gray-500 font-semibold px-4 py-2 border-b-2 border-transparent hover:border-blue-300 focus:outline-none">Seller</button>
        </div>


        <!-- User Registration Form -->
        <form id="userForm" class="space-y-4" method="POST" action="{{ route('passRegister') }}">
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
        <form id="sellerForm" class="space-y-4 hidden" method="POST" action="{{ route('register') }}">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-gray-700 font-medium mb-1">Shop Name</label>
                    <input type="text" name="first_name" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Enter your first name" required>
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
        <button class="flex items-center justify-center w-full border py-2 rounded-md mt-4 hover:bg-gray-100">
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

    // Function to handle form switching with animation
    function switchForm(showForm, hideForm, activeTab, inactiveTab) {
        // Animate out the current form
        hideForm.classList.add('opacity-0', 'translate-x-4'); // Slide out to the right
        hideForm.classList.remove('opacity-100', 'translate-x-0');

        // Wait for the slide-out animation to complete before hiding it and showing the other form
        setTimeout(() => {
            hideForm.classList.add('hidden');

            // Show new form with fade-in and slide-in animation from the opposite direction (left to right)
            showForm.classList.remove('hidden');
            showForm.classList.add('opacity-0', '-translate-x-4'); // Start hidden with a slide-in from the left

            setTimeout(() => {
                showForm.classList.remove('opacity-0', '-translate-x-4');
                showForm.classList.add('opacity-100', 'translate-x-0');
            }, 20);
        }, 300); // Duration of the animation (matches hideForm animation)

        // Update tab styles
        activeTab.classList.add('text-gray-700', 'border-blue-500');
        inactiveTab.classList.remove('text-gray-700', 'border-blue-500');
        inactiveTab.classList.add('text-gray-500');
    }

    // Event listener for the User tab
    userTab.addEventListener('click', () => {
        switchForm(userForm, sellerForm, userTab, sellerTab);
    });

    // Event listener for the Seller tab
    sellerTab.addEventListener('click', () => {
        switchForm(sellerForm, userForm, sellerTab, userTab);
    });
});

</script>

@endsection
