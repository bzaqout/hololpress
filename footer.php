</div>
     <footer>
    	<div class="container">
            	<div class="row">
                	<div class="col-sm-4">
                    	<div class="social">
                        	<span><?php _e('Stay Connected','divvat')?></span>
                            <?php if(get_option('of_facebook')){?>
                        		<a class="fc" href="<?=get_option('of_facebook')?>"><i class="fa fa-facebook"></i></a>
                            <?php } if(get_option('of_twitter')){?>
                            	<a class="tw" href="<?=get_option('of_twitter')?>"><i class="fa fa-twitter"></i></a>
                            <?php } if(get_option('of_instagram')){?>
                            	<a class="is" href="<?=get_option('of_instagram')?>"><i class="fa fa-instagram"></i></a>
                            <?php } if(get_option('of_youtube')){?>
                            	<a class="yt" href="<?=get_option('of_youtube')?>"><i class="fa fa-youtube"></i></a>
                            <?php } if(get_option('of_linkedin')){?>
                            	<a class="in" href="<?=get_option('of_linkedin')?>"><i class="fa fa-linkedin"></i></a>
                            <?php }if(get_option('of_gplus')){?>
                            	<a class="gp" href="<?=get_option('of_gplus')?>"><i class="fa fa-google-plus"></i></a>
                            <?php }?>
                        </div>
                    </div>
                    <div class="col-sm-4 copyright">
                    	<p><?php
							if(is_rtl()){
								echo get_option('of_copyright');
							}else{
								echo get_option('of_copyright_en');
							} 
						?></p>
                    </div>
                    
                    <div class="col-sm-4">
                    	<div class="scroll-top">
                        	<span><?php _e('Scrolling Up','divvat')?></span>
                            <button type="button" class="scrollTop"><i class="fa fa-angle-double-up"></i></button>
                        </div>
                    </div>
                </div>
            </div>
		</footer> 
               
        <?php wp_enqueue_script('jquery');?>
        <?php wp_footer(); ?>
	</body>
</html>