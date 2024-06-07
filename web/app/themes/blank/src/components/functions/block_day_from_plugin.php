<?php

function block_day_from_plugin()
{

  global $wpdb;

  $date = date("Y-m-d", strtotime($_POST['date']));
  $week_day = $_POST['week_day'];

  $what_day = $wpdb->get_var($wpdb->prepare("SELECT id FROM `wp_week_slots` WHERE `day_number` = %s", $week_day));

  $time_array = $wpdb->get_results(
		$wpdb->prepare(
			"SELECT wp_time_slot.id, TIME_FORMAT(wp_time_slot.time, '%%H:%%i') AS time, week_has_slots.time_slots_id, week_has_slots.week_day_id
				FROM wp_time_slot
				JOIN week_has_slots ON wp_time_slot.id = week_has_slots.time_slots_id
				WHERE week_has_slots.week_day_id = %s
				ORDER BY wp_time_slot.time",
			$what_day,
		)
	);

  $id_array = [];

  foreach ($time_array as $time) {
    $id_array[] = $time->id;
  }

  foreach ($id_array as $id) {
    $exist = $wpdb->get_var(
      $wpdb->prepare(
        "SELECT COUNT(*) FROM `wp_demo_appointement` WHERE `date` = %s AND `time_slot_id` = %d",
        $date,
        $id
      )
    );
    if($exist == 0){
      $appointement_id = uniqid();
      $insert = $wpdb->query(
        $wpdb->prepare(
          "INSERT INTO `wp_demo_appointement`(`id`,`first_name`, `last_name`, `company`, `email`, `phone`, `date`, `time_slot_id`) 
              VALUES (%s, %s, %s, %s, %s, %s, %s, %s)",
          $appointement_id,
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
  }


  if ($insert) {
    $response = "Journée " . $date . " bloquée";
  } else {
    $response = "Un problème est survenu";
  }

  echo json_encode($response);
  wp_die();
}

add_action('wp_ajax_block_day_from_plugin', 'block_day_from_plugin');
add_action('wp_ajax_nopriv_block_day_from_plugin', 'block_day_from_plugin');
