<?php 

function create_customer_trial_js(){
?>
<script>
  document.addEventListener("DOMContentLoaded", function() {

    console.log("tu sais qui on est");

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

      // fieldsArray.map((e) => {
      //   if (e.value == "") {
      //     handleAlert(e, copy.emptyFields, lang)
      //     success++
      //   } else if (e == email && !email.value.match(mailRegex)) {
      //     handleAlert(e, copy.badMail, lang);
      //     success++
      //   } else if (e == tel && !tel.value.match(phoneRegex)) {
      //     handleAlert(e, copy.badPhone, lang);
      //     success++
      //   } else if (!pwdOk) {
      //     handleAlert(confirmPwd, copy.badPassword, lang);
      //     success++
      //   } else {
      //     rollBackAlert(e, grey)
      //   }
      // })

      if (success == 0) {
        submit_sign_up.disabled = true;

        let formData = new URLSearchParams({
          action: 'create_customer_trial',
          firstname: firstname.value,
          lastname: lastname.value,
          email: email.value,
          address: address.value,
          zip: zip.value,
          tel: tel.value,
          company: company.value,
          tva: tva.value,
          pwd: pwd.value,
        });

        let url = '<?php echo admin_url('admin-ajax.php'); ?>';

        try {
          const response = await fetch(url, {
            method: 'POST',
            headers: {
              'Content-Type': 'application/x-www-form-urlencoded',
              'X-Requested-With': 'XMLHttpRequest'
            },
            body: formData.toString()
          });

          const data = await response.text();

          console.log(data);

          // if (data.success) {
          //   console.log(data);
          //   alert(data.data.message);
          //   // window.location.href = '/';
          // } else {
          //   alert(data.data.message);
          // }

        } catch (error) {
          console.error('Erreur:', error);
          alert('Une erreur est survenue. Veuillez réessayer.');
        }
      }
    });
  });
</script>
<?php
}

add_action('create_customer', 'create_customer_trial_js');