@extends('components.layouts.navbar')

@section('content')
<div class="pt-10 px-4 min-h-screen flex justify-center bg-gray-100 overflow-hidden">
    <div class="bg-white shadow-lg rounded-lg p-8 w-full max-w-6xl mb-10"> <!-- Adjusted max width for a wider container -->
        <!-- Title -->
        <h2 class="text-2xl font-bold text-gray-800">Profile</h2> <!-- Reduced text size -->
        <p class="text-gray-600 mb-4 text-sm">Manage your account</p> <!-- Reduced text size -->
        <hr class="mb-6">

        <!-- Profile Form -->
        <form id="profile-form" method="POST" action="{{ route('profile.update') }}" class="space-y-6">
            @csrf
            @method('PUT')

            <div class="flex flex-col sm:flex-row items-center space-y-6 sm:space-y-0 sm:space-x-6">
                <!-- Profile Picture -->
                <div class="flex flex-col items-center">
                    <div class="w-20 h-20 rounded-full bg-gray-300 flex items-center justify-center"> <!-- Reduced size -->
                        <span class="text-gray-500 text-xs">Image</span> <!-- Reduced text size -->
                    </div>
                    @can('admin') <!-- Replace 'admin' with the role or permission you want to check -->
                        <button type="button" class="mt-2 px-4 py-1 bg-orange-300 text-white rounded-lg text-xs">Upload</button> <!-- Reduced text size -->
                        <p class="text-xs text-gray-500 mt-1">File size: max 1MB, JPEG, PNG</p> <!-- Reduced text size -->
                    @endcan
                </div>

                <!-- User Info -->
                <div class="flex-1 space-y-4 w-full">
                    <div>
                        <label class="block text-xs font-medium text-gray-700">First Name</label> <!-- Reduced text size -->
                        <input type="text" name="first_name" value="{{ isset($user) ? $user->first_name: '' }}"
                               class="mt-1 w-full px-4 py-2 border rounded-lg shadow-sm focus:ring-orange-400 focus:border-orange-400 text-sm"> <!-- Reduced text size -->
                    </div>

                    <div>
                        <label class="block text-xs font-medium text-gray-700">Last Name</label> <!-- Reduced text size -->
                        <input type="text" name="last_name" value="{{ isset($user) ? $user->last_name: '' }}"
                               class="mt-1 w-full px-4 py-2 border rounded-lg shadow-sm focus:ring-orange-400 focus:border-orange-400 text-sm"> <!-- Reduced text size -->
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-medium text-gray-700">Email</label> <!-- Reduced text size -->
                            <input type="email" name="email" value="{{ isset($user) ? $user->email : '' }}"
                                   class="mt-1 w-full px-4 py-2 border rounded-lg shadow-sm focus:ring-orange-400 focus:border-orange-400 text-sm"> <!-- Reduced text size -->
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-700">Phone Number</label> <!-- Reduced text size -->
                            <input type="tel" name="phone" value="{{ isset($user) ? $user->phone_number : '' }}"
                                   class="mt-1 w-full px-4 py-2 border rounded-lg shadow-sm focus:ring-orange-400 focus:border-orange-400 text-sm"> <!-- Reduced text size -->
                        </div>
                    </div>
                </div>
            </div>

            <!-- Address Section -->
            <div>
                <h3 class="text-lg font-semibold text-gray-700 text-sm">Address (saved for delivery)</h3> <!-- Reduced text size -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-2">
                    <div>
                        <label class="block text-xs font-medium text-gray-700">House/Building & Street</label> <!-- Reduced text size -->
                        <input type="text" name="address" value="{{ isset($user) ? $user->address : '' }}"
                               class="mt-1 w-full px-4 py-2 border rounded-lg shadow-sm focus:ring-orange-400 focus:border-orange-400 text-sm"> <!-- Reduced text size -->
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-700">Barangay</label> <!-- Reduced text size -->
                        <input type="text" name="barangay" value="{{ isset($user) ? $user->barangay : '' }}"
                               class="mt-1 w-full px-4 py-2 border rounded-lg shadow-sm focus:ring-orange-400 focus:border-orange-400 text-sm"> <!-- Reduced text size -->
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-700">City/Municipality</label> <!-- Reduced text size -->
                        <input type="text" name="city" value="{{ isset($user) ? $user->city : '' }}"
                               class="mt-1 w-full px-4 py-2 border rounded-lg shadow-sm focus:ring-orange-400 focus:border-orange-400 text-sm"> <!-- Reduced text size -->
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-700">Province</label> <!-- Reduced text size -->
                        <input type="text" name="province" value="{{ isset($user) ? $user->province : '' }}"
                               class="mt-1 w-full px-4 py-2 border rounded-lg shadow-sm focus:ring-orange-400 focus:border-orange-400 text-sm"> <!-- Reduced text size -->
                    </div>
                </div>
            </div>

            <!-- Change Password Section -->
            <div>
                <h3 class="text-lg font-semibold text-gray-700 text-sm">Change Password</h3> <!-- Reduced text size -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-2">
                    <div class="relative">
                        <label class="block text-xs font-medium text-gray-700">Current Password</label> <!-- Reduced text size -->
                        <input type="password" name="current_password" id="current_password"
                               class="mt-1 w-full px-4 py-2 border rounded-lg shadow-sm focus:ring-orange-400 focus:border-orange-400 text-sm"> <!-- Reduced text size -->
                        <button type="button" onclick="togglePassword('current_password')" class="absolute top-9 right-3 text-gray-500">
                            <img src="{{ asset('img/eye-icon.svg') }}" alt="Show">
                        </button>
                    </div>
                    <div class="relative">
                        <label class="block text-xs font-medium text-gray-700">New Password</label> <!-- Reduced text size -->
                        <input type="password" name="new_password" id="new_password"
                               class="mt-1 w-full px-4 py-2 border rounded-lg shadow-sm focus:ring-orange-400 focus:border-orange-400 text-sm"> <!-- Reduced text size -->
                        <button type="button" onclick="togglePassword('new_password')" class="absolute top-9 right-3 text-gray-500">
                            <img src="{{ asset('img/eye-icon.svg') }}" alt="Show">
                        </button>
                    </div>
                </div>
            </div>

            <!-- Save Button -->
            <div class="flex justify-end">
                <button type="submit"
                        class="px-6 py-2 bg-[#4A2E0F] text-white font-semibold rounded-lg shadow-md hover:bg-[#24190d] text-sm"> <!-- Reduced text size -->
                    Save
                </button>
            </div>
        </form>

        <!-- Success Message -->
        @if(session('success'))
            <div class="mt-4 p-3 bg-green-100 text-green-700 rounded-lg text-sm">
                {{ session('success') }}
            </div>
        @endif
    </div>
</div>

<!-- Password Toggle Script -->
<script>
    function togglePassword(id) {
        let input = document.getElementById(id);
        input.type = input.type === "password" ? "text" : "password";
    }
</script>
@endsection
