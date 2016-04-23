<?php
add_action( 'widgets_init', 'holol_CarouselPosts' );
function holol_CarouselPosts() {
	register_widget( 'MY_CarouselPosts' );
}
class MY_CarouselPosts extends WP_Widget {
    /** constructor */
    function MY_CarouselPosts() {
        parent::WP_Widget(false, $name = 'My Carousel Posts');	
    }

  /** @see WP_Widget::widget */
    function widget($args, $instance) {		
        extract( $args );
        $title = apply_filters('widget_title', $instance['title']);
		$category = apply_filters('widget_category', $instance['category']);
		$no_posts = apply_filters('widget_no_posts', $instance['no_posts']);
		
		carousel_posts($title, $category, $no_posts);
        ?>
        <?php
    }

    /** @see WP_Widget::update */
    function update($new_instance, $old_instance) {				
        return $new_instance;
    }

    /** @see WP_Widget::form */
    function form($instance) {				
      	$title = esc_attr($instance['title']);
		$category = esc_attr($instance['category']);
		$no_posts = esc_attr($instance['no_posts']);
		
		$categories_obj = get_categories();
		$categories 	= array();

		foreach ($categories_obj as $pn_cat) {
			$categories[$pn_cat->cat_ID] = $pn_cat->cat_name;
		}
		
        ?>
      <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('العنوان:', 'holol'); ?> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label></p>
      
      <p><label for="<?php echo $this->get_field_id('category'); ?>"><?php _e('التصنيف:', 'holol'); ?><br />

      <select id="<?php echo $this->get_field_id('category'); ?>" name="<?php echo $this->get_field_name('category'); ?>" style="width:150px;" > 
      <?php foreach ($categories as $key => $option) { ?>
		<option value="<?php echo $key ?>" <?php echo ($category == $key ? ' selected="selected"' : ''); ?>><?php echo $option; ?></option>
	<?php } ?>
      </select>
      </label></p>
      
      <p><label for="<?php echo $this->get_field_id('no_posts'); ?>"><?php _e('عدد المقالات:', 'holol'); ?> <input class="widefat" id="<?php echo $this->get_field_id('no_posts'); ?>" name="<?php echo $this->get_field_name('no_posts'); ?>" type="text" value="<?php echo $no_posts; ?>" /></label></p>
			 
        <?php 
    }

} // class Widget
?>