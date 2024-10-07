<script>
  document.addEventListener("DOMContentLoaded", function() {

    // INITIATE STIPE CARD CHECKOUT
    const stripe = Stripe('pk_test_51Q568r2KTIC8Xb8E7XiZWF6B5aC0sQV6aVRA0dgpr1YjP0Bp1IsyP8flO5cMGdqkUQXYCAZ4qN5Nch06Un0DdfAL00xcjT14Wy');
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
    document.getElementById('first-part-form').addEventListener('submit', async (event) => {

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
          // alert('Customer updated successfully!');
          // window.location.href = "/confirmation-page"; 

          console.log(result);

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