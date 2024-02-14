<?php

function insert_demo_request()
{

    global $wpdb;

    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $full_date = date("Y-m-d", strtotime($_POST['full_date']));
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $company = $_POST['company'];
    $is_consent = $_POST['is_consent'];
    $time = $_POST['time'];

    if ($is_consent === "true") {
        // insert in mailing list
    }

    $time_id = $wpdb->get_var($wpdb->prepare("SELECT id FROM `wp_time_slot` WHERE time = %s", $time));

    $insert = $wpdb->query(
        $wpdb->prepare(
            "INSERT INTO `wp_demo_appointement`(`first_name`, `last_name`, `company`, `email`, `phone`, `date`, `time_slot_id`) 
            VALUES (%s, %s, %s, %s, %s, %s, %s)",
            $first_name,
            $last_name,
            $company,
            $email,
            $phone,
            $full_date,
            $time_id
        )
    );

    $response = [$insert];

    echo json_encode($response);
    wp_die();
}

add_action('wp_ajax_insert_demo_request', 'insert_demo_request');
add_action('wp_ajax_nopriv_insert_demo_request', 'insert_demo_request');
