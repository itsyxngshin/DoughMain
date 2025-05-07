<div class="pt-24 px-4 min-h-screen flex justify-center bg-gray-100">
    <div class="bg-white shadow-lg rounded-lg p-8 w-full max-w-4xl mb-10">
        <h2 class="text-3xl font-bold text-gray-800">Profile</h2>
        <p class="text-gray-600 mb-4">Manage your account</p>
        <hr class="mb-6">

        <form wire:submit.prevent="save" class="space-y-6">
            <div class="flex flex-col sm:flex-row items-center space-y-6 sm:space-y-0 sm:space-x-6">
                <div class="flex flex-col items-center">
                    <div class="w-24 h-24 rounded-full bg-gray-300 flex items-center justify-center">
                        <span class="text-gray-500">Image</span>
                    </div>
                    @can('admin')
                        <button type="button" class="mt-2 px-4 py-1 bg-orange-300 text-white rounded-lg text-sm">Upload</button>
                        <p class="text-xs text-gray-500 mt-1">File size: max 1MB, JPEG, PNG</p>
                    @endcan
                </div>

                <div class="flex-1 space-y-4 w-full">
                    <div>
                    
                        <label class="block text-sm font-medium text-gray-700">First Name</label>
                        <input type="text" wire:model.defer="first_name"
                               class="mt-1 w-full px-4 py-2 border rounded-lg shadow-sm focus:ring-orange-400 focus:border-orange-400">
                        @error('first_name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Last Name</label>
                        <input type="text" wire:model="last_name"
                               class="mt-1 w-full px-4 py-2 border rounded-lg shadow-sm focus:ring-orange-400 focus:border-orange-400">
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Email</label>
                            <input type="email" wire:model="email"
                                   class="mt-1 w-full px-4 py-2 border rounded-lg shadow-sm focus:ring-orange-400 focus:border-orange-400">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Phone Number</label>
                            <input type="tel" wire:model="phone"
                                   class="mt-1 w-full px-4 py-2 border rounded-lg shadow-sm focus:ring-orange-400 focus:border-orange-400">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Address Section -->
            <div>
                <h3 class="text-lg font-semibold text-gray-700">Address</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-2">
                    <input type="text" wire:model="landmark" placeholder="Landmark"
                        class="px-4 py-2 border rounded-lg shadow-sm focus:ring-orange-400 focus:border-orange-400">
                    <input type="text" wire:model="barangay" placeholder="Barangay"
                        class="px-4 py-2 border rounded-lg shadow-sm focus:ring-orange-400 focus:border-orange-400">
                    <input type="text" wire:model="city" placeholder="City/Municipality"
                        class="px-4 py-2 border rounded-lg shadow-sm focus:ring-orange-400 focus:border-orange-400">
                    <input type="text" wire:model="province" placeholder="Province"
                        class="px-4 py-2 border rounded-lg shadow-sm focus:ring-orange-400 focus:border-orange-400">
                </div>
            </div>

            <!-- Change Password Section -->
            <div x-data="{ changePassword: false, showCurrent: false, showNew: false }">
                <!-- Toggle -->
                <label class="inline-flex items-center mt-4">
                    <input type="checkbox" x-model="changePassword" class="form-checkbox text-orange-500 rounded">
                    <span class="ml-2 text-gray-700 font-medium">Change Password</span>
                </label>
            
                <!-- Change Password Section -->
                <div x-show="changePassword" class="mt-4">
                    <h3 class="text-lg font-semibold text-gray-700">Change Password</h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-2">
                        <!-- Current Password -->
                        <div class="relative">
                            <label class="block text-sm font-medium text-gray-700">Current Password</label>
                            <input :type="showCurrent ? 'text' : 'password'" wire:model.defer="current_password"
                                class="mt-1 w-full px-4 py-2 border rounded-lg shadow-sm focus:ring-orange-400 focus:border-orange-400">
                            <button type="button" @click="showCurrent = !showCurrent"
                                class="absolute right-3 top-9 text-sm text-orange-500 focus:outline-none">
                                <span x-text="showCurrent ? 'Hide' : 'Show'"></span>
                            </button>
                            @error('current_password') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
            
                        <!-- New Password -->
                        <div class="relative">
                            <label class="block text-sm font-medium text-gray-700">New Password</label>
                            <input :type="showNew ? 'text' : 'password'" wire:model.defer="new_password"
                                class="mt-1 w-full px-4 py-2 border rounded-lg shadow-sm focus:ring-orange-400 focus:border-orange-400">
                            <button type="button" @click="showNew = !showNew"
                                class="absolute right-3 top-9 text-sm text-orange-500 focus:outline-none">
                                <span x-text="showNew ? 'Hide' : 'Show'"></span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex justify-end">
                <button type="submit"
                        class="px-6 py-2 bg-orange-400 text-white font-semibold rounded-lg shadow-md hover:bg-orange-500">
                    Save
                </button>
            </div>
        </form>

        @if (session()->has('success'))
            <div class="mt-4 p-3 bg-green-100 text-green-700 rounded-lg">
                {{ session('success') }}
            </div>
        @endif
    </div>
</div>
