<div class="min-h-screen bg-gradient-to-br from-green-50 to-indigo-100 py-8">
    <div class="container mx-auto px-4">
        <h2 class="text-4xl font-extrabold text-gray-800 mb-6 text-center">
            Filter Products
        </h2>

        <div class="bg-white shadow-lg rounded-lg p-6 max-w-5xl mx-auto">
            <div class="flex space-x-4 mb-6">
                <select wire:model="selectedCategory" class="border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                    <option value="">All Categories</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>

                <input
                    type="number"
                    wire:model="minPrice"
                    placeholder="Min Price"
                    class="border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                />
                <input
                    type="number"
                    wire:model="maxPrice"
                    placeholder="Max Price"
                    class="border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                />
                <input
                    type="text"
                    wire:model="searchTerm"
                    placeholder="Search..."
                    class="border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                />
            </div>

            <ul class="divide-y divide-gray-200">
                @foreach ($products as $product)
                    <li class="flex justify-between items-center py-4">
                        <span class="text-gray-800">{{ $product->name }}</span>
                        <span class="text-indigo-700 font-bold">${{ $product->price }}</span>
                    </li>
                @endforeach
            </ul>

            <div class="mt-4">
                {{ $products->links() }} <!-- Pagination links -->
            </div>
        </div>
    </div>
</div>
