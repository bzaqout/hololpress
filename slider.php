<section class="slider">
        <div class="flexslider clearfix" id="home-slider">
          <ul class="slides">
					<?php 
					$args = array(
						'numberposts' => 5,
						'posts_per_page' => 5,
						'meta_key'   => 'enable_slider',
						'meta_value' => 1
					);
					query_posts($args);
					while ( have_posts() ) : the_post();
						$thumb = get_post_thumbnail_id();
						$img_url = wp_get_attachment_url( $thumb,'full');
					?>
					
						<li>
                        	<a href="<?php the_permalink()?>">
                                <img src="<?= $img_url?>" alt="<?php the_title();?>" />
                            </a>
                            <div class="slider-caption">
                            	<h2><a href="<?php the_permalink()?>"><?php the_title()?></a></h2>
                                <p><?= get_the_excerpt()?></p>
							</div>
                        </li>
					<?php 
					endwhile;wp_reset_query();?>
			</ul>
        </div>
</section>
