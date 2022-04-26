<?php

namespace App\Http\Controllers;

use Stripe\Stripe;
use Stripe\PaymentIntent;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    /**
     * Payment checkout
     *
     * @param [type] $email
     * @param [type] $total
     * @return void
     */
    public function checkout( $email,$total)
    {
        \Stripe\Stripe::setApiKey('sk_test_51KqdEoSIr9RKeQr8vuac40CpDSSOrNATL0zEeZlCHd8JWeX3UMrIdBXtfT4yFdK6znQ3JBIavFJXz2VlUjjFPCaZ00G57LNMeP');

		$amount = $total;
        $amount=100*$amount;
        $amount = (int) $amount;
        $payment_intent = \Stripe\PaymentIntent::create([
			'description' => 'Stripe Test Payment',
			'amount' => $amount,
			'currency' => 'INR',
			'description' => 'Payment From '.$email,
			'payment_method_types' => ['card'],

		]);
		$intent = $payment_intent->client_secret;

		return view('checkout.credit-card',compact('intent','total'));

    }

}
