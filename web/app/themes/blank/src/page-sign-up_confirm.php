<?php

/**
 * Template Name: Sign-up_confirm
 */
?>

<?php

get_header();

if (!empty($_GET['t'])) {

  include_once get_template_directory() . '/components/functions/stripe/get_costumer_w_token.php';
  $customer = "no";


} else {

?>

  <script>
    window.location.href = '/404';
  </script>

<?php
}


if (isset($costumer)):

?>

  <script src="https://js.stripe.com/v3/"></script>


  <main class="login_body">
    <section class="section_login">
      <div class="container">
        <div class="form_login">
          <a href="<?php echo get_home_url(); ?>" class="back_home"><img src="<?php echo get_template_directory_uri() ?>/images/icon_close.png" alt=""></a>
          <div class="header_login_form">
            <h3><?= __('Update', 'hulkbanner') ?></h3>
          </div>

          <?= $customer ?>

          <form id="first-part-form" action="" method="post">
            <div class="billing_plan">
              <div class="billing_choice">
                <label for="monthly"><?= __('Monthly', 'hulkbanner') ?></label>
                <input type="radio" name="billing" id="monthly" value="monthly" checked>
              </div>
              <div class="billing_choice">
                <label for="yearly"><?= __('Yearly', 'hulkbanner') ?></label>
                <input type="radio" name="billing" id="yearly" value="yearly">
              </div>
            </div>
            <br>
            <label for="subscription_type"><?= __('Choose your plan', 'hulkbanner') ?></label>
            <select id="subscription_type" name="subscription_type">
              <option value=""><?= __('Please choose an option', 'hulkbanner') ?></option>
              <option class="monthly" value="small 3900">Small 39€ / <?= __('month', 'hulkbanner') ?></option>
              <option class="monthly" value="medium 5900">Medium 59€ / <?= __('month', 'hulkbanner') ?></option>
              <option class="monthly" value="large 8900">Large 89€ / <?= __('month', 'hulkbanner') ?></option>
              <option class="yearly" value="small 36000">Small 30€ / <?= __('month', 'hulkbanner') ?></option>
              <option class="yearly" value="medium 60000">Medium 50€ / <?= __('month', 'hulkbanner') ?></option>
              <option class="yearly" value="large 96000">Large 80€ / <?= __('month', 'hulkbanner') ?></option>
            </select>
            <br>
            <div class="billing_infos_link"><a href="<?= get_permalink(58); ?>">Need more infos about billing plans ?</a></div>
            <label for="logo"><?= __('Logo', 'hulkbanner') ?></label>
            <input type="file" name="logo" id="logo">
            <br>
            <div class="captcha">Captcha</div>
            <br>
            <div id="card_element">
              <!-- STRIPE ELEMENTS GOES HERE -->
            </div>
            <input type="submit" value="<?= __('Continue', 'hulkbanner') ?>">
          </form>
        </div>
      </div>
    </section>

  </main>
  <script>
    document.addEventListener("DOMContentLoaded", function() {

      // INITIATE STIPE CARD CHECKOUT
      const stripe = Stripe('pk_test_51Q568r2KTIC8Xb8E7XiZWF6B5aC0sQV6aVRA0dgpr1YjP0Bp1IsyP8flO5cMGdqkUQXYCAZ4qN5Nch06Un0DdfAL00xcjT14Wy');
      const elements = stripe.elements();
      const cardElement = elements.create('card');
      cardElement.mount('#card_element');

      // Sélectionner tous les inputs radio avec le nom "billing"
      let billingInputs = document.querySelectorAll('input[name="billing"]');

      billingInputs.forEach(function(input) {
        input.addEventListener("change", function() {
          let selectedBilling = document.querySelector('input[name="billing"]:checked').value;

          if (selectedBilling === 'monthly') {
            document.querySelectorAll('.monthly').forEach(function(e) {
              e.style.display = 'block';
            });
            document.querySelectorAll('.yearly').forEach(function(e) {
              e.style.display = 'none';
            });
          } else if (selectedBilling === 'yearly') {
            document.querySelectorAll('.monthly').forEach(function(e) {
              e.style.display = 'none';
            });
            document.querySelectorAll('.yearly').forEach(function(e) {
              e.style.display = 'block';
            });
          }

          let dropdown = document.getElementById('subscription_type');
          if (dropdown) {
            dropdown.selectedIndex = 0;
          }
        });
      });


      // SUBMIT 
      document.getElementById('first-part-form').addEventListener('submit', async (event) => {

        event.preventDefault();

        let selectedBilling = document.querySelector('input[name="billing"]:checked').value;
        let selectedPlan = document.getElementById('subscription_type').value;

        if (selectedBilling === "" || selectedPlan === "") {
          alert('All the fields are mandatory exept "Logo"');
        } else {

          // REQUETE AJAX ICI

        }
      });

      // Déclencher l'événement change au chargement de la page
      let checkedBillingInput = document.querySelector('input[name="billing"]:checked');
      if (checkedBillingInput) {
        checkedBillingInput.dispatchEvent(new Event('change'));
      }
    });
  </script>


<?php else: ?>


  <script>
    window.location.href = '/404';
  </script>


<?php endif; ?>

<?php get_footer(); ?>