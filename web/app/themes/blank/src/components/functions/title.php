<?php // WordPress custom title script
$site_name = get_the_title() . ' - ' . get_bloginfo('name'); 

// is the current page a tag archive page?
if (is_front_page() || is_home()) { 
	$site_name = get_bloginfo('name');
} 


// dump($site_name);
?>

<title><?= get_bloginfo('name') ?></title>
