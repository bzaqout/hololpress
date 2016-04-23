
jQuery(document).ready(function() {

	
/*----------------------------------------------------------------------------------*/
/*	Setup pages
/*----------------------------------------------------------------------------------*/
	
	var about_page_meta = jQuery('#meta-box-about');
	about_page_meta.css('display', 'none');
		
	var long_course_page_meta = jQuery('#meta-box-long-course');
	long_course_page_meta.css('display', 'none');
	
	var diploma_page_meta = jQuery('#meta-box-diploma');
	diploma_page_meta.css('display', 'none');
/*----------------------------------------------------------------------------------*/
/*	OnChange conditions
/*----------------------------------------------------------------------------------*/

	var group = jQuery('#page_template');
	
	group.change( function() {
		
		if(jQuery(this).val() == 'template/template-about-page.php') {
			about_page_meta.css('display', 'block');
			tzHideAll(about_page_meta);
			about_page_meta.css('display', 'block');
			
		}else if(jQuery(this).val() == 'template/template-long-course-page.php') {
			long_course_page_meta.css('display', 'block');
			tzHideAll(long_course_page_meta);
			long_course_page_meta.css('display', 'block');
			
		}else if(jQuery(this).val() == 'template/template-diploma-page.php') {
			diploma_page_meta.css('display', 'block');
			tzHideAll(diploma_page_meta);
			diploma_page_meta.css('display', 'block');
			
		} else {
			about_page_meta.css('display', 'none');
			team_page_meta.css('display', 'none');
			long_course_page_meta.css('display', 'none');
			diploma_page_meta.css('display', 'none');
		}
		
	});
	
/*----------------------------------------------------------------------------------*/
/*	OnLoad conditions
/*----------------------------------------------------------------------------------*/	

	if (jQuery("#page_template option[value='template/template-about-page.php']").attr('selected')) 
		{ 
			about_page_meta.css('display', 'block');
		}
				
	if (jQuery("#page_template option[value='template/template-long-course-page.php']").attr('selected')) 
		{ 
			long_course_page_meta.css('display', 'block');
		}
	
	if (jQuery("#page_template option[value='template/template-diploma-page.php']").attr('selected')) 
		{ 
			diploma_page_meta.css('display', 'block');
		}
			
	function tzHideAll(notThisOne) {
		about_page_meta.css('display', 'none');
		long_course_page_meta.css('display', 'none');
		diploma_page_meta.css('display', 'none');
	}

});