<?php get_header(); ?>
	<div class="wrapper">
    	<div class="container">
            <div class="archive-page">
			<?php if (have_posts()) : while (have_posts()) : the_post();
				$thumb = get_post_thumbnail_id();
				$img_url = wp_get_attachment_url( $thumb,'full');
				 ?>
				<div class="blog-box clearfix">
                	<div class="row">
                        <div class="col-sm-5 frame">
                            <a href="<?php the_permalink()?>"><img src="<?=$img_url?>" alt="<?php the_title()?>"></a>
                        </div>
                        <div class="col-sm-7 text">
                          <div class="text-top-row"><?php the_time('l, F j, Y')?></div>
                          <h3><a href="<?php the_permalink()?>"><?php the_title()?></a></h3>
                          <p><?=get_the_excerpt()?> <a class="more" href="<?php the_permalink()?>"><?php _e('... More','divvat')?></a></p>
                        </div>
                    </div>
            	</div>
					<?php endwhile; ?>	
					
					<?php if (function_exists('page_navi')){page_navi();}?>
					<?php endif; ?>
			</div>
		</div>
	</div>
<?php get_footer(); ?>