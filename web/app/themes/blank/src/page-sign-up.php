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
        <form id="first-part-form" action="" onsubmit="return validateFirstPart()">
          <label for="email"><?= get_field('label_email') ?></label>
          <input type="text" name="email" id="email_login">
          <br>
          <label for="password"><?= get_field('label_password') ?></label>
          <input type="text" name="password" id="password_login">
          <br>
          <div class="captcha">Captcha</div>
          <input type="submit" value="<?= get_field('signup_button') ?>">
          <div class="divider">
            <hr>
            <p> or </p>
            <hr>
          </div>
          <div class="google_login">Google signup</div>
        </form>
        

        <form id="second-part-form" action="">
          <label for="firstname"><?= get_field('label_firstname') ?></label>
          <input type="text" name="firstname" id="firstname">
          <br>
          <label for="lastname"><?= get_field('label_lastname') ?></label>
          <input type="text" name="lastname" id="lastname">
          <br>
          <label for="company"><?= get_field('label_company') ?></label>
          <input type="text" name="company" id="company">
          <br>
          <label for="logo"><?= get_field('label_logo') ?></label>
          <input type="file" name="logo" id="logo">
          <br>
          <input type="submit" value="<?= get_field('submit_button') ?>">

        </form>
      </div>
    </div>
  </section>





  <?php endwhile; ?>
  <?php else: ?>
  <?php endif; ?>

</main>
<script>
    function validateFirstPart() {
        // Add your validation logic here, return true if valid, false otherwise
        // For example, you can check if email and password are not empty
        var email = document.getElementById('email_login').value;
        var password = document.getElementById('password_login').value;

        if (email.trim() === '' || password.trim() === '') {
            alert('Please fill in both email and password.');
            return false;
        }

        // If valid, show the second part of the form
        document.getElementById('first-part-form').style.display = 'none';
        document.getElementById('second-part-form').style.display = 'block';

        // Prevent form submission
        return false;
    }
</script>
<!-- <?php get_footer(); ?> -->
