<?php

function unblock_day_from_plugin()
{

  global $wpdb;

  $date = date("Y-m-d", strtotime($_POST['date']));

  $delete = $wpdb->query($wpdb->prepare("DELETE FROM `wp_demo_appointement` WHERE date = %s", $date));

  if($delete){
    $response = "Journée ". $date . " débloquée";
  } else {
    $response = "Un problème est survenu";
  }

  echo json_encode($response);
  wp_die();
}

add_action('wp_ajax_unblock_day_from_plugin', 'unblock_day_from_plugin');
add_action('wp_ajax_nopriv_unblock_day_from_plugin', 'unblock_day_from_plugin');