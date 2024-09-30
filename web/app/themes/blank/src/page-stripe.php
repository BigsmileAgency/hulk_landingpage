<?php
/**
 * Template Name: Stripe
 */
?>
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
    var_dump($_POST['subscription_type']);
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
      $subscription_choice = $_POST['subscription_type'];
      list($plan_type, $duration) = explode(' ', $subscription_choice);
      if ($plan_type === "small") {
        $plan = [
          'quantity' => 1,
          'price_data' => [
            'currency' => 'EUR',
            'product_data' => [
              'name' => 'FoxBanner Small'
            ],
            'unit_amount' => ($duration === 'month') ? 3900 : 36000,
            'recurring' => ['interval' => $duration]
          ]
        ];
      } elseif ($plan_type === "medium") {
        $plan = [
          'quantity' => 1,
          'price_data' => [
            'currency' => 'EUR',
            'product_data' => [
              'name' => 'FoxBanner Medium'
            ],
            'unit_amount' => ($duration === 'month') ? 5900 : 60000,
            'recurring' => ['interval' => $duration]
          ]
        ];
      } elseif ($plan_type === "large") {
        $plan = [
          'quantity' => 1,
          'price_data' => [
            'currency' => 'EUR',
            'product_data' => [
              'name' => 'FoxBanner Large'
            ],
            'unit_amount' => ($duration === 'month') ? 8900 : 96000,
            'recurring' => ['interval' => $duration]
          ]
        ];
      }

      // $name = $_POST['firstname'] ." " . $_POST['lastname'];
      $email = $_POST['mail'];
      // $tel = $_POST['tel'];
      // $address =$_POST['address'];
      // $postcode =$_POST['postcode'];
      // $tva =$_POST['tva'];
      // $company=$_POST['company'];
    }

    // // a continuer, pas eu le temps de finir !
    //   $customer = Customer::create([
    //     'name' => $company,
    //     'email' => $email,
    //     'address' => [
    //       'line1' => $address,
    //       'postal_code' => $postcode,
    //     ],
    //     'phone' => $tel,
    //     // 'tax_id_data' => [
    //     //     'type' => 'eu_vat',
    //     //     'value' => $tva,
    //     // ],
    //   ]);

    $session = Session::create([
      'customer_email' => $email,
      'line_items' => [
        $plan
      ],
      'tax_id_collection' => ['enabled' => true],
      'mode' => 'subscription',
      'success_url' => 'http://hulk-landing.local/',
      'cancel_url' => 'http://hulk-landing.local/',
      'phone_number_collection' => ['enabled' => true],
      'billing_address_collection' => 'required',
      'shipping_address_collection' => [
        'allowed_countries' => ['FR', 'BE'],
      ],
    ]);

    $lien_paiement = $session->url;
    header("HTTP/1.1 303 See other");
    header("Location: " . $session->url);
    wp_send_json_success($lien_paiement);
    wp_die();
  }
}

$stripe_secret_key = "sk_test_51OjiPkEs8IUWb6zlYonAYlGr8LDQXUaCoy1FhY2xdfG11V0e9xTLbw9mCS1ldWY9ikWDNSjNxhVrdfdiifvdXDDX00homK5Gbp";
Stripe::setApiKey($stripe_secret_key);

$payment = new \App\StripePayment($stripe_secret_key);

$payment->startPayment();
?>

<?php get_header("signup"); ?>

<main class="default">
  <?php if (have_posts()): while (have_posts()) : the_post(); ?>

      <section class="section_login">
        <div class="container">
          <div class="form_login">
            <a href="<?php echo get_home_url(); ?>" class="back_home"><img src="<?php echo get_template_directory_uri() ?>/images/icon_close.png" alt=""></a>
            <div class="header_login_form">
              <h1><?= get_field('title_signup') ?></h1>
            </div>
          </div>
          <a href=""></a>
        </div>
      </section>

    <?php endwhile; ?>
  <?php else: ?>
  <?php endif; ?>

</main>

<!-- <?php get_footer(); ?> -->