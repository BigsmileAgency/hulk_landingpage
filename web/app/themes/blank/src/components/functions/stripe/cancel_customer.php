<?php

namespace App;

use Stripe\Stripe;
use Stripe\Subscription;

use Exception;


function cancel_customer()
{
  $customer_id = sanitize_text_field($_POST['customer_id']);

  try {

    Stripe::setApiKey(getenv('STRIPE_KEY'));

    $subscriptions = Subscription::all([
      'customer' => $customer_id,
      'limit' => 1,
    ]);

    if (count($subscriptions->data) > 0) {
      $subscription = $subscriptions->data[0];

      Subscription::update($subscription->id, [
        'cancel_at_period_end' => true,
      ]);

      wp_send_json_success(['message' => 'Subscription cancelled.']);
    } else {
      wp_send_json_error(['message' => 'No active subscription found.']);
    }
  } catch (Exception $e) {
    wp_send_json_error(['message' => $e->getMessage()]);
  }
}


add_action('wp_ajax_nopriv_cancel_customer', 'App\cancel_customer');
add_action('wp_ajax_cancel_customer', 'App\cancel_customer');
