<?php
/*
*****************************************************
* menu custom post
*
* CONTENT:
* - 1) Actions and filters
* - 2) Creating a custom post
* - 3) Custom post list in admin
*****************************************************
*/





/*
*****************************************************
*      1) ACTIONS AND FILTERS
*****************************************************
*/
	//ACTIONS
		//Registering CP
		add_action( 'init', 'sp_menu_cp_init' );
		//CP list table columns
		add_action( 'manage_sp_menu_posts_custom_column', 'sp_menu_cp_custom_column' );

	//FILTERS
		//CP list table columns
		add_filter( 'manage_edit-sp_menu_columns', 'sp_menu_cp_columns' );




/*
*****************************************************
*      2) CREATING A CUSTOM POST
*****************************************************
*/
	/*
	* Custom post registration
	*/
	if ( ! function_exists( 'sp_menu_cp_init' ) ) {
		function sp_menu_cp_init() {
			global $cpMenuPosition;

			$role     = 'post'; // page
			$slug     = 'menu';
			$supports = array( 'title', 'editor', 'thumbnail' );
			//'title', 'editor', 'excerpt', 'thumbnail', 'comments', 'custom-fields'

			/*if ( $smof_data['sp_menu_revisions'] )
				$supports[] = 'revisions';*/

			$args = array(
				'query_var'           => 'menu',
				'capability_type'     => $role,
				'public'              => true,
				'show_ui'             => true,
				'exclude_from_search' => false,
				'hierarchical'        => false,
				'rewrite'             => array( 'slug' => $slug ),
				'menu_position'       => 30,
				'menu_icon'           => SP_BASE_URL . 'framework/assets/img/icon-portfolio-01.png',
				'supports'            => $supports,
				'labels'              => array(
					'name'               => __( 'Menu', 'sptheme_admin' ),
					'singular_name'      => __( 'Menu', 'sptheme_admin' ),
					'add_new'            => __( 'Add new menu', 'sptheme_admin' ),
					'add_new_item'       => __( 'Add new menu', 'sptheme_admin' ),
					'new_item'           => __( 'Add new menu', 'sptheme_admin' ),
					'edit_item'          => __( 'Edit menu', 'sptheme_admin' ),
					'view_item'          => __( 'View menu', 'sptheme_admin' ),
					'search_items'       => __( 'Search menu', 'sptheme_admin' ),
					'not_found'          => __( 'No menu found', 'sptheme_admin' ),
					'not_found_in_trash' => __( 'No menu found in trash', 'sptheme_admin' ),
					'parent_item_colon'  => ''
				)
			);
			register_post_type( 'sp_menu' , $args );
		}
	} // /sp_menu_cp_init





/*
*****************************************************
*      3) CUSTOM POST LIST IN ADMIN
*****************************************************
*/
	/*
	* Registration of the table columns
	*
	* $Cols = ARRAY [array of columns]
	*/
	if ( ! function_exists( 'sp_menu_cp_columns' ) ) {
		function sp_menu_cp_columns( $sp_menuCols ) {
			$prefix = 'sp_menu-';

			$sp_menuCols = array(
				//standard columns
				"cb"                 => '<input type="checkbox" />',
				$prefix . "thumb"    => __( 'Image', 'sptheme_admin' ),
				"title"              => __( 'Menu', 'sptheme_admin' ),
				$prefix . "category" => __( 'Category', 'sptheme_admin' ),
				"date"               => __( 'Date', 'sptheme_admin' ),
				"author"             => __( 'Created by', 'sptheme_admin' )
			);

			return $sp_menuCols;
		}
	} // /sp_menu_cp_columns

	/*
	* Outputting values for the custom columns in the table
	*
	* $Col = TEXT [column id for switch]
	*/
	if ( ! function_exists( 'sp_menu_cp_custom_column' ) ) {
		function sp_menu_cp_custom_column( $sp_menuCol ) {
			global $post;
			$prefix     = 'sp_menu-';
			$prefixMeta = 'menu-';

			switch ( $sp_menuCol ) {
				case $prefix . "category":

					$terms = get_the_terms( $post->ID , 'menu-category' );
					if ( ! is_wp_error( $terms ) && ! empty( $terms ) ) {
						foreach ( $terms as $term ) {
							$termName = ( isset( $term->name ) ) ? ( $term->name ) : ( null );
							echo '<strong>' . $termName . '</strong><br />';
						}
					}

				break;
				case $prefix . "thumb":
					
					$size = explode( 'x', SP_ADMIN_LIST_THUMB );
					echo '<a href="' . get_edit_post_link( $post->ID ) . '">' . get_the_post_thumbnail( $post->ID, $size, array( 'title' => get_the_title( $post->ID ) ) ) . '</a>';
						
				break;
				case $prefix . "link":

					/*$sp_menuLink = esc_url( stripslashes( sp_meta_option( $prefixMeta . 'link' ) ) );
					echo '<a href="' . $sp_menuLink . '" target="_blank">' . $sp_menuLink . '</a>';*/
					echo '<a href="#" target="_blank">http://menulinkurl</a>';

				break;
				default:
				break;
			}
		}
	} // /sp_menu_cp_custom_column