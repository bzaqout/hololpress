<?php
	$header_img = get_post_meta(get_the_ID(), 'header_img', true);
		$image = wp_get_attachment_url( $header_img );
		$video_type = get_post_meta(get_the_ID(), 'video_type', true);
		$video_url = get_post_meta(get_the_ID(), 'video_url', true);
		?>
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
				<?php if($video_type =='youtube'){
									//Get ID from video url
								$video_id = str_replace( 'http://youtube.com/watch?v=', '', $video_url );
								$video_id = str_replace( 'http://www.youtube.com/watch?v=', '', $video_id );
								$video_id = str_replace( 'https://youtube.com/watch?v=', '', $video_id );
								$video_id = str_replace( 'https://www.youtube.com/watch?v=', '', $video_id );
								$video_id = str_replace( '&feature=channel', '', $video_id );
								$video_id = str_replace( '&feature=channel', '', $video_id );

        echo '<iframe title="YouTube video player" class="youtube-player" type="text/html" width="95%" height="500" src="http://www.youtube.com/embed/'.$video_id.'" frameborder="0"></iframe>';
		
								}
							?>
                            <?php if($video_type == 'vimeo'){
									//Get ID from video url
									$video_id = str_replace( 'http://vimeo.com/', '', $video_url );
									$video_id = str_replace( 'vimeo.com/', '', $video_id );
									$video_id = str_replace( 'www.vimeo.com/', '', $video_id );
									$video_id = str_replace( 'http://www.vimeo.com/', '', $video_id );
							
									//Display Vimeo video
									echo '<iframe src="//player.vimeo.com/video/'.$video_id.'" width="95%" height="500" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
';
		
								}
							?>
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
