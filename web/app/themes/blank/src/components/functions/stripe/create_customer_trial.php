<?php

namespace App;

use Stripe\Stripe;
use Exception;

function create_customer_trial()
{
  $stripe_secret_key = getenv('STRIPE_KEY');
  Stripe::setApiKey($stripe_secret_key);

  $firstname = sanitize_text_field($_POST['firstname']);
  $lastname = sanitize_text_field($_POST['lastname']);
  $email = sanitize_email($_POST['email']);
  $address = sanitize_text_field($_POST['address']);
  $zip = sanitize_text_field($_POST['zip']);
  $tel = sanitize_text_field($_POST['tel']);
  $company = sanitize_text_field($_POST['company']);
  $tva = sanitize_text_field($_POST['tva']);

  $user_id = uniqid();

  try {
    $customer = \Stripe\Customer::create([
      'name' => $firstname . " " . $lastname,
      'email' => $email,
      'metadata' => [
        'firstname' => $firstname,
        'lastname' => $lastname,
        'company' => $company,
        'tel' => $tel,
        'tva' => $tva,
        'user_id' => $user_id,
      ],
      'address' => [
        'line1' => $address,
        'postal_code' => $zip,
      ],
    ]);

    $subscription = \Stripe\Subscription::create([
      'customer' => $customer->id,
      'trial_period_days' => 8,
      'items' => [['price' => 'price_1Q5Rcn2KTIC8Xb8EJGv7x1GS']], // basic sub is large monthly for trial
      'expand' => ['latest_invoice.payment_intent'],
    ]);

    if ($subscription->status === 'trialing') {
      wp_send_json_success(['message' => "Trial has started now"]);
    } else {
      wp_send_json_error(['message' => "Erreur lors de la création de l'abonnement."]);
    }
  } catch (Exception $e) {
    wp_send_json_error(['message' => $e->getMessage()]);
  }
}

function insert()
{
  echo "insert";
}

add_action('wp_ajax_nopriv_create_customer_trial', 'App\create_customer_trial');
add_action('wp_ajax_create_customer_trial', 'App\create_customer_trial');
