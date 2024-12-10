<?php

namespace App\Livewire\Order;

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
        /*$this->validate([
            'name' => 'required',
            'email' => 'required|email',
            'address' => 'required',
        ]);*/

        $total = array_sum(array_map(fn($item) => $item['price'] * $item['quantity'], $this->cart));

        session()->put('total', $total);

        /*Order::create([
            'name' => $this->name,
            'email' => $this->email,
            'address' => $this->address,
            'items' => json_encode($this->cart),
            'total' => $total,
        ]);*/
        
        return redirect('/payment');
    }

    public function render()
    {
        return view('livewire.order.checkout');
    }
}
