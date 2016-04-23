	<div class="col-sm-4 sidebar">
    	 <div class="widget">
			<div class="widget-title">
				<h2>اخبار التعليم</h2>
				<a class="readmore" href="#"><i class="fa fa-plus"></i> المزيد</a>
			</div>
			<div class="inner-widget author-news clearfix"> 
				<ul>
				<?php 
					$args = array(
					'numberposts' => 4,
					'posts_per_page' => 4,
					);
					query_posts($args);
				while ( have_posts() ) : the_post();?>
                    <li class="">
                    <?php if ( function_exists("has_post_thumbnail") && has_post_thumbnail() ) {?>	
						<div class="post-thumbnail">	
							<a href="<?php the_permalink()?>" title="<?php the_title( )?>" rel="bookmark">
								<?php the_post_thumbnail('holol-small')?>
								<span class="fa overlay-icon"></span>
							</a>
						</div>
						<?php }?>
						<h3 class="post-box-title"><a href="<?php the_permalink()?>"><?php the_title( )?></a></h3>
					</li>
					<?php endwhile; wp_reset_query();?>
				</ul>
			</div>
		</div>
    	<!-------------------------->
    	<div class="widget">
			<div class="widget-title">
				<h2>اخبار التعليم</h2>
				<a class="readmore" href="#"><i class="fa fa-plus"></i> المزيد</a>
			</div>
			<div class="inner-widget category-news clearfix"> 
				<ul>
				<?php 
					$args = array(
					'numberposts' => 4,
					'posts_per_page' => 4,
					);
					query_posts($args);
				while ( have_posts() ) : the_post();?>
                    <li class="">
                    <?php if ( function_exists("has_post_thumbnail") && has_post_thumbnail() ) {?>	
						<div class="post-thumbnail">	
							<a href="<?php the_permalink()?>" title="<?php the_title( )?>" rel="bookmark">
								<?php the_post_thumbnail('holol-small')?>
								<span class="fa overlay-icon"></span>
							</a>
						</div>
						<?php }?>
						<h3 class="post-box-title"><a href="<?php the_permalink()?>"><?php the_title( )?></a></h3>
					</li>
					<?php endwhile; wp_reset_query();?>
				</ul>
			</div>
		</div>
        <!------------------------------------->
       
	</div>
            