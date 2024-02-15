<?php


function send_demo_request()
{

    $emailR_data = array();
    $emailR_data["fr"] = array();
    $emailR_data["fr"]["CONTACT"] = "6cd82bc9-cc78-40ae-b016-dea907ca017f"; 
    $emailR_data["USER"] = "info@bigsmile.be"; // Account creditential
    $emailR_data["PWD"] = "bsaRFLX@2024"; // Account creditential
    $emailR_data["ACCOUNT_ID"] = "C1DE4A05-049F-4F75-86E9-3B140C481FC2"; // Account ID
    $emailR_data["fr"]["PROFILE_ID"] = "22EFD984-B8A1-42B1-A8B5-958287D5DFF2";  // Profile ID

    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $full_date = date("d-m-Y", strtotime($_POST['full_date']));
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $company = $_POST['company'];
    $is_consent = $_POST['is_consent'];
    $time = $_POST['time'];

    $emailrO = new EmailR( $emailR_data['ACCOUNT_ID'],  $emailR_data['USER'],  $emailR_data['PWD'],  $emailR_data["fr"]['PROFILE_ID'] );

    $emails[] = [
        "Email" => "jr@bigsmile.be",
        "message" => "Vous avez reçu une demande de RDV pour une démo de HulkBanner de la part de : ",
        "first_name" => $first_name,
        "last_name" => $last_name,
        "company" => $company,
        "usermail" => $email,
        "phone" => $phone,
        "date" => $full_date,
        "time" => $time,
    ];

    $sendMail = $emailrO->sendEmail($emailR_data["fr"]["CONTACT"], array('contacts' => $emails ));
 

    echo json_encode($sendMail);
    wp_die();
}

add_action('wp_ajax_send_demo_request', 'send_demo_request');
add_action('wp_ajax_nopriv_send_demo_request', 'send_demo_request');

