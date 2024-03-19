<?php

function get_the_slots()
{

	global $wpdb;

	$date = $_POST['date'];
	$week_day = $_POST['week_day'];

	$what_day = $wpdb->get_var($wpdb->prepare("SELECT id FROM `wp_week_slots` WHERE `day_number` = %s", $week_day));

	$all_slots = $wpdb->get_results(
		$wpdb->prepare(
			"SELECT *
				FROM wp_time_slot
				JOIN week_has_slots ON wp_time_slot.id = week_has_slots.time_slots_id
				WHERE week_has_slots.week_day_id = %s
				ORDER BY wp_time_slot.time",
			$what_day,
		)
	);

	$check_date = $wpdb->get_results($wpdb->prepare("SELECT * FROM `wp_demo_appointement` WHERE `date` = %s;", $date));

	$taken_slots = [];

	if (!empty($check_date)) {
		foreach ($check_date as $appointement) {
			$taken_slots[] = $wpdb->get_var($wpdb->prepare("SELECT time FROM `wp_time_slot` WHERE id = %s", $appointement->time_slot_id));
		}
	}

	$response = [
		"date" => date('d', strtotime($date)),
		"all_slots" => $all_slots,
		"taken_slot" => $taken_slots,
		"what_day" => $what_day,
	];

	echo json_encode($response);
	wp_die();
}

add_action('wp_ajax_get_the_slots', 'get_the_slots');
add_action('wp_ajax_nopriv_get_the_slots', 'get_the_slots');
