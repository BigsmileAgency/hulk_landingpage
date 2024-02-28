<?php


function send_demo_request()
{

    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $full_date = date("d-m-Y", strtotime($_POST['full_date']));
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $company = $_POST['company'];
    $time = $_POST['time'];
    $lang = $_POST['lang'];

    $emailR_data = array();
    $emailR_data["fr"] = array();

    $emailR_data["fr"]["FOR_US"] = "515f498f-ad96-4add-ac16-6c402162a8d9"; 

    $emailR_data["fr"]["FOR_CLIENT"] = "7fe57583-1e52-4406-8976-58488627f0e8"; 
    $emailR_data["nl"]["FOR_CLIENT"] = "a5fd7c05-a118-49d9-88bc-5c15f977d991"; 
    $emailR_data["en"]["FOR_CLIENT"] = "5ee5f165-e37c-4b14-b5df-3a3e360e4be2"; 

    $emailR_data["USER"] = "info@bigsmile.be"; // Account creditential
    $emailR_data["PWD"] = "bsaRFLX@2024"; // Account creditential
    $emailR_data["ACCOUNT_ID"] = "C1DE4A05-049F-4F75-86E9-3B140C481FC2"; // Account ID
    $emailR_data["fr"]["PROFILE_ID"] = "22EFD984-B8A1-42B1-A8B5-958287D5DFF2";  // Profile ID


    // FOR US
    $emailrOforUs = new EmailR( $emailR_data['ACCOUNT_ID'],  $emailR_data['USER'],  $emailR_data['PWD'],  $emailR_data["fr"]['PROFILE_ID'] );
    $emails_for_us[] = [
        "Email" => "jr@bigsmile.be",
        "message" => "Vous avez reçu une demande de RDV pour une démo de HulkBanner de la part de : ",
        "first_name" => $first_name,
        "last_name" => $last_name,
        "company" => $company,
        "usermail" => $email,
        "phone" => $phone,
        "lang" => $lang,
        "date" => $full_date,
        "time" => $time,
    ];
    $sendMailToUs = $emailrOforUs->sendEmail($emailR_data["fr"]["FOR_US"], array('contacts' => $emails_for_us ));


    // FOR THEM
    $emailrOforThem = new EmailR( $emailR_data['ACCOUNT_ID'],  $emailR_data['USER'],  $emailR_data['PWD'],  $emailR_data["fr"]['PROFILE_ID'] );
    
    $emails_for_them[] = [
        "Email" => $email,
        "first_name" => $first_name,
        "last_name" => $last_name,
        "date" => $full_date,
        "time" => $time,       
    ];
    $sendMailToCLient = $emailrOforThem->sendEmail($emailR_data[$lang]["FOR_CLIENT"], array('contacts' => $emails_for_them ));

    echo json_encode([$sendMailToCLient, $sendMailToCLient]);
    wp_die();
}

add_action('wp_ajax_send_demo_request', 'send_demo_request');
add_action('wp_ajax_nopriv_send_demo_request', 'send_demo_request');

