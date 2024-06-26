<?php

function block_slot_from_plugin()
{

  global $wpdb;

  $date = date("Y-m-d", strtotime($_POST['date']));
  $timeArray = explode("," , $_POST['time']);
  $inserted = 0;
  $response = [];
  
  foreach($timeArray as $time){
    $time_id = $wpdb->get_var($wpdb->prepare("SELECT id FROM `wp_time_slot` WHERE time = %s", $time));
    $is_it = $wpdb->get_var($wpdb->prepare("SELECT * FROM `wp_demo_appointement` WHERE time_slot_id = %s AND date = %s", $time_id, $date));

    if(is_null($is_it)){
      $appointement_id = uniqid();
      $insert = $wpdb->query(
        $wpdb->prepare(
          "INSERT INTO `wp_demo_appointement`(`id`,`first_name`, `last_name`, `company`, `email`, `phone`, `date`, `time_slot_id`) 
              VALUES (%s, %s, %s, %s, %s, %s, %s, %s)",
          $appointement_id,
          "BSA",
          "BSA",
          "BSA",
          "BSA",
          "BSA",
          $date,
          $time_id,
        )
      );
      $inserted++;
    }
  }

  if($inserted > 0){
    $response = $inserted . " Créneau(x) bloqué(s)";
  } else {
    $response = "problème";
  }

  echo json_encode($response);
  wp_die();
}

add_action('wp_ajax_block_slot_from_plugin', 'block_slot_from_plugin');
add_action('wp_ajax_nopriv_block_slot_from_plugin', 'block_slot_from_plugin');
