<?php

/* Change WordPress Admin Login Logo */
add_action( 'login_enqueue_scripts', 'login_logo_change' );
function login_logo_change() {

  $logo_url = get_template_directory_uri() . '/../dist/images/layout/logo.svg';
   ?>
    <style type="text/css">
        #login h1 a, .login h1 a {
           background-image: url(<?= $logo_url ?>);
           width: 240px;
           height: 55px;
           background-size: contain;
           background-repeat: no-repeat;
           background-color: transparent;
      }
    </style>
   <?php
}

function admin_login_logo_url() {
  return home_url();
}
add_filter( 'login_headerurl', 'admin_login_logo_url' );