<?php get_header(); ?>
	
    <div class="row">
    	<div class="col-sm-8">
        	<?php get_template_part( 'slider');?>
            <!-------------------RECENT POST-------------------------->
            <div class="recent-news">
            	<div class="title">
                	<h2>آخر الأخبار</h2>
                    <a class="readmore" href="#"><i class="fa fa-plus"></i> المزيد</a>
                </div>
				<div id="news-block-1" class="box-container"> 
                	<div class="row">
						<?php 
						$args = array(
							'cat' =>76,
                            'numberposts' => 12,
                            'posts_per_page' => 12,
                        );
                        query_posts($args);
                        while ( have_posts() ) : the_post();?>
                        	<div class="col-md-3 col-sm-4">
                            	<div class="news-box">
									<?php if ( has_post_thumbnail() ) : ?>			
                                        <div class="post-thumbnail">
                                            <a href="<?php the_permalink(); ?>" rel="bookmark">
												<?php the_post_thumbnail( 'holol-medium' ); ?>
                                                <span class="fa fa-file-text"></span>
                                            </a>
                                        </div><!-- post-thumbnail /-->
                                    <?php endif; ?>
                                    <div class="post-meta">
                                    	<?php holol_get_time()?>
                                    </div>
                                    <h2 class="post-box-title">
                                        <a href="<?php the_permalink()?>">
                                            <?=limit_words(get_the_title(),10)?>...
                                        </a>
                                    </h2>
                                </div>
                            </div>
                        <?php endwhile; wp_reset_query();?>
                    </div>
				</div>
			</div>
            
            <!-------------------RECENT POST-------------------------->
            <div class="recent-news">
            	<div class="title">
                	<h2>اخبار التعليم</h2>
                    <a class="readmore" href="#"><i class="fa fa-plus"></i> المزيد</a>
                </div>
				<div id="news-block-2" class="box-container"> 
                	<div class="row">
						<?php 
                            $args = array(
							'cat' =>76,
                            'numberposts' => 10,
                            'posts_per_page' => 10,
                        );
                        query_posts($args);
                        while ( have_posts() ) : the_post();?>
                        	<div class="col-md-3 col-sm-4">
                            	<div class="news-box">
									<?php if ( has_post_thumbnail() ) : ?>			
                                        <div class="post-thumbnail">
                                            <a href="<?php the_permalink(); ?>" rel="bookmark">
												<?php the_post_thumbnail( 'holol-medium' ); ?>
                                                <span class="fa fa-file-text"></span>
                                            </a>
                                        </div><!-- post-thumbnail /-->
                                    <?php endif; ?>
                                    <div class="post-meta">
                                    	<?php holol_get_time()?>
                                    </div>
                                    <h2 class="post-box-title">
                                        <a href="<?php the_permalink()?>">
                                            <?=limit_words(get_the_title(),10)?>...
                                        </a>
                                    </h2>
                                </div>
                            </div>
                        <?php endwhile; wp_reset_query();?>
                    </div>
				</div>
			</div>
            
            <!-------------------RECENT POST-------------------------->
            <div class="recent-news">
            	<div class="title">
                	<h2>اخبار التعليم</h2>
                    <a class="readmore" href="#"><i class="fa fa-plus"></i> المزيد</a>
                </div>
				<div id="news-pic-1" class="box-container news-pic clearfix"> 
                	<div class="row">
						<?php 
                            $args = array(
							'cat' =>76,
                            'numberposts' => 12,
                            'posts_per_page' => 12,
                        );
                        query_posts($args);
                        while ( have_posts() ) : the_post();?>
                        	<div class="col-md-4 col-sm-3">
                            	<?php if ( function_exists("has_post_thumbnail") && has_post_thumbnail() ) {?>	
                                <div class="post-thumbnail">	
                                	<a href="<?php the_permalink()?>" title="<?php the_title( )?>" rel="bookmark">
                                    	<?php the_post_thumbnail('holol-medium')?>
                                        <h3><?=limit_words(get_the_title(),10)?>...</h3>
                                    </a>
								</div>
								<?php }?>	
                            </div>
                        <?php endwhile; wp_reset_query();?>
                    </div>
				</div>
			</div>
            <!---------------------------------------------> 
            
			<!-------------------RECENT POST-------------------------->
            <div class="recent-news-cat">
            	<div class="title">
                	<h2>اخبار التعليم</h2>
                    <a class="readmore" href="#"><i class="fa fa-plus"></i> المزيد</a>
                </div>
				<div id="pic-box-1" class="box-container pic-box cat-box clearfix"> 
                	<ul>
						<?php 
                            $args = array(
							'cat' =>76,
                            'numberposts' => 5,
                            'posts_per_page' => 5,
                        );
                        query_posts($args); $count=0;?>
							 <?php while ( have_posts() ) : the_post();?>
                             	<?php if(++$count == 1) : ?>
                                <li class="first-pic">
                                    <?php if ( function_exists("has_post_thumbnail") && has_post_thumbnail() ) : ?>			
                                        <div class="post-thumbnail">
                                            <a href="<?php the_permalink(); ?>" class="ttip">
                                                <?php the_post_thumbnail( 'holol-large' ); ?>
                                                <h3><?=limit_words(get_the_title(),10)?>...</h3>
                                            </a>
                                        </div><!-- post-thumbnail /-->
                                    <?php endif; ?>
                                </li><!-- .first-pic -->
								<?php else: ?>
                                <li>
                                    <?php if ( function_exists("has_post_thumbnail") && has_post_thumbnail() ) : ?>			
                                        <div class="post-thumbnail">
                                            <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="ttip">
                                                <?php the_post_thumbnail( 'holol-medium' ); ?>
                                                <h3><?php the_title()?></h3>
                                            </a>
                                        </div><!-- post-thumbnail /-->
                                    <?php endif; ?>			
                                </li>	
                                <?php endif; ?>
						<?php  endwhile; wp_reset_query();?>
                    </ul>
				</div>
			</div>
            <!-------------------RECENT POST-------------------------->
            <div class="recent-news-cat">
            	<div class="title">
                	<h2>اخبار التعليم</h2>
                    <a class="readmore" href="#"><i class="fa fa-plus"></i> المزيد</a>
                </div>
				<div id="pic-box-2" class="box-container pic-box cat-box clearfix"> 
                	<ul>
						<?php 
                            $args = array(
							'cat' =>76,
                            'numberposts' => 5,
                            'posts_per_page' => 5,
                        );
                        query_posts($args); $count=0;?>
							 <?php while ( have_posts() ) : the_post();?>
                             	<?php if(++$count == 1) : ?>
                                <li class="first-pic">
                                    <?php if ( function_exists("has_post_thumbnail") && has_post_thumbnail() ) : ?>			
                                        <div class="post-thumbnail">
                                            <a href="<?php the_permalink(); ?>" class="ttip">
                                                <?php the_post_thumbnail( 'holol-large' ); ?>
                                                <h3><?=limit_words(get_the_title(),10)?>...</h3>
                                            </a>
                                        </div><!-- post-thumbnail /-->
                                    <?php endif; ?>
                                </li><!-- .first-pic -->
								<?php else: ?>
                                <li>
                                    <?php if ( function_exists("has_post_thumbnail") && has_post_thumbnail() ) : ?>			
                                        <div class="post-thumbnail">
                                            <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="ttip">
                                                <?php the_post_thumbnail( 'holol-medium' ); ?>
                                                <h3><?php the_title()?></h3>
                                            </a>
                                        </div><!-- post-thumbnail /-->
                                    <?php endif; ?>			
                                </li>	
                                <?php endif; ?>
						<?php  endwhile; wp_reset_query();?>
                    </ul>
				</div>
			</div>
            
            <!-------------------RECENT POST-------------------------->
            <div class="recent-news">
            	<div class="title">
                	<h2>اخبار التعليم</h2>
                    <a class="readmore" href="#"><i class="fa fa-plus"></i> المزيد</a>
                </div>
				<div id="pic-title-3" class="news-video box-container clearfix"> 
                	<div class="row">
						<?php 
                            $args = array(
							'cat' =>76,
                            'numberposts' => 4,
                            'posts_per_page' => 4,
                        );
                        query_posts($args);?>
						<div class="col-sm-6">
                       <?php while ( have_posts() ) : the_post();
					   	$video_url = get_post_meta(get_the_ID(), 'video_url', true);?>
                       
							<div class="post-video">	
                            <?php 
								if($video_url){
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
							</div>
                        <?php break; endwhile;?>
                        </div>
                        <div class="col-sm-6">
                        	<ul class="list-news">
							 <?php while ( have_posts() ) : the_post();
							 $video = get_post_meta(get_the_ID(), 'video', true);?>
                                <li class="col-md-4 col-sm-6">
                                    <?php if ( function_exists("has_post_thumbnail") && has_post_thumbnail() ) {?>	
                                    <div class="post-thumbnail">	
                                        <a href="<?php the_permalink()?>" title="<?php the_title( )?>" rel="bookmark">
                                            <?php the_post_thumbnail('holol-small')?>
                                            <span class="fa fa-file-text"></span>
                                        </a>
                                    </div>
                                    <?php }?>
                                    <h3 class="post-box-title"><a href="<?php the_permalink()?>" rel="bookmark"><?php the_title()?></a></h3>
                                </li>
                            <?php break; endwhile; wp_reset_query();?>
                            </ul>
                        </div>
                    </div>
				</div>
			</div>
            <!---------------------------------------------> 
            
            <div class="row">
            	<div class="col-sm-6">
                	 <!-------------------RECENT POST-------------------------->
                    <div class="cat-news">
                        <div class="title">
                            <h2>اخبار التعليم</h2>
                            <a class="readmore" href="#"><i class="fa fa-plus"></i> المزيد</a>
                        </div>
                        <div class="cat-box-content box-container clearfix"> 
                            <ul>
                                <?php 
                                    $args = array(
									'cat' =>76,
                                    'numberposts' => 4,
                                    'posts_per_page' => 4,
                                );
                                query_posts($args);
                                $i=0;
                                while ( have_posts() ) : the_post();?>
                                    <?php if(++$i==1){?>
                                        <li class="first-news">
                                            <div class="inner-content">
                                            <?php if ( function_exists("has_post_thumbnail") && has_post_thumbnail() ) {?>	
                                            <div class="post-thumbnail">	
                                                <a href="<?php the_permalink()?>" title="<?php the_title( )?>" rel="bookmark">
                                                    <?php the_post_thumbnail('holol-medium')?>
                                                    <span class="fa fa-file-text"></span>
                                                    
                                                </a>
                                            </div>
                                            <?php }?>
                                            <h2 class="post-box-title"><a href="<?php the_permalink()?>"><?php the_title( )?></a></h2>
                                            </div>
                                        </li>
                                    <?php }else{?>
                                        <li class="other-news">
                                            <?php if ( function_exists("has_post_thumbnail") && has_post_thumbnail() ) {?>	
                                            <div class="post-thumbnail">	
                                                <a href="<?php the_permalink()?>" title="<?php the_title( )?>" rel="bookmark">
                                                    <?php the_post_thumbnail('holol-small')?>
                                                    <span class="fa fa-file-text"></span>
                                                    
                                                </a>
                                            </div>
                                            <?php }?>
                                            <h3 class="post-box-title"><a href="<?php the_permalink()?>"><?php the_title( )?></a></h3>
                                            <div class="post-meta">
												<?php holol_get_time()?>
                                            </div>
                                        </li>
                                    <?php }?>
                                <?php endwhile; wp_reset_query();?>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
					<div class="cat-news">
                        <div class="title">
                            <h2>اخبار التعليم</h2>
                            <a class="readmore" href="#"><i class="fa fa-plus"></i> المزيد</a>
                        </div>
                        <div class="cat-box-content box-container clearfix"> 
                            <ul>
                                <?php 
                                    $args = array(
									'cat' =>76,
                                    'numberposts' => 4,
                                    'posts_per_page' => 4,
                                );
                                query_posts($args);
                                $i=0;
                                while ( have_posts() ) : the_post();?>
                                    <?php if(++$i==1){?>
                                        <li class="first-news">
                                            <div class="inner-content">
                                            <?php if ( function_exists("has_post_thumbnail") && has_post_thumbnail() ) {?>	
                                            <div class="post-thumbnail">	
                                                <a href="<?php the_permalink()?>" title="<?php the_title( )?>" rel="bookmark">
                                                    <?php the_post_thumbnail('holol-medium')?>
                                                    <span class="fa fa-file-text"></span>
                                                    
                                                </a>
                                            </div>
                                            <?php }?>
                                            <h2 class="post-box-title"><a href="<?php the_permalink()?>"><?php the_title( )?></a></h2>
                                            </div>
                                        </li>
                                    <?php }else{?>
                                        <li class="other-news">
                                            <?php if ( function_exists("has_post_thumbnail") && has_post_thumbnail() ) {?>	
                                            <div class="post-thumbnail">	
                                                <a href="<?php the_permalink()?>" title="<?php the_title( )?>" rel="bookmark">
                                                    <?php the_post_thumbnail('holol-small')?>
                                                    <span class="fa overlay-icon"></span>
                                                    
                                                </a>
                                            </div>
                                            <?php }?>
                                            <h3 class="post-box-title"><a href="<?php the_permalink()?>"><?php the_title( )?></a></h3>
                                            <div class="post-meta">
												<?php holol_get_time()?>
                                            </div>
                                        </li>
                                    <?php }?>
                                <?php endwhile; wp_reset_query();?>
                            </ul>
                        </div>
                    </div>

                </div>
            </div>
            
            
        </div>
        
        <?php get_sidebar(); ?>
        
    </div>

<?php get_footer(); ?>