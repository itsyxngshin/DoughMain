<div class="flex flex-col md:flex-row pt-20">

    <!-- Sidebar -->
    <aside class="w-full md:w-1/4 h-auto md:h-screen sticky top-0 bg-[#ffffff] p-8 shadow-lg rounded-xl space-y-8 border border-[#ffffff] mb-8 md:mb-0">
        <h2 class="text-2xl font-bold text-[#51331B] border-b pb-3 mb-3">Filters</h2>

        <!-- Category filter -->
        <div class="space-y-4">
            <h3 class="text-lg font-semibold text-[#4C3C2C]">Categories</h3>
            <div class="flex flex-col space-y-2 text-base text-[#6E4B3B]">
                @foreach ($categories as $category)
                    <label class="inline-flex items-center gap-3 hover:text-[#8E6A4A] cursor-pointer">
                        <input type="checkbox"
                               wire:model="selectedCategories"
                               value="{{ $category->id }}"
                               class="accent-[#D39B6A]">
                        {{ $category->category_name }}
                    </label>
                @endforeach
            </div>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="w-full md:w-3/4 p-8 ml-0 md:ml-8">
        <!-- Filtered Products -->
        <h2 class="text-2xl font-bold text-[#51331B]">Products</h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 mt-4">
            @forelse ($products as $product)
                <div class="border p-3 rounded-lg shadow hover:scale-105 transition-transform">
                    <h4 class="font-semibold text-[#4C3C2C]">{{ $product->name }}</h4>
                    <p class="text-[#6E4B3B] text-sm">{{ $product->category->category_name ?? 'Uncategorized' }}</p>
                </div>
            @empty
                <p class="text-[#6E4B3B]">No products found.</p>
            @endforelse
        </div>
    </main>
</div>
