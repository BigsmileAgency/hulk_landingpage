<?php

// Write log function
function write_log($log) {
  if (true === WP_DEBUG) {
      if (is_array($log) || is_object($log)) {
          error_log(print_r($log, true));
      } else {
          error_log($log);
      }
  }
}

// SECURITY CHECK WHEN AJAX
function nonce_check($data) {
  if( !isset( $data['nonce'] ) || !wp_verify_nonce( $data['nonce'], 'main' ) ){
    $response = [
      'status'  => 500,
      'message' => __('Une erreur est survenue !', 'bsa'),
      'error' => true
    ];

    die($response);
  }
}

// TRIM DESCRIPTION SEAO
function trim_description($str){
  $str = str_replace(array('.', ' ', "\n", "\t", "\r", "#"), " ", $str);
  $str = preg_replace('/\s+/', ' ',$str);
  $str = strip_tags($str);
  $str = textTruncate($str, 299, " ", "...");
  $str = htmlentities($str, ENT_COMPAT);
  // &quot; => "
  return  $str;
}

// TRIM TEXT
function textTruncate($string, $limit, $break = " ", $pad = "...") {
  // return with no change if string is shorter than $limit
  if (strlen($string) <= $limit)
      return $string;

  // is $break present between $limit and the end of the string?
  if (false !== ($breakpoint = strpos($string, $break, $limit))) {
      if ($breakpoint < strlen($string) - 1) {
          $string = substr($string, 0, $breakpoint) . $pad;
      }
  }

  return $string;
}