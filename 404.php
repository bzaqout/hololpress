<?php get_header(); ?>
			<div class="container">
				<div id="content" class="clearfix ">

					<article id="post-not-found" class="clearfix">
							<div class="hero-unit">
							
								<h1><?php _e("Epic 404 - Article Not Found","divvat"); ?></h1>
								<p><?php _e("This is embarassing. We can't find what you were looking for.","divvat"); ?></p>
															
							</div>
					
						<section class="post_content">
							
							<p><?php _e("Whatever you were looking for was not found, but maybe try looking again or search using the form below.","divvat"); ?></p>

							<div class="row">
								<div class="col col-lg-12">
									<?php get_search_form(); ?>
								</div>
							</div>
					
						</section> <!-- end article section -->
						
					</article> <!-- end article -->
			
				</div> <!-- end #main -->
    
			</div> <!-- end #content -->

<?php get_footer(); ?>
