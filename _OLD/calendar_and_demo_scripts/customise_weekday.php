<?php

function customise_weekday()
{

  global $wpdb;

  $add_array = explode(',', $_POST['add']);
  $remove_array = explode(',', $_POST['remove']);
  $day = $_POST['day'];

  if ($add_array[0] !== "") {
    foreach ($add_array as $time_id) {
      $insert = $wpdb->query(
        $wpdb->prepare(
          "INSERT INTO `week_has_slots`(`week_day_id`, `time_slots_id`) 
          VALUES (%s,%s)",
          $day,
          $time_id,
        )
      );
    }
  }

  if ($remove_array[0] !== "") {
    foreach($remove_array as $time_id){
      $delete = $wpdb->query(
        $wpdb->prepare(
          "DELETE FROM `week_has_slots` 
          WHERE `week_day_id` = %s 
          AND `time_slots_id` = %s",
          $day,
          $time_id,
        )
      );
    }
  }

  $response = [
    "add" => $add_array,
    "remove" => $remove_array,
    "day" => $day,
  ];

  echo json_encode($response);
  wp_die();
}

add_action('wp_ajax_customise_weekday', 'customise_weekday');
add_action('wp_ajax_nopriv_customise_weekday', 'customise_weekday');
