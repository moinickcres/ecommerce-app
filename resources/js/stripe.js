import { loadStripe } from '@stripe/stripe-js';

// Initialize Stripe
const stripe = loadStripe('your-publishable-key-here');

// Elements configuration
const elements = stripe.elements();
const cardElement = elements.create('card');
cardElement.mount('#card-element'); // Mount card input field in your Blade file

// Handle form submission
document.getElementById('payment-form').addEventListener('submit', async (e) => {
    e.preventDefault();

    const { setupIntent, error } = await stripe.confirmCardSetup(
        document.getElementById('client-secret').value,
        {
            payment_method: {
                card: cardElement,
                billing_details: {
                    name: document.getElementById('name').value,
                    email: document.getElementById('email').value,
                },
            },
        }
    );

    if (error) {
        // Show error to your customer
        console.error(error.message);
        alert('Payment failed: ' + error.message);
    } else {
        // Send payment_method_id to your server
        document.getElementById('payment-method').value = setupIntent.payment_method;
        document.getElementById('payment-form').submit();
    }
});
