<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<title><?php wp_title(''); ?><?php if(wp_title('', false)) { echo ' :'; } ?> <?php bloginfo('name'); ?></title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<!-- html5.js -->
		<!--[if lt IE 9]>
			<script src="<?=get_template_directory_uri()?>/includes/js/html5shiv.min.js"></script>
		<![endif]-->
		
		<!-- wordpress head functions -->
		<?php wp_head(); ?>
		<!-- end of wordpress head -->
	</head>
    	
<body <?php body_class(); ?>>
	<header>
    
	<!---------------- News Ticker ----------------->
	<div class="news-ticker">
		<span class="ticker-title">جديد الإعلانات : </span>
            <?php
                $args=array(
                    'post_type'=>'newads',
                    'posts_per_page'=>12,
                );
		query_posts($args);?>
		<marquee direction="right" onmouseout="this.start()" onmouseover="this.stop()" scrolldelay="100">
            <?php while ( have_posts() ) : the_post(); ?>
				<a href="<?php the_permalink()?>"><?php the_title();?></a>
			<?php endwhile; wp_reset_query();?>
		</marquee>
	</div>
    <!-----------------Top Header---------------->
    <div class="top-header">
    	<div class="container">
            <div class="row">
                <div class="col-sm-3">
                    <span class="current-date"><i class="fa fa-calender"></i> الثلاثاء , 12 رجب 1437 هـ , 19 أبريل 2016 م
    </span>
                </div>
                <div class="col-sm-6">
                    <?php top_links()?>
                </div>
                <div class="col-sm-3">
                    <form action="<?php echo home_url( '/' ); ?>" method="get" class="form-inline">
                        <div class="input-group">
                            <input type="text" name="s" id="search" placeholder="<?php _e("بحث","divvat"); ?>" value="<?php the_search_query(); ?>" class="form-control" />
                            <span class="input-group-btn">
                                <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                            </span>
                        </div>
                </form>
                </div>
            </div>
        </div>
    </div>
    <!-----------------Middle Header---------------->
	<div class="mid-header">
    	<div class="container">
        	<div class="row">
            	<div class="col-sm-4">
                	<h1 class="logo">
                    	<a title="<?= get_bloginfo('description'); ?>"  href="<?= home_url(); ?>">
                    	<?php if(get_option('of_logo')){?>
                    		<img src="<?=get_option('of_logo')?>" alt="<?= get_bloginfo('name'); ?>" />
                        <?php }else{ echo get_bloginfo('name');}?>
                   </a>
                    </h1>
                </div>
                <div class="col-sm-8">
                	<div class="googleads">
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-----------------------BTM HEADER------------->
    	<div class="container">
        	<div class="main-nav clearfix">
				<div class="navbar-header">
                    <button type="button" class="navbar-toggle close_nav">
                    	<span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
					</button>
                    <a title="<?= get_bloginfo('description'); ?>"  class="navbar-brand" href="<?= home_url(); ?>">
                    	<?= get_bloginfo('name');?>
                   </a>
				  </div>
                  <div class="collapse navbar-collapse clearfix">
                    <?php holol_main_nav(); ?>
                  </div>
			</div>
        </div>
    </header>
    <div class="header-widget">
    	<?php if ( is_active_sidebar( 'headerWidget' ) ){dynamic_sidebar( 'headerWidget' );}?>
    </div>
    
    
    <div class="container">
