<?php 

function register_my_menus() {
	register_nav_menus(
    	array(
      	'nav' => __( 'Header Menu' ),
		'login' => __('Login Menu'),
		'burger' => __('Burger Menu'),
      	'footer' => __( 'Footer Menu' ),
     	)
   	);
}
 
add_action( 'init', 'register_my_menus' );

?>