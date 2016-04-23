<?php
// enqueue styles
if( !function_exists("theme_styles") ) {  
    function theme_styles(){
	wp_register_style( 'main', get_template_directory_uri().'/css/main.css');
	wp_register_style( 'main', get_template_directory_uri().'/css/font-awesome/css/font-awesome.min.css');
    wp_register_style( 'theme-style', get_stylesheet_uri(), array(), '1.011', 'all' );
		wp_enqueue_style( 'main');	
		wp_enqueue_style( 'theme-style');	
    }
}
add_action( 'wp_enqueue_scripts', 'theme_styles' );

?>