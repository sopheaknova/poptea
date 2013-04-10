<?php

/*
*****************************************************
*      WIDGET CLASS
*****************************************************
*/

class sp_projects_list_widget extends WP_Widget {
	/*
	*****************************************************
	*      widget constructor
	*****************************************************
	*/
	function __construct() {
		$id     = 'sp-projects-list';
		$prefix = THEME_NAME . ': ';
		$name   = '<span>' . $prefix . __( 'Projects', 'sptheme_widget' ) . '</span>';
		$widget_ops = array(
			'classname'   => 'sp-projects-list',
			'description' => __( 'List of portfolio projects', 'sptheme_widget' )
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
	function form( $instance ) {
		extract( $instance );
		$title    = ( isset( $title ) ) ? ( $title ) : ( null );
		$type     = ( isset( $type ) ) ? ( $type ) : ( null );
		$category = ( isset( $category ) ) ? ( $category ) : ( null );
		$count    = ( isset( $count ) && 0 < absint( $count ) ) ? ( absint( $count ) ) : ( 6 );

		//HTML to display widget settings form
		?>
		<p class="sp-desc"><?php _e( 'Displays list of projects from all or specific categories.', 'sptheme_widget' ); ?></p>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'sptheme_widget' ); ?></label><br />
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'type' ); ?>"><?php _e( 'List type:', 'sptheme_widget' ); ?></label><br />
			<select class="widefat" name="<?php echo $this->get_field_name( 'type' ); ?>" id="<?php echo $this->get_field_id( 'type' ); ?>">
				<?php
				$options = array(
					'rand' => __( 'Random items', 'sptheme_widget' ),
					'date' => __( 'Recent items', 'sptheme_widget' )
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
			<label for="<?php echo $this->get_field_id( 'category' ); ?>"><?php _e( 'Projects source (category):', 'sptheme_widget' ); ?></label><br />
			<select class="widefat" name="<?php echo $this->get_field_name( 'category' ); ?>[]" id="<?php echo $this->get_field_id( 'category' ); ?>" multiple="multiple">
				<?php
				$options = sp_tax_array( array(
						'allCountPost' => 'sp_projects',
						'allText'      => __( 'All projects', 'sptheme_widget' ),
						'parentsOnly'  => true,
						'return'       => 'term_id',
						'tax'          => 'project-category',
					) );
				foreach ( $options as $optId => $option ) {
					?>
					<option <?php echo 'value="'. $optId . '" ';
					if ( is_array( $category ) && in_array( $optId, $category ) )
						echo 'selected="selected"';
					elseif ( ! is_array( $category ) )
						selected( $category, $optId );
					?>><?php echo $option; ?></option>
					<?php
				}
				?>
			</select>
			<small><?php _e( 'Hold down [CTRL] key for multiselection', 'sptheme_widget' ) ?></small>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'count' ); ?>"><?php _e( 'Projects count:', 'sptheme_widget' ); ?></label><br />
			<input class="text-center" type="number" id="<?php echo $this->get_field_id( 'count' ); ?>" name="<?php echo $this->get_field_name( 'count' ); ?>" value="<?php echo $count; ?>" size="5" maxlength="2" />
		</p>
		<?php
	} // /form



	/*
	*****************************************************
	*      process and save the widget options
	*****************************************************
	*/
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		$instance['title']    = $new_instance['title'];
		$instance['type']     = $new_instance['type'];
		$instance['category'] = $new_instance['category'];
		$count                = ( 0 < absint( $new_instance['count'] ) ) ? ( absint( $new_instance['count'] ) ) : ( 6 );
		$instance['count']    = $count;

		return $instance;
	} // /update



	/*
	*****************************************************
	*      output the widget content
	*****************************************************
	*/
	function widget( $args, $instance ) {
		extract( $args );
		extract( $instance );

		$type     = ( isset( $type ) ) ? ( $type ) : ( 'rand' );
		$count    = ( isset( $count ) && 0 < absint( $count ) ) ? ( absint( $count ) ) : ( 12 );
		$category = ( isset( $category ) ) ? ( $category ) : ( array() );
		$category = array_filter( $category, 'sp_remove_zero_negative_array' );

		if ( isset( $category ) && is_array( $category ) )
			$category = $category;
		else
			$category = array();

		echo $before_widget;

		//if the title is not filled, no title will be displayed
		if ( isset( $title ) && '' != $title && ' ' != $title )
			echo $before_title . apply_filters( 'widget_title', $title ) . $after_title;

		wp_reset_query();

		$queryArgs = array(
			'post_type'           => 'sp_projects',
			'ignore_sticky_posts' => 1,
			'posts_per_page'      => $count,
			'orderby'             => $type,
			);
		if ( ! empty( $category ) )
			$queryArgs['tax_query'] = array( array(
				'taxonomy' => 'project-category',
				'field'    => 'id',
				'terms'    => $category
			) );

		$projects = new WP_Query( $queryArgs );
		if ( $projects->have_posts() ) :
			//HTML to display output
			?>
			<div class="portfolio-content">
			<?php
			$imgSize = 'widget';
			while ( $projects->have_posts() ) : $projects->the_post();
				?>
				<article title="<?php echo esc_attr( strip_tags( get_the_title() ) ); ?>" class="frame">
					<?php
					//image
					$image = ( has_post_thumbnail() ) ? ( wp_get_attachment_image_src( get_post_thumbnail_id(), $imgSize ) ) : ( array( SP_BASE_URL . 'framework/assest/img/placeholder/widget.png' ) );
					echo '<div class="image-container"><a href="' . get_permalink() . '"><img src="' . esc_url( $image[0] ) . '" alt="' . get_the_title() . '" title="' . get_the_title() . '" /></a></div>';
					?>
				</article>
				<?php
			endwhile;
			?>
			</div>
		<?php
		endif;
		wp_reset_query();

		echo $after_widget;
	} // /widget
} // /sp_projects_list

?>