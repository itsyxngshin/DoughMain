@extends('components.layouts.navbar')

@section('content')
<div class="h-screen flex pt-20 justify-center overflow-hidden bg-gray-50">
<div class="scrollable-container mt-3 bg-white shadow-lg rounded p-8 w-full max-w-4xl mb-10 max-h-screen overflow-y-auto">
        <!-- Title -->
        <h2 class="text-3xl font-bold text-gray-800">Profile</h2>
        <p class="text-gray-600 mb-4">Manage your account</p>
        <hr class="mb-6">

        <!-- Profile Form -->
        <form id="profile-form" method="POST" action="{{ route('profile.update') }}" class="space-y-6">
            @csrf
            @method('PUT')

            <div class="flex flex-col sm:flex-row items-center space-y-6 sm:space-y-0 sm:space-x-6">
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
                <h3 class="text-lg font-semibold text-gray-700">Address (saved for delivery)</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-2">
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

            <!-- Change Password Section -->
            <div>
                <h3 class="text-lg font-semibold text-gray-700">Change Password</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-2">
                    <div class="relative">
                        <label class="block text-sm font-medium text-gray-700">Current Password</label>
                        <input type="password" name="current_password" id="current_password"
                               class="mt-1 w-full px-4 py-2 border rounded-lg shadow-sm focus:ring-orange-400 focus:border-orange-400">
                        <button type="button" onclick="togglePassword('current_password')" class="absolute top-9 right-3 text-gray-500">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M12 9a3 3 0 0 0-3 3a3 3 0 0 0 3 3a3 3 0 0 0 3-3a3 3 0 0 0-3-3m0 8a5 5 0 0 1-5-5a5 5 0 0 1 5-5a5 5 0 0 1 5 5a5 5 0 0 1-5 5m0-12.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5"/></svg>
                        </button>
                    </div>
                    <div class="relative">
                        <label class="block text-sm font-medium text-gray-700">New Password</label>
                        <input type="password" name="new_password" id="new_password"
                               class="mt-1 w-full px-4 py-2 border rounded-lg shadow-sm focus:ring-orange-400 focus:border-orange-400">
                        <button type="button" onclick="togglePassword('new_password')" class="absolute top-9 right-3 text-gray-500">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M12 9a3 3 0 0 0-3 3a3 3 0 0 0 3 3a3 3 0 0 0 3-3a3 3 0 0 0-3-3m0 8a5 5 0 0 1-5-5a5 5 0 0 1 5-5a5 5 0 0 1 5 5a5 5 0 0 1-5 5m0-12.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5"/></svg>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Save Button -->
            <div class="flex justify-end">
                <button type="submit"
                        class="px-6 py-2 bg-orange-400 text-white font-semibold rounded-lg shadow-md hover:bg-orange-500">
                    Save
                </button>
            </div>
        </form>

        <!-- Success Message -->
        @if(session('success'))
            <div class="mt-4 p-3 bg-green-100 text-green-700 rounded-lg">
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
