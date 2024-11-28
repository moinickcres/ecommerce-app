<div>
    <h3>Your Cart</h3>
    <ul>
        @foreach ($cart as $productId => $item)
            <li>
                {{ $item['name'] }} - ${{ $item['price'] }}
                <input type="number" wire:change="updateQuantity({{ $productId }}, $event.target.value)" value="{{ $item['quantity'] }}" />
                <button wire:click="removeFromCart({{ $productId }})">Remove</button>
            </li>
        @endforeach
    </ul>
    <h4>Total: ${{ $total }}</h4>
</div>


<form method="POST" action="{{ route('logout') }}">
    @csrf
    <button type="submit">Logout</button>
</form>
