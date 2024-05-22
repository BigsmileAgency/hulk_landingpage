<?php

global $wpdb;

$response = "";
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
  $response = "Erreur";
}
?>

<script>
  document.addEventListener('DOMContentLoaded', load => {

    load.preventDefault();
    let cancelBtn = document.querySelector('#cancel_appointement_from_mail');

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

  function displayResponse(){
    let container = document.querySelector('.cancel_container');
    container.innerHTML = 
      `<p>Votre RDV a été annulé</p>
      <button><a href="<?= get_home_url() . '/'; ?>">Retour</a></button>`;
  }

</script>