<div x-data="{ show: false }" x-effect="show = query.length > 0" class="sticky top-1 py-2 z-50 mb-4" @click.away="show = false">


    <div class="relative ml-0 w-[700px]">
        <svg class="absolute left-4 top-1/2 transform -translate-y-1/2 w-5 h-5 text-[#6E4B3B]" 
            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                d="M21 21l-4.35-4.35m2.85-5.65a7 7 0 11-14 0 7 7 0 0114 0z"/>
        </svg>
        <!-- Livewire bound input -->
        <input type="text" 
                wire:model.live="query"
                @focus="show = true"
                placeholder="Search products, categories..." 
                class="w-full p-2.5 pl-10 border border-[#ffffff] rounded-full focus:outline-none 
                      focus:ring-2 focus:ring-[#D39B6A] transition-all duration-200">
    
    <div x-show="show" 
    x-transition
    class="absolute w-full bg-white mt-2 rounded-lg shadow-lg z-50 border border-gray-200">
        @foreach($products as $product)
        <div  class="p-3 hover:bg-gray-100 cursor-pointer flex justify-between items-center">
            <a > {{ $product['product_name']}}</a>
            <div class="text-sm text-gray-500">
                {{ $product->category->category_name ?? 'No Category' }} | 
                {{ $product->shop->shop_name ?? 'No Shop' }}
            </div>
        </div>
            
        @endforeach
    </div>

</div>
    
</div>
