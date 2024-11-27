<div>
    @if (session()->has('error'))
        <div>{{ session('error') }}</div>
    @endif

    <form wire:submit.prevent="login">
        <input type="email" wire:model="email" placeholder="Email" required>
        @error('email') <span>{{ $message }}</span> @enderror

        <input type="password" wire:model="password" placeholder="Password" required>
        @error('password') <span>{{ $message }}</span> @enderror

        <button type="submit">Login</button>
        @if (session()->has('error'))
            <span>{{ session('error') }}</span>
        @endif
    </form>
</div>
