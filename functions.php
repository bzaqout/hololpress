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
require_once PARENT_DIR . '/includes/sidebar-init.php';

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

function ArabicDate() {
    $months = array("Jan" => "يناير", "Feb" => "فبراير", "Mar" => "مارس", "Apr" => "أبريل", "May" => "مايو", "Jun" => "يونيو", "Jul" => "يوليو", "Aug" => "أغسطس", "Sep" => "سبتمبر", "Oct" => "أكتوبر", "Nov" => "نوفمبر", "Dec" => "ديسمبر");
    $your_date = date('y-m-d'); // The Current Date
    $en_month = date("M", strtotime($your_date));
    foreach ($months as $en => $ar) {
        if ($en == $en_month) { $ar_month = $ar; }
    }

    $find = array ("Sat", "Sun", "Mon", "Tue", "Wed" , "Thu", "Fri");
    $replace = array ("السبت", "الأحد", "الإثنين", "الثلاثاء", "الأربعاء", "الخميس", "الجمعة");
    $ar_day_format = date('D',time()+60*60*$diff=3); // The Current Day
    $ar_day = str_replace($find, $replace, $ar_day_format);
	if(date('a',time()+60*60*$diff=3)=='pm') $dd = 'مساء'; else $dd = 'صباحا';
    $standard = array("0","1","2","3","4","5","6","7","8","9");
    $eastern_arabic_symbols = array("٠","١","٢","٣","٤","٥","٦","٧","٨","٩");
    $current_date = date('d',time()+60*60*$diff=3).'-'.date('m',time()+60*60*$diff=3).'-'.date('Y',time()+60*60*$diff=3).' '.$ar_day.' , '.date('h:i' ,time()+60*60*$diff=3).' ' . $dd;
    $arabic_date = str_replace($standard , $eastern_arabic_symbols , $current_date);

    return $arabic_date;
}

?>