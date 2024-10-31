<?php

function cancel_demo_meeting_with_id()
{

  global $wpdb;

  $id = $_POST['id'];

  $delete = $wpdb->query(
    $wpdb->prepare(
      "DELETE FROM `wp_demo_appointement` WHERE `id` = %s",
      $id,
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

add_action('wp_ajax_cancel_demo_meeting_with_id', 'cancel_demo_meeting_with_id');
add_action('wp_ajax_nopriv_cancel_demo_meeting_with_id', 'cancel_demo_meeting_with_id');