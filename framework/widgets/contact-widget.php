<?php
/*
*****************************************************
* Contact information widget
*****************************************************
*/

/*
*****************************************************
*      WIDGET CLASS
*****************************************************
*/
class sp_contact_info_widget extends WP_Widget {
	/*
	*****************************************************
	*      widget constructor
	*****************************************************
	*/
	function __construct() {
		$id     = 'sp-contact-info';
		$prefix = THEME_NAME . ': ';
		$name   = '<span>' . $prefix . __( 'Contact', 'sptheme_widget' ) . '</span>';
		$widget_ops = array(
			'classname'   => 'sp-contact-info',
			'description' => __( 'Contact information', 'sptheme_widget' )
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
		$name     = ( isset( $name ) ) ? ( $name ) : ( null );
		$address  = ( isset( $address ) ) ? ( $address ) : ( null );
		$phone    = ( isset( $phone ) ) ? ( $phone ) : ( null );
		$email    = ( isset( $email ) ) ? ( $email ) : ( null );

		//HTML to display widget settings form
		?>
		<p class="sp-desc"><?php _e( 'Displays specially styled contact information. JavaScript anti-spam protection will be applied on the email address (also, email will not be displayed when JavaScript is turned off).', 'sptheme_widget' ) ?></p>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'sptheme_widget' ) ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'name' ); ?>"><?php _e( 'Name:', 'sptheme_widget' ) ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'name' ); ?>" name="<?php echo $this->get_field_name( 'name' ); ?>" type="text" value="<?php echo esc_attr( $name ); ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'address' ); ?>"><?php _e( 'Address:', 'sptheme_widget' ) ?></label><br />
			<textarea cols="50" rows="5" id="<?php echo $this->get_field_id( 'address' ); ?>" name="<?php echo $this->get_field_name( 'address' ); ?>"><?php echo esc_attr( $address ); ?></textarea>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'phone' ); ?>"><?php _e( 'Phone number:', 'sptheme_widget' ) ?></label>
			<textarea cols="50" rows="2" id="<?php echo $this->get_field_id( 'phone' ); ?>" name="<?php echo $this->get_field_name( 'phone' ); ?>"><?php echo esc_attr( $phone ); ?></textarea>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'email' ); ?>"><?php _e( 'Email address:', 'sptheme_widget' ) ?></label>
			<textarea cols="50" rows="2" id="<?php echo $this->get_field_id( 'email' ); ?>" name="<?php echo $this->get_field_name( 'email' ); ?>"><?php echo esc_attr( $email ); ?></textarea>
			<small><?php _e( 'JavaScript anti-spam protection applied', 'sptheme_widget' ); ?></small>
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

		$instance['title']   = $new_instance['title'];
		$instance['name']    = $new_instance['name'];
		$instance['address'] = $new_instance['address'];
		$instance['phone']   = $new_instance['phone'];
		$instance['email']   = $new_instance['email'];

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

		$out = $outAddress = '';

		//if the title is not filled, no title will be displayed
		if ( isset( $title ) && '' != $title && ' ' != $title )
			$out .= $before_title . apply_filters( 'widget_title', $title ) . $after_title;

		//HTML to display output
		//address
		if ( ( isset( $name ) && $name ) || ( isset( $address ) && $address ) )
			$outAddress .= '<div class="address contact-info"><strong>' . $name . '</strong><br />' . $address . '</div>';


		//email addresses
		if ( isset( $email ) && $email ) {
			//$regex = '/(\S+@\S+\.\S+)/i';
			//preg_match_all( $regex, $email, $emailArray );
			//if ( $emailArray && is_array( $emailArray ) ) {
			//	foreach ( $emailArray[0] as $e ) {
			//		$email = str_replace( $e, '<a href="#" data-address="' . sp_nospam( $e ) . '" class="email-nospam">' . sp_nospam( $e ) . '</a>', $email );
			//	}
			//}
			$outAddress .= '<div class="email contact-info">E-mail : <a href="mailto:' . antispambot($email) . '">' . antispambot($email) . '</a></div>';
		}

		//phone numbers
		if ( isset( $phone ) && $phone )
			if(strpos($phone, '/')){
				$split = explode('/', $phone);
		        foreach ($split as $spl) {
		    	  $outAddress .= '<div class="phone contact-info"><h1>'.$spl.'</h1></div>';
		        }
            }
			else {
				$outAddress .= '<div class="phone contact-info"><h3>' . $phone . '</h3></div>';
			}
			
		//output wrapper
		if ( $outAddress )
			$out .= '<div class="address-container">' . apply_filters( 'sp_default_content_filters', $outAddress ) . '</div>';

		if ( $out )
			echo $before_widget . $out . $after_widget;
	} // /widget
} // /sp_contact_info

?>