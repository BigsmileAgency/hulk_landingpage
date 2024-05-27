<?php

$lang = get_language_attributes($doctype = "html");
$lang = explode('=', $lang);
$lang = explode('-', $lang[1]);
$lang = explode('"', $lang[0])[1];
$language = [
  "fr" => "Français",
  "nl" => "Nederlands",
  "en" => "English",
];

$langArray = ["fr", "nl", "en"];
$otherLang = [];

foreach($langArray as $item){
  if($item !== $lang) {
    $otherLang[] = $item;
  }
}

global $wpdb;

$response = "";

if (isset($_GET['what']) && ($_GET['what'] == "update" || $_GET['what'] == "cancel")) {
  if (!isset($_GET['id'])) {
    $response = "Error trying to get user timetable";
  } else {
    $id = $_GET['id'];
    $appointement = $wpdb->get_row(
      $wpdb->prepare(
        "SELECT * 
        FROM `wp_demo_appointement` 
        WHERE id = %s",
        $id,
      )
    );
    if (empty($appointement)) {
      $response = "User doesn't exist";
    } else {
      $time = $appointement->time_slot_id;
      $what_time = $wpdb->get_row(
        $wpdb->prepare(
          "SELECT time 
              FROM `wp_time_slot` 
              WHERE id=%s",
          $time,
        )
      );
      $now = date("Y-m-d");
      $dislayDate = date('d-m-Y', strtotime($appointement->date));
      if ($appointement->date <= $now) {
        $response = "Ce rdv n'existe plus...";
      }
    }
  }
} else {
  $response = "Wrong request";
}
?>

<script>
  document.addEventListener('DOMContentLoaded', load => {

    load.preventDefault();
    let cancelBtn = document.querySelector('#cancel_appointement_from_mail');
    let updateBtn = document.querySelector('#update_appointement_from_mail');
    let appointementDate = new Date(<?= json_encode($appointement->date) ?> + " " + <?= json_encode($what_time->time) ?>).toString();

    if (cancelBtn !== null) {
      cancelBtn.addEventListener('click', click => {
        click.preventDefault();
        cancelBtn.disabled = true;
        let xhr = new XMLHttpRequest();
        let url = '<?= admin_url('admin-ajax.php') ?>';
        let id = <?= json_encode($id); ?>;
        let dataSet = 'action=cancel_demo_meeting_with_id&id=' + id;
        xhr.open("POST", url, true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function() {
          if (xhr.readyState == 4 && xhr.status == 200) {
            let result = xhr.responseText;
            result = JSON.parse(result);
            if (!result.error) {
              displayResponse("cancel")
            } else {
              console.log(result);
              cancelBtn.disabled = false;
            }
          }
        };
        xhr.send(dataSet);
      })
    }

    if (updateBtn !== null) {
      updateBtn.addEventListener('click', click => {

        let updateSubmit = document.querySelector('#update_appointement_from_mail');
        let firstName = document.querySelector("#first_name_update");
        let lastName = document.querySelector("#last_name_update");
        let email = document.querySelector("#email_update");
        let phone = document.querySelector("#phone_update");
        let companyName = document.querySelector("#company_update");
        let updateLang = document.querySelector('#lang_update').value;
        let id = <?= json_encode($id); ?>;
        let isAgency = document.querySelector('input[type=radio][name=update_agency]:checked');
        let grey = companyName.style.borderColor

        // regexs 
        let mailRegex = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        let phoneRegex = /^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/;

        let fieldsArray = [firstName, lastName, email, phone];

        let success = 0;

        fieldsArray.map((e) => {
          if (e.value == "") {
            handleAlert(e, copy.emptyFields, lang)
            success++
          } else if (e == email && !email.value.match(mailRegex)) {
            handleAlert(e, copy.badMail, lang);
            success++
          } else if (e == phone && !phone.value.match(phoneRegex)) {
            handleAlert(e, copy.badPhone, lang);
            success++
          } else {
            rollBackAlert(e, grey)
          }
        })

        let time = document.querySelector('.time_selected');
        let day = document.querySelector('.date_selected');

        date.setDate(day.innerHTML);

        if (success == 0) {
          if (day == null || day == undefined) {
            alert(copy.noDate[lang]);
          } else if (time == null || time == undefined) {
            alert(copy.noTime[lang]);
          } else {

            // if (confirm("Vous êtes sur ?")) {

              updateBtn.disabled = true;
              let dataSet = 'first_name=' + firstName.value +
                '&last_name=' + lastName.value +
                '&full_date=' + date.toDateString() +
                '&phone=' + phone.value +
                '&email=' + email.value +
                '&company=' + companyName.value +
                '&is_agency=' + isAgency.value +
                '&time=' + time.innerHTML +
                '&lang=' + updateLang +
                '&id=' + id;

              // INSERT DB + SEND MAIL
              let xhrSend = new XMLHttpRequest();
              let urlSend = '<?= admin_url('admin-ajax.php') ?>';
              let dataSetSend = 'action=update_demo_request&' + dataSet;

              xhrSend.open("POST", urlSend, true);
              xhrSend.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
              xhrSend.onreadystatechange = function() {
                if (xhrSend.readyState == 4 && xhrSend.status == 200) {
                  let result = xhrSend.responseText;
                  result = JSON.parse(result);
                  if (!result.error) {
                    displayResponse("update");
                  } else {
                    console.log(result);
                    alert(copy.problem[lang])
                    bookBtn.disabled = false;
                  }
                }
              };
              xhrSend.send(dataSetSend);

            // }
            
          }
        }
      })

      function handleAlert(field, message, lang) {
        field.style.borderColor = "red";
        let response = field.nextElementSibling;
        response.innerHTML = `<img class="response_img" src="<?php echo get_template_directory_uri() ?>/images/material_error.svg" /><p class="response_text">${message[lang]}</p>`
      }

      function rollBackAlert(field, grey) {
        field.style.borderColor = grey;
        let response = field.nextElementSibling;
        response.innerHTML = ""
      }
    }
  })

  function displayResponse(answer) {
    let displayResponse = "";
    if (answer == "update") {
      displayResponse = copy.updateSuccess[lang];
    } else if (answer == "cancel") {
      displayResponse = copy.cancelSuccess[lang];
    } else {
      displayResponse = "Erreur";
    }
    let container = document.querySelector('.edit_container');
    container.innerHTML =
      `<p>${displayResponse}</p>
      <a href="<?= get_home_url() . '/'; ?>"><button>${copy.back[lang]}</button></a>`;
  }
</script>