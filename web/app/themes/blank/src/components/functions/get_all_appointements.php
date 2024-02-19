<?php

function get_all_appointements()
{

  global $wpdb;

  $appointements =
    $wpdb->get_results(
        "SELECT * FROM wp_demo_appointement 
        INNER JOIN wp_time_slot 
        ON wp_demo_appointement.time_slot_id = wp_time_slot.id
        WHERE wp_demo_appointement.first_name != 'BSA'
        ORDER BY wp_demo_appointement.date, wp_time_slot.time"      
    );


  $response = $appointements;

  echo json_encode($response);
  wp_die();
}

add_action('wp_ajax_get_all_appointements', 'get_all_appointements');
add_action('wp_ajax_nopriv_get_all_appointements', 'get_all_appointements');
