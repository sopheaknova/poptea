<?php 

/* ---------------------------------------------------------------------- */
/*	Basic Theme Settings
/* ---------------------------------------------------------------------- */
$shortname = get_template();

//WP 3.4+ only
$themeData     = wp_get_theme( $shortname );
$themeName     = $themeData->Name;
$themeVersion  = $themeData->Version;
	
define( 'SP_BASE_DIR', TEMPLATEPATH . '/' );
define( 'SP_BASE_URL', get_template_directory_uri() . '/' );
define( 'THEME_VERSION', $themeData->Version);
define( 'THEME_NAME', 'PT'); // should be $themeName but it's too long
define( 'SP_SCRIPTS_VERSION', 20130405 );
define( 'SP_ADMIN_LIST_THUMB', '64x64' ); //thumbnail size (width x height) on post/page/custom post listings

//Global variables
	//Custom post WordPress admin menu position
		if ( ! isset( $cpMenuPosition ) )
			$cpMenuPosition = array(
					'projects'        => 30
					/*'logos'           => 33,
					'staff'           => 48*/
				);

/* ---------------------------------------------------------------------- */
/*	Setup and Load Parts
/* ---------------------------------------------------------------------- */

// Add setup functions
require_once( SP_BASE_DIR . 'framework/functions/setup-theme.php' );
require_once( SP_BASE_DIR . 'framework/functions/theme-functions.php' );

// Add widgets
require_once( SP_BASE_DIR . 'framework/widgets/widgets.php' );

//Custom post type
require_once( SP_BASE_DIR . 'framework/custom-posts/custom-posts.php' );

// Add Admin Option
require_once( SP_BASE_DIR . 'framework/admin/index.php' );

//Add Shortcodes
/*require_once( SP_BASE_DIR . 'framework/shortcodes/shortcodes.php' );
if ( is_admin() && current_user_can( 'edit_posts' ) )
		require_once( SP_BASE_DIR . 'framework/shortcodes/shortcodes-generator.php' );*/

// Add metaboxes
require_once( SP_BASE_DIR . 'framework/meta-box/class.php' );
require_once( SP_BASE_DIR . 'framework/meta-box/meta-boxes.php' );

//Plugins activation
if ( is_admin() && current_user_can( 'switch_themes' ) ) {
	require_once( SP_BASE_DIR . 'framework/plugins/plugin-activation/class-tgm-plugin-activation.php' );
	require_once( SP_BASE_DIR . 'framework/plugins/plugin-activation/plugins.php' );
}