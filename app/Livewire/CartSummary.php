<?php

namespace App\Livewire;

use Livewire\Component;

class CartSummary extends Component
{
    public $cart = [];
    public $totalItems = 0;

    protected $listeners = ['cartUpdated' => 'updateCart'];

    public function mount()
    {
        $this->loadCart();
    }

    public function loadCart()
    {
        $this->cart = session()->get('cart', []);
        $this->totalItems = array_sum(array_column($this->cart, 'quantity'));
    }

    public function updateCart()
    {
        $this->loadCart();
    }

    public function render()
    {
        return view('livewire.cart-summary');
    }
}
