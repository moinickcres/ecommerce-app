<?php

namespace App\Livewire\Order;

use Livewire\Component;
use Stripe\Stripe;
use Stripe\Charge;

class Payment extends Component
{
    public $cart, $total, $name, $email, $cardNumber, $expiryMonth, $expiryYear, $cvc;

    public function mount($cart, $total)
    {
        $this->cart = $cart;
        $this->total = $total;
    }

    public function processPayment()
    {
        $this->validate([
            'name' => 'required',
            'email' => 'required|email',
            'cardNumber' => 'required',
            'expiryMonth' => 'required',
            'expiryYear' => 'required',
            'cvc' => 'required',
        ]);

        Stripe::setApiKey(env('STRIPE_SECRET'));

        $charge = Charge::create([
            'amount' => $this->total * 100, // Convert to cents
            'currency' => 'usd',
            'source' => [
                'object' => 'card',
                'number' => $this->cardNumber,
                'exp_month' => $this->expiryMonth,
                'exp_year' => $this->expiryYear,
                'cvc' => $this->cvc,
            ],
            'description' => 'E-commerce Order',
        ]);

        session()->flash('success', 'Payment Successful!');
    }

    public function render()
    {
        return view('livewire.order.payment');
    }
}
