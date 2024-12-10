<?php

namespace App\Livewire\Product;

use Livewire\Component;
use App\Models\Product;

class Listing extends Component
{
    public $category, $products;

    public function mount($category = null)
    {
        // Load products from the database
        $this->category = $category;
        $this->products = Product::with('category') // Eager load the category
            ->when($category, function ($query) {
                $query->where('category_id', $category);
            })->get();
        //$this->products = \App\Models\Product::all();
    }

    public function render()
    {
        return view('livewire.product.listing');
    }

    public function addToCart($productId)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$productId])) {
            $cart[$productId]['quantity']++;
        } else {
            $product = \App\Models\Product::find($productId);
            $cart[$productId] = [
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => 1,
            ];
        }

        session()->put('cart', $cart);
        
        // Emit an event for real-time cart updates
        $this->dispatch('cartUpdated');
    }
}
