<?php

namespace App\Livewire\Order;

use Illuminate\Support\Facades\Log;

use Illuminate\Http\Request; // Add this line
use Livewire\Component;
use App\Models\Order;
use Stripe\Stripe;
use Stripe\Charge;
use Stripe\PaymentIntent;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class Payment extends Component
{
    public $cart, $total, $name, $email;

    public function mount()
    {
    }

    public function processPayment(Request $request)
    {
        $this->total = Session::get('total');

        $request->validate([
            'payment_method_id' => 'required',
            'name' => 'required',
            'email' => 'required|email',
        ]);

        Stripe::setApiKey(env('STRIPE_SECRET'));

        DB::beginTransaction();
        try {
            // Create PaymentIntent
            $paymentIntent = PaymentIntent::create([
                'amount' => $this->total * 100, // Amount in cents
                'currency' => 'usd',
                'payment_method' => $request->payment_method_id,
                'confirmation_method' => 'manual',
                'confirm' => true,
                'return_url' => route('payment.confirmation'),
            ]);

            if ($paymentIntent->status === 'requires_action') {
                return response()->json([
                    'redirect_url' => route('payment.confirmation', [
                        'payment_intent' => $paymentIntent->id,
                    ]),
                ]);
            }

            // Save order to the database
            Order::create([
                'user_id' => auth()->id(),
                'name' => $request->name,
                'email' => $request->email,
                'total_price' => $this->total,
                'status' => 'Completed',
            ]);

            DB::commit();
            session()->forget('cart');

            return redirect()->route('listing')->with('success', 'Payment successful!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('payment')->with('error', 'Payment failed: ' . $e->getMessage());

        }
    }


    public function render()
    {
        return view('livewire.order.payment');
    }
}
