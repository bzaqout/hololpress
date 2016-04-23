<?php
$meta_boxes[] = array(
	'id' => 'meta-box-post',
	'title' => 'إعدادات إضافية',
	'pages' => array('post'),
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(
		array(
    	   'name' => __('العنوان الثانوي', 'divvat'),
    	   'id' => 'dbt_secondary_title',
		   'desc' => 'إذا رغبت في إضافة عنوان ثانوي للخبر',
    	   'type' => 'text',
    	),
		array(
    	   'name' => __('مصدر الخبر	', 'divvat'),
    	   'id' => 'dbt_source_news',
		   'desc' => 'المصدر الذي تم من خلاله معرفة الخبر',
    	   'type' => 'text',
    	),
		array(
    	   'name' => __('تنزيل ملف', 'divvat'),
    	   'id' => 'dbt_download_news',
		   'desc' => 'اضافة ملف للتحميل إذا كان القسم مكتبة صوتية أو كتب أو ملفات ، ضع مسار الملف كاملاً .',
    	   'type' => 'text',
    	),
		array(
    	   'name' => __('المحتوى مقال', 'divvat'),
    	   'id' => 'dbt_articles',
		   'desc' => 'عرض بيانات الكاتب في صفحة المقال',
    	   'type' => 'checkbox',
    	),
		array(
    	   'name' => __('كاتب المقال', 'divvat'),
    	   'id' => 'dbt_author_name',
		   'desc' => 'أضف اسم الكاتب إذا كنت لا ترغب في تسجيله كعضو .',
    	   'type' => 'text',
    	),
		array(
    	   'name' => __('خبر هام', 'divvat'),
    	   'id' => 'dbt_important',
		   'desc' => 'عرض الخبر في قالب الأخبار الهامة',
    	   'type' => 'checkbox',
    	),
		array(
    	   'name' => __('خبر محدَث', 'divvat'),
    	   'id' => 'dbt_updated',
		   'desc' => 'عرض أيقونة محدث أعلى المحتوى',
    	   'type' => 'checkbox',
    	),
		array(
    	   'name' => __('خبر ساخن', 'divvat'),
    	   'id' => 'dbt_hot_content',
		   'desc' => 'عرض أيقونة ساخن أعلى المحتوى',
    	   'type' => 'checkbox',
    	),
		array(
    	   'name' => __('يحتوي صور', 'divvat'),
    	   'id' => 'dbt_photo',
		   'desc' => 'عرض أيقونة صور أعلى المحتوى',
    	   'type' => 'checkbox',
    	),
		array(
    	   'name' => __('يحتوي ملف صوتي', 'divvat'),
    	   'id' => 'dbt_audio',
		   'desc' => 'عرض أيقونة صوتيات أعلى المحتوى',
    	   'type' => 'checkbox',
    	),
		array(
    	   'name' => __('يحتوي فيديو', 'divvat'),
    	   'id' => 'dbt_video',
		   'desc' => 'عرض أيقونة فيديو أعلى المحتوى',
    	   'type' => 'checkbox',
    	),
	)
);

$meta_boxes[] = array(
	'id' => 'meta-box-post-video',
	'title' => 'فيديو رئيسي للمحتوى',
	'pages' => array('post'),
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(
		array(
    	   'name' => __('رابط الفيديو من اليوتيوب فقط', 'divvat'),
    	   'id' => 'featuredVideoURL_field',
    	   'type' => 'text',
    	),
	)
);
function rw_register_meta_boxes()
{
	// Make sure there's no errors when the plugin is deactivated or during upgrade
	if ( !class_exists( 'RW_Meta_Box' ) )
		return;

	global $meta_boxes;
	foreach ( $meta_boxes as $meta_box )
	{
		new RW_Meta_Box( $meta_box );
	}
}
// Hook to 'admin_init' to make sure the meta box class is loaded before
// (in case using the meta box class in another plugin)
// This is also helpful for some conditionals like checking page template, categories, etc.
add_action( 'admin_init', 'rw_register_meta_boxes' );
