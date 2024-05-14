<?php

function insert_demo_request()
{
    global $wpdb;

    $first_name =  $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $full_date = date("Y-m-d", strtotime($_POST['full_date']));
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $company = $_POST['company'];
    $is_agency = $_POST['is_agency'];
    $is_consent = ($_POST['is_consent'] === 'true') ? 1 : 0;
    $time = $_POST['time'];
    $lang = $_POST['lang'];

    $time_id = $wpdb->get_var($wpdb->prepare("SELECT id FROM `wp_time_slot` WHERE time = %s", $time));

    $insert = $wpdb->query(
        $wpdb->prepare(
            "INSERT INTO `wp_demo_appointement`(`first_name`, `last_name`, `company`, `is_agency`, `is_consent`, `email`, `phone`, `lang`, `date`, `time_slot_id`) 
            VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
            $first_name,
            $last_name,
            $company,
            $is_agency,
            $is_consent,
            $email,
            $phone,
            $lang,
            $full_date,
            $time_id
        )
    );

    if ($insert) {
        $response ="Nouveau RDV inséré dans la DB";
    } else {
        $response = "Echec";
    }

    echo json_encode($is_consent);
    wp_die();
}

add_action('wp_ajax_insert_demo_request', 'insert_demo_request');
add_action('wp_ajax_nopriv_insert_demo_request', 'insert_demo_request');
