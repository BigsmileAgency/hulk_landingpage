<?php 

function register_my_menus() {
	register_nav_menus(
    	array(
      	'header' => __( 'Header_nav Menu' ),
     	)
   	);
}
 
add_action( 'init', 'register_my_menus' );

?>