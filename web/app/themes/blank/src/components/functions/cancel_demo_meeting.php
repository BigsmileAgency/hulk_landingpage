<?php

function cancel_demo_meeting()
{

  global $wpdb;

  $first_name = $_POST['first_name'];
  $last_name = $_POST['last_name'];
  $date = date("Y-m-d", strtotime($_POST['date']));
  $time = $_POST['time'];

  $time_id = $wpdb->get_var($wpdb->prepare("SELECT id FROM `wp_time_slot` WHERE time = %s", $time));

  $delete = $wpdb->query(
    $wpdb->prepare(
      "DELETE FROM `wp_demo_appointement` WHERE `first_name` = %s AND `last_name` = %s AND `time_slot_id` = %s AND `date` = %s",
      $first_name,
      $last_name,
      $time_id,
      $date,
    )
  );

  if($delete){
    $response = "effacé";
  } else {
    $response = "problème";
  }

  echo json_encode($response);
  wp_die();
}

add_action('wp_ajax_cancel_demo_meeting', 'cancel_demo_meeting');
add_action('wp_ajax_nopriv_cancel_demo_meeting', 'cancel_demo_meeting');