<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class SearchBar extends Component
{
    public $query = ''; // User input
    public $results = []; // Search results
    public $suggestions = [];

    public function updatedQuery()
    {
        if (strlen($this->query) > 2) {
            $this->suggestions = DB::table('products')
                ->where('name', 'LIKE', '%' . $this->query . '%')
                ->take(5)
                ->pluck('name');
        } else {
            $this->suggestions = [];
        }
    }

    public function search()
    {
        return redirect()->route('search-results', ['query' => $this->query]);
    }

    public function render()
    {
        return view('livewire.search-bar');
    }
}
