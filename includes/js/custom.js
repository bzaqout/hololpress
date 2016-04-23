 $(window).load(function() {
	var $flexslider = $('#home-slider');
		$flexslider.flexslider({
		  
			animation: 'fade',
			controlNav:false,
			manualControls: '.flex-control-nav li',
			useCSS: false,
			start: function ($slider) {
				$('.icon-pause').click(function(){
					if($(this).hasClass('stop')){
						$slider.play(); 
						$(this).removeClass('stop');
						$(this).find('i').removeClass('fa-play');
						$(this).find('i').addClass('fa-pause');
					}else{
						$slider.pause();
						$(this).addClass('stop')
						$(this).find('i').removeClass('fa-pause');
						$(this).find('i').addClass('fa-play');
					}
				});
			
				var $this = $(this)[0];
				$('<div />', {
					'class': $this.namespace + 'progress'
				}).append($('<span />')).appendTo($slider);
				$('.' + $this.namespace + 'progress').find('span').stop().css('width', '0%');
				$('.' + $this.namespace + 'progress').find('span').animate({
					'width': '100%'
				}, $this.slideshowSpeed, $this.easing);
			},
			before: function ($slider) {
				var $this = $(this)[0];
				$('.' + $this.namespace + 'progress').find('span').stop().css('width', '0%');
			},
			after: function ($slider) {
				var $this = $(this)[0];
				$('.' + $this.namespace + 'progress').find('span').animate({
					'width': '100%'
				}, $this.slideshowSpeed, $this.easing);
			}
			
		});	
		
		var counter = 0;
            addCounter();
            function addCounter() {
                counter = $(".flex-progress>span").width() * 100 / ($(".flex-progress").width()+1) ;
                $(".progress-value").text(Math.round(counter)+' %');
                
                setTimeout(addCounter, 100);
            }
			
});
$(document).ready(function() {
	$(".gallery-icon a").attr('rel', 'prettyPhoto[pp_gal]');
	$(".gallery-icon a").prettyPhoto({
		default_width: 800,
		autoplay_slideshow: false,
	});
	$(".lightBox").prettyPhoto();
	
	
	$('.ajax-popup').magnificPopup({ 
		type: 'ajax',
		modal: true,
		closeOnBgClick :true,
		enableEscapeKey : true,
		gallery: {
      enabled: true
    },
		callbacks: {
			ajaxContentAdded: function() {
            this.content.append('<button class="mfp-cust-close">x</button>');
						this.content.find('.mfp-cust-close').on('click', function(e) {
                e.preventDefault();
               $.magnificPopup.close();
            });
        }
		}
	});
	
	if ( $('.filter-list').length) {
		$('.filter-list').mixitup();
	}
	
	$('.service-box').click(function() {
		var selector = '#'+$(this).attr('id');
		$('.serv-thumb').hide();
		$( '.serv-thumb'+selector ).fadeIn();
		
		$('.service-box').removeClass('active');
		$( this ).addClass('active');
	});
	$('.scrollTop').click(function(){
		$('html, body').animate({scrollTop: '0px'}, 800);
		return false;
	});
	
	$('.navbar-toggle').click(function() {
		$('.navbar-collapse').slideToggle();
	 });
	 $('.search-btn').click(function() {
		if($(this).hasClass('open')){
			$('.search-form').fadeOut();
			$(this).removeClass('open');
		}else{
			$('.search-form').fadeIn();
			$(this).addClass('open');
			$('.search-form').find('input').focus();
		}
	 });
	 
	
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
	 
	  $('.about-link').magnificPopup({ 
		type: 'ajax',
		modal: true,
		closeOnBgClick :true,
		enableEscapeKey : true,
		gallery: {
      enabled: true
    },
		callbacks: {
			ajaxContentAdded: function() {
            this.content.append('<button class="mfp-cust-close">x</button>');
						this.content.find('.mfp-cust-close').on('click', function(e) {
                e.preventDefault();
               $.magnificPopup.close();
            });
        }
		}
	});
});