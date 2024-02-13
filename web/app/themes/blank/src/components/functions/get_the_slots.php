<?php

function get_the_slots()
{

    global $wpdb;

    $date = $_POST['date'];
    $all_slots = $wpdb->get_results($wpdb->prepare("SELECT * FROM `wp_time_slot`"));
    $check_date = $wpdb->get_results($wpdb->prepare("SELECT * FROM `wp_demo_appointement` WHERE `date` = %s;", $date));

    $taken_slots = [];

    if (!empty($check_date)) {
        foreach ($check_date as $appointement) {
            // $taken_slots[] = $appointement->time_slot_id;
            $taken_slots[] = $wpdb->get_var($wpdb->prepare("SELECT time FROM `wp_time_slot` WHERE id = %s", $appointement->time_slot_id));
        }
    }

    $response = [
        "all_slots" => $all_slots,
        "taken_slot" => $taken_slots,
    ];

    echo json_encode($response);
    wp_die();
}

add_action('wp_ajax_get_the_slots', 'get_the_slots');
add_action('wp_ajax_nopriv_get_the_slots', 'get_the_slots');
