<?php
		$header_img = get_post_meta(get_the_ID(), 'header_img', true);
		$image = wp_get_attachment_url( $header_img );?>
		<div class="page-title" style="background-image:url(<?=$image?>)">
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
				<?php if(has_post_thumbnail()){
                    echo '<div class="post-img">';
                        the_post_thumbnail('full');
                    echo '</div>';
                }?>
                <div class="page-content">
                
                <div class="post-meta">
                    <span class="post-meta-author"><i class="fa fa-user"></i><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) )?>" title=""><?php echo get_the_author() ?> </a></span>
                    <span class="postDate"><i class="fa fa-clock-o"></i><?php the_time('j F Y');?></span>
                    <span class="post-cats"><i class="fa fa-tags"></i><?php printf('%1$s', get_the_category_list( ', ' ) ); ?></span>
                    <span class="postView"><i class="fa fa-eye"></i> <?= getPostViews(get_the_id()); ?></span>
                </div>

                	<?php the_content()?>
                </div>
            </div>
			<?php get_sidebar(); ?>
            </div>
		</div> <!-- end #content -->
