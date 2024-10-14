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

if (isset($customer)):
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
            <p><?= $customer['metadata']['firstname'] ?> <?= $customer['metadata']['lastname'] ?> - <span class="bold"><?= $customer['metadata']['company'] ?></span></p>
          </div>

          <form id="confirm_form" action="" method="post">
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

  <script>
    document.addEventListener("DOMContentLoaded", function() {

      // INITIATE STIPE CARD CHECKOUT
      const stripe = Stripe('<?= getenv("STRIPE_PUBLIC_KEY"); ?>');
      const elements = stripe.elements();

      const style = {
        base: {
          color: "#32325d",
          fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
          fontSmoothing: "antialiased",
          fontSize: "16px",
          "::placeholder": {
            color: "#aab7c4"
          }
        },
        invalid: {
          color: "#fa755a",
          iconColor: "#fa755a"
        }
      };

      const cardElement = elements.create('card', {
        style: style,
        hidePostalCode: true,
      });

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
      document.getElementById('confirm_form').addEventListener('submit', async (event) => {

        event.preventDefault();

        let selectedBilling = document.querySelector('input[name="billing"]:checked').value;
        let selectedPlan = document.getElementById('subscription_type').value;

        if (selectedBilling === "" || selectedPlan === "") {
          alert('All the fields are mandatory exept "Logo"');
        } else {

          // Initialiser Stripe Elements
          const {
            token,
            error
          } = await stripe.createToken(cardElement);

          if (error) {
            console.error('Error creating Stripe token:', error);
            alert('Invalid card information');
            return;
          }

          // Envoi des données via AJAX
          const response = await fetch('<?= admin_url('admin-ajax.php'); ?>', {
            method: 'POST',
            headers: {
              'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: new URLSearchParams({
              action: 'confirm_customer',
              stripeToken: token.id,
              plan: selectedPlan,
              billing: selectedBilling,
              customer_id: '<?= $customer['id'] ?>'
            })
          });

          // Vérifier la réponse
          const result = await response.json();


          if (result.success) {

            alert(copy.successConfirmCustomer[lang]);
            window.location = "https://hulkbanner.bigsmile.be/"; 

            // console.log(result);

          } else {
            console.error(result);
            alert('Failed to update customer: ' + result);
          }

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