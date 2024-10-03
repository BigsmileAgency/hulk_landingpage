<?php

namespace App;

use Stripe\Stripe;
use Exception;

function create_customer_trial()
{

  wp_send_json_success(['message' => "Success"]);

  // $stripe_secret_key = getenv('STRIPE_KEY');
  // Stripe::setApiKey($stripe_secret_key);

  // $paymentMethodId = sanitize_text_field($_POST['paymentMethod']);
  // $firstname = sanitize_text_field($_POST['firstname']);
  // $lastname = sanitize_text_field($_POST['lastname']);
  // $email = sanitize_email($_POST['email']);
  // $address = sanitize_text_field($_POST['address']);
  // $zip = sanitize_text_field($_POST['zip']);
  // $tel = sanitize_text_field($_POST['tel']);
  // $company = sanitize_text_field($_POST['company']);
  // $tva = sanitize_text_field($_POST['tva']);
  // $selectedBilling = sanitize_text_field($_POST['selectedBilling']);
  // $selectedPlanAndPrice = sanitize_text_field($_POST['selectedPlan']);
  // $selectedPlanAndPrice = explode(' ', $selectedPlanAndPrice);
  // $selectedPlan = $selectedBilling . " " . $selectedPlanAndPrice[0];

  // $priceMapping = [
  //   "yearly large" => "price_1Q5Rdm2KTIC8Xb8EDBPwEJsb",
  //   "yearly medium" => "price_1Q5RdR2KTIC8Xb8EfFk21K1c",
  //   "yearly small" => "price_1Q5Rd72KTIC8Xb8EzQn8EcPy",
  //   "monthly large" => "price_1Q5Rcn2KTIC8Xb8EJGv7x1GS",
  //   "monthly medium" => "price_1Q5RcV2KTIC8Xb8EbxThxXhO",
  //   "monthly small" => "price_1Q5Rc82KTIC8Xb8EBoqvsLeJ"
  // ];

  // $price = isset($priceMapping[$selectedPlan]) ? $priceMapping[$selectedPlan] : "error";
  // $user_id = uniqid();

  // insert();
  // wp_send_json_success(['message' => "Success"]);

  // try {
  //   $customer = \Stripe\Customer::create([
  //     'email' => $email,
  //     'payment_method' => $paymentMethodId,      
  //     'invoice_settings' => [
  //       'default_payment_method' => $paymentMethodId, 
  //     ],
  //     'metadata' => [
  //       'firstname' => $firstname,
  //       'lastname' => $lastname,
  //       'company' => $company,
  //       'tel' => $tel,
  //       'tva' => $tva,
  //       'plan' => $selectedPlan,
  //       'user_id' => $user_id,
  //     ],
  //   ]);

  //   $subscription = \Stripe\Subscription::create([
  //     'customer' => $customer->id,
  //     'items' => [['price' => $price]],
  //     'expand' => ['latest_invoice.payment_intent'],
  //   ]);

  //   if ($subscription->status === 'active') {
  //     insert();
  //     wp_send_json_success(['message' => "Success"]);
  //   } else {
  //     wp_send_json_error(['message' => "Erreur lors de la création de l'abonnement."]);
  //   }
  // } catch (Exception $e) {
  //   wp_send_json_error(['message' => $e->getMessage()]);
  // }  
  
}

// function insert(){
//   echo "insert";
// }

add_action('wp_ajax_nopriv_create_customer_trial', 'App\create_customer_trial');
add_action('wp_ajax_create_customer_trial', 'App\create_customer_trial');
