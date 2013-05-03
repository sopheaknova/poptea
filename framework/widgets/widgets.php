<?php

/* ---------------------------------------------------------------------- */
/*	Add custom color of widget header
/* ---------------------------------------------------------------------- */
function load_custom_wp_admin_style() {
		wp_register_style( 'admin_addons', SP_BASE_URL . 'framework/assets/css/admin-addon.css', false, SP_SCRIPTS_VERSION );
		wp_enqueue_style( 'admin_addons' );
}
add_action( 'admin_enqueue_scripts', 'load_custom_wp_admin_style' );

/* ---------------------------------------------------------------------- */
/*	Register sidebars
/* ---------------------------------------------------------------------- */
function sp_widgets_init() {
	
	global $data;
	
	// Main Widget Area
	register_sidebar(array(
		'name'          => __('Right Sidebar', 'sptheme_domain'),
		'id' => 'right-sidebar',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3><hr class="green">',
	));
	
	// Footer Widget Area
	register_sidebar(array(
		'name'          => __('Footer Sidebar', 'sptheme_domain'),
		'id' => 'footer-sidebar',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	));
	
	// Dynamic sidebar generate
	$generate_sidebars = $data['sidebar_options']; 
	if($generate_sidebars){
		foreach ($generate_sidebars as $sidebar) { 
			if ( function_exists('register_sidebar') )
			register_sidebar(array(
			'name' 			=> $sidebar['title'],
			'id'			=> str_replace(' ', '-', strtolower($sidebar['title'])),
			'description' 	=> 'Widgets in this area will be shown in the sidebar.',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h5 class="label-mod">',
			'after_title'   => '</h5>',
			));
		}
	}
	
	// Addon widgets		
	require_once ( SP_BASE_DIR . 'framework/widgets/text-image-widget.php' );
	require_once ( SP_BASE_DIR . 'framework/widgets/video-widget.php' );
	require_once ( SP_BASE_DIR . 'framework/widgets/fb-likebox-widget.php' );
	require_once ( SP_BASE_DIR . 'framework/widgets/subnav-widget.php' );
	require_once ( SP_BASE_DIR . 'framework/widgets/contact-widget.php' );
	require_once ( SP_BASE_DIR . 'framework/widgets/postslist-widget.php' );
	require_once ( SP_BASE_DIR . 'framework/widgets/cp-newproduct-widget.php' );
	
	// Register widgets
	register_widget( 'sp_text_image_widget' );
	register_widget( 'sp_video_widget' );
	register_widget( 'sp_fb_likebox_widget' );
	register_widget( 'sp_subnav_widget' );
	register_widget( 'sp_contact_info_widget' );
	register_widget( 'sp_post_list_widget' );
    register_widget( 'sp_custom_list_widget' );
}
add_action('widgets_init', 'sp_widgets_init');




