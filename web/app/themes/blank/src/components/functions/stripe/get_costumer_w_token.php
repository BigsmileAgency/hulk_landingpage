<?php

use Stripe\Stripe;

$stripe_secret_key = getenv('STRIPE_KEY');
Stripe::setApiKey($stripe_secret_key);

$platform_dbname = getenv('PLATFORM_DB_NAME');
$platform_dbuser = getenv('PLATFORM_DB_USER');
$platform_dbpwd = getenv('PLATFORM_DB_PWD');

$token = sanitize_text_field($_GET['t']);


try {

  // STAGING:
  // $dsn = "mysql:host=localhost;dbname=$platform_dbname;charset=utf8mb4";
  // $pdo = new PDO($dsn, $platform_dbuser, $platform_dbpwd, [
  //   PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
  //   PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
  // ]);
  
  // $stmt = $pdo->prepare("SELECT stripe_id FROM users WHERE token = :token");
  // $stmt->execute([':token' => $token]);
  // $result = $stmt->fetch();
  
  // TEST EN LOCAL
  $result = true;  
  
  if ($result) {
    
    // STAGING:
    // $stripe_customer_id = $result['stripe_id'];
    
    // TEST EN LOCAL
    $stripe_customer_id = "cus_R0HPMrI70VAUKT";
    
    $customer = \Stripe\Customer::retrieve($stripe_customer_id);
    
  } else {
    echo "<script>window.location.href='/404';</script>";
    exit;
  }
} catch (Exception $e) {
  echo $e->getMessage();
  echo "<script>window.location.href='/404';</script>";
  exit;
}
