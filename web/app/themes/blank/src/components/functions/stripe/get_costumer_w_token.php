<?php

use Stripe\Stripe;

$stripe_secret_key = getenv('STRIPE_KEY');
Stripe::setApiKey($stripe_secret_key);

$platform_dbname = getenv('PLATFORM_DB_NAME');
$platform_dbuser = getenv('PLATFORM_DB_USER');
$platform_dbpwd = getenv('PLATFORM_DB_PWD');

$token = sanitize_text_field($_GET['t']);

try {

  $dsn = "mysql:host=localhost;dbname=$platform_dbname;charset=utf8mb4";
  $pdo = new PDO($dsn, $platform_dbuser, $platform_dbpwd, [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
  ]);

  // STAGING:
  $stmt = $pdo->prepare("SELECT stripe_id FROM users WHERE token = :token");
  $stmt->execute([':token' => $token]);
  $result = $stmt->fetch();

  // TEST EN LOCAL
  // $result = true;

  if ($result) {

    // STAGING:
    $stripe_customer_id = $result['stripe_id'];

    // TEST EN LOCAL
    // $stripe_customer_id = "cus_Qxlx4IQ265dWkh";

    $customer = \Stripe\Customer::retrieve($stripe_customer_id);

    if ($customer) {
      $costumer = $customer;
    }
  } else {
    echo "<script>window.location.href='/404';</script>";
    exit;
  }
} catch (Exception $e) {
  error_log("Erreur lors de la connexion à la base de données ou récupération du client : " . $e->getMessage());
  echo "<script>window.location.href='/404';</script>";
  exit;
}
