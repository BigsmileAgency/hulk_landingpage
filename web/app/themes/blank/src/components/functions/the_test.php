<?php

function the_test()
{

    $first_name =$_POST['first_name'];
    $last_name =$_POST['last_name'];

    $response = [$first_name, $last_name];
  
    echo json_encode($response);
    wp_die();
}

add_action('wp_ajax_the_test', 'the_test');
add_action('wp_ajax_nopriv_the_test', 'the_test');

