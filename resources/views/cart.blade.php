<div class="container mx-auto py-8">
    <h2 class="text-2xl font-bold mb-4">Your Cart</h2>
    <div class="bg-white shadow-md rounded-lg p-4">
        @if(count($cart) > 0)
            <ul>
                @foreach ($cart as $item)
                    <li class="flex justify-between items-center border-b border-gray-200 py-2">
                        <span>{{ $item['name'] }}</span>
                        <div>
                            <span class="text-gray-800 font-bold">${{ $item['price'] }}</span>
                            <span class="ml-4">Qty: {{ $item['quantity'] }}</span>
                        </div>
                    </li>
                @endforeach
            </ul>
        @else
            <p>Your cart is empty.</p>
        @endif
    </div>
</div>