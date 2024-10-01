<?php

namespace App;

use Stripe\Checkout\Session;
use Stripe\Stripe;
use Stripe\Customer;

class StripePayment
{

  public function __construct(private string $stripe)
  {
    Stripe::setApiKey($this->stripe);
  }

  public function startPayment()
  {

    if (!empty($_POST)) {
      $mail = sanitize_text_field($_POST['mail']);
      $billing_interval = sanitize_text_field($_POST['billing']);
      $subscription_array = explode(' ', sanitize_text_field($_POST['subscription_type']));
      // $first_name = sanitize_text_field($_POST['firstname']);
      // $last_name = sanitize_text_field($_POST['lastname']);
      // $tel = sanitize_text_field($_POST['tel']);
      // $address = sanitize_text_field($_POST['address']);
      // $zipcode = sanitize_text_field($_POST['zipcode']);
      // $company = sanitize_text_field($_POST['company']);
      // $tva = sanitize_text_field($_POST['tva']);
    }
    
    
    if (isset($mail, $billing_interval, $subscription_array)) {
      var_dump($mail, $billing_interval, $subscription_array);
      $plan = [
        'quantity' => 1,
        'price_data' => [
          'currency' => 'EUR',
          'product_data' => [
            'name' => 'FoxBanner ' . $subscription_array[0],
          ],
          'unit_amount' => $subscription_array[1],
          'recurring' => ['interval' => $billing_interval],
        ]
      ];

      // $customer = Customer::create([
      //   'name' => $company,
      //   'email' => $mail,
      //   'address' => [
      //     'line1' => $address,
      //     'postal_code' => $zipcode,
      //   ],
      //   'phone' => $tel,
      //   // 'tax_id_data' => [
      //   //     'type' => 'eu_vat',
      //   //     'value' => $tva,
      //   // ],
      // ]);
    }

    if (isset($plan)) {
      $session = Session::create([
        'mode' => 'subscription',
        'customer_email' => $mail,
        'line_items' => [
          $plan
        ],
        'tax_id_collection' => ['enabled' => true],
        'success_url' => 'http://hulk-landing.local/login?session_id={CHECKOUT_SESSION_ID}',
        'cancel_url' => 'http://hulk-landing.local/sign-up',
        'phone_number_collection' => ['enabled' => true],
        'billing_address_collection' => 'required',
        'shipping_address_collection' => [
          'allowed_countries' => ['FR', 'BE'],
        ],
      ]);
    }

    if (isset($session)) {
      // wp_send_json_success(['payment_url' => $session->url]);
?>
      <script>
        window.location.href = "<?= $session->url ?>";
      </script>
<?php
      wp_die();
    }
  }
}

function stripe_handler()
{
  $stripe_secret_key = getenv('STRIPE_KEY');
  $payment = new \App\StripePayment($stripe_secret_key);
  $payment->startPayment();
}

add_action('wp_head', 'App\stripe_handler');
