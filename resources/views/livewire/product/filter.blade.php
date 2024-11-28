<div>
    <div class="filters">
        <select wire:model="selectedCategory">
            <option value="">All Categories</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>

        <input type="number" wire:model="minPrice" placeholder="Min Price" />
        <input type="number" wire:model="maxPrice" placeholder="Max Price" />
        <input type="text" wire:model="searchTerm" placeholder="Search..." />
    </div>

    <ul class="product-list">
        @foreach ($products as $product)
            <li>
                {{ $product->name }} - ${{ $product->price }}
            </li>
        @endforeach
    </ul>

    {{ $products->links() }} <!-- Pagination links -->
</div>
