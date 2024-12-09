<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Auth\Login;
use App\Livewire\Auth\Register;
use App\Livewire\Product\Listing;
use App\Livewire\Cart\Manage;
use App\Livewire\Product\Filter;
use App\Livewire\Order\Checkout;
use App\Livewire\Order\Payment;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/logout', function () {
    Auth::logout();
    session()->forget('cart'); // Clear the cart
    return redirect('/login');
})->name('logout');

Route::get('/register', Register::class)->name('register');
Route::post('/register', [Register::class, 'register'])->name('register');

Route::get('/login', Login::class)->name('login');

Route::/*middleware(['auth'])->*/get('/manage', Manage::class)->name('manage');

Route::/*middleware(['auth'])->*/get('/listing', Listing::class)->name('listing');

Route::/*middleware(['auth'])->*/get('/checkout', Checkout::class)->name('checkout');

Route::/*middleware(['auth'])->*/get('/payment', Payment::class)->name('payment');

Route::/*middleware(['auth'])->*/get('/filter', Filter::class)->name('filter');

Route::get('/products', Listing::class);

Route::get('/cart', function () {
    return view('cart', ['cart' => session()->get('cart', [])]);
})->name('cart');

//Route::middleware(['auth'])->get('/product/{id}', )->name('product');