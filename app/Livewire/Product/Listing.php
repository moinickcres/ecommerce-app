<?php

namespace App\Livewire\Product;

use Livewire\Component;
use App\Models\Product;

class Listing extends Component
{
    public $category, $products;

    public function mount($category = null)
    {
        $this->category = $category;
        $this->products = Product::when($category, function ($query) {
            $query->where('category_id', $this->category);
        })->get();
    }

    public function render()
    {
        return view('livewire.product.listing');
    }
}
