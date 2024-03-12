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

// DEMO FORM JS HANDLER SCRIPT
include get_theme_file_path( '/components/functions/demo_form_handler.php' );

// MYSQL 
include get_theme_file_path( '/components/functions/insert_demo_request.php' );
include get_theme_file_path( '/components/functions/get_the_slots.php' );

// EMAILR : 
include get_theme_file_path( '/components/functions/emailr/class.emailr.php' );
include get_theme_file_path( '/components/functions/emailr/conf.emailr.php' );
include get_theme_file_path( '/components/functions/emailr/send_demo_request.php' ); 

// PLUGIN FUNCTION : 
include get_theme_file_path( '/components/functions/block_slot_from_plugin.php' );
include get_theme_file_path( '/components/functions/block_day_from_plugin.php' );
include get_theme_file_path( '/components/functions/unblock_slot_from_plugin.php' );
include get_theme_file_path( '/components/functions/unblock_day_from_plugin.php' );
include get_theme_file_path( '/components/functions/get_all_appointements.php' );
include get_theme_file_path( '/components/functions/cancel_demo_meeting.php' );
include get_theme_file_path( '/components/functions/get_all_days_and_all_slots.php' );
include get_theme_file_path( '/components/functions/get_slots_for_that_day.php' );
include get_theme_file_path( '/components/functions/customise_weekday.php' );

// LANGUAGE SWITCH BUTTON
include get_theme_file_path( '/components/functions/lang_switch_handler.php' );

// GSAP / ANIMATION
include get_theme_file_path( '/components/functions/homepage_scroll_animation.php' );


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