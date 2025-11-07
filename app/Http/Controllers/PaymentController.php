<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Checkout\Session;
use App\Models\Bill;

class PaymentController extends Controller
{
    // Show payment page
    public function create(Bill $bill)
    {
        return view('payments.create', compact('bill'));
    }

    // Process payment
    public function process(Request $request, Bill $bill)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));

        $session = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'usd',
                    'product_data' => [
                        'name' => 'Water Bill for ' . $bill->customer->name,
                    ],
                    'unit_amount' => $bill->amount * 100, // cents
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => route('payment.success') . '?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => route('payment.cancel'),
        ]);

        return redirect($session->url);
    }

    // Success page
    public function success(Request $request)
    {
        $session_id = $request->get('session_id');
        if ($session_id) {
            // Mark bill as paid
            $bill = Bill::where('id', session('bill_id'))->first();
            if ($bill) {
                $bill->paid = true;
                $bill->save();
            }
        }
        return view('payments.success');
    }

    // Cancel page
    public function cancel()
    {
        return view('payments.cancel');
    }
}
