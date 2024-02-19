<?php

function unblock_slot_from_plugin()
{

  global $wpdb;

  $date = date("Y-m-d", strtotime($_POST['date']));
  $timeArray = explode(",", $_POST['time']);
  $inserted = 0;

  foreach ($timeArray as $time) {
    $time_id = $wpdb->get_results($wpdb->prepare("SELECT * FROM `wp_time_slot` WHERE time = %s", $time));

    $check = $wpdb->get_results(
      $wpdb->prepare(
        "SELECT * FROM `wp_demo_appointement` WHERE `date` = %s AND `time_slot_id` = %s",
        $date,
        $time_id[0]->id,
      )
    );

    if ($check[0]->first_name == "BSA") {
      $insert = $wpdb->query(
        $wpdb->prepare(
          "DELETE FROM `wp_demo_appointement` WHERE `date` = %s AND `time_slot_id` = %s",
          $date,
          $time_id[0]->id,
        )
      );

      $response[] = [
        "first_name" => "BSA",       
      ];

    } else {

      $response[] = [
        "first_name" => $check[0]->first_name,
        "last_name" => $check[0]->last_name,
        "date"=> $check[0]->date, 
        "time"=>$time_id[0]->time,       
      ];

    }
    $inserted++;
  }

  echo json_encode($response);
  wp_die();
}

add_action('wp_ajax_unblock_slot_from_plugin', 'unblock_slot_from_plugin');
add_action('wp_ajax_nopriv_unblock_slot_from_plugin', 'unblock_slot_from_plugin');
