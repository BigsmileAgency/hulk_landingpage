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
    $is_agency = $_POST['is_agency'];
    $is_consent = $_POST['is_consent'];
    $time = $_POST['time'];
    $lang = $_POST['lang'];

    if ($is_consent === "true") {
        // insert in mailing list
    }

    if($is_agency === "true"){
        $is_agency = '1';
    } else {
        $is_agency = '0';
    }

    $time_id = $wpdb->get_var($wpdb->prepare("SELECT id FROM `wp_time_slot` WHERE time = %s", $time));

    $insert = $wpdb->query(
        $wpdb->prepare(
            "INSERT INTO `wp_demo_appointement`(`first_name`, `last_name`, `company`, `is_agency`, `email`, `phone`, `lang`, `date`, `time_slot_id`) 
            VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s)",
            $first_name,
            $last_name,
            $company,
            $is_agency,
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

    echo json_encode($response);
    wp_die();
}

add_action('wp_ajax_insert_demo_request', 'insert_demo_request');
add_action('wp_ajax_nopriv_insert_demo_request', 'insert_demo_request');
