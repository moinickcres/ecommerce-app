<div>
    <h3>Payment</h3>
    <form wire:submit.prevent="processPayment">
        <input type="text" wire:model="name" placeholder="Name" />
        @error('name') <span>{{ $message }}</span> @enderror

        <input type="email" wire:model="email" placeholder="Email" />
        @error('email') <span>{{ $message }}</span> @enderror

        <input type="text" wire:model="cardNumber" placeholder="Card Number" />
        @error('cardNumber') <span>{{ $message }}</span> @enderror

        <input type="text" wire:model="expiryMonth" placeholder="MM" />
        <input type="text" wire:model="expiryYear" placeholder="YY" />
        @error('expiryMonth') <span>{{ $message }}</span> @enderror
        @error('expiryYear') <span>{{ $message }}</span> @enderror

        <input type="text" wire:model="cvc" placeholder="CVC" />
        @error('cvc') <span>{{ $message }}</span> @enderror

        <button type="submit">Pay ${{ $total }}</button>
    </form>
    @if (session()->has('success'))
        <p>{{ session('success') }}</p>
    @endif
</div>
