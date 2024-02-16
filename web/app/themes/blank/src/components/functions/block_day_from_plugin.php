<?php

function block_day_from_plugin()
{

  global $wpdb;

  $date = date("Y-m-d", strtotime($_POST['date']));

  $time_array = $wpdb->get_results($wpdb->prepare("SELECT id FROM `wp_time_slot`"));

  $id_array= [];

  foreach($time_array as $time){
    $id_array[] = $time->id;
  }

  foreach($id_array as $id){
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
        $id,
      )
    );
  }

  if($insert){
    $response = "Journée ". $date . " bloquée";
  } else {
    $response = "Un problème est survenu";
  }

  echo json_encode($response);
  wp_die();
}

add_action('wp_ajax_block_day_from_plugin', 'block_day_from_plugin');
add_action('wp_ajax_nopriv_block_day_from_plugin', 'block_day_from_plugin');


