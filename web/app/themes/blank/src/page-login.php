<?php 
  /**
  * Template Name: Login
  */
?>

<?php 
get_header("login"); 


// Recup les infos du check-out de stripe
$session_id = $_GET['session_id'];
$session = \Stripe\Checkout\Session::retrieve($session_id);
$customer = \Stripe\Customer::retrieve($session->customer);
var_dump($customer); 


?>


<main class="default">
  <?php if (have_posts()): while (have_posts()) : the_post(); ?>

  <section class="section_login" >
    <div class="container">
      <div class="form_login">
        <a href="<?php echo get_home_url(); ?>" class="back_home"><img src="<?php echo get_template_directory_uri() ?>/images/icon_close.png" alt=""></a>
        <div class="header_login_form">
          <h1><?= get_field('title_login') ?></h1>
          <p><?= get_field('title_content_login') ?></p>
        </div>
        <form action="">
          <label for="email"><?= get_field('label_email') ?></label>
          <input type="text" name="email" id="email_login">
          <br>
          <label for="password"><?= get_field('label_password') ?></label>
          <input type="text" name="password" id="password_login">
          <br>
          <div class="sublogin">
            <div class="remember_me">
              <input type="checkbox" name="remember_me" id="remember_me">
              <label for="remember_me"><?= get_field('label_rememberme') ?></label>
            </div>
            <a href="<?= get_field('password_reset_link') ?>" class="reset_password bold"><?= get_field('password_reset') ?></a>
          </div>
          <input type="submit" value="<?= get_field('login_button') ?>">
        </form>
        <div class="divider">
          <hr>
          <p> or </p>
          <hr>
        </div>
        
        <div class="google_login">Google login</div>
      </div>
    </div>
  </section>

  <?php endwhile; ?>
  <?php else: ?>
  <?php endif; ?>


</main>

<?php get_footer(); ?>