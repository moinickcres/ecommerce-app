<div class="min-h-screen bg-gray-100 py-8">
    <div class="container mx-auto px-4">
        <h2 class="text-3xl font-bold mb-6">Search Results for "{{ $query }}"</h2>
        <div class="bg-white shadow-md rounded-lg p-4">
            @if ($products->isEmpty())
                <p>No products found matching your query.</p>
            @else
                <ul class="divide-y divide-gray-300">
                    @foreach ($products as $product)
                        <li class="flex justify-between items-center py-4">
                            <a href="{{ route('product-view', ['id' => $product->id]) }}"
                               class="text-lg font-medium text-indigo-600 hover:underline">
                                {{ $product->name }}
                            </a>
                            <span class="text-gray-800 font-bold">${{ $product->price }}</span>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
</div>
