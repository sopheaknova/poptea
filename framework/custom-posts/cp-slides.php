<?php
/*
*****************************************************
* slide custom post
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
		add_action( 'init', 'sp_slide_cp_init' );
		//CP list table columns
		add_action( 'manage_sp_slide_posts_custom_column', 'sp_slide_cp_custom_column' );

	//FILTERS
		//CP list table columns
		add_filter( 'manage_edit-sp_slide_columns', 'sp_slide_cp_columns' );




/*
*****************************************************
*      2) CREATING A CUSTOM POST
*****************************************************
*/
	/*
	* Custom post registration
	*/
	if ( ! function_exists( 'sp_slide_cp_init' ) ) {
		function sp_slide_cp_init() {
			global $cpSlidePosition;

			$role     = 'post'; // page
			$slug     = 'slide';
			$supports = array( 'title', 'thumbnail' );
			//'title', 'editor', 'excerpt', 'thumbnail', 'comments', 'custom-fields'

			/*if ( $smof_data['sp_slide_revisions'] )
				$supports[] = 'revisions';*/

			$args = array(
				'query_var'           => 'slide',
				'capability_type'     => $role,
				'public'              => true,
				'show_ui'             => true,
				'exclude_from_search' => false,
				'hierarchical'        => false,
				'rewrite'             => array( 'slug' => $slug ),
				'slide_position'       => $cpSlidePosition['slide'],
				'menu_icon'           => SP_BASE_URL . 'framework/assets/img/icon-slides.png',
				'supports'            => $supports,
				'labels'              => array(
					'name'               => __( 'Slide', 'sptheme_admin' ),
					'singular_name'      => __( 'Slide', 'sptheme_admin' ),
					'add_new'            => __( 'Add new slide', 'sptheme_admin' ),
					'add_new_item'       => __( 'Add new slide', 'sptheme_admin' ),
					'new_item'           => __( 'Add new slide', 'sptheme_admin' ),
					'edit_item'          => __( 'Edit slide', 'sptheme_admin' ),
					'view_item'          => __( 'View slide', 'sptheme_admin' ),
					'search_items'       => __( 'Search slide', 'sptheme_admin' ),
					'not_found'          => __( 'No slide found', 'sptheme_admin' ),
					'not_found_in_trash' => __( 'No slide found in trash', 'sptheme_admin' ),
					'parent_item_colon'  => ''
				)
			);
			register_post_type( 'sp_slide' , $args );
		}
	} // /sp_slide_cp_init





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
	if ( ! function_exists( 'sp_slide_cp_columns' ) ) {
		function sp_slide_cp_columns( $sp_slideCols ) {
			$prefix = 'sp_slide-';

			$sp_slideCols = array(
				//standard columns
				"cb"                 => '<input type="checkbox" />',
				$prefix . "thumb"    => __( 'Image', 'sptheme_admin' ),
				"title"              => __( 'Slide', 'sptheme_admin' ),
				//$prefix . "category" => __( 'Category', 'sptheme_admin' ),
				"date"               => __( 'Date', 'sptheme_admin' ),
				"author"             => __( 'Created by', 'sptheme_admin' )
			);

			return $sp_slideCols;
		}
	} // /sp_slide_cp_columns

	/*
	* Outputting values for the custom columns in the table
	*
	* $Col = TEXT [column id for switch]
	*/
	if ( ! function_exists( 'sp_slide_cp_custom_column' ) ) {
		function sp_slide_cp_custom_column( $sp_slideCol ) {
			global $post;
			$prefix     = 'sp_slide-';
			$prefixMeta = 'slide-';

			switch ( $sp_slideCol ) {
				//case $prefix . "category":

				//	$terms = get_the_terms( $post->ID , 'slide-category' );
				//	if ( ! is_wp_error( $terms ) && ! empty( $terms ) ) {
				//		foreach ( $terms as $term ) {
				//			$termName = ( isset( $term->name ) ) ? ( $term->name ) : ( null );
				//			echo '<strong>' . $termName . '</strong><br />';
				//		}
				//	}

				//break;
				case $prefix . "thumb":
					
					$size = explode( 'x', SP_ADMIN_LIST_THUMB );
					echo '<a href="' . get_edit_post_link( $post->ID ) . '">' . get_the_post_thumbnail( $post->ID, $size, array( 'title' => get_the_title( $post->ID ) ) ) . '</a>';
						
				break;
				case $prefix . "link":

					/*$sp_slideLink = esc_url( stripslashes( sp_meta_option( $prefixMeta . 'link' ) ) );
					echo '<a href="' . $sp_slideLink . '" target="_blank">' . $sp_slideLink . '</a>';*/
					echo '<a href="#" target="_blank">http://slidelinkurl</a>';

				break;
				default:
				break;
			}
		}
	} // /sp_slide_cp_custom_column