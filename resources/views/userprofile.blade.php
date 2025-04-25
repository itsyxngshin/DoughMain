@extends('layouts.navbar')

@section('content')
    <div class="bg-white shadow-lg rounded-lg p-8 w-full max-w-20xl mt-5">
        <h2 class="text-2xl font-bold text-gray-800">User Profile</h2>
        <p class="text-gray-600 mb-4">Your account details</p>
        <hr class="mb-6">

        <div class="space-y-6">
            <div class="flex items-center space-x-6">
                <!-- Profile Picture -->
                <div class="w-24 h-24 rounded-full bg-gray-300 flex items-center justify-center">
                    <span class="text-gray-500">Image</span>
                </div>

                <!-- User Info -->
                <div class="flex-1 space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Full Name</label>
                        <p class="mt-1 text-gray-900">{{ isset($user) ? $user->name : 'N/A' }}</p>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Email</label>
                            <p class="mt-1 text-gray-900">{{ isset($user) ? $user->email : 'N/A' }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Phone</label>
                            <p class="mt-1 text-gray-900">{{ isset($user) ? $user->phone : 'N/A' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Address Section -->
            <div>
                <h3 class="text-lg font-semibold text-gray-700">Address</h3>
                <div class="grid grid-cols-2 gap-4 mt-2">
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
            <div class="flex justify-end">
                <a href="{{ route('profile.edit') }}"
                   class="px-6 py-2 bg-orange-400 text-white font-semibold rounded-lg shadow-md hover:bg-orange-500">
                    Edit Profile
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
