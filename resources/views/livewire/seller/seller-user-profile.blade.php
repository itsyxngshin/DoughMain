@extends('components.layouts.navbar')

@section('content')
<div class="h-screen flex pt-20 justify-center overflow-hidden bg-gray-50">
    <div class="scrollable-container mt-3 bg-white shadow-lg rounded p-8 w-full max-w-4xl mb-10 max-h-screen overflow-y-auto">

        <!-- Title -->
        <h2 class="text-3xl font-bold text-gray-800">Shop Manager</h2>
        <p class="text-gray-600 mb-4">Manage your shop account</p>
        <hr class="mb-6">

        <!-- Profile Form -->
        <form action="{{ route('shop.update', $shop->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')


           <div class="flex flex-col sm:flex-row items-center sm:items-start space-y-6 sm:space-y-0 sm:space-x-6">
                <!-- Image Upload -->
                <div x-data="fileUpload()" class="w-1/3 mx-auto">
                    <label for="shopLogo" class="font-semibold">Upload Bakery Cover</label><br>
                    <div 
                        x-bind:class="dragging ? 'bg-gray-200' : 'bg-gray-50'"
                        class=" m-auto my-3 flex items-center justify-center rounded w-56 h-56 border-2 border-dashed border-gray-300 p-4 cursor-pointer"
                        @click="$refs.fileInput.click()"
                        @dragover.prevent="dragging = true"
                        @dragleave.prevent="dragging = false"
                        @drop.prevent="handleDrop">

                        <!-- Image Preview -->
                        <template x-if="imagePreview">
                            <div class="relative w-full h-full flex items-center justify-center">
                                <img :src="imagePreview" class="w-full h-full object-cover max-w-full max-h-full">
                                <!-- Remove Button -->
                                <button @click.stop="removeImage" class="absolute top-2 right-2 bg-transparent text-gray p-1 rounded-full">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 2048 2048">
                                        <path fill="currentColor" d="m1115 1024l690 691l-90 90l-691-690l-691 690l-90-90l690-691l-690-691l90-90l691 690l691-690l90 90z"/>
                                    </svg>
                                </button>
                            </div>
                        </template>

                        <!-- Default Upload Content -->
                        <template x-if="!imagePreview">
                            <div class=" w-full h-full flex items-center justify-center text-center">
                                @if ($shop->shopLogo && $shop->shopLogo->logo_path)
                                    <img src="{{ asset('storage/' . $shop->shopLogo->logo_path) }}"
                                        class="w-56 h-56 object-cover max-w-full max-h-full">
                                @else  
                                    <p class="mt-2 text-sm text-gray-600">
                                        Drag & drop a photo or <span class="text-blue-500">click here to upload</span>
                                    </p>
                                @endif
                            </div>
                        </template>
                    </div>

                    <!-- Hidden File Input -->
                    <input type="file" name="shop_logo" x-ref="fileInput" hidden accept="image/*" @change="previewImage" >
                </div>


                <!-- Bakery Info -->
                <div class="flex-1 space-y-4 w-full">
                    <h3 class="text-lg font-semibold text-gray-700">Bakery Profile</h3>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Bakery Name</label>
                        <input type="text" name="shop_name" value="{{ $shop->shop_name ?? '' }}"
                            class="mt-1 w-full px-4 py-2 border rounded-lg shadow-sm focus:ring-orange-400 focus:border-orange-400">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Bakery Description</label>
                        <textarea name="shop_description" rows="4" 
                            class="mt-1 w-full px-4 py-2 border rounded-lg shadow-sm focus:ring-orange-400 focus:border-orange-400 resize-none"> {{ $shop->shop_description ?? '' }}</textarea>
                    </div>
                </div>
            </div>

            <!-- Manager Info -->
            <div>
                <h3 class="text-lg font-semibold text-gray-700">Bakery Manager's Information</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-2">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">First Name</label>
                        <input type="text" name="first_name" value="{{ $shop->user->first_name ?? '' }}"
                            class="mt-1 w-full px-4 py-2 border rounded-lg shadow-sm focus:ring-orange-400 focus:border-orange-400">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Last Name</label>
                        <input type="text" name="last_name" value="{{ $shop->user->last_name ?? '' }}"
                            class="mt-1 w-full px-4 py-2 border rounded-lg shadow-sm focus:ring-orange-400 focus:border-orange-400">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Email</label>
                        <input type="email" name="email" value="{{ $shop->user->email ?? '' }}"
                            class="mt-1 w-full px-4 py-2 border rounded-lg shadow-sm focus:ring-orange-400 focus:border-orange-400">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Phone Number</label>
                        <input type="tel" name="phone_number" value="{{ $shop->user->phone_number ?? '' }}"
                            class="mt-1 w-full px-4 py-2 border rounded-lg shadow-sm focus:ring-orange-400 focus:border-orange-400">
                    </div>
                </div>
            </div>

            <!-- Bakery Payment Method Details-->
            <div class="mt-6">
                <h3 class="text-lg font-semibold text-gray-700">Bakery Payment Method Details</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-2">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Gcash Account</label>
                        <input type="text" name="gcash_account_name" placeholder="Gcash Account Name" value="{{ optional($shop->paymentDetails->where('mode_of_payment_id', 1)->first())->account_name }}" class="mt-1 w-full px-4 py-2 border rounded-lg shadow-sm focus:ring-orange-400 focus:border-orange-400">
                        <input type="text" name="gcash_account_number" placeholder="GCash Account Number" value="{{ optional($shop->paymentDetails->where('mode_of_payment_id', 1)->first())->account_number }}" class="mt-1 w-full px-4 py-2 border rounded-lg shadow-sm focus:ring-orange-400 focus:border-orange-400">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Maya Account</label>
                        <input type="text" name="maya_account_name" placeholder="Maya Account Name" value="{{ optional($shop->paymentDetails->where('mode_of_payment_id', 2)->first())->account_name }}" class="mt-1 w-full px-4 py-2 border rounded-lg shadow-sm focus:ring-orange-400 focus:border-orange-400">
                        <input type="text" name="maya_account_number" placeholder="Maya Account Number" value="{{ optional($shop->paymentDetails->where('mode_of_payment_id', 2)->first())->account_number }}" class="mt-1 w-full px-4 py-2 border rounded-lg shadow-sm focus:ring-orange-400 focus:border-orange-400">
                    </div>
            </div>

            <!-- Address -->
            <div class="mt-6">
                <h3 class="text-lg font-semibold text-gray-700">Bakery Address</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-2">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Region</label>
                        <input type="text" value="{{ $shop->location->region ?? '-' }}" name="region" class="mt-1 w-full px-4 py-2 border rounded-lg shadow-sm focus:ring-orange-400 focus:border-orange-400" id="region" >
                        
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Province</label>
                        <input type="text" name="province" value="{{$shop->location->province ?? '-'}}" class="mt-1 w-full px-4 py-2 border rounded-lg shadow-sm focus:ring-orange-400 focus:border-orange-400" id="province" >
                        
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">City/Municipality</label>
                        <input type="text" name="city" value="{{$shop->location->city ?? '-'}}" class="mt-1 w-full px-4 py-2 border rounded-lg shadow-sm focus:ring-orange-400 focus:border-orange-400" id="city" >
                            
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Barangay</label>
                        <input type="text" name="barangay" value="{{$shop->location->barangay ?? '-' }}" class="mt-1 w-full px-4 py-2 border rounded-lg shadow-sm focus:ring-orange-400 focus:border-orange-400" id="barangay" >
                       
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">House/Building/Street (optional)</label>
                        <input type="text" value="{{$shop->location->street ?? '-'}}" class="mt-1 w-full px-4 py-2 border rounded-lg shadow-sm focus:ring-orange-400 focus:border-orange-400" name="street" id="street">
                    </div>


            </div>

            <!-- Password Change -->
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

            <!-- Submit -->
            <div class="flex justify-end mt-10">
                <button type="submit"
                    class="px-6 py-2 bg-orange-400 hover:bg-orange-500 text-white font-semibold rounded-lg shadow-md transition">
                    Save Changes
                </button>
            </div>
        </form>

        <!-- Flash Message -->
        @if(session('success'))
            <div class="mt-6 p-3 bg-green-100 text-green-800 rounded-lg shadow">
                {{ session('success') }}
            </div>
        @endif
    </div>
</div>

<!-- Password Toggle Script -->
<script>
    function togglePassword(id) {
        const input = document.getElementById(id);
        input.type = input.type === 'password' ? 'text' : 'password';
    }

    function fileUpload() {
        return {
            imagePreview: null,
            dragging: false,

            previewImage(event) {
                const file = event.target.files[0];
                if (file && file.type.startsWith('image/')) {
                    const reader = new FileReader();
                    reader.onload = e => {
                        this.imagePreview = e.target.result;
                    };
                    reader.readAsDataURL(file);
                }
            },

            handleDrop(event) {
                this.dragging = false;
                const file = event.dataTransfer.files[0];
                if (file && file.type.startsWith('image/')) {
                    const reader = new FileReader();
                    reader.onload = e => {
                        this.imagePreview = e.target.result;
                    };
                    reader.readAsDataURL(file);
                }
            },

            removeImage() {
                this.imagePreview = null;
                this.$refs.fileInput.value = null;
            }
        }
    }
</script>
@endsection
