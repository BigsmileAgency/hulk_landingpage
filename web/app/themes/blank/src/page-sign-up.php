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
        <form action="">
          <label for="email"><?= get_field('label_email') ?></label>
          <input type="text" name="email" id="email_login">
          <br>
          <label for="password"><?= get_field('label_password') ?></label>
          <input type="text" name="password" id="password_login">
          <br>
          <div class="captcha">Captcha</div>
          <input type="submit" value="<?= get_field('signup_button') ?>">
        </form>
        <div class="divider">
          <hr>
          <p> or </p>
          <hr>
        </div>
        
        <div class="google_login">Google signup</div>
      </div>
    </div>
  </section>





  <?php endwhile; ?>
  <?php else: ?>
  <?php endif; ?>

</main>

<!-- <?php get_footer(); ?> -->
