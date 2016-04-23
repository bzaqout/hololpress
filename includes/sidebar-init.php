<?php
function holol_widgets_init() {
	
	register_sidebar(array(
    	'id' => 'header_sidbar',
    	'name' => 'المربع الجانبي العلوي',
    	'before_widget' => '<div id="%1$s" class="box-widget clearfix %2$s">',
    	'after_widget' => '</div>',
    	'before_title' => '<h3 class="widget-title">',
    	'after_title' => '</h3>',
    ));
	
	register_sidebar(array(
    	'id' => 'home_right_sidebar',
    	'name' => 'المربع الجانبي وسط - يمين',
    	'before_widget' => '<div id="%1$s" class="box-widget clearfix %2$s">',
    	'after_widget' => '</div>',
    	'before_title' => '<h3 class="widget-title">',
    	'after_title' => '</h3>',
    ));
	
	register_sidebar(array(
    	'id' => 'home_left_sidebar',
    	'name' => 'المربع الجانبي وسط - يسار',
    	'before_widget' => '<div id="%1$s" class="box-widget clearfix %2$s">',
    	'after_widget' => '</div>',
    	'before_title' => '<h3 class="widget-title">',
    	'after_title' => '</h3>',
    ));
	register_sidebar(array(
    	'id' => 'home_sidebar1',
    	'name' => 'المربع الجانبي أسفل - يمين',
    	'before_widget' => '<div id="%1$s" class="box-widget clearfix %2$s">',
    	'after_widget' => '</div>',
    	'before_title' => '<h3 class="widget-title">',
    	'after_title' => '</h3>',
    ));
	register_sidebar(array(
    	'id' => 'home_sidebar2',
    	'name' => 'المربع الجانبي أسفل - وسط',
    	'before_widget' => '<div id="%1$s" class="box-widget clearfix %2$s">',
    	'after_widget' => '</div>',
    	'before_title' => '<h3 class="widget-title">',
    	'after_title' => '</h3>',
    ));
	register_sidebar(array(
    	'id' => 'home_sidebar3',
    	'name' => 'المربع الجانبي أسفل - يسار',
    	'before_widget' => '<div id="%1$s" class="box-widget clearfix %2$s">',
    	'after_widget' => '</div>',
    	'before_title' => '<h3 class="widget-title">',
    	'after_title' => '</h3>',
    ));
	register_sidebar(array(
    	'id' => 'sidebar1',
    	'name' => 'Page Sidebar',
    	'before_widget' => '<div id="%1$s" class="box-widget clearfix %2$s">',
    	'after_widget' => '</div>',
    	'before_title' => '<h3 class="widget-title">',
    	'after_title' => '</h3>',
    ));
	
}
add_action( 'widgets_init', 'bilal_widgets_init' );
?>