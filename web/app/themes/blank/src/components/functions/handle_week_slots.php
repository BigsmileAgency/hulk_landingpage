<?php

function handle_week_slots()
{

  global $wpdb;

  $response = "handle_week_slots";

  echo json_encode($response);
  wp_die();
}

add_action('wp_ajax_handle_week_slots', 'handle_week_slots');
add_action('wp_ajax_nopriv_handle_week_slots', 'handle_week_slots');