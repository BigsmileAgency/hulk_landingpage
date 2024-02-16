<?php

function block_slot_from_plugin()
{

  global $wpdb;

  $date = date("Y-m-d", strtotime($_POST['date']));
  $time = $_POST['time'];

  $time_id = $wpdb->get_var($wpdb->prepare("SELECT id FROM `wp_time_slot` WHERE time = %s", $time));

  $insert = $wpdb->query(
    $wpdb->prepare(
      "INSERT INTO `wp_demo_appointement`(`first_name`, `last_name`, `company`, `email`, `phone`, `date`, `time_slot_id`) 
          VALUES (%s, %s, %s, %s, %s, %s, %s)",
      "BSA",
      "BSA",
      "BSA",
      "BSA",
      "BSA",
      $date,
      $time_id,
    )
  );

  if($insert){
    $response = "Créneau bloqué";
  } else {
    $response = "problème";
  }

  // $response = $date;

  echo json_encode($response);
  wp_die();
}

add_action('wp_ajax_block_slot_from_plugin', 'block_slot_from_plugin');
add_action('wp_ajax_nopriv_block_slot_from_plugin', 'block_slot_from_plugin');
