<?php

namespace App;

use Stripe\Stripe;
use Stripe\Customer;
use Stripe\Subscription;

use Exception;
use PDO;


function confirm_customer()
{

  $price_ids = [
    'monthly' => [
      'small' => 'price_1Q5Rc82KTIC8Xb8EBoqvsLeJ',
      'medium' => 'price_1Q5RcV2KTIC8Xb8EbxThxXhO',
      'large' => 'price_1Q5Rcn2KTIC8Xb8EJGv7x1GS',
    ],
    'yearly' => [
      'small' => 'price_1Q5Rd72KTIC8Xb8EzQn8EcPy',
      'medium' => 'price_1Q5RdR2KTIC8Xb8EfFk21K1c',
      'large' => 'price_1Q5Rdm2KTIC8Xb8EDBPwEJsb',
    ],
  ];

  $stripeToken = sanitize_text_field($_POST['stripeToken']);
  $plan = sanitize_text_field($_POST['plan']);
  $billing = sanitize_text_field($_POST['billing']);
  $customer_id = sanitize_text_field($_POST['customer_id']);
  $price_id = $price_ids[$billing][$plan];
  
  try {

    $platform_dbname = getenv('PLATFORM_DB_NAME');
    $platform_dbuser = getenv('PLATFORM_DB_USER');
    $platform_dbpwd = getenv('PLATFORM_DB_PWD');

    $dsn = "mysql:host=localhost;dbname=$platform_dbname;charset=utf8mb4";
    $pdo = new PDO($dsn, $platform_dbuser, $platform_dbpwd, [
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
      PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);

    $is_trial_stmt = $pdo->prepare("SELECT `is_trial` FROM `users` WHERE id=:customer_id");
    $is_trial_stmt->execute([':customer_id' => $customer_id]);
    $is_trial = $is_trial_stmt->fetch(PDO::FETCH_ASSOC);

    // wp_send_json_success(['message' => $is_trial]);    

    if($is_trial == "1"){
      Stripe::setApiKey(getenv('STRIPE_KEY'));
      $customer = Customer::update($customer_id, [
        'source' => $stripeToken,
      ]);
      $subscriptions = Subscription::all(['customer' => $customer_id, 'limit' => 1]);
      $subscription = $subscriptions->data[0];
      $trial_end = $subscription->trial_end;
  
      Subscription::update($subscription->id, [
        'trial_end' => $trial_end,
        'items' => [
          [
            'id' => $subscription->items->data[0]->id,
            'price' => $price_id
          ],
        ],
        'proration_behavior' => 'create_prorations',
      ]);
  
      $stmt = $pdo->prepare("UPDATE users SET is_trial = :plan, updatedAt = :updatedAt WHERE stripe_id = :customer_id");
      $stmt->execute([
        ':plan' => '0', 
        ':updatedAt' => date("Y-m-d H:i:s"),
        ':customer_id' => $customer_id,
      ]);
      wp_send_json_success(['message' => 'customerIsConfirmed']);
    } else {
      wp_send_json_success(['message' => 'customerAlreadyConfirmed']);
    }
  } catch (Exception $e) {
    wp_send_json_error(['message' => $e->getMessage()]);
  }
}


add_action('wp_ajax_nopriv_confirm_customer', 'App\confirm_customer');
add_action('wp_ajax_confirm_customer', 'App\confirm_customer');
