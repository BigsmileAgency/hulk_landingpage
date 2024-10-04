<?php

/**
 * Template Name: Sign-up_trial
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
              <label for="firstname"><?= __('Firstname', 'hulkbanner') ?></label>
              <input type="text" name="firstname" id="firstname">
              <br>
              <label for="lastname"><?= __('Lastname', 'hulkbanner') ?></label>
              <input type="text" name="lastname" id="lastname">
              <br>
              <label for="email"><?= __('Email', 'hulkbanner') ?></label>
              <input type="email" name="email" id="email">
              <br>
              <label for="tel"><?= __('Phone', 'hulkbanner') ?></label>
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
              <br>
              <label for="pwd"><?= __('Password', 'hulkbanner') ?></label>
              <input type="password" name="pwd" id="pwd">
              <br>
              <label for="logo"><?= __('Logo', 'hulkbanner') ?></label>
              <input type="file" name="logo" id="logo">
              <br>
              <div class="captcha">Captcha</div>
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
      </section>

    <?php endwhile; ?>
  <?php else: ?>
  <?php endif; ?>

</main>
<script>
  document.addEventListener("DOMContentLoaded", function() {
    document.getElementById('first-part-form').addEventListener('submit', async (event) => {

      // A RETIRER
      event.preventDefault();

      let submit_sign_up = document.getElementById('submit_sign_up');

      let firstname = document.getElementById('firstname').value;
      let lastname = document.getElementById('lastname').value;
      let email = document.getElementById('email').value;
      let address = document.getElementById('address').value;
      let zip = document.getElementById('zipcode').value
      let tel = document.getElementById('tel').value;
      let company = document.getElementById('company').value;
      let pwd = document.getElementById('pwd').value;


      // if (firstname === "" || lastname === "" || email === "" || tel === "" || company === "" || pwd === "") {
      //   event.preventDefault();
      //   alert('All the fields are mandatory exept "Logo"');
      // } else {

        submit_sign_up.disabled = true;

        let formData = new URLSearchParams({
          action: 'create_customer_trial',
          firstname: firstname,
          firstname: firstname,
          lastname: lastname,
          email: email,
          address: address,
          zip: zip,
          tel: tel,
          company: company,
          pwd: pwd,
        });

        let url = '<?php echo admin_url('admin-ajax.php'); ?>';
        console.log(url);

        try {
          const response = await fetch(url, {
            method: 'POST',
            headers: {
              'Content-Type': 'application/x-www-form-urlencoded',
              'X-Requested-With': 'XMLHttpRequest'
            },
            body: formData.toString()
          });


          const data = await response.json();

          if (data.success) {
            console.log(data);
            alert(data.data.message);
            // window.location.href = '/';
          } else {
            alert(data.data.message);
          }

        } catch (error) {
          console.error('Erreur:', error);
          alert('Une erreur est survenue. Veuillez réessayer.');
        }
      // }
    });
  });
</script>

<?php get_footer(); ?>