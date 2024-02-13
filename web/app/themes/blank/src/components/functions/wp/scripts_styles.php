<?php 

$theme = wp_get_theme();
define('THEME_VERSION', $theme->Version);


/* Specify CSS bundle path */
function loadStyles() {
  wp_enqueue_style('app', get_template_directory_uri() . '/../dist/css/app.css', array(), THEME_VERSION);

  // Remove unwanted css
  wp_dequeue_style( 'wp-block-library' );
  wp_dequeue_style( 'wp-block-library-theme' );
  wp_dequeue_style( 'wc-blocks-style' );
}

/* Specify JS bundle path */
function loadScripts() {
  wp_register_script('app', get_template_directory_uri() . '/../dist/js/app.js', array('jquery'), THEME_VERSION, true);

  if (!is_admin()) {
    //Making jQuery to load from Google Library
		wp_deregister_script('jquery');
		wp_register_script('jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js', false, '3.6.0');
		wp_enqueue_script('jquery');
	}

  wp_localize_script( 'app', 'app', array(
      'nonce'    => wp_create_nonce( 'app' ),
      'ajax_url' => admin_url( 'admin-ajax.php' )
  ));

  wp_enqueue_script('app');
}

/* Register styles and scripts */
add_action('wp_enqueue_scripts', 'loadStyles');
add_action('wp_enqueue_scripts', 'loadScripts');

// Defer js
function add_defer_attribute($tag, $handle) {
  $scripts_to_defer = array('app');
  foreach($scripts_to_defer as $defer_script) {
    if ($defer_script === $handle) {
      return str_replace(' src', ' defer="defer" src', $tag);
    }
  }
  return $tag;
}
add_filter('script_loader_tag', 'add_defer_attribute', 10, 2);