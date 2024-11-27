<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Auth\Login;
use App\Livewire\Auth\Register;
use App\Http\Livewire\Product\Listing;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/logout', function () {
    Auth::logout();
    return redirect('/');
})->name('logout');

Route::get('/register', Register::class)->name('register');

Route::get('/login', Login::class)->name('login');

Route::middleware(['auth'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/listing', Listing::class)->name('listing');

Route::post('/test-register', function () {
    $name = 'Test User';
    $email = 'test@example.com';
    $password = Hash::make('password123');

    $user = App\Models\User::create([
        'name' => $name,
        'email' => $email,
        'password' => $password,
    ]);

    auth()->login($user);

    return 'User registered and logged in successfully.';
});