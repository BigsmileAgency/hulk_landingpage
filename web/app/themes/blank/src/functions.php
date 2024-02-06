<?php

// ENQUEUE SCRIPTS + STYLES
include get_theme_file_path( '/components/functions/wp/scripts_styles.php' );

// LOGIN PAGE CUSTOM
include get_theme_file_path( '/components/functions/wp/login.php' );

// CUSTOM WP
include get_theme_file_path( '/components/functions/wp/customize.php' );

// EMAILS SETUP
include get_theme_file_path( '/components/functions/wp/emails.php' );

// WP USEFULL
include get_theme_file_path( '/components/functions/wp/usefull.php' );

// CUSTOM MENUS
include get_theme_file_path( '/components/functions/custom_menu.php' );

// CUSTOM POST
include get_theme_file_path( '/components/functions/custom_post_type.php' );

// AJAX CATEGORY FILTER
// include get_theme_file_path( '/components/functions/ajaxFilter.php' );


// // Thumbnails sizes
// add_image_size( 'thumb__product_block', 500, 9999 );
// add_image_size( 'thumb__full', 1920, 9999 );

// // ACF OPTIONS PAGE REGISTER
// if( function_exists('acf_add_options_page') ) {
// 	acf_add_options_page(array(
// 		'page_title' 	=> 'Infos',
// 		'menu_title'	=> 'Infos',
// 		'menu_slug' 	=> 'Infos',
// 		'capability'	=> 'edit_posts',
// 		'redirect'		=> false
// 	));	
// }



?>
