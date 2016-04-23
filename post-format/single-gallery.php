<?php
		$header_img = get_post_meta(get_the_ID(), 'header_img', true);
		$bg_title = wp_get_attachment_url( $header_img );?>
		<div class="page-title" style="<?=($bg_title)?'background-image:url('.$bg_title.')':''?>">
        	<div class="container">
            	<div class="row">
                	<div class="col-sm-5">
						<h2><?php the_title()?></h2>
                    </div>
                    <div class="col-sm-7">
                    	<?php breadcrumb_lists();?>
                    </div>
                </div>
			</div>
		</div>
		<div class="container">
        	<div class="row">
            	<div class="col-sm-8">          
                <div class="page-content">
                
                <div class="post-meta">
                    <span class="post-meta-author"><i class="fa fa-user"></i><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) )?>" title=""><?php echo get_the_author() ?> </a></span>
                    <span class="postDate"><i class="fa fa-clock-o"></i><?php the_time('j F Y');?></span>
                    <span class="post-cats"><i class="fa fa-tags"></i><?php printf('%1$s', get_the_category_list( ', ' ) ); ?></span>
                    <span class="postView"><i class="fa fa-eye"></i> <?= getPostViews(get_the_id()); ?></span>
                </div>

                	<?php $gallery = get_post_gallery_images( $post );
					if($gallery):
						echo '<div class="flexslider" id="gallery-slider">
							  <ul class="slides">';
						foreach( $gallery as $image_url ) {
							echo '<li><img src="'.$image_url.'" /></li>';
						}
						echo '</ul></div>';
					endif;
					?>
                    <br/><br/>
                    <?php strip_shortcodes(get_the_content())?>
                </div>
            </div>
			<?php get_sidebar(); ?>
            </div>
		</div> <!-- end #content -->
