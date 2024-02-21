<?php

namespace App;

use Stripe\Checkout\Session;
use Stripe\Stripe;

class StripePayment 
{

    public function __construct(private string $stripe) {
        Stripe::setApiKey($this->stripe);
    }

    public function startPayment() {
        $session = Session::create([
            'line_items' => [
                [
                    'quantity' => 1,
                    'price_data' => [
                        'currency' => 'EUR',
                        'product_data' => [ 
                            'name' => 'abonnement'
                        ],
                        'unit_amount' => 10000
                    ]
                ]
            ], // Add the missing comma here
            'mode' => 'payment',
            'success_url' => 'http://hulk-landing.local/',
            'cancel_url' => 'http://hulk-landing.local/',
            'billing_address_collection' => 'required',
            'shipping_address_collection' => [
                'allowed_countries' => ['FR'],
            ],
        ]);
    }
}

?>
