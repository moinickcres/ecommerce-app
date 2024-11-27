<?php

namespace App\Http\Livewire\Product;

use Livewire\Component;
use App\Models\Product;
use Livewire\WithPagination;

class Filter extends Component
{
    use WithPagination;

    public $categories, $selectedCategory;
    public $minPrice = 0, $maxPrice = 1000;
    public $searchTerm;

    public function mount($categories)
    {
        $this->categories = $categories;
    }

    public function updated($propertyName)
    {
        $this->resetPage(); // Reset pagination when filters change
    }

    public function render()
    {
        $products = Product::when($this->selectedCategory, function ($query) {
            $query->where('category_id', $this->selectedCategory);
        })
        ->when($this->minPrice, function ($query) {
            $query->where('price', '>=', $this->minPrice);
        })
        ->when($this->maxPrice, function ($query) {
            $query->where('price', '<=', $this->maxPrice);
        })
        ->when($this->searchTerm, function ($query) {
            $query->where('name', 'like', '%' . $this->searchTerm . '%');
        })
        ->paginate(10);

        return view('livewire.product.filter', ['products' => $products]);
    }
}
