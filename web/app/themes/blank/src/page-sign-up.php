<?php

/**
 * Template Name: Sign-up
 */
?>

<?php get_header(); ?>

<main class="login_body">
  <?php if (have_posts()): while (have_posts()) : the_post(); ?>

      <section class="section_login">
        <div class="container">
          <div class="form_login">
            <a href="<?php echo get_home_url(); ?>" class="back_home"><img src="<?php echo get_template_directory_uri() ?>/images/icon_close.png" alt=""></a>
            <div class="header_login_form">
              <h3><?= get_field('title_signup') ?></h3>
            </div>
            <form id="first-part-form" action="" method="post">
              <!-- <label for="firstname"><?= __('Firstname', 'hulkbanner') ?></label>
              <input type="text" name="firstname" id="firstname">
              <br>
              <label for="lastname"><?= __('Lastname', 'hulkbanner') ?></label>
              <input type="text" name="lastname" id="lastname">
              <br> -->
              <label for="mail"><?= __('Mail', 'hulkbanner') ?></label>
              <input type="email" name="mail" id="mail">
              <br>
              <!-- <label for="tel"><?= __('Phone', 'hulkbanner') ?></label>
              <input type="text" name="tel" id="tel">
              <br>
              <label for="address"><?= __('Address', 'hulkbanner') ?></label>
              <input type="text" name="address" id="address">
              <br>
              <label for="zipcode"><?= __('Zipcode', 'hulkbanner') ?></label>
              <input type="text" name="zipcode" id="zipcode">
              <br>
              <label for="company"><?= __('Company', 'hulkbanner') ?></label>
              <input type="text" name="company" id="company">
              <br>
              <label for="tva"><?= __('TVA number', 'hulkbanner') ?></label>
              <input type="text" name="tva" id="tva">
              <br> -->
              <div class="billing_plan">
                <div class="billing_choice">
                  <label for="monthly"><?= __('Monthly', 'hulkbanner') ?></label>
                  <input type="radio" name="billing" id="monthly" value="month" checked>
                </div>
                <div class="billing_choice">
                  <label for="yearly"><?= __('Yearly', 'hulkbanner') ?></label>
                  <input type="radio" name="billing" id="yearly" value="year">
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
              <input type="submit" value="<?= __('Continue', 'hulkbanner') ?>">
              <div class="divider">
                <hr>
                <p> or </p>
                <hr>
              </div>
              <div class="google_login">Google signup</div>
            </form>
          </div>
        </div>
      </section>

    <?php endwhile; ?>
  <?php else: ?>
  <?php endif; ?>

</main>
<script>
  document.addEventListener("DOMContentLoaded", function() {

    // Sélectionner tous les inputs radio avec le nom "billing"
    let billingInputs = document.querySelectorAll('input[name="billing"]');

    billingInputs.forEach(function(input) {
      input.addEventListener("change", function() {
        let selectedBilling = document.querySelector('input[name="billing"]:checked').value;

        if (selectedBilling === 'month') {
          document.querySelectorAll('.monthly').forEach(function(e) {
            e.style.display = 'block';
          });
          document.querySelectorAll('.yearly').forEach(function(e) {
            e.style.display = 'none';
          });
        } else if (selectedBilling === 'year') {
          document.querySelectorAll('.monthly').forEach(function(e) {
            e.style.display = 'none';
          });
          document.querySelectorAll('.yearly').forEach(function(e) {
            e.style.display = 'block';
          });
        }

        // Réinitialiser la sélection du dropdown
        let dropdown = document.getElementById('subscription_type');
        if (dropdown) {
          dropdown.selectedIndex = 0;
        }
      });
    });
    
    document.getElementById('first-part-form').addEventListener('submit', function(event) {
      // Récupérer les valeurs des champs
      let firstname = document.getElementById('firstname').value;
      let lastname = document.getElementById('lastname').value;
      let mail = document.getElementById('mail').value;
      let tel = document.getElementById('tel').value;
      let company = document.getElementById('company').value;
      let tva = document.getElementById('tva').value;

      if (mail !== "") {
        // La validation réussit, le formulaire sera soumis normalement
      } else {
        event.preventDefault();
        alert('Veuillez remplir tous les champs sauf le logo.');
      }
    });


    // Déclencher l'événement change au chargement de la page
    let checkedBillingInput = document.querySelector('input[name="billing"]:checked');
    if (checkedBillingInput) {
      checkedBillingInput.dispatchEvent(new Event('change'));
    }
  });
</script>

<?php get_footer(); ?>