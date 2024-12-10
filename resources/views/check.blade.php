<x-layouts.app title="Your Cart">
    <div class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100 py-8">
        <div class="container mx-auto px-4">
            <h2 class="text-4xl font-extrabold text-gray-800 mb-6 text-center">
                Your Cart
            </h2>

            <div class="bg-white shadow-lg rounded-lg p-6 max-w-5xl mx-auto">
                @if(session()->has('cart') && count(session()->get('cart')) > 0)
                    <ul class="divide-y divide-gray-200">
                        @foreach(session()->get('cart') as $item)
                            <li class="flex items-center justify-between py-4">
                                <div>
                                    <p class="text-lg font-medium text-gray-900">{{ $item['name'] }}</p>
                                    <p class="text-sm text-gray-600">Quantity: {{ $item['quantity'] }}</p>
                                </div>
                                <div class="flex items-center space-x-4">
                                    <span class="text-lg font-bold text-indigo-700">${{ $item['price'] }}</span>
                                    
                                </div>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-gray-600 text-center">Your cart is empty.</p>
                @endif
            </div>
        </div>
    </div>
</x-layouts.app>
