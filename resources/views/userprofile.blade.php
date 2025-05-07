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
                <div class="flex flex-col items-center">
                    <div class="w-24 h-24 rounded-full bg-gray-300 flex items-center justify-center">
                        <img src="{{ asset('storage/profile.jpg') }}" alt="" class="rounded-full w-full h-full">
                    </div>
                    @can('admin') <!-- Replace 'admin' with the role or permission you want to check -->
                        <button type="button" class="mt-2 px-4 py-1 bg-orange-300 text-white rounded-lg text-sm">Upload</button>
                        <p class="text-xs text-gray-500 mt-1">File size: max 1MB, JPEG, PNG</p>
                    @endcan
                </div>

                <!-- User Info -->
                <div class="flex-1 space-y-4 w-full">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">First Name</label>
                        <input type="text" name="first_name" value="{{ $user->first_name ?? '-' }}"
                               class="mt-1 w-full px-4 py-2 border rounded-lg shadow-sm focus:ring-orange-400 focus:border-orange-400">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Last Name</label>
                        <input type="text" name="last_name" value="{{ $user->last_name ?? '-' }}"
                               class="mt-1 w-full px-4 py-2 border rounded-lg shadow-sm focus:ring-orange-400 focus:border-orange-400">
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Email</label>
                            <input type="email" name="email" value="{{ $user->email ?? '-'  }}"
                                   class="mt-1 w-full px-4 py-2 border rounded-lg shadow-sm focus:ring-orange-400 focus:border-orange-400">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Phone Number</label>
                            <input type="tel" name="phone" value="{{ $user->phone_number ?? '-'  }}"
                                   class="mt-1 w-full px-4 py-2 border rounded-lg shadow-sm focus:ring-orange-400 focus:border-orange-400">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Address Section -->
            <div>
                <h3 class="text-lg font-semibold text-gray-700">Address</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-2">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">House/Building & Street</label>
                        <input type="text" name="street" value="{{ $user->location->street ?? '-' }}"
                               class="mt-1 w-full px-4 py-2 border rounded-lg shadow-sm focus:ring-orange-400 focus:border-orange-400">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Barangay</label>
                        <input type="text" name="barangay" value="{{ $user->location->barangay ?? '-' }}"
                               class="mt-1 w-full px-4 py-2 border rounded-lg shadow-sm focus:ring-orange-400 focus:border-orange-400">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">City/Municipality</label>
                        <input type="text" name="city" value="{{ $user->location->city ?? '-' }}"
                               class="mt-1 w-full px-4 py-2 border rounded-lg shadow-sm focus:ring-orange-400 focus:border-orange-400">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Province</label>
                        <input type="text" name="province" value="{{  $user->location->province ?? '-' }}"
                               class="mt-1 w-full px-4 py-2 border rounded-lg shadow-sm focus:ring-orange-400 focus:border-orange-400">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Region</label>
                        <input type="text" name="region" value="{{ $user->location->region ?? '-'  }}"
                               class="mt-1 w-full px-4 py-2 border rounded-lg shadow-sm focus:ring-orange-400 focus:border-orange-400">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Landmark</label>
                        <input type="text" name="landmark" value="{{ $user->location->landmark ?? '-'  }}"
                               class="mt-1 w-full px-4 py-2 border rounded-lg shadow-sm focus:ring-orange-400 focus:border-orange-400">
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
