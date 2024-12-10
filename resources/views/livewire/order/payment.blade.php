<div class="min-h-screen bg-gradient-to-br from-red-50 to-indigo-100 py-8">
    <div class="container mx-auto px-4">
        <h2 class="text-4xl font-extrabold text-gray-800 mb-6 text-center">
            Payment
        </h2>

        <div class="bg-white shadow-lg rounded-lg p-6 max-w-3xl mx-auto">
            <form id="payment-form" method="POST" action="{{ route('payment.process') }}" class="space-y-4">
                @csrf <!-- Include CSRF token -->

                <div>
                    <label for="name" class="block text-gray-700">Name</label>
                    <input
                        type="text"
                        id="name"
                        name="name"
                        class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                    />
                    <p id="name-error" class="text-red-500 text-sm"></p>
                </div>

                <div>
                    <label for="email" class="block text-gray-700">Email</label>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                    />
                    <p id="email-error" class="text-red-500 text-sm"></p>
                </div>

                <div>
                    <label for="card-element" class="block text-gray-700">Card Details</label>
                    <div id="card-element" class="p-4 border rounded shadow-sm"></div>
                    <p id="card-errors" class="text-red-500 text-sm mt-2"></p>
                </div>

                <!-- Hidden field to store the payment method ID -->
                <input type="hidden" id="payment-method-id" name="payment_method_id" />

                <button
                    id="submit-button"
                    type="button"
                    class="w-full py-2 mt-4 bg-indigo-600 text-white font-semibold rounded-lg hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-400"
                >
                    Pay ${{ $total }}
                </button>
            </form>
        </div>
    </div>
</div>

<script src="https://js.stripe.com/v3/"></script>
<script>
    const stripe = Stripe('{{ env('STRIPE_KEY') }}');
    const elements = stripe.elements();
    const card = elements.create('card');
    card.mount('#card-element');

    const submitButton = document.getElementById('submit-button');

    submitButton.addEventListener('click', async () => {
        // Validate Name and Email
        const name = document.getElementById('name').value.trim();
        const email = document.getElementById('email').value.trim();
        let hasError = false;

        if (!name) {
            document.getElementById('name-error').textContent = 'Name is required.';
            hasError = true;
        } else {
            document.getElementById('name-error').textContent = '';
        }

        if (!email) {
            document.getElementById('email-error').textContent = 'Email is required.';
            hasError = true;
        } else {
            document.getElementById('email-error').textContent = '';
        }

        if (hasError) {
            return;
        }

        // Create Payment Method
        const { paymentMethod, error } = await stripe.createPaymentMethod({
            type: 'card',
            card: card,
            billing_details: { name, email },
        });

        if (error) {
            document.getElementById('card-errors').textContent = error.message;
        } else {
            // Set payment method ID in the hidden input field
            document.getElementById('payment-method-id').value = paymentMethod.id;

            // Submit the form
            document.getElementById('payment-form').submit();
        }
    });
</script>
