 $(window).load(function() {
	var $flexslider = $('#home-slider');
		$flexslider.flexslider({
			animation: 'fade',
			controlNav:false,
			directionNav:false,
		});	
});
$(document).ready(function() {
	$(".gallery-icon a").attr('rel', 'prettyPhoto[pp_gal]');
	$(".gallery-icon a").prettyPhoto({
		default_width: 800,
		autoplay_slideshow: false,
	});
	$(".lightBox").prettyPhoto();
	$('.navbar-nav>li>a').click(function() {
		if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
		  var target = $(this.hash);
		  target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
			if (target.length) {
				$('html,body').animate({
				scrollTop: target.offset().top
			}, 1000);
			return false;
			}
		}
	  
	 });
	 
});

function createTicker(){    	
	var tickerLIs 	= jQuery("#breaking-news ul").children();          
	tickerItems 	= new Array();                                
	tickerLIs.each(function(el) {                             
		tickerItems.push( jQuery(this).html() );                
	});                                                       
	i = 0  ;                                                 
	rotateTicker();                                           
}                                                        
var isInTag = false;                                        
function typetext() {
	var $breaking_news = jQuery('#breaking-news ul');
	if( $breaking_news.length > 0 ){
		var thisChar = tickerText.substr(c, 1);                   
		if( thisChar == '<' ){ isInTag = true; }                  
		if( thisChar == '>' ){ isInTag = false; }                 
		$breaking_news.html(tickerText.substr(0, c++));   
		if(c < tickerText.length+1)                                     
			if( isInTag ){                                                
				typetext();                                                 
			}else{                                                        
				setTimeout("typetext()", 35);                               
			}                                                             
		else {                                                          
			c = 1;                                                        
			tickerText = "";                                              
		}
	}
}
