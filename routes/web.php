<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Livewire\Auth\Login;
use App\Livewire\Auth\Register;
use App\Livewire\Product\Listing;
use App\Livewire\Cart\Manage;
use App\Livewire\Product\Filter;
use App\Livewire\Order\Checkout;
use App\Livewire\Order\Payment;
use App\Livewire\Product\ProductView;
use App\Check;
use Stripe\Stripe;
use Stripe\PaymentIntent;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/logout', function () {
    Auth::logout();
    session()->flush(); // Clear all session data
    return redirect('/login');
})->name('logout');

Route::get('/register', Register::class)->name('register');
Route::post('/register', [Register::class, 'register'])->name('register');

Route::get('/login', Login::class)->name('login');

Route::/*middleware(['auth'])->*/get('/manage', Manage::class)->name('manage');

Route::/*middleware(['auth'])->*/get('/listing', Listing::class)->name('listing');

Route::/*middleware(['auth'])->*/get('/checkout', Checkout::class)->name('checkout');

Route::/*middleware(['auth'])->*/get('/payment', Payment::class)->name('payment');

Route::/*middleware(['auth'])->*/post('/payment', [Payment::class, 'processPayment'])->name('payment.process');

Route::/*middleware(['auth'])->*/get('/filter', Filter::class)->name('filter');

Route::get('/product/{id}', ProductView::class)->name('product-view');

Route::get('/products', Listing::class);

Route::get('/search-results/{query}', \App\Livewire\Product\SearchResults::class)->name('search-results');

Route::get('/check', function () {
    return view('check', ['check' => session()->get('cart', [])]);
})->name('check');

//Route::middleware(['auth'])->get('/product/{id}', )->name('product');


// Routes of the return_url of Stripe

Route::post('/payment/confirmation', function (Request $request) {
    Stripe::setApiKey(env('STRIPE_SECRET'));

    // Retrieve PaymentIntent
    try {
        $paymentIntent = PaymentIntent::retrieve($request->query('payment_intent')); // Get the ID from the URL
        $status = $paymentIntent->status;

        if ($status === 'succeeded') {
            // Payment was successful. Perform post-payment actions.
            $userId = auth()->id();

            // Example: Create an order
            $order = Order::create([
                'user_id' => $userId,
                'total_price' => $paymentIntent->amount / 100, // Convert cents to dollars
                'status' => 'Completed',
            ]);

            // Clear the cart
            session()->forget('cart');

            // Redirect to a success page
            return redirect()->route('listing')->with('success', 'Payment successful! Order placed.');
        } elseif ($status === 'requires_action') {
            // Handle additional user action (if needed)
            return redirect()->route('payment.retry'); // Or a custom route
        } else {
            // Payment failed
            return redirect()->route('payment')->with('error', 'Payment failed. Please try again.');
        }
    } catch (\Exception $e) {
        // Handle errors
        return redirect()->route('payment')->with('error', 'An error occurred: ' . $e->getMessage());
    }
})->name('payment.confirmation');

Route::post('/payment/retry', function () {
    // Show retry page
    return view('payment.retry');
})->name('payment.retry');