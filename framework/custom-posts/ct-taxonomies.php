<?php
/*
*****************************************************
* Custom taxonomies for custom posts
*
* CONTENT:
* - 1) Actions and filters
* - 2) Taxonomies function
*****************************************************
*/





/*
*****************************************************
*      1) ACTIONS AND FILTERS
*****************************************************
*/
	//ACTIONS
		//Registering taxonomies
		add_action( 'init', 'sp_create_taxonomies', 0 );
		/*
		The init action occurs after the theme's functions file has been included, so if you're looking for terms directly in the functions file, you're doing so before they've actually been registered.
		*/





/*
*****************************************************
*      2) TAXONOMIES FUNCTION
*****************************************************
*/
	/*
	* Custom taxonomies registration
	*/
	if ( ! function_exists( 'sp_create_taxonomies' ) ) {
		function sp_create_taxonomies() {
			$slugMenuCategory = 'menu/category';
			$slugMenuType     = 'menu/type';
			
				register_taxonomy( 'menu-category', 'sp_menu', array(
					'hierarchical'      => true,
					'show_in_nav_menus' => false,
					'show_ui'           => true,
					'query_var'         => 'menu-category',
					'rewrite'           => array( 'slug' => $slugMenuCategory ),
					'labels'            => array(
						'name'          => __( 'Menu categories', 'sptheme_admin' ),
						'singular_name' => __( 'Menu category', 'sptheme_admin' ),
						'search_items'  => __( 'Search categories', 'sptheme_admin' ),
						'all_items'     => __( 'All categories', 'sptheme_admin' ),
						'parent_item'   => __( 'Parent category', 'sptheme_admin' ),
						'edit_item'     => __( 'Edit category', 'sptheme_admin' ),
						'update_item'   => __( 'Update category', 'sptheme_admin' ),
						'add_new_item'  => __( 'Add new category', 'sptheme_admin' ),
						'new_item_name' => __( 'New category title', 'sptheme_admin' )
					)
				) );
				register_taxonomy( 'menu-type', 'sp_menu', array(
					'hierarchical'      => false,
					'show_in_nav_menus' => false,
					'show_ui'           => true,
					'query_var'         => 'menu-type',
					'rewrite'           => array( 'slug' => $slugMenuType ),
					'labels'            => array(
						'name'          => __( 'Menu types', 'sptheme_admin' ),
						'singular_name' => __( 'Menu type', 'sptheme_admin' ),
						'search_items'  => __( 'Search types', 'sptheme_admin' ),
						'all_items'     => __( 'All types', 'sptheme_admin' ),
						'parent_item'   => __( 'Parent type', 'sptheme_admin' ),
						'edit_item'     => __( 'Edit type', 'sptheme_admin' ),
						'update_item'   => __( 'Update type', 'sptheme_admin' ),
						'add_new_item'  => __( 'Add new type', 'sptheme_admin' ),
						'new_item_name' => __( 'New type title', 'sptheme_admin' )
					)
				) );
		}
	} // /sp_create_taxonomies

?>