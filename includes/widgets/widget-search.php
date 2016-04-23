<?php
add_action( 'widgets_init', 'holol_search_widget' );
function holol_search_widget() {
	register_widget( 'holol_search' );
}
class holol_search extends WP_Widget {
	function holol_search() {
		$widget_ops 	= array( 'classname' => 'search'  );
		$control_ops 	= array( 'width' => 250, 'height' => 350, 'id_base' => 'search-widget' );
		parent::__construct( 'search-widget', __( 'بحث' , 'tie') , $widget_ops, $control_ops );
	}
	function widget( $args, $instance ) { global $is_IE; ?>
        <form action="<?php echo home_url( '/' ); ?>" method="get" class="form-inline">
            <div class="input-group">
                <input type="text" name="s" id="search" placeholder="<?php _e("Search","divvat"); ?>" value="<?php the_search_query(); ?>" class="form-control" />
                <span class="input-group-btn">
                    <button type="submit" class="btn btn-default"><?php _e("Search","divvat"); ?></button>
                </span>
            </div>
    </form>		
<?php
	}
}
?>