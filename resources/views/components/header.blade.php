<header class="bg-indigo-600 text-white">
    <div class="container mx-auto px-4 py-4 flex justify-between items-center">
        <!-- Logo -->
        <a href="/" class="text-2xl font-bold hover:text-gray-200">My Shop</a>

        <!-- Navigation Links -->
        <nav class="flex space-x-4">
            <a href="/listing" class="hover:text-gray-300">Listing</a>
            <a href="/manage" class="hover:text-gray-300">Manage</a>
            <a href="/checkout" class="hover:text-gray-300">Checkout</a>
            @auth
                @livewire('cart-summary') <!-- Include Cart Summary -->
            @endauth
            <form method="POST" action="{{ route('logout') }}" class="inline-block">
                @csrf
                <button type="submit" class="hover:text-gray-300">Logout</button>
            </form>
        </nav>
    </div>
</header>
