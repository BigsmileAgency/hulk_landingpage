<?php

function get_unavailable_days()
{

  global $wpdb;

  $year = $_POST['year'];
  $month = $_POST['month'];
  $days_array = explode(',', $_POST['days_array']);
  $weekdays_array = explode(',', $_POST['weekdays_array']);
  $today = date('Y-m-d');

  $results = [];

  foreach ($days_array as $key => $day_item) {

    $date = $year . "-" . $month . "-" . $day_item;

    if ($date <= $today || $weekdays_array[$key] == 6 || $weekdays_array[$key] == 7) {
      $results[] = [
        'date' => $date,
        'day' => $day_item,
        'week_day' => $weekdays_array[$key],
        'year' => $year,        
      ];
    }

    $appointements = $wpdb->get_results(
      $wpdb->prepare(
        "SELECT * FROM `wp_demo_appointement` WHERE date = %s",
        $date
      )
    );

    if ($appointements !== []) {
      $slots = $wpdb->get_results(
        $wpdb->prepare(
          "SELECT wp_time_slot.id, TIME_FORMAT(wp_time_slot.time, '%%H:%%i') AS time
            FROM wp_time_slot
            JOIN week_has_slots ON wp_time_slot.id = week_has_slots.time_slots_id
            WHERE week_has_slots.week_day_id = %s
            ORDER BY wp_time_slot.time",
          $weekdays_array[$key],
        )
      );

      if (count($slots) <= count($appointements)) {
        $results[] = [
          'date' => $date,
          'day' => $day_item,
          'week_day' => $weekdays_array[$key],
        ];
      }
    }
  }

  echo json_encode($results);
  wp_die();
}

add_action('wp_ajax_get_unavailable_days', 'get_unavailable_days');
add_action('wp_ajax_nopriv_get_unavailable_days', 'get_unavailable_days');
