<div>
    <h3>Checkout</h3>
    <form wire:submit.prevent="placeOrder">
        <input type="text" wire:model="name" placeholder="Name" required />
        @error('name') <span>{{ $message }}</span> @enderror

        <input type="email" wire:model="email" placeholder="Email" required />
        @error('email') <span>{{ $message }}</span> @enderror

        <input type="text" wire:model="address" placeholder="Address" required />
        @error('address') <span>{{ $message }}</span> @enderror

        <h4>Order Summary</h4>
        <ul>
            @foreach ($cart as $item)
                <li>{{ $item['name'] }} - ${{ $item['price'] }} x {{ $item['quantity'] }}</li>
            @endforeach
        </ul>

        <h4>Total: ${{ array_sum(array_map(fn($item) => $item['price'] * $item['quantity'], $cart)) }}</h4>
        <button type="submit">Place Order</button>
    </form>
</div>


<form method="POST" action="{{ route('logout') }}">
    @csrf
    <button type="submit">Logout</button>
</form>
