<header class="bg-indigo-600 text-white">
    <div class="container mx-auto px-4 py-4 flex justify-between items-center">
        <!-- Logo -->
        <a href="/" class="text-2xl font-bold hover:text-gray-200">My Shop</a>

        <!-- Navigation Links -->
        <nav class="flex space-x-4">
            <a href="/" class="hover:text-gray-300">Home</a>
            <a href="/register" class="hover:text-gray-300">Register</a>
            <a href="/login" class="hover:text-gray-300">Login</a>
            <form method="POST" action="{{ route('logout') }}" class="inline-block">
                @csrf
                <button type="submit" class="hover:text-gray-300">Logout</button>
            </form>
        </nav>
    </div>
</header>
