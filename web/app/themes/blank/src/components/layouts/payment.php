<?php 
require __DIR__ . "../../../../../vendor/autoload.php";

$stripe_secret_key = "sk_test_51OjiPkEs8IUWb6zlYonAYlGr8LDQXUaCoy1FhY2xdfG11V0e9xTLbw9mCS1ldWY9ikWDNSjNxhVrdfdiifvdXDDX00homK5Gbp";
\Stripe\Stripe::setApiKey($stripe_secret_key);

$payment = new \App\StripePayment($stripe_secret_key);

$payment -> startPayment();