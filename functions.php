<?php


 define('PARENT_DIR', get_template_directory());
 if ( STYLESHEETPATH == TEMPLATEPATH ) {
	define('OF_FILEPATH', TEMPLATEPATH);
	define('OF_DIRECTORY', get_template_directory_uri());
} else {
	define('OF_FILEPATH', STYLESHEETPATH);
	define('OF_DIRECTORY', get_stylesheet_directory_uri());
}
require_once (OF_FILEPATH . '/admin/admin-functions.php');		// Custom functions and plugins
require_once (OF_FILEPATH . '/admin/admin-interface.php');		// Admin Interfaces (options,framework, seo)
require_once (OF_FILEPATH . '/admin/theme-options.php'); 		// Options panel settings and custom settings
require_once (OF_FILEPATH . '/admin/theme-functions.php'); 	// Theme actions based on options settings

define( 'RWMB_URL', trailingslashit( get_template_directory_uri() . '/admin/meta-box/' ) );
define( 'RWMB_DIR', trailingslashit( get_template_directory(). '/admin/meta-box/' ) );

require_once RWMB_DIR . 'meta-box.php';
include PARENT_DIR.'/includes/metabox.php';

require_once PARENT_DIR . '/includes/theme-function.php';
require_once PARENT_DIR . '/includes/theme-scripts.php';
require_once PARENT_DIR . '/includes/theme-styles.php';
require_once PARENT_DIR . '/includes/register-widgets.php';
require_once PARENT_DIR . '/includes/aq_resizer.php';

add_action("login_head", "my_login_head");
function my_login_head() {
	echo "
	<style>
	body.login #login h1 a {
		background: url('".get_bloginfo('template_url')."/images/logo.png') no-repeat top center;
		height: 90px;
		width: 400px;
	}
	</style>
	";
}
?>