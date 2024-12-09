<div class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100 py-8">
    <div class="container mx-auto px-4">
        <!-- Header -->
        <h2 class="text-4xl font-extrabold text-gray-800 mb-6 text-center">
            Explore Our Products
        </h2>

        <!-- Product List -->
        <div class="bg-white shadow-lg rounded-lg p-6 max-w-5xl mx-auto">
            <ul class="divide-y divide-gray-200">
                @foreach ($products as $product)
                    <li class="flex items-center justify-between py-4">
                        <!-- Product Info -->
                        <div class="flex items-center space-x-4">
                            <div class="flex-shrink-0">
                                <div class="bg-indigo-500 text-white w-12 h-12 flex items-center justify-center rounded-full">
                                    <span class="text-xl font-semibold">{{ substr($product->name, 0, 1) }}</span>
                                </div>
                            </div>
                            <div>
                                <a href="/product/{{ $product->id }}"
                                   class="text-lg font-medium text-gray-900 hover:text-indigo-600">
                                    {{ $product->name }}
                                </a>
                                <p class="text-sm text-gray-500">Category: {{ $product->category->name ?? 'Uncategorized' }}</p>
                            </div>
                        </div>

                        <!-- Product Price and Button -->
                        <div class="flex items-center space-x-4">
                            <span class="text-lg font-bold text-indigo-700">${{ $product->price }}</span>
                            <button
                                wire:click="addToCart({{ $product->id }})"
                                class="px-4 py-2 bg-indigo-600 text-white text-sm font-semibold rounded-lg hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-400"
                            >
                                Add to Cart
                            </button>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
