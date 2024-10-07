<?php

/**
 * Template Name: Sign-up_confirm
 */
?>


<?php

get_header();

if (!empty($_GET['t'])) {
  include_once get_template_directory() . '/components/functions/stripe/get_costumer_w_token.php';
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
          <div class="header_login_form">
            <h3><?= __('Update', 'hulkbanner') ?></h3>
          </div>

          <div class="customer_infos">
            <!-- <?= $customer['id'] ?> -->
            <p><?= $customer['metadata']['firstname'] ?> <?= $customer['metadata']['lastname'] ?> - <span class="bold"><?= $customer['metadata']['company'] ?></span></p>
          </div>

          <form id="first-part-form" action="" method="post">
            <label for="subscription_type"><?= __('Choose your plan', 'hulkbanner') ?></label><br>
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
            <select id="subscription_type" name="subscription_type">
              <option value=""><?= __('Please choose an option', 'hulkbanner') ?></option>
              <option class="monthly" value="small">Small 39€ / <?= __('month', 'hulkbanner') ?></option>
              <option class="monthly" value="medium">Medium 59€ / <?= __('month', 'hulkbanner') ?></option>
              <option class="monthly" value="large">Large 89€ / <?= __('month', 'hulkbanner') ?></option>
              <option class="yearly" value="small">Small 30€ / <?= __('month', 'hulkbanner') ?></option>
              <option class="yearly" value="medium">Medium 50€ / <?= __('month', 'hulkbanner') ?></option>
              <option class="yearly" value="large">Large 80€ / <?= __('month', 'hulkbanner') ?></option>
            </select>
            <br>
            <div class="billing_infos_link"><a href="<?= get_permalink(58); ?>">Need more infos about billing plans ?</a></div>
            <!-- <label for="logo"><?= __('Logo', 'hulkbanner') ?></label>
            <input type="file" name="logo" id="logo">
            <br>
            <div class="captcha">Captcha</div> -->
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

  <?php do_action('confirm_customer'); ?>
  
  <?php else: ?>
    
    <script>
      window.location.href = '/404';
      </script>

<?php endif; ?>

<?php get_footer(); ?>