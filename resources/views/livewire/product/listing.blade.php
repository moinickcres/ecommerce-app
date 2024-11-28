        <div class="min-h-screen flex flex-col items-center bg-gray-100 py-8">
            <h2 class="text-3xl font-bold mb-4">Products</h2>
                <div class="bg-white shadow-md rounded-lg w-full max-w-3xl p-4">
                    <ul>
                        @foreach ($products as $product)
                            <li class="flex justify-between items-center border-b border-gray-200 py-2">
                                <div>
                                    <a href="/product/{{ $product->id }}" class="text-indigo-600 hover:underline">{{ $product->name }}</a>
                                </div>
                                <span class="text-gray-800 font-bold">${{ $product->price }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>



            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit">Logout</button>
            </form>
        </div>