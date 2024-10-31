<?php
/*
Plugin Name: Calendar Handler
Description: Handle calendar entries
Author: Jon JR Rauzy
*/

function calendar_handler()
{
	add_menu_page('Calendar Handler', 'Calendar Handler', 'manage_options', 'calendar_handler', 'calendar_handler_options');
}

function calendar_handler_options()
{

	include('calendar_interface.php');
	include('calendar_js.php');

}

add_action('admin_menu', 'calendar_handler');
