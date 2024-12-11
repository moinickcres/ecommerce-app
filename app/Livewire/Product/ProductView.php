<?php

namespace App\Livewire\Product;

use Livewire\Component;
use App\Models\Product;

class ProductView extends Component
{
    public $product;
    public $quantity = 1;

    public function mount($id)
    {
        $this->product = Product::findOrFail($id);
    }

    public function addToCart()
    {
        $cart = session()->get('cart', []);
        $cart[$this->product->id] = [
            'name' => $this->product->name,
            'price' => $this->product->price,
            'quantity' => ($cart[$this->product->id]['quantity'] ?? 0) + $this->quantity,
        ];
        session()->put('cart', $cart);

        $this->dispatch('cartUpdated');
    }

    public function render()
    {
        return view('livewire.product.product-view');
    }
}
