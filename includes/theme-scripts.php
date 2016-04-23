<?php
// enqueue javascript
function theme_scripts(){

	if (!is_admin()) {
        wp_deregister_script('jquery');
        wp_register_script('jquery', get_template_directory_uri() . '/includes/js/jquery-1.11.1.min.js', array(), '1.11.1',$in_footer = true);
		
		wp_register_script( 'prettyPhoto',get_template_directory_uri() . '/includes/js/jquery.prettyPhoto.js',array('jquery'), '',$in_footer = true );
        wp_enqueue_script('prettyPhoto');

        wp_register_script( 'flexslider',get_template_directory_uri() . '/includes/js/jquery.flexslider-min.js',array('jquery'), '',$in_footer = true );
        wp_enqueue_script('flexslider');
				
        // Script for inits
		wp_register_script( 'custom',get_template_directory_uri() . '/includes/js/custom.js',array('jquery'), '',$in_footer = true );
        wp_enqueue_script('custom'); 
    }
	
  }
add_action( 'wp_enqueue_scripts', 'theme_scripts' );

function admin_scripts() {
	wp_enqueue_script( 'custom.admin',get_template_directory_uri() . '/includes/js/jquery.custom.admin.js');
}
add_action('admin_enqueue_scripts', 'admin_scripts');
?>