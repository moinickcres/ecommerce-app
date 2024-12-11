<div class="container mx-auto py-8">
    <h2 class="text-3xl font-bold mb-4">{{ $product->name }}</h2>
    <div class="bg-white shadow-md rounded-lg p-4">
        <p class="text-gray-600 mb-4">{{ $product->description }}</p>
        <span class="text-lg font-bold text-indigo-700">${{ $product->price }}</span>
        <div class="mt-4">
            <button
                wire:click="addToCart"
                class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700"
            >
                Add to Cart
            </button>
        </div>
    </div>
</div>
