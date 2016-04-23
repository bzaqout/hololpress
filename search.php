<?php get_header(); ?>
		<div class="container">
			<div id="content" class="clearfix row">
			
				<div id="main" class="col col-lg-8 clearfix" role="main">
                	<div class="title">
                    	<h2>نتائج البحث لـ : <?php echo esc_attr(get_search_query()); ?></h2>
                    </div>
				<div class="clearfix row">
					<?php if (have_posts()) : while (have_posts()) : the_post();
						$news_type = get_post_meta(get_the_ID(), 'divvat_news_type', true);
					?>
					<div class="box-news">
                    	<div class="news-img">
                        	<a href="<?php the_permalink()?>">
                            	<?php if(has_post_thumbnail()){
									the_post_thumbnail('full');
								}else{
									echo '<div style="height:93px;background:#fff;"></div>';
								}
								?>
                                <span><?= strip_tags(get_the_term_list( $post->ID, 'category', '', ', ', '' )); ?><i></i></span>
                            </a>
                        </div>
                        <div class="news-desc">
                        	<time><?php the_time('j F Y')?></time>
                            <h2><a href="<?php the_permalink()?>"><?php the_title()?> </a></h2>
                            <div class="tags-list">
								<?php
									$posttags = get_the_tags();
									if ($posttags) {
									  foreach($posttags as $tag) {
										echo '<span>'.$tag->name . '</span>'; 
									  }
									}
									?>
                            </div>
                            
                            <div class="news-share clearfix">
                            	<div class='stats-share-box'>
                                	<a href='#' class='stats-share'>مشاركة</a>
                                </div>
                                
                                <div class="commentTotale">
                                	<a href="<?php comments_link(); ?>"><i class="fa fa-comments"></i> <?= wp_count_comments(get_the_id())->approved;?> </a>
                                </div>
                                
                               <div class="facebookTotale">
                                    <a href="http://www.facebook.com/sharer.php?u=<?php the_permalink(); ?>&amp;t=<?php echo urlencode(get_the_title()); ?>" target="_blank" class="share_facebook"><i class="fa fa-facebook-square"></i> <span id="fb_no"></span></a>
                                </div>
                                <div class="twitterTotale">
                                    <a href="http://twitter.com/home?status=<?php echo urlencode(get_the_title() .' '. get_permalink()); ?>" class="share_tweet" target="_blank"><i class="fa fa-twitter-square"></i> <span id="tw_no"></span></a>
                                </div>
                                
                            </div>
                        </div>
                    </div>
					<?php endwhile; ?>	
					
					<?php if (function_exists('page_navi')) { // if expirimental feature is active ?>
						
						<?php page_navi(); // use the page navi function ?>
						
					<?php }?>			
					<?php endif; ?>
                    </div>
			
				</div> <!-- end #main -->
    			
    			<?php get_sidebar(); // sidebar 1 ?>
    
			</div> <!-- end #content -->
		</div>
<?php get_footer(); ?>