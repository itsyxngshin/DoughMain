@extends('components.layouts.seller')

@section('add product')

@section('content')


    <div class="top-0 left-0 w-full h-auto bg-white shadow-lg bg-cover bg-center bg-no-repeat items-center px-0 " >
        <div class="top-0 left-0 w-full h-[60px] bg-white border-b border-gray-200 bg-cover bg-center bg-no-repeat flex items-center px-6 rounded-t-xl">
            <h1 class="text-[#51331b] font-bold text-3xl px-6">{{ $product->shop->shop_name ?? 'N/A'}}</h1>
        </div>    

        <div class="px-8 pb-8">
            <h2 class="p-3 ml-5 text-xl font-bold text-[#51331b]">Update Product</h2>

            <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-2 ml-5 flex-col gap-20 p-3 pt-0">
                    <div>
                        <div>
                            <label for="productName" class="">Product Name</label></br>
                            <input type="text" name="product_name" value="{{ $product->product_name }}" class="border border-gray-300 mt-2 my-3 px-2 py-1 w-[100%] rounded" placeholder="e.g. Pandesal" required>
                        </div>

                        <div x-data="{ text: '{{ old('product_description', $product->product_description) }}', maxChars: 300 }">
                            <label for="ProductDes">Product Description</label><br>
                            
                            <textarea 
                                x-model="text" 
                                name="product_description"
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
                                            @if ($product->product_image)
                                                <img src="{{ asset('storage/' . $product->product_image) }}" class="w-full h-40 object-cover rounded-lg">
                                            @else
                                                <p class="mt-2 text-sm text-gray-600 text-center">Drag & drop a photo or <span class="text-blue-500">click here to upload</span></p>
                                            @endif
                                        </div>
                                    </template>
                                </div>

                                <!-- Hidden File Input -->
                                <input type="file" name="product_image" x-ref="fileInput" hidden @change="handleFileSelect" accept="image/*" @change="previewImage">
                            </div>
                    </div>
                    
                    <!-- Product Category -->
                    <div>
                        <div>
                            <label for="productCategory">Product Category</label>
                            <select name="category_id" class="border border-gray-300 mt-2 my-3 px-2 py-1 w-[100%] rounded" id="productCategory" required>
                                <option value="">Select Category</option>
                                @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>
                                    {{ $category->category_name }}
                                </option>
                                @endforeach

                            </select>

                            @if ($categories->isEmpty())
                                <p class="text-sm text-gray-500 mt-2">Loading categories...</p>
                            @endif
                        </div>

                        <!-- Status and Price -->
                        <div class="grid grid-cols-2 flex gap-5">
                            <div class="flex gap-3 w-full items-center">
                                <label for="status">Status</label>
                                <select name="product_status" class="border border-gray-300 mt-2 my-3 ml-2 px-2 py-1 w-[100%] rounded" id="productStatus">
                                    <option value="available" {{ $product->product_status == 'available' ? 'selected' : '' }}>Available</option>
                                    <option value="unavailable" {{ $product->product_status == 'unavailable' ? 'selected' : '' }}>Unavailable</option>
                                </select>
                            </div>

                            <div class="flex gap-3 w-full items-center">
                                <label for="price">Selling Price</label>
                                <div class="relative w-full">
                                    <span class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-500">₱</span>
                                        <input type="number" name="product_price" class="border border-gray-300 mt-2 my-3 px-2 py-1 w-full pl-7 rounded text-right" value="{{ old('product_price', $product->product_price) }}" required>
                                </div>
                            </div>
                        </div>

                    
                        <!-- Stocks Section -->
                        <div class="grid grid-cols-2 gap-5">
                            <!-- Current Stock (read-only) -->
                            <div class="w-full">
                                <label class="text-gray-700 font-semibold">Current Stock</label>
                                <input 
                                    type="number" 
                                    value="{{$product->stock->quantity}}"
                                    class="border border-gray-300 mt-2 my-3 px-2 py-1 w-full rounded bg-gray-100 text-gray-700" 
                                    value="{{ $product->initial_stock }}" 
                                    readonly>
                            </div>

                            <!-- Add Stock -->
                            <div class="w-full">
                                <label for="add_stock" class="text-gray-700 font-semibold">Add Stock</label>
                                <input 
                                    type="number" 
                                    name="add_stock" 
                                    id="add_stock"
                                    class="border border-gray-300 mt-2 my-3 px-2 py-1 w-full rounded" 
                                    placeholder="e.g. 10" 
                                    min="0" >
                            </div>
                        </div>
                    </div>
                    
                </div>
                <div class="flex justify-end pr-11">
                    <button class="px-6 py-1 bg-transparent text-[#51331b] hover:underline rounded font-regular text-sm  " 
                        x-data 
                        onclick="window.location.href='{{ route('productmanagement') }}'" >Discard</button>
                    <button  class="px-6 py-1 bg-[#51331b] text-white hover:bg-white border border-[#51331b] hover:text-[#51331b] rounded font-regular text-sm">Save</button>
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