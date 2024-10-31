<?php

function get_all_days_and_all_slots()
{

  global $wpdb;

  $all_days = $wpdb->get_results("SELECT * FROM `wp_week_slots` ORDER BY wp_week_slots.day_number");
  $all_time_slots = $wpdb->get_results("SELECT wp_time_slot.id, TIME_FORMAT(wp_time_slot.time, '%H:%i') AS time FROM `wp_time_slot` ORDER BY wp_time_slot.time");

  if($all_days && $all_time_slots){
    $response = [
      "all_days" => $all_days,
      "all_time_slots" => $all_time_slots,
    ];
  } else {
    $response = "Problème";
  }

  echo json_encode($response);
  wp_die();
}

add_action('wp_ajax_get_all_days_and_all_slots', 'get_all_days_and_all_slots');
add_action('wp_ajax_nopriv_get_all_days_and_all_slots', 'get_all_days_and_all_slots');