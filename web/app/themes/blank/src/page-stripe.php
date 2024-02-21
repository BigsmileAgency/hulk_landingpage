<?php 
  /**
  * Template Name: Sign-up
  */
?>
<?php

namespace App;

use Stripe\Checkout\Session;
use Stripe\Stripe;

class StripePayment 
{

  public function __construct(private string $stripe) {
    Stripe::setApiKey($this->stripe);
    }

    public function startPayment() {
        $session = Session::create([
            'line_items' => [
                [
                    'quantity' => 1,
                    'price_data' => [
                        'currency' => 'EUR',
                        'product_data' => [ 
                            'name' => 'abonnement'
                        ],
                        'unit_amount' => 10000
                    ]
                ]
            ],
            'mode' => 'payment',
            'success_url' => 'http://hulk-landing.local/',
            'cancel_url' => 'http://hulk-landing.local/',
            'billing_address_collection' => 'required',
            'shipping_address_collection' => [
                'allowed_countries' => ['FR'],
            ],
        ]);

        $lien_paiement = $session->url;
        header("HTTP/1.1 303 See other");
        header("Location: " . $session ->url);
        wp_send_json_success($lien_paiement);
        wp_die();
    }
}
require __DIR__ . "/../../../../../vendor/autoload.php";

$stripe_secret_key = "sk_test_51OjiPkEs8IUWb6zlYonAYlGr8LDQXUaCoy1FhY2xdfG11V0e9xTLbw9mCS1ldWY9ikWDNSjNxhVrdfdiifvdXDDX00homK5Gbp";
\Stripe\Stripe::setApiKey($stripe_secret_key);

$payment = new \App\StripePayment($stripe_secret_key);

$payment -> startPayment();
?>

<?php get_header("signup"); ?>

<main class="default">
  <?php if (have_posts()): while (have_posts()) : the_post(); ?>

  <section class="section_login" >
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
