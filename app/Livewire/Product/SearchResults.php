<?php

namespace App\Livewire\Product;

use Livewire\Component;
use App\Models\Product;

class SearchResults extends Component
{
    public $query;
    public $products = [];

    public function mount($query)
    {
        $this->query = $query;
        $this->products = Product::where('name', 'LIKE', "%{$query}%")
            ->orWhere('description', 'LIKE', "%{$query}%")
            ->get();
    }

    public function render()
    {
        return view('livewire.product.search-results');
    }
}
