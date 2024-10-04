<?php

namespace App;

use Stripe\Stripe;
use Exception;
use PDO;

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
  $pwd = password_hash(sanitize_text_field($_POST['pwd']), PASSWORD_BCRYPT);
  
  $user_id = uniqid();
  
  $insert = insert_customer_to_platform($user_id, $firstname, $lastname, $company, $email, $pwd);
  wp_send_json_success([
    'message' => "Trial has started now",
    'insert' => $insert['message']
  ]);

  // try {
  //   $customer = \Stripe\Customer::create([
  //     'name' => $firstname . " " . $lastname,
  //     'email' => $email,
  //     'metadata' => [
  //       'firstname' => $firstname,
  //       'lastname' => $lastname,
  //       'company' => $company,
  //       'tel' => $tel,
  //       'tva' => $tva,
  //       'user_id' => $user_id,
  //     ],
  //     'address' => [
  //       'line1' => $address,
  //       'postal_code' => $zip,
  //     ],
  //   ]);

  //   $subscription = \Stripe\Subscription::create([
  //     'customer' => $customer->id,
  //     'trial_period_days' => 8,
  //     'items' => [['price' => 'price_1Q5Rcn2KTIC8Xb8EJGv7x1GS']], // basic sub is large monthly for trial
  //     'expand' => ['latest_invoice.payment_intent'],
  //   ]);

  //   if ($subscription->status === 'trialing') {

  //     $insert = insert_customer_to_platform($user_id, $firstname, $lastname, $company, $email, $pwd);
  //     wp_send_json_success([
  //       'message' => "Trial has started now",
  //       'insert' => $insert['message']
  //     ]);
  //   } else {

  //     wp_send_json_error(['message' => "Erreur lors de la création de l'abonnement."]);
  //   }
  // } catch (Exception $e) {

  //   wp_send_json_error(['message' => $e->getMessage()]);
  // }
}

function insert_customer_to_platform($user_id, $firstname, $lastname, $company, $email, $pwd)
{
  $dbname = getenv('PLATFORM_DB_NAME');
  $dbuser = getenv('PLATFORM_DB_USER');
  $dbpwd = getenv('PLATFORM_DB_PWD');

  try {
    $dsn = "mysql:host=localhost;dbname=$dbname;charset=utf8mb4";
    $pdo = new PDO($dsn, $dbuser, $dbpwd, [
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
      PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);

    // $stmt = $pdo->prepare(
    //   "INSERT INTO users (user_id, firstname, lastname, company, email, password, isAdmin, ownerID) 
    //   VALUES (:user_id, :firstname, :lastname,  :company, :email, :password, :isAdmin, :ownerID)"
    // );

    // $stmt->execute([
    //   ':user_id' => $user_id,
    //   ':firstname' => $firstname,
    //   ':lastname' => $lastname,
    //   ':company' => $company,
    //   ':email' => $email,
    //   ':password' => $pwd,
    //   ':isAdmin' => '0',
    //   ':ownerID' => '0',
    // ]);

    return ['success' => true, 'message' => 'Insertion dans la plateforme réussie.'];
  } catch (Exception $e) {
    return ['success' => false, 'message' => $e->getMessage()];
  } finally {
    $pdo = null;
  }
}

add_action('wp_ajax_nopriv_create_customer_trial', 'App\create_customer_trial');
add_action('wp_ajax_create_customer_trial', 'App\create_customer_trial');
