<?php

function get_slots_for_that_day()
{

  global $wpdb;

  $day = $_POST['day'];

  $slots = $wpdb->get_results(
		$wpdb->prepare(
			"SELECT wp_time_slot.id, TIME_FORMAT(wp_time_slot.time, '%%H:%%i') AS time
				FROM wp_time_slot
				JOIN week_has_slots ON wp_time_slot.id = week_has_slots.time_slots_id
				WHERE week_has_slots.week_day_id = %s
				ORDER BY wp_time_slot.time",
			$day,
		)
	);
  
  $response = $slots;
  
  echo json_encode($response);
  wp_die();
}

add_action('wp_ajax_get_slots_for_that_day', 'get_slots_for_that_day');
add_action('wp_ajax_nopriv_get_slots_for_that_day', 'get_slots_for_that_day');