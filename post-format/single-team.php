<?php get_header(); ?>
    <div class="wrapper">
        <div class="container">
        	<div class="row">
            	<div class="col-sm-8">
				<?php if (have_posts()) : while (have_posts()) : the_post();
                $position = get_post_meta(get_the_ID(), 'position', true);
				$team_email = get_post_meta(get_the_ID(), 'team_email', true);
				$team_phone = get_post_meta(get_the_ID(), 'team_phone', true);
                $facebook = get_post_meta(get_the_ID(), 'facebook', true);
                $twitter = get_post_meta(get_the_ID(), 'twitter', true);
                $gplus = get_post_meta(get_the_ID(), 'gplus', true);
                $linedin = get_post_meta(get_the_ID(), 'linedin', true);?>
				<div class="post-details clearfix">
                	<div class="row">
                	<?php if(has_post_thumbnail()){?>
                            <div class="col-md-5">
                            	<div class="post-thumbnail">
                                	<?php the_post_thumbnail('full');?>
                                </div>
                            </div>
                            <div class="col-md-7 team-info">
                            	<h3><?php the_title()?></h3>
                                <span><?= $position?></span>
								<span><i class="fa fa-envelope"></i> <?= $team_email?></span>
								<span><i class="fa fa-phone"></i> <?= $team_phone?></span>
                                
                                <div class="team-social social">
                                	<?php if($facebook){?>
                                        <a href="<?=$facebook?>" alt="facebook">
                                            <i class="fa fa-facebook"></i>
                                        </a>
                                    <?php }?>
                                    <?php if($twitter){?>
                                        <a href="<?=$twitter?>" alt="twitter">
                                            <i class="fa fa-twitter"></i>
                                        </a>
                                    <?php }?>
                                    <?php if($gplus){?>
                                        <a href="<?=$gplus?>" alt="google +">
                                            <i class="fa fa-google-plus"></i>
                                        </a>
                                    <?php }?>
                                    <?php if($linkedin){?>
                                        <a href="<?=$linkedin?>" alt="linkedin">
                                            <i class="fa fa-linkedin"></i>
                                        </a>
                                    <?php }?>
                                </div>
                            </div>
                        <?php }?>
                     </div>
                    <div class="text-post">
                        <?php the_content()?>
            		</div>
				</div>
			<?php endwhile; ?>
			<?php endif; ?>
            </div>
            	<?php get_sidebar()?>
            </div>
            
		</div> 
	</div>
<?php get_footer(); ?>