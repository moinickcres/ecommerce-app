<?php

namespace App\Http\Livewire\Order;

use Livewire\Component;
use App\Models\Order;
use Illuminate\Support\Facades\Session;

class Checkout extends Component
{
    public $cart, $name, $email, $address;

    public function mount()
    {
        $this->cart = Session::get('cart', []);
    }

    public function placeOrder()
    {
        $this->validate([
            'name' => 'required',
            'email' => 'required|email',
            'address' => 'required',
        ]);

        Order::create([
            'name' => $this->name,
            'email' => $this->email,
            'address' => $this->address,
            'items' => json_encode($this->cart),
            'total' => array_sum(array_map(fn($item) => $item['price'] * $item['quantity'], $this->cart)),
        ]);

        Session::forget('cart');
        return redirect('/thank-you');
    }

    public function render()
    {
        return view('livewire.order.checkout');
    }
}
