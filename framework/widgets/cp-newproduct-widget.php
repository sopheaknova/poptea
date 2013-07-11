<?php
/*
*****************************************************
* List of Custom New Product
*****************************************************
*/


/*
*****************************************************
*      WIDGET CLASS
*****************************************************
*/
class sp_custom_list_widget extends WP_Widget {
	/*
	*****************************************************
	*      widget constructor
	*****************************************************
	*/
	function __construct() {
		$id     = 'sp-custom-list';
		$prefix = THEME_NAME . ': ';
		$name   = '<span>' . $prefix . __( 'New Products', 'sptheme_widget' ) . '</span>';
		$widget_ops = array(
			'classname'   => 'sp-custom-list',
			'description' => __( 'List of recent, new products with slideshow of thumbnail images', 'sptheme_widget' )
			);
		$control_ops = array();

		//$this->WP_Widget( $id, $name, $widget_ops, $control_ops );
		parent::__construct( $id, $name, $widget_ops, $control_ops );
	} // /__construct

	/*
	*****************************************************
	*      widget options form in admin
	*****************************************************
	*/
	public function form( $instance ) {
		extract( $instance );
		$title         = ( isset( $title ) ) ? ( $title ) : ( null );
		$type          = ( isset( $type ) ) ? ( $type ) : ( null );
		$taxonomyCat = ( isset( $taxonomyCat ) ) ? ( $taxonomyCat ) : ( null );
		//$category      = ( isset( $category ) ) ? ( $category ) : ( null );
		$count         = ( isset( $count ) && 0 < absint( $count ) ) ? ( absint( $count ) ) : ( 5 );
		//$disableThumbnail = ( isset( $disableThumbnail ) ) ? ( $disableThumbnail ) : ( null );
		//$date          = ( isset( $date ) ) ? ( $date ) : ( null );

		//HTML to display widget settings form
		?>
		<p class="sp-desc"><?php _e( 'Displays advanced New Products. You can select which category menu you want.', 'sptheme_widget' ) ?><br /><?php _e( 'Please note that this widget does not display Quote and Status post formats.', 'sptheme_widget' ) ?></p>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'sptheme_widget' ) ?></label><br />
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'type' ); ?>"><?php _e( 'List type:', 'sptheme_widget' ); ?></label><br />
			<select class="widefat" name="<?php echo $this->get_field_name( 'type' ); ?>" id="<?php echo $this->get_field_id( 'type' ); ?>">
				<?php
				$options = array(
					'date,DESC,publish'          => __( 'Recent posts', 'sptheme_widget' ),
					'comment_count,DESC,publish' => __( 'Popular posts', 'sptheme_widget' ),
					'rand,DESC,publish'          => __( 'Random posts', 'sptheme_widget' ),
					'date,DESC,future'           => __( 'Upcoming posts', 'sptheme_widget' )
					);
				foreach ( $options as $optId => $option ) {
					?>
					<option <?php echo 'value="'. $optId . '" '; selected( $type, $optId ); ?>><?php echo $option; ?></option>
					<?php
				}
				?>
			</select>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'taxonomyCat' ); ?>"><?php _e( 'Category New Product:', 'sptheme_widget' ); ?></label><br />
			<select class="widefat" name="<?php echo $this->get_field_name( 'taxonomyCat' ); ?>" id="<?php echo $this->get_field_id( 'taxonomyCat' ); ?>">
				
				<?php // testing
				$args = array(
							'type'                     => 'sp_menu',
							'orderby'                  => 'name',
							'order'                    => 'ASC',
							'taxonomy'                 => 'menu-category');
				
				$categories = get_categories($args);
				foreach($categories as $cat){
	 	   	  	          	  
                    if($cat->parent == 0 ){ ?>  
                    <option <?php echo 'value="'.$parent = $cat->name.'"'; selected( $taxonomyCat, $optId );?>><?php echo $parent = $cat->name; ?></option>
                      	
                <?php    }// end if parent
	   	  	    }
				?>
			</select>
		</p>


		<p>
			<label for="<?php echo $this->get_field_id( 'count' ); ?>"><?php _e( 'Posts count:', 'sptheme_widget' ) ?></label><br />
			<input class="text-center" type="number" id="<?php echo $this->get_field_id( 'count' ); ?>" name="<?php echo $this->get_field_name( 'count' ); ?>" value="<?php echo $count; ?>" size="5" maxlength="2" />
		</p>
        
		
		<?php
	} // /form

	/*
	*****************************************************
	*      process and save the widget options
	*****************************************************
	*/
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		$instance['title']         		= $new_instance['title'];
		$instance['type']          		= $new_instance['type'];
		$instance['taxonomyCat'] 		= $new_instance['taxonomyCat'];
		//$instance['category']      		= $new_instance['category'];
		$count                     		= ( 0 < absint( $new_instance['count'] ) ) ? ( absint( $new_instance['count'] ) ) : ( 5 );
		$instance['count']         		= $count;
		//$instance['disableThumbnail']   = $new_instance['disableThumbnail'];
		//$instance['date']          		= $new_instance['date'];

		return $instance;
	} // /update


	/*
	*****************************************************
	*      output the widget content
	*****************************************************
	*/
	public function widget( $args, $instance ) {
		extract( $args );
		extract( $instance );

		$type          = ( isset( $type ) ) ? ( explode( ',', $type ) ) : ( array( 'date', 'DESC', 'publish' ) );
		$taxonomyCat = ( isset( $taxonomyCat ) ) ? ( $taxonomyCat ) : ( 0 );
		$count         = ( isset( $count ) && 0 < absint( $count ) ) ? ( absint( $count ) ) : ( 5 );

		echo $before_widget;

		//if the title is not filled, no title will be displayed
		if ( isset( $title ) && '' != $title && ' ' != $title ){
			echo $before_title . apply_filters( 'widget_title', $title ) . $after_title;
		}
			
            
		wp_reset_query();

		$posts = new WP_Query( array(
				'posts_per_page'      => $count,
				'ignore_sticky_posts' => 1,
				'orderby'             => $type[0],
				'order'               => $type[1],
				'post_status'         => $type[2],
				'menu-category'       => $taxonomyCat,
				'post_type'           =>'sp_menu'
			) );

		if ( $posts->have_posts() ) :
			//HTML to display output?>
			<?php
			$imgSize = 'product-thumb';
			$imgSize = trim($imgSize); ?>
            <div class="widget-slide">
			<?php while ( $posts->have_posts() ) : $posts->the_post();
				$out = '<div class="items">';
				//image
				$thumb  = ( has_post_thumbnail() ) ? ( wp_get_attachment_image_src( get_post_thumbnail_id(), $imgSize ) ) : ( array( '' ) );
				$image  = ( $thumb[0] ) ? ( '<img src="' . esc_url( $thumb[0] ) . '" alt="' . get_the_title() . '" title="' . get_the_title() . '" />' ) : '<i class="wmicon-post-format"></i>';

					$out .= $image ;

                //title
				if(has_post_thumbnail()){

			    $out .= '<h6><a href="' . get_permalink() . '">' . get_the_title() . '</a></h6>';
                }

				echo $out . '</div>';
			endwhile;?>
            </div>
            <!-- end .widget-slide -->
            <div class="widget-nav clearfix">
           	   <a id="prev" href="">
           	   	<img src="<?php bloginfo('template_url');?>/images/previous-white.png"/></a>
           	   <a id= "next" href="">
           	   	<img src="<?php bloginfo('template_url');?>/images/next-white.png"></a>
           </div>
			<?php
		endif;
		wp_reset_query();

		echo $after_widget;
	} // /widget

} // /sp_post_list
?>