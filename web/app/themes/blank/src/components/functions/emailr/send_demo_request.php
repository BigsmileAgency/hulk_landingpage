<?php


function send_demo_request()
{
	date_default_timezone_set('Europe/Brussels');
	global $wpdb;

	// $POST //
	$first_name = sanitize_text_field($_POST['first_name']);
	$last_name = sanitize_text_field($_POST['last_name']);
	$insert_date = date("Y-m-d");
	$mail_date = date("d-m-Y");
	$phone = sanitize_text_field($_POST['phone']);
	$email = sanitize_email($_POST['email']);
	$company = sanitize_text_field($_POST['company']);
	$is_agency = $_POST['is_agency'];
	$is_consent = ($_POST['is_consent'] === 'true') ? 1 : 0;
	// $time = $_POST['time'];
	$lang = $_POST['lang'];
	$id = md5(uniqid(rand(), true));

	// INSERT DB //
	// $time_id = $wpdb->get_var($wpdb->prepare("SELECT id FROM `wp_time_slot` WHERE time = %s", $time));

	$insert = $wpdb->query(
		$wpdb->prepare(
			"INSERT INTO `wp_demo_appointement`(`id`, `first_name`, `last_name`, `company`, `is_agency`, `is_consent`, `email`, `phone`, `lang`, `date`, `time_slot_id`) 
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
			'1',
		)
	);


	// ICS FILE (ADD TO AGENDA) //
	// $ics_start = strtotime($mail_date . " " . $time);
	// $ics_end = strtotime('+30 minutes', $ics_start);
	// $ics_id = uniqid();

	// $description = "";
	// if ($lang == "fr") {
	// 	$description = "Vous avez RDV avec FoxBanner";
	// } else if ($lang == "nl") {
	// 	$description = "U heeft een afspraak met FoxBanner";
	// } else {
	// 	$description = "You have an appoitement with FoxBanner";
	// }

	// $ics_content = "BEGIN:VCALENDAR\n" .
	// 	"VERSION:2.0\n" .
	// 	"BEGIN:VEVENT\n" .
	// 	"SUMMARY:" . $_POST['first_name'] . " " . $_POST['last_name'] . "\n" .
	// 	"UID:" . $ics_id . "\n" .
	// 	"DTSTAMP:20240419T120000Z\n" .
	// 	"DTSTART:" . date("Ymd\THis", $ics_start) . "\n" .
	// 	"DTEND:" . date("Ymd\THis", $ics_end) . "\n" .
	// 	"DESCRIPTION:" . $description . "\n" .
	// 	"ORGANIZER:FoxBanner\n" .
	// 	"STATUS:CONFIRMED\n" .
	// 	"PRIORITY:0\n" .
	// 	"LOCATION:Online\n" .
	// 	"END:VEVENT\n" .
	// 	"END:VCALENDAR";

	// $ics_url = get_theme_file_path("/components/functions/emailr/ics_files/fba-" . $ics_id . ".ics");

	// file_put_contents($ics_url, $ics_content);

	// // Clean ics folder of outdated appointement:
	// // include get_theme_file_path("/components/functions/cleaning.php");

	// // EMAILR VAR //
	$emailR_data = array();
	$emailR_data["fr"] = array();

	$emailR_data["fr"]["FOR_US"] = "33e47a07-fc83-4889-a419-f1639bf1ded7";

	// $emailR_data["en"]["FOR_CLIENT"] = "da7b5d1e-7349-4755-aa7d-d4237c4b913d";
	// $emailR_data["fr"]["FOR_CLIENT"] = "d8dd8016-af49-424f-9215-8c3ebff11371";
	// $emailR_data["nl"]["FOR_CLIENT"] = "c589e2f2-dbc4-4c9b-9723-1ce7d8fc42e9";

	$emailR_data["USER"] = "info@bigsmile.be";
	$emailR_data["PWD"] = "bsaRFLX@2024";
	$emailR_data["ACCOUNT_ID"] = "C1DE4A05-049F-4F75-86E9-3B140C481FC2"; // Account ID
	$emailR_data["fr"]["PROFILE_ID"] = "22EFD984-B8A1-42B1-A8B5-958287D5DFF2";  // Profile ID

	// MAIL FOR US
	$emailrOforUs = new EmailR($emailR_data['ACCOUNT_ID'],  $emailR_data['USER'],  $emailR_data['PWD'],  $emailR_data["fr"]['PROFILE_ID']);
	$emails_for_us[] = [
		"Email" => "jr@bigsmile.be",
		"message" => "Vous avez reçu une demande de démo pour une démo de FoxBanner de la part de : ",
		"first_name" => $first_name,
		"last_name" => $last_name,
		"company" => $company,
		"usermail" => $email,
		"phone" => $phone,
		"lang" => $lang,
	];
	$sendMailToUs = $emailrOforUs->sendEmail($emailR_data["fr"]["FOR_US"], array('contacts' => $emails_for_us));


	// // MAIL FOR CLIENT
	// $emailrOforThem = new EmailR($emailR_data['ACCOUNT_ID'],  $emailR_data['USER'],  $emailR_data['PWD'],  $emailR_data["fr"]['PROFILE_ID']);

	// $emails_for_them[] = [
	// 	"Email" => htmlspecialchars($email, ENT_XML1, 'UTF-8'),
	// 	"first_name" => htmlspecialchars($first_name, ENT_XML1, 'UTF-8'),
	// 	"last_name" => htmlspecialchars($last_name, ENT_XML1, 'UTF-8'),
	// 	"date" => htmlspecialchars($mail_date, ENT_XML1, 'UTF-8'),
	// 	"time" => htmlspecialchars($time, ENT_XML1, 'UTF-8'),
	// 	"ics_url" => htmlspecialchars(get_template_directory_uri() . "/components/functions/emailr/ics_files/fba-" . $ics_id . ".ics", ENT_XML1, 'UTF-8'),
	// 	"update_url" => $lang == "en" ? htmlspecialchars(get_home_url() . "/edit/?what=update&id=" . $id, ENT_XML1, 'UTF-8') : htmlspecialchars(get_home_url() . "/" . $lang . "/edit/?what=update&id=" . $id, ENT_XML1, 'UTF-8'),
	// 	"cancel_url" => $lang == "en" ? htmlspecialchars(get_home_url() . "/edit/?what=cancel&id=" . $id, ENT_XML1, 'UTF-8') : htmlspecialchars(get_home_url() . "/" . $lang . "/edit/?what=cancel&id=" . $id, ENT_XML1, 'UTF-8'),
	// 	"id" => htmlspecialchars($id, ENT_XML1, 'UTF-8'),
	// ];

	// $sendMailToCLient = $emailrOforThem->sendEmail($emailR_data[$lang]["FOR_CLIENT"], array('contacts' => $emails_for_them));

	echo json_encode($sendMailToUs);
	wp_die();
}

add_action('wp_ajax_send_demo_request', 'send_demo_request');
add_action('wp_ajax_nopriv_send_demo_request', 'send_demo_request');
