<?php 
  /**
  * Template Name: Sign-up
  */
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

        <form id="first-part-form" action="<?= get_permalink(342); ?>" method="post">
          <label for="firstname"><?= __('Firstname', 'hulkbanner') ?></label>
          <input type="text" name="firstname" id="firstname">
          <br>
          <label for="lastname"><?= __('Lastname', 'hulkbanner') ?></label>
          <input type="text" name="lastname" id="lastname">
          <br>
          <label for="mail"><?= __('Mail', 'hulkbanner') ?></label>
          <input type="email" name="mail" id="mail">
          <br>
          <label class="hidden" for="tel"><?= __('Phone', 'hulkbanner') ?></label>
          <input type="hidden" name="tel" id="tel">
          <br>
          <label class="hidden" for="address"><?= __('Address', 'hulkbanner') ?></label>
          <input type="hidden" name="address" id="address">
          <br>
          <label class="hidden" for="postcode"><?= __('Postcode', 'hulkbanner') ?></label>
          <input type="hidden" name="postcode" id="postcode">
          <br>
          <label for="company"><?= __('Company', 'hulkbanner') ?></label>
          <input type="text" name="company" id="company">
          <br>
          <label class="hidden" for="tva"><?= __('TVA number', 'hulkbanner') ?></label>
          <input type="hidden" name="tva" id="tva">
          <br>
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
            <option class="monthly" value="small month">Small 39€ / <?= __('month', 'hulkbanner') ?></option>
            <option class="monthly" value="medium month">Medium 59€ / <?= __('month', 'hulkbanner') ?></option>
            <option class="monthly" value="large month">Large 89€ / <?= __('month', 'hulkbanner') ?></option>
            <option class="yearly" value="small year">Small 30€ / <?= __('month', 'hulkbanner') ?></option>
            <option class="yearly" value="medium year">Medium 50€ / <?= __('month', 'hulkbanner') ?></option>
            <option class="yearly" value="large year">Large 80€ / <?= __('month', 'hulkbanner') ?></option>
          </select>
          <br>
          <div class="billing_infos_link"><a  href="<?= get_permalink(58); ?>">Need more infos about billing plans ?</a></div>
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
  document.getElementById('first-part-form').addEventListener('submit', function (event) {
    // Récupérer les valeurs des champs
    var firstname = document.getElementById('firstname').value;
    var lastname = document.getElementById('lastname').value;
    var mail = document.getElementById('mail').value;
    var tel = document.getElementById('tel').value;
    var company = document.getElementById('company').value;
    var tva = document.getElementById('tva').value;

    // Valider si tous les champs (sauf logo) sont remplis
    if (firstname !=="" && lastname !=="" && mail !=="" && tel !=="" && company !=="" && tva !=="") {
      // La validation réussit, le formulaire sera soumis normalement
    } else {
      // La validation échoue, annuler l'événement de soumission
      event.preventDefault();
      alert('Veuillez remplir tous les champs sauf le logo.');
    }
  });
</script>
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    $(document).ready(function () {
        $('input[name="billing"]').change(function () {
            var selectedBilling = $('input[name="billing"]:checked').val();

            if (selectedBilling === 'monthly') {
                $('.monthly').show();
                $('.yearly').hide();
            } else if (selectedBilling === 'yearly') {
                $('.monthly').hide();
                $('.yearly').show();
            }
             // Reset the selected index of the dropdown to 0
             $('#subscription_type').prop('selectedIndex', 0);
        });

        // Trigger the change event initially
        $('input[name="billing"]:checked').trigger('change');
    });
</script>
<!-- <?php get_footer(); ?> -->
