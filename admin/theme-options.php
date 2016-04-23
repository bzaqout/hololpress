<?php

add_action('init','of_options');

if (!function_exists('of_options')) {
function of_options(){
	
// VARIABLES
$themename = get_theme_data(STYLESHEETPATH . '/style.css');
$themename = $themename['Name'];
$shortname = "of";

// Populate OptionsFramework option in array for use in theme
global $of_options;
$of_options = get_option('of_options');

$GLOBALS['template_path'] = OF_DIRECTORY;

//Access the WordPress Categories via an Array
$of_categories = array();  
$of_categories_obj = get_categories('hide_empty=0');
foreach ($of_categories_obj as $of_cat) {
    $of_categories[$of_cat->cat_ID] = $of_cat->cat_name;}
       
//Access the WordPress Pages via an Array
$of_pages = array();
$of_pages_obj = get_pages('sort_column=post_parent,menu_order');    
foreach ($of_pages_obj as $of_page) {
    $of_pages[$of_page->ID] = $of_page->post_title; }


//Stylesheets Reader
$alt_stylesheet_path = OF_FILEPATH . '/styles/';
$alt_stylesheets = array();

if ( is_dir($alt_stylesheet_path) ) {
    if ($alt_stylesheet_dir = opendir($alt_stylesheet_path) ) { 
        while ( ($alt_stylesheet_file = readdir($alt_stylesheet_dir)) !== false ) {
            if(stristr($alt_stylesheet_file, ".css") !== false) {
                $alt_stylesheets[] = $alt_stylesheet_file;
            }
        }    
    }
}

//More Options
$uploads_arr = wp_upload_dir();

if (isset($uploads_arr['path'])) {
	$all_uploads_path = $uploads_arr['path'];
}

$all_uploads = get_option('of_uploads');
$other_entries = array("Select a number:","1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","16","17","18","19");
$body_repeat = array("no-repeat","repeat-x","repeat-y","repeat");
$body_pos = array("top left","top center","top right","center left","center center","center right","bottom left","bottom center","bottom right");



// Set the Options Array
$options = array();

/*------------- start general settings ----------------*/
$options[] = array( "name" => __("General Settings", "divvat"),
                    "type" => "heading");
					
$options[] = array( "name" => __("Custom Logo", "divvat"),
					"id" => $shortname."_logo",
					"std" => "",
					"type" => "upload");
					
$options[] = array( "name" => __("Custom Favicon", "divvat"),
					"id" => $shortname."_custom_favicon",
					"std" => "",
					"type" => "upload"); 

$options[] = array( "name" => __("English Address", "divvat"),
					"id" => $shortname."_address",
					"std" => "",
					"type" => "textarea");	

$options[] = array( "name" => __("Arabic Address", "divvat"),
					"id" => $shortname."_address_ar",
					"std" => "",
					"type" => "textarea");	
										
$options[] = array( "name" => __("hotline", "divvat"),
					"id" => $shortname."_hotline",
					"std" => "",
					"type" => "textarea");	
															
$options[] = array( "name" => __("Tracking Code", "divvat"),
					"desc" => __("Paste your Google Analytics (or other) tracking code here. This will be added into the footer template of your theme.", "divvat"),
					"id" => $shortname."_google_analytics",
					"std" => "",
					"type" => "textarea");	
					
$options[] = array( "name" => __("English Copyright text", "divvat"),
					"id" => $shortname."_copyright_en",
					"std" => "",
					"type" => "textarea");	

$options[] = array( "name" => __("Arabic Copyright text", "divvat"),
					"id" => $shortname."_copyright",
					"std" => "",
					"type" => "textarea");

$options[] = array( "name" => __("Latest News in Our Blog", "divvat"),
					"id" => $shortname."_latest_news",
					"std" => "",
					"type" => "text");					

$options[] = array( "name" => __("Latest work portfolio", "divvat"),
					"id" => $shortname."_work_portfolio",
					"std" => "",
					"type" => "text");	

$options[] = array( "name" => __("find location on map", "divvat"),
					"id" => $shortname."_find_location",
					"std" => "",
					"type" => "text");										

$options[] = array( "name" => __("request for a service", "divvat"),
					"id" => $shortname."_request_service",
					"std" => "",
					"type" => "text");																						  
/*------------- start social media icons ----------------*/
$options[] = array( "name" => __("Social media links", "divvat"),
                    "type" => "heading");
					
$options[] = array( "name" => __("Facebook", "divvat"),
					"id" => $shortname."_facebook",
					"std" => "",
					"type" => "text");	

$options[] = array( "name" => __("Twitter", "divvat"),
					"id" => $shortname."_twitter",
					"std" => "",
					"type" => "text");	
					
$options[] = array( "name" => __("Instagram", "divvat"),
					"id" => $shortname."_instagram",
					"std" => "",
					"type" => "text");
										
$options[] = array( "name" => __("Youtube", "divvat"),
					"id" => $shortname."_youtube",
					"std" => "",
					"type" => "text");

$options[] = array( "name" => __("Linkedin", "divvat"),
					"id" => $shortname."_linkedin",
					"std" => "",
					"type" => "text");	
					
$options[] = array( "name" => __("Google plus", "divvat"),
					"id" => $shortname."_gplus",
					"std" => "",
					"type" => "text");
										
/*------------- start general settings ----------------*/
$options[] = array( "name" => __("Home Page", "divvat"),
                    "type" => "heading");	

$options[] = array( "name" => __("about page id", "divvat"),
					"id" => $shortname."_about",
					"std" => "",
					"type" => "text"); 
					
$options[] = array( "name" => __("Portfolio Desc", "divvat"),
					"id" => $shortname."_portfolio",
					"std" => "",
					"type" => "textarea"); 

$options[] = array( "name" => __("Contact Desc", "divvat"),
					"id" => $shortname."_contact_desc",
					"std" => "",
					"type" => "textarea"); 

$options[] = array( "name" => __("Contact Form", "divvat"),
					"id" => $shortname."_contact_form",
					"std" => "",
					"type" => "textarea"); 
					
/*------------- start general settings ----------------*/
$options[] = array( "name" => __("Arabic Home Page", "divvat"),
                    "type" => "heading");	

$options[] = array( "name" => __("about page id", "divvat"),
					"id" => $shortname."_about_ar",
					"std" => "",
					"type" => "text"); 
					
$options[] = array( "name" => __("Portfolio Desc", "divvat"),
					"id" => $shortname."_portfolio_ar",
					"std" => "",
					"type" => "textarea"); 

$options[] = array( "name" => __("Contact Desc", "divvat"),
					"id" => $shortname."_contact_desc_ar",
					"std" => "",
					"type" => "textarea"); 

$options[] = array( "name" => __("Contact Form", "divvat"),
					"id" => $shortname."_contact_form_ar",
					"std" => "",
					"type" => "textarea"); 
																														
update_option('of_template',$options); 					  
update_option('of_themename',$themename);   
update_option('of_shortname',$shortname);

}
}
?>
