@extends('components.layouts.navbar')

@section('content')
<div class="pt-10 px-4 min-h-screen flex justify-center bg-gray-100">
    <div class="bg-white shadow-lg rounded-lg p-10 w-full max-w-5xl mb-8"> <!-- Reduced margin-bottom here -->
        <h2 class="text-3xl font-bold text-gray-800 mb-2">User Profile</h2>
        <p class="text-gray-600 mb-6">Your account details</p>
        <hr class="mb-6">

        <div class="space-y-6">
            <div class="flex flex-col lg:flex-row items-center space-y-6 lg:space-y-0 lg:space-x-8">
                <!-- Profile Picture -->
                <div class="w-28 h-28 rounded-full bg-gray-300 flex items-center justify-center">
                    <span class="text-gray-500">Image</span>
                </div>

                <!-- User Info -->
                <div class="flex-1 space-y-4 w-full">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Full Name</label>
                        <p class="mt-1 text-gray-900">{{ isset($user) ? $user->first_name . ' ' . $user->last_name : 'N/A' }}</p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Email</label>
                            <p class="mt-1 text-gray-900">{{ isset($user) ? $user->email : 'N/A' }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Phone</label>
                            <p class="mt-1 text-gray-900">{{ isset($user) ? $user->phone_number : 'N/A' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Address Section -->
            <div>
                <h3 class="text-lg font-semibold text-gray-700">Address</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-2">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">House/Street</label>
                        <p class="mt-1 text-gray-900">{{ isset($user) ? $user->address : 'N/A' }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Barangay</label>
                        <p class="mt-1 text-gray-900">{{ isset($user) ? $user->barangay : 'N/A' }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">City</label>
                        <p class="mt-1 text-gray-900">{{ isset($user) ? $user->city : 'N/A' }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Province</label>
                        <p class="mt-1 text-gray-900">{{ isset($user) ? $user->province : 'N/A' }}</p>
                    </div>
                </div>
            </div>

            <!-- Edit Profile Button -->
            <div class="flex justify-end mt-6">
                <a href="{{ route('profile.edit') }}"
                   class="px-10 py-3 bg-[#4A2E0F] text-white font-semibold rounded-lg shadow-md hover:bg-[#24190d]">
                    Edit Profile
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
