<?php 

// // SMTP Setup
// add_action( 'phpmailer_init', 'mailer_config', 10, 1);
// function mailer_config($mailer){
//   $mailer->IsSMTP();
//   $mailer->Host = SMTP_HOST;
//   $mailer->Port = SMTP_PORT;
//   $mailer->SMTPAuth = true;
//   $mailer->Username = SMTP_USER;
//   $mailer->Password = SMTP_PASS;
//   $mailer->SMTPDebug = 0;
//   $mailer->CharSet  = "utf-8";
//   $mailer->SMTPSecure = SMTP_SECURE;
// }

// // Send Mail
// function sendMail($user_info, $password, $subject, $type) {
//   $to = $user_info['email'];

//   ob_start();
//   get_template_part('emails/' . $type, null, array(
// 		'user' => $user_info,
// 		'password' => $password,
// 		'title' => $type
// 	));
//   $email_content = ob_get_contents();
//   ob_end_clean();
  
//   $headers  = 'MIME-Version: 1.0' . "\r\n";
//   $headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
//   $headers .= 'From: Bigsmile <info@bigsmile.be>' . "\r\n";
  
//   $mail = wp_mail($to, $subject, $email_content, $headers);

//   $response = array(
//     'email_content' => $email_content,
//     'user_info' => $user_info,
//     'password' => $password,
//     'subject' => $subject,
//     'type' => $type,
//     'error' => false,
//     'type'    => 'default',
//     'message'   => __('test', 'bsa')
//   );

// // dump($body);
//   return $response;
// }