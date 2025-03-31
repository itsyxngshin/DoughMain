@extends('layouts.seller')

@section('add product')

@section('content')


    <div class="top-0 left-0 w-full h-auto bg-white shadow-lg bg-cover bg-center bg-no-repeat items-center px-0 " >
        <div class="top-0 left-0 w-full h-[60px] bg-white border-b border-gray-200 bg-cover bg-center bg-no-repeat flex items-center px-6 rounded-t-xl">
            <h1 class="text-[#51331b] font-bold text-3xl px-6">[bakery Name]</h1>
        </div>    

        <div class="px-8 pb-8">
            <h2 class="p-3 ml-5 text-xl font-bold text-[#51331b]">Update Product</h2>

            <form action="">
                <div class="grid grid-cols-2 ml-5 flex-col gap-20 p-3 pt-0">
                    <div>
                        <div>
                            <label for="productName" class="">Product Name</label></br>
                            <input type="text" class="border border-gray-300 mt-2 my-3 px-2 py-1 w-[100%] rounded" placeholder="e.g. Pandesal" required>
                        </div>

                        <div x-data="{ text: '', maxChars: 300 }">
                            <label for="ProductDes">Product Description</label><br>
                            
                            <textarea 
                                x-model="text" 
                                @input="if (text.length > maxChars) text = text.substring(0, maxChars)" 
                                class="border border-gray-300 mt-2 my-0 px-2 py-1 w-full h-[100px] rounded resize-none" 
                                placeholder="Enter product description..." 
                                required>
                            </textarea>
                            
                            <p class="text-sm text-gray-500 text-right">
                                <span x-text="text.length"></span> / 300 characters
                            </p>
                        </div>

                        <div x-data="fileUpload" class="w-full">
                            <label for="productImage">Product Image</label></br>
                                <!-- Upload Image Box -->
                                <div 
                                    x-bind:class="dragging ? 'bg-gray-200' : 'bg-gray-50'"
                                    class="relative mt-2 my-3  flex items-center justify-center w-full border-2 border-dashed border-gray-300 rounded-lg p-4 cursor-pointer"
                                    @click="$refs.fileInput.click()"
                                    @dragover.prevent="dragging = true"
                                    @dragleave.prevent="dragging = false"
                                    @drop.prevent="handleDrop">
                                    
                                    <!-- Image Preview -->
                                    <template x-if="imagePreview">
                                        <div class="relative w-full h-40 flex items-center justify-center">
                                            <img :src="imagePreview" class="w-full h-full object-cover rounded-lg">
                                            <!-- Remove Button -->
                                            <button @click.stop="removeImage" class="absolute top-2 right-2 bg-transparent text-gray p-1 rounded-full">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 2048 2048"><path fill="currentColor" d="m1115 1024l690 691l-90 90l-691-690l-691 690l-90-90l690-691l-690-691l90-90l691 690l691-690l90 90z"/></svg>
                                            </button>
                                        </div>
                                    </template>

                                    <!-- Default Upload Content (Shown if No Image) -->
                                    <template x-if="!imagePreview">
                                        <div class="flex flex-col items-center">
                                            <p class="mt-2 text-sm text-gray-600 text-center">
                                                Drag & drop a photo or <span class="text-blue-500">click here to upload</span>
                                            </p>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" class="text-gray-500">
                                                <path fill="currentColor" d="M13 19c0 .7.13 1.37.35 2H5a2 2 0 0 1-2-2V5c0-1.1.9-2 2-2h14a2 2 0 0 1 2 2v8.35c-.63-.22-1.3-.35-2-.35V5H5v14zm.96-6.71l-2.75 3.54l-1.96-2.36L6.5 17h6.85c.4-1.12 1.12-2.09 2.05-2.79zM20 18v-3h-2v3h-3v2h3v3h2v-3h3v-2z"/>
                                            </svg>
                                        </div>
                                    </template>
                                </div>

                                <!-- Hidden File Input -->
                                <input type="file" x-ref="fileInput" hidden @change="handleFileSelect" accept="image/*">
                            </div>
                    </div>
                    
                    <div>
                        <div>
                            <label for="productName">Product Category</label>
                            <select name="category" class="border border-gray-300 mt-2 my-3 px-2 py-1 w-[100%] rounded" id="productCategory">
                                <option value="" disabled selected>Select category</option>
                                <option value="1">Bread</option>
                                <option value="2">Pastries</option>
                                <option value="3">Cake</option>
                            </select>

                        </div>

                        <div class="grid grid-cols-2 flex gap-5">
                            <div class="flex gap-3 w-full items-center">
                                <label for="status">Status</label>
                                <select name="status" class="border border-gray-300 mt-2 my-3 ml-2 px-2 py-1 w-[100%] rounded" id="productStatus">
                                    <option value="1">Available</option>
                                    <option value="2">Not Available</option>
                                </select>

                            </div>
                            <div class="flex gap-3 w-full items-center">

                                <label for="visibility">Visibility</label>
                                <select name="visibility" class="border border-gray-300 mt-2 my-3 px-2 py-1 w-[100%] rounded" id="visibilityStatus">
                                    <option value="1">On</option>
                                    <option value="2">Off</option>
                                </select>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 flex gap-5">
                            <div x-data="priceInput" class="flex gap-3 w-full items-center">
                                <label for="price">Selling Price</label>

                                <div class="relative w-full">
                                    <!-- Peso Symbol -->
                                    <span class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-500">₱</span>

                                    <!-- Input Field -->
                                    <input 
                                        type="text" 
                                        x-model="formattedPrice" 
                                        @input="formatPrice"
                                        class="border border-gray-300 mt-2 my-3 px-2 py-1 w-full pl-7 rounded text-right"
                                        placeholder="0.00" 
                                        required>
                                </div>
                            </div>
                            <div class="flex gap-3 w-full items-center">
                                <label for="quantity">Quantity</label>
                                <input type="number" class="border border-gray-300 mt-2 my-3 px-2 py-1 w-[100%] rounded" min="1" value="1">
                            </div>
                        </div>
                    </div>
                    
                </div>
                <div class="flex justify-end pr-11">
                    <button class="px-6 py-1 bg-transparent text-[#51331b] hover:underline rounded font-regular text-sm  " 
                        x-data 
                        @click="window.location.href='{{ route('productmanagement') }}'" >Discard</button>
                    <button class="px-6 py-1 bg-[#51331b] text-white hover:bg-white border border-[#51331b] hover:text-[#51331b] rounded font-regular text-sm">Create</button>
                </div>
                
            </form>
            
            
        </div>

    </div>
   

    <script>

        //UPLOAD PHOTO SCRIPT
        document.addEventListener("alpine:init", () => {
            Alpine.data("fileUpload", () => ({
                dragging: false,
                imagePreview: null,

                handleFileSelect(event) {
                    const file = event.target.files[0];
                    this.previewImage(file);
                },

                handleDrop(event) {
                    this.dragging = false;
                    const file = event.dataTransfer.files[0];
                    this.previewImage(file);
                },

                previewImage(file) {
                    if (!file || !file.type.startsWith("image/")) return;
                    const reader = new FileReader();
                    reader.onload = (e) => this.imagePreview = e.target.result;
                    reader.readAsDataURL(file);
                },

                removeImage() {
                    this.imagePreview = null;
                    this.$refs.fileInput.value = ""; // Clear file input
                }
            }));
        });



</script>

@endsection