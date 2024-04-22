<?php

// Clean Ics Folder from outdated appointements
$files_ics = get_theme_file_path("/components/functions/emailr/ics_files/");;
$files = scandir($files_ics);
$date_actuelle_utc = gmdate('Ymd\THis');

foreach ($files as $file) {

  if ($file == '.' || $file == '..') {
    continue;
  }

  $path_file = $files_ics . $file;

  if (pathinfo($path_file, PATHINFO_EXTENSION) != 'ics') {
    continue;
  }

  $contenu_file = file_get_contents($path_file);

  if (preg_match('/DTEND:(\d{8}T\d{6})/', $contenu_file, $matches)) {
    $date_rdv = $matches[1];

    if ($date_rdv < $date_actuelle_utc) {
      unlink($path_file);
    }
  }
}


// Clean DB from BSA placeholders in appoitement table
global $wpdb;

$name = "BSA";
$today = (new DateTime())->format('Y-m-d'); 

$delete = $wpdb->query(
  $wpdb->prepare(
    "DELETE FROM `wp_demo_appointement` WHERE `first_name` = %s AND `date` < %s",
    $name,
    $today
  )
);

if($delete){
  $response = "effacé";
} else {
  $response = "problème";
}

echo $response;