<?php

namespace App\Http\Livewire\Cart;

use Livewire\Component;
use Illuminate\Support\Facades\Session;

class Manage extends Component
{
    public $cart = [];

    public function mount()
    {
        $this->cart = Session::get('cart', []);
    }

    public function addToCart($productId)
    {
        $product = Product::find($productId);

        if (isset($this->cart[$productId])) {
            $this->cart[$productId]['quantity']++;
        } else {
            $this->cart[$productId] = [
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => 1,
            ];
        }

        Session::put('cart', $this->cart);
    }

    public function removeFromCart($productId)
    {
        unset($this->cart[$productId]);
        Session::put('cart', $this->cart);
    }

    public function updateQuantity($productId, $quantity)
    {
        if ($quantity <= 0) {
            $this->removeFromCart($productId);
        } else {
            $this->cart[$productId]['quantity'] = $quantity;
            Session::put('cart', $this->cart);
        }
    }

    public function render()
    {
        $total = array_sum(array_map(fn($item) => $item['price'] * $item['quantity'], $this->cart));
        return view('livewire.cart.manage', ['total' => $total]);
    }
}
