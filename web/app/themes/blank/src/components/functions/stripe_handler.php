<?php

namespace App;

use Stripe\Stripe;
use Exception;

function stripe_handler()
{
  $stripe_secret_key = getenv('STRIPE_KEY');
  Stripe::setApiKey($stripe_secret_key);

  $paymentMethodId = sanitize_text_field($_POST['paymentMethod']);
  $firstname = sanitize_text_field($_POST['firstname']);
  $lastname = sanitize_text_field($_POST['lastname']);
  $email = sanitize_email($_POST['email']);
  $address = sanitize_text_field($_POST['address']);
  $zip = sanitize_text_field($_POST['zip']);
  $tel = sanitize_text_field($_POST['tel']);
  $company = sanitize_text_field($_POST['company']);
  $tva = sanitize_text_field($_POST['tva']);
  $selectedBilling = sanitize_text_field($_POST['selectedBilling']);
  $selectedPlan = sanitize_text_field($_POST['selectedPlan']);
  $selectedPlan = explode(' ', $selectedPlan);

  try {
    // Créer un client dans Stripe
    $customer = \Stripe\Customer::create([
      'email' => $email,
      'payment_method' => $paymentMethodId,
      'metadata' => [
        'user_id' => "123456789",
        'firstname' => $firstname,
        'lastname' => $lastname,
        'company' => $company,
        'tel' => $tel,
        'tva' => $tva,
        'plan' => $selectedBilling . " " . $selectedPlan[0],
      ],
    ]);

    // Créer un abonnement
    $subscription = \Stripe\Checkout\Session::create([
      'customer' => $customer->id,      
      'line_items' => [
        [
          'price' => $selectedPlan[1],
          'quantity' => 1
        ]
      ],
    ]);

    // Vérifiez si le paiement a réussi
    if ($subscription->status === 'active') {
      // Répondre avec un message de succès
      wp_send_json_success(['message' => 'Abonnement créé avec succès!']);
    } else {
      wp_send_json_error(['message' => 'Erreur lors de la création de l\'abonnement.']);
    }
  } catch (Exception $e) {
    // Gérer les erreurs
    wp_send_json_error(['message' => $e->getMessage()]);
  }
}

add_action('wp_ajax_nopriv_stripe_handler', 'App\stripe_handler');
add_action('wp_ajax_stripe_handler', 'App\stripe_handler');
