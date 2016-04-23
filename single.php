<?php get_header(); ?>
    <div class="wrapper">
        <div class="container">
            <div class="news-details clearfix">
            	<?php if (have_posts()) : while (have_posts()) : the_post();
					$thumb = get_post_thumbnail_id();
					$img_url = wp_get_attachment_url( $thumb,'full'); ?>
                    <div class="post-thumbnail">
                        <a href="<?php the_permalink()?>"><img src="<?=$img_url ?>" alt="<?php the_title()?>"></a>
                    </div>
                    <div class="text">
						<div class="text-top-row"><?php the_time('l, F j, Y')?></div>
						<h3><?php the_title()?></h3>
                        <?php echo strip_shortcodes(get_the_content());?>
            		</div>
                    
                    <div class="gallery-post row">
                    	<?php
							$gallery = get_post_gallery_images( $post );
							if($gallery){
								foreach( $gallery as $image_url ) {
									$image = aq_resize( $image_url, 250, 250, true );?>
                                    <div class="col-md-3 col-sm-6">
                                        <div class="gallery-item">
                                            <a href="<?=$image_url?>" class="lightbox" rel="prettyPhoto[pp_gal]">
                                                <img src="<?php echo $image;?>" alt="<?php the_title();?>"/>
                                            </a>
                                        </div>	
                                </div>
							<?php	}
							}
						?>
                    </div>
                <?php endwhile; ?>
				<?php endif; ?>
            </div>
		</div> 
	</div>
<?php get_footer(); ?>