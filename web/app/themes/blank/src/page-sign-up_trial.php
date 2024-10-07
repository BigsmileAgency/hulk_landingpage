<?php

/**
 * Template Name: Sign-up_trial
 */
?>

<?php get_header(); ?>

<main class="login_body">

  <section class="section_login">
    <div class="container">
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
  </section>
</main>

<!-- JS HANDLER SCRIPT -->
<!-- <?php include_once get_template_directory() . '/components/functions/stripe/create_customer_trial_js.php'; ?> -->

<script>
  document.addEventListener("DOMContentLoaded", function() {

    let submit_sign_up = document.getElementById('submit_sign_up');
    let firstname = document.getElementById('firstname');
    let lastname = document.getElementById('lastname');
    let email = document.getElementById('email');
    let address = document.getElementById('address');
    let zip = document.getElementById('zipcode')
    let tel = document.getElementById('tel');
    let company = document.getElementById('company');
    let tva = document.getElementById('tva');
    let pwd = document.getElementById('pwd');
    let confirmPwd = document.getElementById('confirm_pwd');
    let pwdOk = true;


    function isConfirm() {
      if (confirmPwd.value !== pwd.value) {
        handleAlert(confirmPwd, copy.badPassword, lang);
        pwdOk = false;
      } else {
        rollBackAlert(confirmPwd, grey);
        pwdOk = true;
      }
    }
    
    pwd.addEventListener('input', isConfirm);
    confirmPwd.addEventListener('input', isConfirm);

    
    document.getElementById('first-part-form').addEventListener('submit', async (event) => {      
      event.preventDefault();

      let fieldsArray = [firstname, lastname, email, address, zip, tel, company, tva, pwd, confirmPwd];
      let success = 0;
      
      fieldsArray.map((e) => {
        if (e.value == "") {
          handleAlert(e, copy.emptyFields, lang)
          success++
        } else if (e == email && !email.value.match(mailRegex)) {
          handleAlert(e, copy.badMail, lang);
          success++
        } else if (e == tel && !tel.value.match(phoneRegex)) {
          handleAlert(e, copy.badPhone, lang);
          success++
        } else if (!pwdOk) {
          handleAlert(confirmPwd, copy.badPassword, lang);
          success++
        } else {
          rollBackAlert(e, grey)
        }
      })

      if (success == 0) {
        submit_sign_up.disabled = true;
        let formData = new URLSearchParams({
          action: 'create_customer_trial',
          firstname: firstname.value,
          firstname: firstname.value,
          lastname: lastname.value,
          email: email.value,
          address: address.value,
          zip: zip.value,
          tel: tel.value,
          company: company.value,
          pwd: pwd.value,
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
      }
    });
  });
</script>

<?php get_footer(); ?>