<?php

// The excerpt based on words
function limit_words($string, $word_limit)
{
  $words = explode(' ', $string, ($word_limit + 1));
  if(count($words) > $word_limit)
  array_pop($words);
  return implode(' ', $words);
}
/*-----------------------------------------------------------------------------------*/
# Post Thumbnails
/*-----------------------------------------------------------------------------------*/
if ( function_exists( 'add_image_size' ) ){
	add_image_size( 'holol-small'		,110,  75,  true );
	add_image_size( 'holol-medium'	,310,  165, true );
	add_image_size( 'holol-large'		,382,  250, true );
	add_image_size( 'slider'		,660,  330, true );
	add_image_size( 'big-slider'	,1050, 525, true );
}

// Set content width
if ( ! isset( $content_width ) ) $content_width = 970;

function holol_theme_support() {
	add_theme_support('post-thumbnails');      // wp thumbnails (sizes handled in functions.php)
	set_post_thumbnail_size(220, 190, true);   // default thumb size
	add_theme_support( 'menus' );            // wp menus
	register_nav_menus(                      // wp3+ menus
		array( 
			'main_nav' => 'The Main Menu',   // main nav in header
			'top_links' => 'Top Link', 
		)
	);	
	add_post_type_support( 'page', 'excerpt' );
}

add_action('after_setup_theme','holol_theme_support');

function holol_main_nav() {
    wp_nav_menu( 
    	array( 
    		'menu' => 'main_nav', /* menu name */
    		'menu_class' => 'nav navbar-nav',
    		'theme_location' => 'main_nav', /* where in the theme it's assigned */
    		'container' => 'false', /* container class */
			'fallback_cb' => 'wp_main_nav_fallback', /* menu fallback */
			'walker' => new Bootstrap_walker()
    	)
    );
}
function top_links() {
    wp_nav_menu( 
    	array( 
    		'menu' => 'top_links', /* menu name */
    		'menu_class' => 'top-links',
    		'theme_location' => 'top_links', /* where in the theme it's assigned */
			'fallback_cb' => 'false', /* menu fallback */
    	)
    );
}

add_filter('nav_menu_css_class', 'add_active_class', 10, 2 );
function add_active_class($classes, $item) {
	if( $item->menu_item_parent == 0 && in_array('current-menu-item', $classes) ) {
    $classes[] = "active";
	}
  
  return $classes;
}
class Bootstrap_walker extends Walker_Nav_Menu{

  function start_el(&$output, $object, $depth = 0, $args = Array(), $current_object_id = 0){

	 global $wp_query;
	 $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
	
	 $class_names = $value = '';
	
		// If the item has children, add the dropdown class for bootstrap
		if ( $args->has_children ) {
			$class_names = "dropdown ";
		}
	
		$classes = empty( $object->classes ) ? array() : (array) $object->classes;
		
		$class_names .= join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $object ) );
		$class_names = ' class="'. esc_attr( $class_names ) . '"';
       
   	$output .= $indent . '<li id="menu-item-'. $object->ID . '"' . $value . $class_names .'>';

   	$attributes  = ! empty( $object->attr_title ) ? ' title="'  . esc_attr( $object->attr_title ) .'"' : '';
   	$attributes .= ! empty( $object->target )     ? ' target="' . esc_attr( $object->target     ) .'"' : '';
   	$attributes .= ! empty( $object->xfn )        ? ' rel="'    . esc_attr( $object->xfn        ) .'"' : '';
   	$attributes .= ! empty( $object->url )        ? ' href="'   . esc_attr( $object->url        ) .'"' : '';

   	// if the item has children add these two attributes to the anchor tag
   	// if ( $args->has_children ) {
		  // $attributes .= ' class="dropdown-toggle" data-toggle="dropdown"';
    // }

    $item_output = $args->before;
    $item_output .= '<a'. $attributes .'>';
    $item_output .= $args->link_before .apply_filters( 'the_title', $object->title, $object->ID );
    $item_output .= $args->link_after;

    // if the item has children add the caret just before closing the anchor tag
    if ( $args->has_children ) {
    	$item_output .= '<b class="caret"></b></a>';
    }
    else {
		if($object->attr_title){
			$item_output .='<img class="navImg" src="'.$object->attr_title.'" />';
		}
		
    	$item_output .= '</a>';
    }

    $item_output .= $args->after;

    $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $object, $depth, $args );
  } // end start_el function
        
  function start_lvl(&$output, $depth = 0, $args = Array()) {
    $indent = str_repeat("\t", $depth);
    $output .= "\n$indent<ul class=\"dropdown-menu\">\n";
  }
      
	function display_element( $element, &$children_elements, $max_depth, $depth=0, $args, &$output ){
    $id_field = $this->db_fields['id'];
    if ( is_object( $args[0] ) ) {
        $args[0]->has_children = ! empty( $children_elements[$element->$id_field] );
    }
    return parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
  }        
}
add_filter( 'widget_text', 'do_shortcode' );

add_filter( 'post_thumbnail_html', 'remove_thumbnail_dimensions', 10 );
add_filter( 'image_send_to_editor', 'remove_thumbnail_dimensions', 10 );
function remove_thumbnail_dimensions( $html ) {
    $html = preg_replace( '/(width|height)=\"\d*\"\s/', "", $html );
    return $html;
}
function filter_ptags_on_images($content){
   return preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content);
}

add_filter('the_content', 'filter_ptags_on_images');

if ( ! function_exists( 'page_navi' ) ) {
	function page_navi($before = '', $after = '') {
	global $wpdb, $wp_query;
	$request = $wp_query->request;
	$posts_per_page = intval(get_query_var('posts_per_page'));
	$paged = intval(get_query_var('paged'));
	$numposts = $wp_query->found_posts;
	$max_page = $wp_query->max_num_pages;
	if ( $numposts <= $posts_per_page ) { return; }
	if(empty($paged) || $paged == 0) {
		$paged = 1;
	}
	$pages_to_show = 7;
	$pages_to_show_minus_1 = $pages_to_show-1;
	$half_page_start = floor($pages_to_show_minus_1/2);
	$half_page_end = ceil($pages_to_show_minus_1/2);
	$start_page = $paged - $half_page_start;
	if($start_page <= 0) {
		$start_page = 1;
	}
	$end_page = $paged + $half_page_end;
	if(($end_page - $start_page) != $pages_to_show_minus_1) {
		$end_page = $start_page + $pages_to_show_minus_1;
	}
	if($end_page > $max_page) {
		$start_page = $max_page - $pages_to_show_minus_1;
		$end_page = $max_page;
	}
	if($start_page <= 0) {
		$start_page = 1;
	}
		
	echo $before.'<ul class="pagination">'."";
	if ($paged > 1) {
		$first_page_text = "&laquo";
		echo '<li class="prev"><a href="'.get_pagenum_link().'" title="First">'.$first_page_text.'</a></li>';
	}
		
	$prevposts = get_previous_posts_link('&laquo;');
	if($prevposts) { echo '<li>' . $prevposts  . '</li>'; }
	else { echo '<li class="disabled"><a href="#">&laquo;</a></li>'; }
	
	for($i = $start_page; $i  <= $end_page; $i++) {
		if($i == $paged) {
			echo '<li class="active"><a href="#">'.$i.'</a></li>';
		} else {
			echo '<li><a href="'.get_pagenum_link($i).'">'.$i.'</a></li>';
		}
	}
	echo '<li class="">';
	next_posts_link('&raquo;');
	echo '</li>';
	if ($end_page < $max_page) {
		$last_page_text = "&raquo;";
		echo '<li class="next"><a href="'.get_pagenum_link($max_page).'" title="Last">'.$last_page_text.'</a></li>';
	}
	echo '</ul>'.$after."";
}
} // End IF Statement


function breadcrumb_lists(array $options = array() ) {
	
	// default values assigned to options
	$options = array_merge(array(
	'crumbId' => 'breadcrumbs', // id for the breadcrumb Div
	'crumbClass' => 'breadcrumbs', // class for the breadcrumb Div
	'beginningText' => '', // text showing before breadcrumb starts
	'showOnHome' => 1,// 1 - show breadcrumbs on the homepage, 0 - don't show
	'delimiter' => ' / ', // delimiter between crumbs
	'homePageText' => 'الرئيسية', // text for the 'Home' link
	'showCurrent' => 1, // 1 - show current post/page title in breadcrumbs, 0 - don't show
	'beforeTag' => '<span class="current">', // tag before the current breadcrumb
	'afterTag' => '</span>', // tag after the current crumb
	'showTitle'=> 1 // showing post/page title or slug if title to show then 1
   ), $options);
   
   $crumbId = $options['crumbId'];
	$crumbClass = $options['crumbClass'];
	$beginningText = $options['beginningText'] ;
	$showOnHome = $options['showOnHome'];
	$delimiter = $options['delimiter']; 
	$homePageText = $options['homePageText']; 
	$showCurrent = $options['showCurrent']; 
	$beforeTag = $options['beforeTag']; 
	$afterTag = $options['afterTag']; 
	$showTitle =  $options['showTitle']; 
	
	global $post;

	$wp_query = $GLOBALS['wp_query'];

	$homeLink = get_bloginfo('url');
	
	echo '<div id="'.$crumbId.'" class="'.$crumbClass.'" >'.$beginningText;
	
	if (is_home() || is_front_page()) {
	
	  if ($showOnHome == 1)

		  echo $beforeTag . $homePageText . $afterTag;

	} else { 
	
	  echo '<a href="' . $homeLink . '">' . $homePageText . '</a> ' . $delimiter . ' ';
	
	  if ( is_category() ) {
		$thisCat = get_category(get_query_var('cat'), false);
		if ($thisCat->parent != 0) echo get_category_parents($thisCat->parent, TRUE, ' ' . $delimiter . ' ');
		echo $beforeTag . 'Archive by category "' . single_cat_title('', false) . '"' . $afterTag;
	
	  } elseif ( is_tax() ) {
		  $term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
		  $parents = array();
		  $parent = $term->parent;
		  while ( $parent ) {
			  $parents[] = $parent;
			  $new_parent = get_term_by( 'id', $parent, get_query_var( 'taxonomy' ) );
			  $parent = $new_parent->parent;

		  }		  
		  if ( ! empty( $parents ) ) {
			  $parents = array_reverse( $parents );
			  foreach ( $parents as $parent ) {
				  $item = get_term_by( 'id', $parent, get_query_var( 'taxonomy' ));
				  echo '<a href="' . get_term_link( $item->slug, get_query_var( 'taxonomy' ) ) . '">' . $item->name . '</a>'  . $delimiter. ' ';
			  }
		  }

		  $queried_object = $wp_query->get_queried_object();
		  echo $beforeTag . $queried_object->name . $afterTag;	  
		  } elseif ( is_search() ) {
		echo $beforeTag . 'Search results for "' . get_search_query() . '"' . $afterTag;
	
	  } elseif ( is_day() ) {
		echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
		echo '<a href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F') . '</a> ' . $delimiter . ' ';
		echo $beforeTag . get_the_time('d') . $afterTag;
	
	  } elseif ( is_month() ) {
		echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
		echo $beforeTag . get_the_time('F') . $afterTag;
	
	  } elseif ( is_year() ) {
		echo $beforeTag . get_the_time('Y') . $afterTag;
	
	  } elseif ( is_single() && !is_attachment() ) {
		  
		     if($showTitle)
			   $title = get_the_title();
			  else
			  $title =  $post->post_name;
			  	if ( get_post_type() == 'product' ) { 
					  if ( $terms = wp_get_object_terms( $post->ID, 'product_cat' ) ) {
		
						  $term = current( $terms );
		
						  $parents = array();
		
						  $parent = $term->parent;
						  while ( $parent ) {
		
							  $parents[] = $parent;
		
							  $new_parent = get_term_by( 'id', $parent, 'product_cat' );
		
							  $parent = $new_parent->parent;
		
						  }
						  if ( ! empty( $parents ) ) {
		
							  $parents = array_reverse($parents);
		
							  foreach ( $parents as $parent ) {
		
								  $item = get_term_by( 'id', $parent, 'product_cat');
		
								  echo  '<a href="' . get_term_link( $item->slug, 'product_cat' ) . '">' . $item->name . '</a>'  . $delimiter;
		
							  }
		
						  }
						  echo  '<a href="' . get_term_link( $term->slug, 'product_cat' ) . '">' . $term->name . '</a>'  . $delimiter;
					  }
					  echo $beforeTag . $title . $afterTag;
				  }  elseif ( get_post_type() != 'post' ) {
				  $post_type = get_post_type_object(get_post_type());
				  $slug = $post_type->rewrite;
				  echo '<a href="' . $homeLink . '/' . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a>';
				  if ($showCurrent == 1) echo ' ' . $delimiter . ' ' . $beforeTag . $title . $afterTag;
				} else {
				  $cat = get_the_category(); $cat = $cat[0];
				  $cats = get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
				  if ($showCurrent == 0) $cats = preg_replace("#^(.+)\s$delimiter\s$#", "$1", $cats);
				  echo $cats;
				  if ($showCurrent == 1) echo $beforeTag . $title . $afterTag;
		
				}

	  } elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
		  
		$post_type = get_post_type_object(get_post_type());
		
		echo $beforeTag . $post_type->labels->singular_name . $afterTag;
			 
	 } elseif ( is_attachment() ) {
			 
		$parent = get_post($post->post_parent);
		$cat = get_the_category($parent->ID); $cat = $cat[0];
		echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
		echo '<a href="' . get_permalink($parent) . '">' . $parent->post_title . '</a>';
		if ($showCurrent == 1) echo ' ' . $delimiter . ' ' . $beforeTag . get_the_title() . $afterTag;	
		  
		} elseif ( is_page() && !$post->post_parent ) {
			$title =($showTitle)? get_the_title():$post->post_name;
			  
		if ($showCurrent == 1) echo $beforeTag .  $title . $afterTag;

	  } elseif ( is_page() && $post->post_parent ) {
		$parent_id  = $post->post_parent;
		$breadcrumbs = array();
		while ($parent_id) {
		  $page = get_page($parent_id);
		  $breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
		  $parent_id  = $page->post_parent;
		}
		$breadcrumbs = array_reverse($breadcrumbs);
		for ($i = 0; $i < count($breadcrumbs); $i++) {
		  echo $breadcrumbs[$i];
		  if ($i != count($breadcrumbs)-1) echo ' ' . $delimiter . ' ';
		}
			$title =($showTitle)? get_the_title():$post->post_name;
		   
	if ($showCurrent == 1) echo ' ' . $delimiter . ' ' . $beforeTag . $title . $afterTag;

	  } elseif ( is_tag() ) {

		echo $beforeTag . 'Posts tagged "' . single_tag_title('', false) . '"' . $afterTag;

	  } elseif ( is_author() ) {
		 global $author;
		$userdata = get_userdata($author);

		echo $beforeTag . 'Articles posted by ' . $userdata->display_name . $afterTag;

	  } elseif ( is_404() ) {
		  
		echo $beforeTag . 'Error 404' . $afterTag;

	  }

	  if ( get_query_var('paged') ) {
		if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() || is_tax() ) echo ' (';
		echo __('Page') . ' ' . get_query_var('paged');
		if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() || is_tax() ) echo ')';
	  }
	}
	echo '</div>';
  }
  
/*-----------------------------------------------------------------------------------*/
#display number of posts
/*-----------------------------------------------------------------------------------*/
function getPostViews($postID){
    $count_key = 'views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        update_post_meta($postID, $count_key, '0');
        return "0 مشاهدة";
    }
    return $count.' مشاهدات';
}

/*-----------------------------------------------------------------------------------*/
#Set post count views
/*-----------------------------------------------------------------------------------*/
function setPostViews($postID) {
    $count_key = 'views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        $count = 0;
        update_post_meta($postID, $count_key, '0');
    }else{
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}
 /*-----------------------------------------------------------------------------------*/
# Social 
/*-----------------------------------------------------------------------------------*/
function get_social_icon( $newtab = true, $colored = true, $tooltip='ttip' ){
	if ( !empty( $newtab ) ) $newtab = "target=\"_blank\"";
	else $newtab = '';
	
	if ( !empty( $colored ) ) $colored = " social-colored";
	else $colored = '';
				
		?>
		<div class="social-icons<?php echo $colored ?>">
		<?php
		// RSS
		if ( $rss = get_option('of_rss') ){
			?><a class="<?php echo $tooltip; ?>" title="Rss" href="<?php echo esc_url( $rss ) ; ?>" <?php echo $newtab; ?>><i class="fa fa-rss"></i></a><?php 
		}
		// Google+
		if ( $gplus = get_option('of_gplus') ) {
			?><a class="<?php echo $tooltip; ?>" title="Google+" href="<?php echo esc_url( $gplus ); ?>" <?php echo $newtab; ?>><i class="fa fa-google-plus"></i></a><?php 
		}
		// Facebook
		if ( $facebook = get_option('of_facebook') ) {
			?><a class="<?php echo $tooltip; ?>" title="Facebook" href="<?php echo esc_url( $facebook ); ?>" <?php echo $newtab; ?>><i class="fa fa-facebook"></i></a><?php 
		}
		// Twitter
		if ( $twitter = get_option('of_twitter')) {
			?><a class="<?php echo $tooltip; ?>" title="Twitter" href="<?php echo esc_url( $twitter ); ?>" <?php echo $newtab; ?>><i class="fa fa-twitter"></i></a><?php
		}		
		// Pinterest
		if ( $pinterest = get_option('of_pinterest')) {
			?><a class="<?php echo $tooltip; ?>" title="Pinterest" href="<?php echo esc_url( $Pinterest ); ?>" <?php echo $newtab; ?>><i class="fa fa-pinterest"></i></a><?php
		}
		// dribbble
		if ( $dribbble = get_option('of_dribbble') ) {
			?><a class="<?php echo $tooltip; ?>" title="Dribbble" href="<?php echo esc_url( $dribbble ); ?>" <?php echo $newtab; ?>><i class="fa fa-dribbble"></i></a><?php
		}
		// LinkedIN
		if ( $linkedin = get_option('of_linkedin') ) {
			?><a class="<?php echo $tooltip; ?>" title="LinkedIn" href="<?php echo esc_url( $linkedin ); ?>" <?php echo $newtab; ?>><i class="fa fa-linkedin"></i></a><?php
		}
		// YouTube
		if ( $youtube = get_option('of_youtube')) {
			?><a class="<?php echo $tooltip; ?>" title="Youtube" href="<?php echo esc_url( $youtube ); ?>" <?php echo $newtab; ?>><i class="fa fa-youtube"></i></a><?php
		}
		// Skype
		if ( $skype = get_option('of_skype') ) {
			?><a class="<?php echo $tooltip; ?>" title="Skype" href="<?php echo esc_url( $skype ); ?>" <?php echo $newtab; ?>><i class="fa fa-skype"></i></a><?php
		}
		// Digg
		if ( $digg = get_option('of_digg') ) {
			?><a class="<?php echo $tooltip; ?>" title="Digg" href="<?php echo esc_url( $digg ); ?>" <?php echo $newtab; ?>><i class="fa fa-digg"></i></a><?php
		}
		// Reddit 
		if ( $reddit = get_option('of_reddit') ) {
			?><a class="<?php echo $tooltip; ?>" title="Reddit" href="<?php echo esc_url( $reddit ); ?>" <?php echo $newtab; ?>><i class="fa fa-reddit"></i></a><?php
		}
		// Delicious 
		if ( $delicious = get_option('of_delicious') ) {
			?><a class="<?php echo $tooltip; ?>" title="Delicious" href="<?php echo esc_url( $delicious ); ?>" <?php echo $newtab; ?>><i class="fa fa-delicious"></i></a><?php
		}
		// stumbleuponUpon 
		if ( $stumbleupon = get_option('of_stumbleupon') ) {
			?><a class="<?php echo $tooltip; ?>" title="StumbleUpon" href="<?php echo esc_url( $stumbleupon ); ?>" <?php echo $newtab; ?>><i class="fa fa-stumbleupon"></i></a><?php
		}
		// Tumblr 
		if ( $tumblr = get_option('of_tumblr') ) {
			?><a class="<?php echo $tooltip; ?>" title="Tumblr" href="<?php echo esc_url( $tumblr ); ?>" <?php echo $newtab; ?>><i class="fa fa-tumblr"></i></a><?php
		}
		// Vimeo
		if ( $vimeo = get_option('of_vimeo') ) {
			?><a class="<?php echo $tooltip; ?>" title="Vimeo" href="<?php echo esc_url( $vimeo ); ?>" <?php echo $newtab; ?>><i class="fa fa-vimeo"></i></a><?php
		}
		// Blogger
		if ( $blogger = get_option('of_blogger') ) {
			?><a class="<?php echo $tooltip; ?>" title="Blogger" href="<?php echo esc_url( $blogger ); ?>" <?php echo $newtab; ?>><i class="fa fa-blogger"></i></a><?php
		}
		// Wordpress
		if ( $wordpress = get_option('of_wordpress') ) {
			?><a class="<?php echo $tooltip; ?>" title="WordPress" href="<?php echo esc_url( $wordpress ); ?>" <?php echo $newtab; ?>><i class="fa fa-wordpress"></i></a><?php
		}
		// Yelp
		if ( $yelp = get_option('of_yelp') ) {
			?><a class="<?php echo $tooltip; ?>" title="Yelp" href="<?php echo esc_url( $yelp ); ?>" <?php echo $newtab; ?>><i class="fa fa-yelp"></i></a><?php
		}
		// Last.fm
		if ( $lastfm = get_option('of_lastfm') ) {
			?><a class="<?php echo $tooltip; ?>" title="Last.fm" href="<?php echo esc_url( $lastfm ); ?>" <?php echo $newtab; ?>><i class="fa fa-lastfm"></i></a><?php
		}
		// sharethis
		if ( $sharethis = get_option('of_sharethis') ) {
			?><a class="<?php echo $tooltip; ?>" title="ShareThis" href="<?php echo esc_url( $sharethis ); ?>" <?php echo $newtab; ?>><i class="fa fa-share-alt"></i></a><?php
		}
		// dropbox
		if ( $dropbox = get_option('of_dropbox') ) {
			?><a class="<?php echo $tooltip; ?>" title="Dropbox" href="<?php echo esc_url( $dropbox ); ?>" <?php echo $newtab; ?>><i class="fa fa-dropbox"></i></a><?php
		}
		// xing.me
		// Apple
		if ( $apple = get_option('of_apple') ) {
			?><a class="<?php echo $tooltip; ?>" title="Apple" href="<?php echo esc_url( $apple ); ?>" <?php echo $newtab; ?>><i class="fa fa-apple"></i></a><?php
		}
		// foursquare
		if ( $foursquare = get_option('of_foursquare') ) {
			?><a class="<?php echo $tooltip; ?>" title="Foursquare" href="<?php echo esc_url( $foursquare ); ?>" <?php echo $newtab; ?>><i class="fa fa-foursquare"></i></a><?php
		}
		// github
		if ( $github = get_option('of_github') ) {
			?><a class="<?php echo $tooltip; ?>" title="Github" href="<?php echo esc_url( $github ); ?>" <?php echo $newtab; ?>><i class="fa fa-github"></i></a><?php
		}
		// soundcloud
		if ( $soundcloud = get_option('of_soundcloud') ) {
			?><a class="<?php echo $tooltip; ?>" title="SoundCloud" href="<?php echo esc_url( $soundcloud ); ?>" <?php echo $newtab; ?>><i class="fa fa-soundcloud"></i></a><?php
		}		
		// behance
		if ( $behance = get_option('of_behance') ) {
			?><a class="<?php echo $tooltip; ?>" title="Behance" href="<?php echo esc_url( $behance ); ?>" <?php echo $newtab; ?>><i class="fa fa-behance"></i></a><?php
		}
		// instagram
		if ( $instagram = get_option('of_instagram') ) {
			?><a class="<?php echo $tooltip; ?>" title="instagram" href="<?php echo esc_url( $instagram ); ?>" <?php echo $newtab; ?>><i class="fa fa-instagram"></i></a><?php
		}
	?>
	</div>

<?php
} 
/*-----------------------------------------------------------------------------------*/
# Get the post time
/*-----------------------------------------------------------------------------------*/
function holol_get_time( $return = false ){
	global $post ;

	if( get_option( 'time_format' ) == 'none' ){
		return false;

	}elseif( get_option( 'time_format' ) == 'modern' ){	

		$time_now  = current_time('timestamp');
		$post_time = get_the_time('U') ;

		if ( $post_time > $time_now - ( 60 * 60 * 24 * 30 ) ) {
			$since = sprintf( __( '%s ago' ), human_time_diff( $post_time, $time_now ) );
		} else {
			$since = get_the_time(get_option('date_format'));
		}

	}else{
		$since = get_the_time(get_option('date_format'));
	}
	
	$post_time = '<span class="holol-date"><i class="fa fa-clock-o"></i>'.$since.'</span>';

	if( $return ){
		return $post_time;
	}else{
		echo $post_time;
	}
}
/*-----------------------------------------------------------------------------------*/
# Custome CSS  
/*-----------------------------------------------------------------------------------*/
function theme_custome_css() {?>
	<style>
	</style>
<?php 
}
add_action('wp_head', 'theme_custome_css');


/*-----------------------------------------------------------------------------------*/
# Get Post Audio  
/*-----------------------------------------------------------------------------------*/
function holol_audio(){
	global $post;
	$get_meta = get_post_custom($post->ID);
	$mp3 = $get_meta["holol_audio_mp3"][0] ;
	$m4a = $get_meta["holol_audio_m4a"][0] ;
	$oga = $get_meta["holol_audio_oga"][0] ;
	echo do_shortcode('[audio mp3="'.$mp3.'" ogg="'.$oga.'" m4a="'.$m4a.'"]');
}

/*-----------------------------------------------------------------------------------*/
# Get Post Video  
/*-----------------------------------------------------------------------------------*/
function holol_video(){
 $wp_embed = new WP_Embed();
	global $post;
	$get_meta = get_post_custom($post->ID);
	if( !empty( $get_meta["holol_video_url"][0] ) ){
		$video_url = $get_meta["holol_video_url"][0];
		
		$protocol = is_ssl() ? 'https' : 'http';
		if( !is_ssl() ){
			$video_url = str_replace ( 'https://', 'http://', $video_url );
		}
		$video_output = $wp_embed->run_shortcode('[embed width="660" height="371.25"]'.$video_url.'[/embed]');
		if( $video_output == '<a href="'.$video_url.'">'.$video_url.'</a>' ){
			$width  = '660' ;
			$height = '371.25';
			$video_link = @parse_url($video_url);
			if ( $video_link['host'] == 'www.youtube.com' || $video_link['host']  == 'youtube.com' ) {
				parse_str( @parse_url( $video_url, PHP_URL_QUERY ), $my_array_of_vars );
				$video =  $my_array_of_vars['v'] ;
				$video_output ='<iframe width="'.$width.'" height="'.$height.'" src="'.$protocol.'://www.youtube.com/embed/'.$video.'?rel=0&wmode=opaque" frameborder="0" allowfullscreen></iframe>';
			}
			elseif( $video_link['host'] == 'www.youtu.be' || $video_link['host']  == 'youtu.be' ){
				$video = substr(@parse_url($video_url, PHP_URL_PATH), 1);
				$video_output ='<iframe width="'.$width.'" height="'.$height.'" src="'.$protocol.'://www.youtube.com/embed/'.$video.'?rel=0&wmode=opaque" frameborder="0" allowfullscreen></iframe>';
			}elseif( $video_link['host'] == 'www.vimeo.com' || $video_link['host']  == 'vimeo.com' ){
				$video = (int) substr(@parse_url($video_url, PHP_URL_PATH), 1);
				$video_output='<iframe src="'.$protocol.'://player.vimeo.com/video/'.$video.'?wmode=opaque" width="'.$width.'" height="'.$height.'" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>';
			}
			elseif( $video_link['host'] == 'www.dailymotion.com' || $video_link['host']  == 'dailymotion.com' ){
				$video = substr(@parse_url($video_url, PHP_URL_PATH), 7);
				$video_id = strtok($video, '_');
				$video_output='<iframe frameborder="0" width="'.$width.'" height="'.$height.'" src="'.$protocol.'://www.dailymotion.com/embed/video/'.$video_id.'"></iframe>';
			}
		}
	}
	elseif( !empty( $get_meta["holol_embed_code"][0] ) ){
		$embed_code = $get_meta["holol_embed_code"][0];
		$video_output = htmlspecialchars_decode( $embed_code);
	}
	elseif( !empty( $get_meta["holol_video_self"][0] ) ){
		$video_self = $get_meta["holol_video_self"][0];
		$video_output = do_shortcode( '[video width="1280" height="720" mp4="'.$get_meta["holol_video_self"][0].'"][/video]' );
	}
	if( !empty($video_output) ) echo $video_output; ?>
<?php
}


/*-----------------------------------------------------------------------------------*/
# Post Video embed URL 
/*-----------------------------------------------------------------------------------*/
function holol_video_embed(){
	global $post;
	$get_meta = get_post_custom($post->ID);
	if( !empty( $get_meta["holol_video_url"][0] ) ){
		$video_output = holol_get_video_embed( $get_meta["holol_video_url"][0] );
	}
	if( !empty($video_output) ) return $video_output;
	else false; ?>
<?php
}


/*-----------------------------------------------------------------------------------*/
# Get Video embed URL 
/*-----------------------------------------------------------------------------------*/
function holol_get_video_embed( $video_url ){
	$protocol = is_ssl() ? 'https' : 'http';
	$video_link = @parse_url($video_url);
	if ( $video_link['host'] == 'www.youtube.com' || $video_link['host']  == 'youtube.com' ) {
		parse_str( @parse_url( $video_url, PHP_URL_QUERY ), $my_array_of_vars );
		$video =  $my_array_of_vars['v'] ;
		$video_output = $protocol.'://www.youtube.com/embed/'.$video.'?rel=0&wmode=opaque&autohide=1&border=0&egm=0&showinfo=0';
	}
	elseif( $video_link['host'] == 'www.youtu.be' || $video_link['host']  == 'youtu.be' ){
		$video = substr(@parse_url($video_url, PHP_URL_PATH), 1);
		$video_output = $protocol.'://www.youtube.com/embed/'.$video.'?rel=0&wmode=opaque&autohide=1&border=0&egm=0&showinfo=0';
	}elseif( $video_link['host'] == 'www.vimeo.com' || $video_link['host']  == 'vimeo.com' ){
		$video = (int) substr(@parse_url($video_url, PHP_URL_PATH), 1);
		$video_output= $protocol.'://player.vimeo.com/video/'.$video.'?wmode=opaque';
	}else{
		$video_output = $video_url;
	}
	
	if( !empty($video_output) ) return $video_output; ?>
<?php
}


function holol_post_class( $classes = false ) {
    global $post;
	
	$post_format = get_post_meta($post->ID, 'holol_post_head', true);
	if( !empty($post_format) ){
		if( !empty($classes) ) $classes .= ' ';
		$classes .= 'holol_'.$post_format;
	}
	if( !empty($classes) )	
		echo 'class="'.$classes.'"';
}

function holol_get_post_class( $classes = false ) {
    global $post;
	
	$post_format = get_post_meta($post->ID, 'holol_post_head', true);
	if( !empty($post_format) ){
		if( !empty($classes) ) $classes .= ' ';
		$classes .= 'holol_'.$post_format;
	}
	if( !empty($classes) )	
		return 'class="'.$classes.'"';
}

/*-----------------------------------------------------------------------------------*/
# Get Most Recent posts
/*-----------------------------------------------------------------------------------*/
function holol_last_posts($posts_number = 5 , $thumb = true){
	global $post;
	$original_post = $post;

	$args = array(
		'posts_per_page'		 => $posts_number,
		'no_found_rows'          => true,
		'ignore_sticky_posts'	 => true
	);

	$get_posts_query = new WP_Query( $args );

	if ( $get_posts_query->have_posts() ):
		while ( $get_posts_query->have_posts() ) : $get_posts_query->the_post()?>
		<li <?php holol_post_class(); ?>>
			<?php if ( function_exists("has_post_thumbnail") && has_post_thumbnail() && $thumb ) : ?>			
				<div class="post-thumbnail">
					<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_post_thumbnail( 'tie-small' ); ?><span class="fa overlay-icon"></span></a>
				</div><!-- post-thumbnail /-->
			<?php endif; ?>
			<h3><a href="<?php the_permalink(); ?>"><?php the_title();?></a></h3>
            <?php holol_get_time();?>
		</li>
		<?php
		endwhile;
	endif;
	
	$post = $original_post;
	wp_reset_query();
}


/*-----------------------------------------------------------------------------------*/
# Get Most Recent posts from Category
/*-----------------------------------------------------------------------------------*/
function holol_last_posts_cat($posts_number = 5 , $thumb = true , $cats = 1){
	global $post;
	$original_post = $post;

	$args = array(
		'posts_per_page'		 => $posts_number,
		'cat'					 => $cats,
		'no_found_rows'          => true,
		'ignore_sticky_posts'	 => true
	);

	$get_posts_query = new WP_Query( $args );

	if ( $get_posts_query->have_posts() ):
		while ( $get_posts_query->have_posts() ) : $get_posts_query->the_post()?>
		<li <?php holol_post_class(); ?>>
			<?php if ( function_exists("has_post_thumbnail") && has_post_thumbnail() && $thumb ) : ?>			
				<div class="post-thumbnail">
					<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_post_thumbnail( 'tie-small' ); ?><span class="fa overlay-icon"></span></a>
				</div><!-- post-thumbnail /-->
			<?php endif; ?>
			<h3><a href="<?php the_permalink(); ?>"><?php the_title();?></a></h3>
            <?php holol_get_time();?>
		</li>
		<?php
		endwhile;
	endif;
	
	$post = $original_post;
	wp_reset_query();
}

/*-----------------------------------------------------------------------------------*/
# Get Most Recent posts from Category - Timeline
/*-----------------------------------------------------------------------------------*/
function holol_last_posts_cat_timeline($posts_number = 5 , $cats = 1){
	global $post;
	$original_post = $post;

	$args = array(
		'posts_per_page'		 => $posts_number,
		'cat'					 => $cats,
		'no_found_rows'          => true,
		'ignore_sticky_posts'	 => true
	);

	$get_posts_query = new WP_Query( $args );

	if ( $get_posts_query->have_posts() ):
		while ( $get_posts_query->have_posts() ) : $get_posts_query->the_post()?>
		<li>
			<a href="<?php the_permalink(); ?>">
            	<?php holol_get_time();?>
				<h3><?php the_title();?></h3>
			</a>
		</li>
		<?php
		endwhile;
	endif;
	
	$post = $original_post;
	wp_reset_query();
}

/*-----------------------------------------------------------------------------------*/
# Get Most Recent posts from Category with Authors
/*-----------------------------------------------------------------------------------*/
function holol_last_posts_cat_authors($posts_number = 5 , $thumb = true , $cats = 1){
	global $post;
	$original_post = $post;

	$args = array(
		'posts_per_page'		 => $posts_number,
		'cat'					 => $cats,
		'no_found_rows'          => true,
		'ignore_sticky_posts'	 => true
	);

	$get_posts_query = new WP_Query( $args );

	if ( $get_posts_query->have_posts() ):
		while ( $get_posts_query->have_posts() ) : $get_posts_query->the_post()?>
		<li>
			<?php if ( function_exists("has_post_thumbnail") && has_post_thumbnail() && $thumb ) : ?>			
				<div class="post-thumbnail">
					<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) )?>" title=""><?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'MFW_author_bio_avatar_size', 50 ) ); ?></a>
				</div><!-- post-thumbnail /-->
			<?php endif; ?>
			<h3><a href="<?php the_permalink(); ?>"><?php the_title();?></a></h3>
            <?php holol_get_time();?>
			<strong><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) )?>" title=""><?php echo get_the_author() ?> </a></strong>
		</li>
		<?php
		endwhile;
	endif;
	
	$post = $original_post;
	wp_reset_query();
}


/*-----------------------------------------------------------------------------------*/
# Get Random posts 
/*-----------------------------------------------------------------------------------*/
function holol_random_posts($posts_number = 5 , $thumb = true){
	global $post;
	$original_post = $post;

	$args = array(
		'posts_per_page'		 => $posts_number,
		'orderby'				 => 'rand',
		'no_found_rows'          => true,
		'ignore_sticky_posts'	 => true
	);

	$get_posts_query = new WP_Query( $args );

	if ( $get_posts_query->have_posts() ):
		while ( $get_posts_query->have_posts() ) : $get_posts_query->the_post()?>
		<li <?php holol_post_class(); ?>>
			<?php if ( function_exists("has_post_thumbnail") && has_post_thumbnail() && $thumb ) : ?>			
				<div class="post-thumbnail">
					<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_post_thumbnail( 'tie-small' ); ?><span class="fa overlay-icon"></span></a>
				</div><!-- post-thumbnail /-->
			<?php endif; ?>
			<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
            <?php holol_get_time();?>
		</li>
		<?php
		endwhile;
	endif;
	
	$post = $original_post;
	wp_reset_query();
}


/*-----------------------------------------------------------------------------------*/
# Get Popular posts 
/*-----------------------------------------------------------------------------------*/
function holol_popular_posts( $posts_number = 5 , $thumb = true){
	global $post;
	$original_post = $post;

	$args = array(
		'orderby'				 => 'comment_count',
		'order'					 => 'DESC',
		'posts_per_page'		 => $posts_number,
		'post_status'			 => 'publish',
		'no_found_rows'          => true,
		'ignore_sticky_posts'	 => true
	);

	$popularposts = new WP_Query( $args );
	if ( $popularposts->have_posts() ):
		while ( $popularposts->have_posts() ) : $popularposts->the_post()?>
			<li <?php holol_post_class(); ?>>
			<?php if ( function_exists("has_post_thumbnail") && has_post_thumbnail() && $thumb ) : ?>			
				<div class="post-thumbnail">
					<a href="<?php the_permalink() ?>" title="<?php the_title_attribute( ) ?>" rel="bookmark"><?php the_post_thumbnail( 'tie-small' ); ?><span class="fa overlay-icon"></span></a>
				</div><!-- post-thumbnail /-->
			<?php endif; ?>
				<h3><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h3>
                <?php holol_get_time();?>
				<?php if ( get_comments_number() != 0 ) : ?>
				<span class="post-comments post-comments-widget"><i class="fa fa-comments"></i><?php comments_popup_link( '0' , '1' , '%' ); ?></span>
				<?php endif; ?>
			</li>
	<?php 
		endwhile;
	endif;

	$post = $original_post;
	wp_reset_query();
}

/*-----------------------------------------------------------------------------------*/
# Get Popular posts / Views
/*-----------------------------------------------------------------------------------*/
function holol_most_viewed( $posts_number = 5 , $thumb = true){
	global $post;
	$original_post = $post;

	$args = array(
		'orderby'				 => 'meta_value_num',
		'meta_key'				 => 'holol_views',
		'posts_per_page'		 => $posts_number,
		'post_status'			 => 'publish',
		'no_found_rows'          => true,
		'ignore_sticky_posts'	 => true
	);

	$popularposts = new WP_Query( $args );
	if ( $popularposts->have_posts() ):
		while ( $popularposts->have_posts() ) : $popularposts->the_post()?>
			<li <?php holol_post_class(); ?>>
			<?php if ( function_exists("has_post_thumbnail") && has_post_thumbnail() && $thumb ) : ?>			
				<div class="post-thumbnail">
					<a href="<?php echo get_permalink( $post->ID ) ?>" title="<?php the_title_attribute() ?>" rel="bookmark"><?php the_post_thumbnail( 'tie-small' ); ?><span class="fa overlay-icon"></span></a>
				</div><!-- post-thumbnail /-->
			<?php endif; ?>
				<h3><a href="<?php echo get_permalink( $post->ID ) ?>"><?php the_title(); ?></a></h3>
                <span class="postDate"><i class="fa fa-clock-o"></i><?php the_time('j F Y');?></span>
				<span class="post-views-widget"><?= getPostViews(); ?></span>
			</li>
	<?php 
		endwhile;
	endif;

	$post = $original_post;
	wp_reset_query();
}


/*-----------------------------------------------------------------------------------*/
# Get Most commented posts 
/*-----------------------------------------------------------------------------------*/
function holol_most_commented($comment_posts = 5 , $avatar_size = 55){
$comments = get_comments('status=approve&number='.$comment_posts);
foreach ($comments as $comment) { ?>
	<li>
		<div class="post-thumbnail" style="width:<?php echo $avatar_size ?>px">
			<?php echo get_avatar( $comment, $avatar_size ); ?>
		</div>
		<a href="<?php echo get_permalink($comment->comment_post_ID ); ?>#comment-<?php echo $comment->comment_ID; ?>">
		<?php echo strip_tags($comment->comment_author); ?>: <?php echo wp_html_excerpt( $comment->comment_content, 80 ); ?>... </a>
	</li>
<?php } 
}

/*-----------------------------------------------------------------------------------*/
# Get Best Reviews posts 
/*-----------------------------------------------------------------------------------*/
function holol_best_reviews_posts( $posts_number = 5 , $thumb = true){
	global $post;
	$original_post = $post;

	$args = array(
		'orderby'				 => 'meta_value_num',
		'meta_key'				 => 'taq_review_score',
		'posts_per_page'		 => $posts_number,
		'post_status'			 => 'publish',
		'no_found_rows'          => true,
		'ignore_sticky_posts'	 => true
	);

	$best_views = new WP_Query( $args );

	if ( $best_views->have_posts() ):
		while ( $best_views->have_posts() ) : $best_views->the_post()?>
<li <?php holol_post_class(); ?>>
	<?php if ( function_exists("has_post_thumbnail") && has_post_thumbnail() && $thumb ) : ?>			
		<div class="post-thumbnail">
			<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_post_thumbnail( 'tie-small' ); ?><span class="fa overlay-icon"></span></a>
		</div><!-- post-thumbnail /-->
	<?php endif; ?>
	<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
    <?php holol_get_time();?>
</li>
<?php
		endwhile;
	endif;

	$post = $original_post;
	wp_reset_query();
}


/*-----------------------------------------------------------------------------------*/
# Google Map Function
/*-----------------------------------------------------------------------------------*/
function holol_google_maps($src , $width = 610 , $height = 440 , $class="") {
	return '<div class="google-map '.$class.'"><iframe width="'.$width.'" height="'.$height.'" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="'.$src.'&amp;output=embed"></iframe></div>';
}

/*-----------------------------------------------------------------------------------*/
# Soundcloud Function
/*-----------------------------------------------------------------------------------*/
function holol_soundcloud($url, $autoplay = 'false', $visual = 'false' ) {
	global $post;
	
	$color = $holol_post_color = $cat_id = '';

	$height = '166';
	if(	$visual != 'false' ){
		$height = '350'; 
	}

	if( is_singular() ){
		$get_meta = get_post_custom($post->ID);
		
		if( !empty( $get_meta["post_color"][0] ) )
			$holol_post_color = $get_meta["post_color"][0];
	}
	if( empty($holol_post_color) ){
		if( is_category() ){
			$cat_id = get_query_var('cat');
		}
		elseif( is_single() ){
			$category = get_the_category($post->ID);
			
			if( !empty( $category[0]->cat_ID ) )
				$cat_id = $category[0]->cat_ID;
		}

		$holol_cats_options = get_option( 'holol_cats_options' );
		if( !empty( $holol_cats_options[ $cat_id ] ) )
			$cat_option = $holol_cats_options[ $cat_id ];
		
		if( !empty( $cat_option['cat_color'] ) )
			$holol_post_color = $cat_option['cat_color'];
	}
	if( empty($holol_post_color) && get_option( 'theme_skin' ) && !get_option( 'global_color' ) ) $holol_post_color = get_option( 'theme_skin' );
	if( empty($holol_post_color) && get_option( 'global_color' ) ) $holol_post_color = get_option( 'global_color' );
	
	if( !empty( $holol_post_color ) ){
		$holol_post_color = str_replace ( '#' , '' , $holol_post_color );
		$color = '&amp;color='.$holol_post_color;
	}
	
	return '<iframe width="100%" height="'.$height.'" scrolling="no" frameborder="no" src="https://w.soundcloud.com/player/?url='.$url.$color.'&amp;auto_play='.$autoplay.'&amp;show_artwork=true&amp;visual='.$visual.'"></iframe>';
}			

/*-----------------------------------------------------------------------------------*/
# Login Form
/*-----------------------------------------------------------------------------------*/
function holol_login_form( $login_only  = 0 ) {
	global $user_ID, $user_identity, $user_level;
	$redirect = site_url();

	if ( $user_ID ) : ?>
		<?php if( empty( $login_only ) ): ?>
		<div id="user-login">
			<span class="author-avatar"><?php echo get_avatar( $user_ID, $size = '90'); ?></span>
			<p class="welcome-text"><?php _e( 'Welcome' ) ?> <strong><?php echo $user_identity ?></strong> .</p>
			<ul>
				<li><a href="<?php echo admin_url() ?>"><?php _e( 'Dashboard' ) ?> </a></li>
				<li><a href="<?php echo admin_url() ?>profile.php"><?php _e( 'Your Profile' ) ?> </a></li>
				<li><a href="<?php echo wp_logout_url($redirect); ?>"><?php _e( 'Logout' ) ?> </a></li>
			</ul>
			<div class="clear"></div>
		</div>
		<?php endif; ?>
	<?php else: ?>
		<div id="login-form">
			<form name="loginform" id="loginform" action="<?php echo esc_url( site_url( 'wp-login.php', 'login_post' ) ) ?>" method="post">
				<p id="log-username"><input type="text" name="log" id="log" title="<?php _e( 'Username' ) ?>" value="<?php _e( 'Username' ) ?>" onfocus="if (this.value == '<?php _e( 'Username' ) ?>') {this.value = '';}" onblur="if (this.value == '') {this.value = '<?php _e( 'Username' ) ?>';}"  size="33" /></p>
				<p id="log-pass"><input type="password" name="pwd" id="pwd" title="<?php _e( 'Password' ) ?>" value="<?php _e( 'Password' ) ?>" onfocus="if (this.value == '<?php _e( 'Password' ) ?>') {this.value = '';}" onblur="if (this.value == '') {this.value = '<?php _e( 'Password' ) ?>';}" size="33" /></p>
				<input type="submit" name="submit" value="<?php _e( 'Log in' ) ?>" class="login-button" />
				<label for="rememberme"><input name="rememberme" id="rememberme" type="checkbox" checked="checked" value="forever" /> <?php _e( 'Remember Me' ) ?></label>
				<input type="hidden" name="redirect_to" value="<?php echo $_SERVER['REQUEST_URI']; ?>"/>
			</form>
			<ul class="login-links">
				<?php echo wp_register() ?>
				<li><a href="<?php echo wp_lostpassword_url($redirect) ?>"><?php _e( 'Lost your password?' ) ?></a></li>
			</ul>
		</div>
	<?php endif;
}

/*-----------------------------------------------------------------------------------*/
# News In Picture
/*-----------------------------------------------------------------------------------*/
function holol_last_news_pic($order , $posts_number = 12 , $cats = 1 ){
	global $post;
	$original_post = $post;

	if( $order == 'random')
		$args = array(
			'posts_per_page'		 => $posts_number,
			'cat'					 => $cats,
			'orderby'				 => 'rand',
			'no_found_rows'          => true,
			'ignore_sticky_posts'	 => true
		);
	else
		$args = array(
			'posts_per_page'		 => $posts_number,
			'cat'					 => $cats,
			'no_found_rows'          => true,
			'ignore_sticky_posts'	 => true
		);

	$get_posts_query = new WP_Query( $args );

	if ( $get_posts_query->have_posts() ):
		$i = 0;
		while ( $get_posts_query->have_posts() ) : $get_posts_query->the_post()?>
        <?php if(++$i%3 == 0) $last = 'last';else $last = '';?>
		<?php if ( function_exists("has_post_thumbnail") && has_post_thumbnail() ) : ?>
				<div <?php holol_post_class( 'post-thumbnail '.$last ); ?>>
					<a class="ttip" title="<?php the_title();?>" href="<?php the_permalink(); ?>" ><?php the_post_thumbnail( 'tie-small' ); ?><span class="fa overlay-icon"></span></a>
				</div><!-- post-thumbnail /-->
			<?php endif; ?>	
		<?php 
		endwhile;
	endif;

	$post = $original_post;
	wp_reset_query();
}
?>