<div class="min-h-screen bg-gradient-to-br from-yellow-50 to-indigo-100 py-8">
    <div class="container mx-auto px-4">
        <h2 class="text-4xl font-extrabold text-gray-800 mb-6 text-center">
            Checkout
        </h2>

        <div class="bg-white shadow-lg rounded-lg p-6 max-w-3xl mx-auto">
            <form wire:submit.prevent="placeOrder" class="space-y-4">
                

                <h4 class="text-lg font-semibold text-gray-700">Order Summary</h4>
                <ul class="divide-y divide-gray-200">
                    @foreach ($cart as $item)
                        <li class="flex justify-between py-2">
                            <span>{{ $item['name'] }}</span>
                            <span>${{ $item['price'] }} x {{ $item['quantity'] }}</span>
                        </li>
                    @endforeach
                </ul>

                <h4 class="text-lg font-bold text-gray-900 mt-4">Total: ${{ array_sum(array_map(fn($item) => $item['price'] * $item['quantity'], $cart)) }}</h4>

                <button
                    type="submit"
                    class="w-full py-2 bg-indigo-600 text-white font-semibold rounded-lg hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-400"
                >
                    Place Order
                </button>
            </form>
        </div>
    </div>
</div>
