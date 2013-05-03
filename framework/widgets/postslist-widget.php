<?php
/*
*****************************************************
* List of posts
*****************************************************
*/


/*
*****************************************************
*      WIDGET CLASS
*****************************************************
*/
class sp_post_list_widget extends WP_Widget {
	/*
	*****************************************************
	*      widget constructor
	*****************************************************
	*/
	function __construct() {
		$id     = 'sp-posts-list';
		$prefix = THEME_NAME . ': ';
		$name   = '<span>' . $prefix . __( 'Posts', 'sptheme_widget' ) . '</span>';
		$widget_ops = array(
			'classname'   => 'sp-posts-list',
			'description' => __( 'List of recent, popular, random or upcoming posts with/without thumbnail images', 'sptheme_widget' )
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
		$excerptLength = ( isset( $excerptLength ) ) ? ( absint( $excerptLength ) ) : ( 10 );
		$category      = ( isset( $category ) ) ? ( $category ) : ( null );
		$count         = ( isset( $count ) && 0 < absint( $count ) ) ? ( absint( $count ) ) : ( 5 );
		$disableThumbnail = ( isset( $disableThumbnail ) ) ? ( $disableThumbnail ) : ( null );
		$date          = ( isset( $date ) ) ? ( $date ) : ( null );

		//HTML to display widget settings form
		?>
		<p class="sp-desc"><?php _e( 'Displays advanced posts list. You can set multiple post categories, just press [CTRL] key and click the category names.', 'sptheme_widget' ) ?><br /><?php _e( 'Please note that this widget does not display Quote and Status post formats.', 'sptheme_widget' ) ?></p>

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
			<label for="<?php echo $this->get_field_id( 'excerptLength' ); ?>"><?php _e( 'Excerpt length in:', 'sptheme_widget' ); ?></label><br />
			<select class="widefat" name="<?php echo $this->get_field_name( 'excerptLength' ); ?>" id="<?php echo $this->get_field_id( 'excerptLength' ); ?>">
				<?php
				$options = array(
					0  => 0,
					5  => 5,
					10 => 10,
					15 => 15,
					20 => 20,
					25 => 25,
					30 => 30,
					35 => 35,
					40 => 40
					);
				foreach ( $options as $optId => $option ) {
					?>
					<option <?php echo 'value="'. $optId . '" '; selected( $excerptLength, $optId ); ?>><?php echo $option; ?></option>
					<?php
				}
				?>
			</select>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'category' ); ?>"><?php _e( 'Posts source (category):', 'sptheme_widget' ); ?></label><br />
			<select class="widefat" name="<?php echo $this->get_field_name( 'category' ); ?>[]" id="<?php echo $this->get_field_id( 'category' ); ?>" multiple="multiple">
				<?php
				$options = sp_tax_array( array( 'return' => 'term_id' ) );
				foreach ( $options as $optId => $option ) {
					?>
					<option <?php echo 'value="'. $optId . '" ';
					if ( is_array( $category ) && in_array( $optId, $category ) )
						echo 'selected="selected"';
					else
						selected( $category, $optId );
					?>><?php echo $option; ?></option>
					<?php
				}
				?>
			</select>
			<small><?php _e( 'Hold down [CTRL] key for multiselection', 'sptheme_widget' ) ?></small>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'count' ); ?>"><?php _e( 'Posts count:', 'sptheme_widget' ) ?></label><br />
			<input class="text-center" type="number" id="<?php echo $this->get_field_id( 'count' ); ?>" name="<?php echo $this->get_field_name( 'count' ); ?>" value="<?php echo $count; ?>" size="5" maxlength="2" />
		</p>
        
		<p>
			<input id="<?php echo $this->get_field_id( 'disableThumbnail' ); ?>" name="<?php echo $this->get_field_name( 'disableThumbnail' ); ?>" type="checkbox" <?php checked( $disableThumbnail, 'on' ); ?>/>
			<label for="<?php echo $this->get_field_id( 'disableThumbnail' ); ?>"><?php _e( 'Disable disable Thumbnail', 'sptheme_widget' ); ?></label>
		</p>
        
		<p>
			<input id="<?php echo $this->get_field_id( 'date' ); ?>" name="<?php echo $this->get_field_name( 'date' ); ?>" type="checkbox" <?php checked( $date, 'on' ); ?>/>
			<label for="<?php echo $this->get_field_id( 'date' ); ?>"><?php _e( 'Disable publish date', 'sptheme_widget' ); ?></label>
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
		$instance['excerptLength'] 		= absint( $new_instance['excerptLength'] );
		$instance['category']      		= $new_instance['category'];
		$count                     		= ( 0 < absint( $new_instance['count'] ) ) ? ( absint( $new_instance['count'] ) ) : ( 5 );
		$instance['count']         		= $count;
		$instance['disableThumbnail']   = $new_instance['disableThumbnail'];
		$instance['date']          		= $new_instance['date'];

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
		$excerptLength = ( isset( $excerptLength ) ) ? ( absint( $excerptLength ) ) : ( 10 );
		$count         = ( isset( $count ) && 0 < absint( $count ) ) ? ( absint( $count ) ) : ( 5 );

		if ( isset( $category ) && is_array( $category ) )
			$category = implode( ',', $category );
		elseif ( isset( $category ) )
			$category = $category;
		else
			$category = 0;

		$class = '';
		if ( isset( $date ) )
			$class .= ' no-date';
		if ( 0 === $excerptLength )
			$class .= ' no-excerpt';

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
				'cat'                 => $category
				/*'tax_query'           => array( array(
					'taxonomy' => 'post_format',
					'field'    => 'slug',
					'terms'    => array( 'post-format-quote', 'post-format-status' ),
					'operator' => 'NOT IN',
					) ) */
			) );

		if ( $posts->have_posts() ) :
			//HTML to display output
			?>
			<ul class="<?php echo $class; ?>">
			<?php
			$imgSize = 'widget';
			$imgSize = trim($imgSize);

			while ( $posts->have_posts() ) : $posts->the_post();
				$out = '<li>';

				$content = $posts->post->post_excerpt . $posts->post->post_content;

				if ( has_post_format( 'audio' ) || has_post_format( 'video' ) ) {
					$mediaURL = '';

					//search for the first URL in content
					preg_match( '/http(.*)/', strip_tags( $content ), $matches );
					if ( isset( $matches[0] ) )
						$mediaURL = trim( $matches[0] );

					//remove <a> tag containing URL
					$content = preg_replace( '/<a(.*?)>http(.*?)<\/a>/', '', $content );
					//remove any video URL left in content
					if ( $mediaURL )
						$content = str_replace( array( $mediaURL, $mediaURL . ' ', ' ' . $mediaURL ), '', $content );
				}

				//image
				$thumb  = ( has_post_thumbnail() ) ? ( wp_get_attachment_image_src( get_post_thumbnail_id(), $imgSize ) ) : ( array( '' ) );
				$image  = ( $thumb[0] ) ? ( '<img src="' . esc_url( $thumb[0] ) . '" alt="' . get_the_title() . '" title="' . get_the_title() . '" />' ) : '<i class="wmicon-post-format"></i>';

				if ( ! isset( $disableThumbnail ) )
					$out .= '<div class="image-container"><a href="' . get_permalink() . '">' . $image . '</a></div>';
                
                // image video
     
				if( has_post_format( 'video' )) {
                    
                    $image_video = '<img src="http://img.youtube.com/vi/'.sp_get_custom_field( 'sp_video_id', $post->ID ).'/0.jpg" width="71" height="66" />';
				    $out .= '<div class="image-container"><a href="' . get_permalink() . '" rel="bookmark">' . $image_video . '</a></div>';
				}
				
                /* add div cover title, date, excerpt */
                $get_class = has_post_thumbnail()||has_post_format( 'video' )? 'widget-info': '';

                $out .= '<div class= '.$get_class.'>';
				//title
				if(has_post_thumbnail() || has_post_format( 'video' )){

			    $out .= '<h3><a href="' . get_permalink() . '">' . get_the_title() . '</a></h3>';
                }else{
                
                $out .= '<h3><a class="no-thumbnail" href="' . get_permalink() . '">' . get_the_title() . '</a></h3>';
				}
				/* add hr for title */
				$get_title = get_the_title();
				if(isset($get_title) && $get_title!= '' && $get_title!= ' '){
                $out .= '<hr class="grey">';
				}

				//date
				$get_date = get_the_date();
				if($excerptLength > 0){
                    
                   if ( ! isset( $date ) )
				   $out .= '<div datetime="' . esc_attr( get_the_date( 'c' ) ) . '" class="date">' . esc_html( "Posted on: ".$get_date ) . '</div>';

				}else{
				   if ( ! isset( $date ) )
				   $out .= '<div datetime="' . esc_attr( get_the_date( 'c' ) ) . '" class="date">' . esc_html( $get_date ) . '</div>';

				}
				
				//excerpt
				if ( isset( $excerptLength ) && $excerptLength ) {
					$content = sp_string_length( strip_tags( $content ), $excerptLength, '&hellip;' );
					if ( $content )
						$out .= '<div class="excerpt">' . $content . '</div>';
				}

				$out .= '</div>';
                
				echo $out . '</li>';
			endwhile;
			?>
			</ul>
			<?php
		endif;
		wp_reset_query();

		echo $after_widget;
	} // /widget

} // /sp_post_list

?>