<?php
add_action( 'widgets_init', 'holol_PostWidget' );
function holol_PostWidget() {
	register_widget( 'MY_PostWidget' );
}
class MY_PostWidget extends WP_Widget {
    /** constructor */
    function MY_PostWidget() {
        parent::WP_Widget(false, $name = 'آخر المقالات للتصنيف');	
    }

  /** @see WP_Widget::widget */
    function widget($args, $instance) {		
        extract( $args );
        $title = apply_filters('widget_title', $instance['title']);
		$category = apply_filters('widget_category', $instance['category']);
		$post_style = apply_filters('widget_post_style', $instance['post_style']);
		
		if($post_style == 3){
				echo do_shortcode('[news_pic cat="'.$category.'" title="'.$title.'"]');
		}else{
			echo do_shortcode('[last_post cat="'.$category.'" style="'.$post_style.'" title="'.$title.'"]');
		}
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
		$post_style = esc_attr($instance['post_style']);
		
		$categories_obj = get_categories();
		$categories 	= array();

		foreach ($categories_obj as $pn_cat) {
			$categories[$pn_cat->cat_ID] = $pn_cat->cat_name;
		}
		
        ?>
      <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'holol'); ?> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label></p>
      
      <p><label for="<?php echo $this->get_field_id('category'); ?>"><?php _e('Category:', 'holol'); ?><br />

      <select id="<?php echo $this->get_field_id('category'); ?>" name="<?php echo $this->get_field_name('category'); ?>" style="width:150px;" > 
      <?php foreach ($categories as $key => $option) { ?>
		<option value="<?php echo $key ?>" <?php echo ($category == $key ? ' selected="selected"' : ''); ?>><?php echo $option; ?></option>
	<?php } ?>
      </select>
      </label></p>
      
			
			<p><label for="<?php echo $this->get_field_id('post_style'); ?>"><?php _e('style:', 'holol'); ?><br />

      <select id="<?php echo $this->get_field_id('post_style'); ?>" name="<?php echo $this->get_field_name('post_style'); ?>" style="width:150px;" > 
		<option value="1" <?php echo ($post_style == 1 ? ' selected="selected"' : ''); ?>>1</option>
      	<option value="2" <?php echo ($post_style == 2 ? ' selected="selected"' : ''); ?>>2</option>
		<option value="3" <?php echo ($post_style == 3 ? ' selected="selected"' : ''); ?> >3</option>
      </select>
      </label></p>
			 
        <?php 
    }

} // class Widget
?>