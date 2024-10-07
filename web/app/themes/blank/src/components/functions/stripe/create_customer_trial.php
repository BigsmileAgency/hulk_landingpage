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
      ],
      'address' => [
        'line1' => $address,
        'postal_code' => $zip,
      ],
    ]);

    $subscription = \Stripe\Subscription::create([
      'customer' => $customer->id,
      'trial_period_days' => 30,
      'items' => [['price' => 'price_1Q5Rcn2KTIC8Xb8EJGv7x1GS']], // basic sub is large monthly for trial
      'expand' => ['latest_invoice.payment_intent'],
    ]);

    if ($subscription->status === 'trialing') {

      $insert = insert_customer_to_platform($firstname, $lastname, $company, $email, $pwd, $customer->id);
      wp_send_json_success([
        'message' => "Trial has started now",
        'insert' => $insert['message']
      ]);
    } else {

      wp_send_json_error(['message' => "Erreur lors de la création de l'abonnement."]);
    }
  } catch (Exception $e) {

    wp_send_json_error(['message' => $e->getMessage()]);
  }
}

function insert_customer_to_platform($firstname, $lastname, $company, $email, $pwd, $customer_id)
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

    $stmt = $pdo->prepare(
      "INSERT INTO users (firstname, lastname, company, email, password, isAdmin stripe_id, is_trial, is_active, createdAt, updatedAt) 
      VALUES (:firstname, :lastname,  :company, :email, :password, :isAdmin, :stripe_id, :is_trial, :is_active, :createdAt, :updatedAt)"
    );

    $stmt->execute([
      ':firstname' => $firstname,
      ':lastname' => $lastname,
      ':company' => $company,
      ':email' => $email,
      ':password' => $pwd,
      ':isAdmin' => "1",
      ':stripe_id' => $customer_id, 
      ':is_trial' => "1", 
      ':is_active' => "1",
      ':createdAt' => date("Y-m-d H:i:s"), 
      ':updatedAt' => date("Y-m-d H:i:s")
    ]);

    return ['success' => true, 'message' => 'Insertion dans la plateforme réussie.'];
  } catch (Exception $e) {
    return ['success' => false, 'message' => $e->getMessage()];
  } finally {
    $pdo = null;
  }
}

add_action('wp_ajax_nopriv_create_customer_trial', 'App\create_customer_trial');
add_action('wp_ajax_create_customer_trial', 'App\create_customer_trial');
