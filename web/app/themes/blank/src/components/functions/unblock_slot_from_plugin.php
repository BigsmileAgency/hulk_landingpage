<?php

function unblock_slot_from_plugin()
{

  global $wpdb;

  $date = date("Y-m-d", strtotime($_POST['date']));
  $time = $_POST['time'];

  $time_id = $wpdb->get_var($wpdb->prepare("SELECT id FROM `wp_time_slot` WHERE time = %s", $time));

  $insert = $wpdb->query(
    $wpdb->prepare(
      "DELETE FROM `wp_demo_appointement` WHERE `date` = %s AND `time_slot_id` = %s",
      $date,
      $time_id,
    )
  );

  if($insert){
    $response = "Créneau débloqué";
  } else {
    $response = "problème";
  }

  // $response = [$date, $time];

  echo json_encode($response);
  wp_die();
}

add_action('wp_ajax_unblock_slot_from_plugin', 'unblock_slot_from_plugin');
add_action('wp_ajax_nopriv_unblock_slot_from_plugin', 'unblock_slot_from_plugin');
