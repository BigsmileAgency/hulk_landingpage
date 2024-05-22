<?php


function send_demo_request()
{
    date_default_timezone_set('Europe/Brussels');
    global $wpdb;

    // $POST //
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $insert_date = date("Y-m-d", strtotime($_POST['full_date']));
    $mail_date = date("d-m-Y", strtotime($_POST['full_date']));
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $company = $_POST['company'];
    $is_agency = $_POST['is_agency'];
    $is_consent = ($_POST['is_consent'] === 'true') ? 1 : 0;
    $time = $_POST['time'];
    $lang = $_POST['lang'];
    $id = uniqid();

    // INSERT DB //
    $time_id = $wpdb->get_var($wpdb->prepare("SELECT id FROM `wp_time_slot` WHERE time = %s", $time));

    $insert = $wpdb->query(
        $wpdb->prepare(
            "INSERT INTO `wp_demo_appointement`(`id`,`first_name`, `last_name`, `company`, `is_agency`, `is_consent`, `email`, `phone`, `lang`, `date`, `time_slot_id`) 
                VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
            $id,
            $first_name,
            $last_name,
            $company,
            $is_agency,
            $is_consent,
            $email,
            $phone,
            $lang,
            $insert_date,
            $time_id
        )
    );
    $apointementId = $wpdb->insert_id;

    // ICS FILE (ADD TO AGENDA) //
    $ics_start = strtotime($mail_date . " " . $time);
    $ics_end = strtotime('+30 minutes', $ics_start);
    $ics_id = uniqid();

    $ics_content = "BEGIN:VCALENDAR\n" .
        "VERSION:2.0\n" .
        "BEGIN:VEVENT\n" .
        "SUMMARY:" . $_POST['first_name'] . " " . $_POST['last_name'] . "\n" .
        "UID:" . $ics_id . "\n" .
        "DTSTAMP:20240419T120000Z\n" .
        "DTSTART:" . date("Ymd\THis", $ics_start) . "\n" .
        "DTEND:" . date("Ymd\THis", $ics_end) . "\n" .
        "DESCRIPTION:RDV avec FoxBanner\n" .
        "ORGANIZER:FoxBanner\n" .
        "STATUS:CONFIRMED\n" .
        "PRIORITY:0\n" .
        "LOCATION:Online\n" .
        "END:VEVENT\n" .
        "END:VCALENDAR";

    $ics_url = get_theme_file_path("/components/functions/emailr/ics_files/fba-" . $ics_id . ".ics");

    file_put_contents($ics_url, $ics_content);

    // Clean ics folder of outdated appointement:
    // include get_theme_file_path("/components/functions/cleaning.php");

    // EMAILR VAR //
    $emailR_data = array();
    $emailR_data["fr"] = array();

    $emailR_data["fr"]["FOR_US"] = "515f498f-ad96-4add-ac16-6c402162a8d9";

    $emailR_data["fr"]["FOR_CLIENT"] = "7fe57583-1e52-4406-8976-58488627f0e8";
    $emailR_data["nl"]["FOR_CLIENT"] = "a5fd7c05-a118-49d9-88bc-5c15f977d991";
    $emailR_data["en"]["FOR_CLIENT"] = "589fa875-bbaa-4cb9-bbbe-cc6cb8f7ae94";

    $emailR_data["USER"] = "info@bigsmile.be"; // Account creditential
    $emailR_data["PWD"] = "bsaRFLX@2024"; // Account creditential
    $emailR_data["ACCOUNT_ID"] = "C1DE4A05-049F-4F75-86E9-3B140C481FC2"; // Account ID
    $emailR_data["fr"]["PROFILE_ID"] = "22EFD984-B8A1-42B1-A8B5-958287D5DFF2";  // Profile ID


    // MAIL FOR US
    $emailrOforUs = new EmailR($emailR_data['ACCOUNT_ID'],  $emailR_data['USER'],  $emailR_data['PWD'],  $emailR_data["fr"]['PROFILE_ID']);
    $emails_for_us[] = [
        "Email" => "jr@bigsmile.be",
        "message" => "Vous avez reçu une demande de RDV pour une démo de HulkBanner de la part de : ",
        "first_name" => $first_name,
        "last_name" => $last_name,
        "company" => $company,
        "usermail" => $email,
        "phone" => $phone,
        "lang" => $lang,
        "date" => $mail_date,
        "time" => $time,
    ];
    $sendMailToUs = $emailrOforUs->sendEmail($emailR_data["fr"]["FOR_US"], array('contacts' => $emails_for_us));


    // MAIL FOR CLIENT
    $emailrOforThem = new EmailR($emailR_data['ACCOUNT_ID'],  $emailR_data['USER'],  $emailR_data['PWD'],  $emailR_data["fr"]['PROFILE_ID']);

    $emails_for_them[] = [
        "Email" => $email,
        "first_name" => $first_name,
        "last_name" => $last_name,
        "date" => $mail_date,
        "time" => $time,
        "ics_url" =>  get_template_directory_uri() . "/components/functions/emailr/ics_files/fba-" . $ics_id . ".ics",
        "id" => $apointementId,
    ];

    $sendMailToCLient = $emailrOforThem->sendEmail($emailR_data[$lang]["FOR_CLIENT"], array('contacts' => $emails_for_them));

    echo json_encode([$insert, $sendMailToUs, $sendMailToCLient, $apointementId]);
    wp_die();
}

add_action('wp_ajax_send_demo_request', 'send_demo_request');
add_action('wp_ajax_nopriv_send_demo_request', 'send_demo_request');
