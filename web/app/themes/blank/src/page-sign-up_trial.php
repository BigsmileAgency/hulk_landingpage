<?php

/**
 * Template Name: Sign-up_trial
 */
?>

<?php
get_header();
do_action('create_customer');
?>

<main class="login_body default">
  <div class="section_login container">
    <div class="form_login">
      <div class="header_login_form">
        <h3><?= get_field('title_signup') ?></h3>
      </div>
      <form id="first-part-form" action="" method="post">
        <div class="form_grid">
          <div class="form_item">
            <label for="firstname"><?= __('Firstname', 'hulkbanner') ?></label>
            <input type="text" name="firstname" id="firstname">
            <div class="response"></div>
          </div>

          <div class="form_item">
            <label for="lastname"><?= __('Lastname', 'hulkbanner') ?></label>
            <input type="text" name="lastname" id="lastname">
            <div class="response"></div>
          </div>

          <div class="form_item">
            <label for="email"><?= __('Email', 'hulkbanner') ?></label>
            <input type="text" name="email" id="email">
            <div class="response"></div>
          </div>

          <div class="form_item">
            <label for="tel"><?= __('Phone', 'hulkbanner') ?></label>
            <input type="text" name="tel" id="tel">
            <div class="response"></div>
          </div>

          <div class="form_item">
            <label for="address"><?= __('Address', 'hulkbanner') ?></label>
            <input type="text" name="address" id="address">
            <div class="response"></div>
          </div>

          <div class="form_item">
            <label for="zipcode"><?= __('Zipcode', 'hulkbanner') ?></label>
            <input type="text" name="zipcode" id="zipcode">
            <div class="response"></div>
          </div>
          <div class="form_item">
            <label for="company"><?= __('Company', 'hulkbanner') ?></label>
            <input type="text" name="company" id="company">
            <div class="response"></div>
          </div>

          <div class="form_item">
            <label for="tva"><?= __('TVA number', 'hulkbanner') ?></label>
            <input type="text" name="tva" id="tva">
            <div class="response"></div>
          </div>

          <div class="form_item">
            <label for="pwd"><?= __('Password', 'hulkbanner') ?></label>
            <input type="password" name="pwd" id="pwd">
            <div class="response"></div>
          </div>

          <div class="form_item">
            <label for="confirm_pwd"><?= __('Confirm password', 'hulkbanner') ?></label>
            <input type="password" id="confirm_pwd">
            <div class="response"></div>
          </div>

        </div>

        <!-- <div class="form_item">
            <label for="logo"><?= __('Logo', 'hulkbanner') ?></label>
            <input type="file" name="logo" id="logo">
          </div>

          <div class="captcha">Captcha</div> -->
        <br>
        <input type="submit" id="submit_sign_up" value="<?= __('Continue', 'hulkbanner') ?>">
        <div class="divider">
          <hr>
          <p> or </p>
          <hr>
        </div>
        <div class="google_login">Google signup</div>
      </form>
    </div>
  </div>
</main>

<!-- JS HANDLER SCRIPT -->
<?php include_once get_template_directory() . '/components/functions/stripe/create_customer_trial_js.php'; ?>

<?php get_footer(); ?>