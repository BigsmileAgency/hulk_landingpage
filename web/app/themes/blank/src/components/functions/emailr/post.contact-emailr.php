<?php

  require_once('../core/config.php');
  require_once('../wservice/conf.emailr.php');
  require_once('../wservice/class.emailr.php');

  if ($user_data[0]['lang'] == 'nl') {
    if ($user_data[0]['gender'] == 'M') {
      $user_gender['nl']['gender'] = 'Beste';
    }else {
      $user_gender['nl']['gender'] = 'Beste';
    }
  }else {
    if ($user_data[0]['gender'] == 'M') {
      $user_gender['fr']['gender'] = 'Cher';
    }else {
      $user_gender['fr']['gender'] = 'Chère';
    }
  }

  $emails = array();
  $emailrO = new EmailR( $emailR_data['ACCOUNT_ID'],  $emailR_data['USER'],  $emailR_data['PWD'],  $emailR_data[$lang]['PROFILE_ID'] );
  
  $emails[] = array(
  'Lang' => $user_data[0]['lang'],
  'Gender' => $user_gender[$lang]['gender'],
  'Email' => $user_data[0]['email'],
  'FirstName' => $user_data[0]['fname'],
  'LastName' => $user_data[0]['lname']);

$sendMail = $emailrO->sendEmail($emailR_data[$lang]['CONTACT'], array( 'contacts' => $emails ) );



 ?>
