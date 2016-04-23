<?php get_header(); ?>
    <div class="wrapper">
    	<div class="container">
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					
					<div class="title">
                        <h2><?php the_title()?></h2>
                    </div>
                    <?php the_content()?>
                            
					<?php endwhile; ?>		
					<?php endif; ?>
			
	</div> <!-- end #content -->
</div>
<?php get_footer(); ?>