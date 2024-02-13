<?php

function get_the_slots() {

    $response = 'test get the slots';

    echo json_encode($response);
    wp_die();

}

add_action('wp_ajax_get_the_slots', 'get_the_slots');
add_action('wp_ajax_nopriv_get_the_slots', 'get_the_slots');