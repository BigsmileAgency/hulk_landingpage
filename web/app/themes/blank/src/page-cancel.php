<?php

/**
 * Template Name: Cancel
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

if (!empty($customer)):
?>

  <script src="https://js.stripe.com/v3/"></script>

  <main class="login_body">
    <section class="section_login">
      <div class="container">
        <div class="form_login">
          <div class="header_login_form">
            <h3><?= __('Cancel Subscription', 'hulkbanner') ?></h3>
          </div>

          <?php var_dump($customer); ?>

          <div class="customer_infos">
            <p><?= $customer['metadata']['firstname'] ?> <?= $customer['metadata']['lastname'] ?> - <span class="bold"><?= $customer['metadata']['company'] ?></span></p>
          </div>

          <form id="cancel_form" action="" method="post">
            <label for="submit"><?= __('Are you sure you wanna cancel you subscription?', 'hulkbanner') ?></label>
            <input type="submit" value="<?= __('Confirm', 'hulkbanner') ?>">
          </form>
        </div>
      </div>
    </section>
  </main>

  <script>
    document.addEventListener("DOMContentLoaded", function() {

      // SUBMIT 
      document.getElementById('cancel_form').addEventListener('submit', async (event) => {

        event.preventDefault();

        const response = await fetch('<?= admin_url('admin-ajax.php'); ?>', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
          },
          body: new URLSearchParams({
            action: 'cancel_customer',
            customer_id: '<?= $customer['id'] ?>'
          })
        });

        // Vérifier la réponse
        const result = await response.text();

        console.log(result);

        if (result.success) {
          console.log(result);
          // alert(copy.successCancelCustomer[lang]);
          // window.location = "https://hulkbanner.bigsmile.be/";

        } else {
          console.error(result);
          alert('Failed to update customer: ' + result);
        }
      })
    });
  </script>

<?php else: ?>

  <script>
    window.location.href = '/404';
  </script>

<?php endif; ?>

<?php get_footer(); ?>