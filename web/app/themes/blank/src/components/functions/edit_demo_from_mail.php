<?php

global $wpdb;

$response = "";

var_dump($_GET);

if (isset($_GET['what']) && ($_GET['what'] == "update" || $_GET['what'] == "cancel")) {

  if (isset($_GET['id'])) {

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
    }
  } else {
    $response = "Error trying to get user timetable";
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
            displayResponse()
          } else {
            console.log(result);
            cancelBtn.disabled = false;
          }
        }
      };
      xhr.send(dataSet);
    })




  })

  function displayResponse() {
    let container = document.querySelector('.cancel_container');
    container.innerHTML =
      `<p>Votre RDV a été annulé</p>
      <a href="<?= get_home_url() . '/'; ?>"><button>Retour</button></a>`;
  }
</script>