<?php
/*
*****************************************************
*      1) ACTIONS AND FILTERS
*****************************************************
*/
	//ACTIONS
		$wmGeneratorIncludes = array( 'post.php', 'post-new.php' );
		if ( in_array( $pagenow, $wmGeneratorIncludes ) ) {
			add_action( 'admin_enqueue_scripts', 'sp_mce_assets', 1000 );
			add_action( 'init', 'sp_shortcode_generator_button' );
			add_action( 'admin_footer', 'sp_add_generator_popup', 1000 );
		}





/*
*****************************************************
*      2) ASSETS NEEDED
*****************************************************
*/
	/*
	* Assets files
	*/
	if ( ! function_exists( 'sp_mce_assets' ) ) {
		function sp_mce_assets() {
			global $pagenow;

			$wmGeneratorIncludes = array( 'post.php', 'post-new.php' );

			if ( in_array( $pagenow, $wmGeneratorIncludes ) ) {
				//styles
				wp_register_style( 'sp-buttons', SP_BASE_URL . 'framework/assets/css/shortcodes.css', false, SP_SCRIPTS_VERSION, 'screen' );
				wp_enqueue_style( 'sp-buttons' );

				//scripts
				wp_register_script( 'sp-shortcodes', SP_BASE_URL . 'framework/assets/js/shortcodes/sp-shortcodes.js', array( 'jquery' ), SP_SCRIPTS_VERSION, true );
				wp_enqueue_script( 'sp-shortcodes' );
			}
		}
	} // /sp_mce_assets





/*
*****************************************************
*      3) TINYMCE BUTTON REGISTRATION
*****************************************************
*/
	/*
	* Register visual editor custom button position
	*/
	if ( ! function_exists( 'sp_register_tinymce_buttons' ) ) {
		function sp_register_tinymce_buttons( $buttons ) {
			$wmButtons = array( '|', 'sp_mce_button_line_above', 'sp_mce_button_line_below', '|', 'sp_mce_button_shortcodes' );

			array_push( $buttons, implode( ',', $wmButtons ) );

			return $buttons;
		}
	} // /sp_register_tinymce_buttons



	/*
	* Register the button functionality script
	*/
	if ( ! function_exists( 'sp_add_tinymce_plugin' ) ) {
		function sp_add_tinymce_plugin( $plugin_array ) {
			$plugin_array['sp_mce_button'] = SP_BASE_URL . 'framework/assets/js/shortcodes/sp-mce-button.js?ver=' . SP_SCRIPTS_VERSION;

			return $plugin_array;
		}
	} // /sp_add_tinymce_plugin



	/*
	* Adding the button to visual editor
	*/
	if ( ! function_exists( 'sp_shortcode_generator_button' ) ) {
		function sp_shortcode_generator_button() {
			if ( ! ( current_user_can( 'edit_posts' ) || current_user_can( 'edit_pages' ) ) )
				return;

			if ( 'true' == get_user_option( 'rich_editing' ) ) {
				//filter the tinymce buttons and add custom ones
				add_filter( 'mce_external_plugins', 'sp_add_tinymce_plugin' );
				add_filter( 'mce_buttons_2', 'sp_register_tinymce_buttons' );
			}
		}
	} // /sp_shortcode_generator_button
	

/*
*****************************************************
*      4) SHORTCODES ARRAY
*****************************************************
*/
	/*
	* Shortcodes settings for Shortcode Generator
	*/
	if ( ! function_exists( 'sp_shortcode_generator_tabs' ) ) {
		function sp_shortcode_generator_tabs() {
			
			$wmShortcodeGeneratorTabs = array(

			//Accordion
				array(
					'id' => 'accordion',
					'name' => __( 'Accordion', 'sptheme_admin' ),
					'desc' => __( 'Please, copy the <code>[accordion_item title=""][/accordion_item]</code> sub-shortcode as many times as you need. But keep them wrapped in <code>[accordion][/accordion]</code> parent shortcode.', 'sptheme_admin' ),
					'settings' => array(
						'auto' => array(
							'label' => __( 'Automatic accordion', 'sptheme_admin' ),
							'desc'  => __( 'Select whether the accordion should automatically animate', 'sptheme_admin' ),
							'value' => array(
								''  => __( 'No', 'sptheme_admin' ),
								'1' => __( 'Yes', 'sptheme_admin' ),
								)
							),
						),
					'output-shortcode' => '[accordion{{auto}}] [accordion_item title="TEXT"]TEXT[/accordion_item] [/accordion]'
				),

			//Box
				array(
					'id' => 'box',
					'name' => __( 'Box', 'sptheme_admin' ),
					'settings' => array(
						'color' => array(
							'label' => __( 'Color', 'sptheme_admin' ),
							'desc'  => __( 'Choose box color', 'sptheme_admin' ),
							'value' => array(
								''       => __( 'Default', 'sptheme_admin' ),
								'blue'   => __( 'Blue', 'sptheme_admin' ),
								'gray'   => __( 'Gray', 'sptheme_admin' ),
								'green'  => __( 'Green', 'sptheme_admin' ),
								'orange' => __( 'Orange', 'sptheme_admin' ),
								'red'    => __( 'Red', 'sptheme_admin' ),
								)
							),
						'icon' => array(
							'label' => __( 'Icon', 'sptheme_admin' ),
							'desc'  => __( 'Choose an icon for this box', 'sptheme_admin' ),
							'value' => array(
								''         => __( 'No icon', 'sptheme_admin' ),
								'cancel'   => __( 'Cancel icon', 'sptheme_admin' ),
								'check'    => __( 'Check icon', 'sptheme_admin' ),
								'info'     => __( 'Info icon', 'sptheme_admin' ),
								'question' => __( 'Question icon', 'sptheme_admin' ),
								'warning'  => __( 'Warning icon', 'sptheme_admin' ),
								)
							),
						'title' => array(
							'label' => __( 'Optional title', 'sptheme_admin' ),
							'desc'  => __( 'Optional box title', 'sptheme_admin' ),
							'value' => ''
							),
						'transparent' => array(
							'label' => __( 'Opacity', 'sptheme_admin' ),
							'desc'  => __( 'Whether box background is colored or not', 'sptheme_admin' ),
							'value' => array(
								''  => __( 'Opaque', 'sptheme_admin' ),
								'1' => __( 'Transparent', 'sptheme_admin' ),
								)
							),
						'hero' => array(
							'label' => __( 'Hero box', 'sptheme_admin' ),
							'desc'  => __( 'Specially styled hero box', 'sptheme_admin' ),
							'value' => array(
								''  => __( 'Normal box', 'sptheme_admin' ),
								'1' => __( 'Hero box', 'sptheme_admin' ),
								)
							),
						),
					'output-shortcode' => '[box{{color}}{{title}}{{icon}}{{transparent}}{{hero}}]TEXT[/box]'
				),

			//Big text
				array(
					'id' => 'big_text',
					'name' => __( 'Big text', 'sptheme_admin' ),
					'settings' => array(
						'style' => array(
							'label' => __( 'Optional CSS style', 'sptheme_admin' ),
							'desc'  => __( 'Custom CSS rules inserted into "style" attribute.', 'sptheme_admin' ),
							'value' => '',
							),
						),
					'output-shortcode' => '[big_text{{style}}]TEXT[/big_text]'
				),
			);
			
		return $wmShortcodeGeneratorTabs;
		}
	} // /sp_shortcode_generator_tabs



/*
*****************************************************
*      5) SHORTCODE GENERATOR HTML
*****************************************************
*/
	/*
	* Shortcode generator popup form
	*/
	if ( ! function_exists( 'sp_add_generator_popup' ) ) {
		function sp_add_generator_popup() {
			$shortcodes = sp_shortcode_generator_tabs();

			$out = '
				<div id="wm-shortcode-generator" class="selectable">
				<div id="wm-shortcode-form">
				';

			if ( ! empty( $shortcodes ) ) {

				//tabs
				/*
				$out .= '<ul class="wm-tabs">';
				foreach ( $shortcodes as $shortcode ) {
					$shortcodeId = 'wm-generate-' . $shortcode['id'];
					$out .= '<li><a href="#' . $shortcodeId . '">' . $shortcode['name'] . '</a></li>';
				}
				$out .= '</ul>';
				*/

				//select
				$out .= '<div class="wm-select-wrap"><label for="select-shortcode">' . __( 'Select a shortcode:', 'sptheme_admin' ) . '</label><select id="select-shortcode" class="wm-select">';
				foreach ( $shortcodes as $shortcode ) {
					$shortcodeId = 'wm-generate-' . $shortcode['id'];
					$out .= '<option value="#' . $shortcodeId . '">' . $shortcode['name'] . '</option>';
				}
				$out .= '</select></div>';

				//content
				$out .= '<div class="wm-tabs-content">';
				foreach ( $shortcodes as $shortcode ) {

					$shortcodeId     = 'wm-generate-' . $shortcode['id'];
					$settings        = ( isset( $shortcode['settings'] ) ) ? ( $shortcode['settings'] ) : ( null );
					$shortcodeOutput = ( isset( $shortcode['output-shortcode'] ) ) ? ( $shortcode['output-shortcode'] ) : ( null );
					$close           = ( isset( $shortcode['close'] ) ) ? ( ' ' . $shortcode['close'] ) : ( null );
					$settingsCount   = count( $settings );

					$out .= '
						<div id="' . $shortcodeId . '" class="tab-content">
						<p class="shortcode-title"><strong>' . $shortcode['name'] . '</strong> ' . __( 'shortcode', 'sptheme_admin' ) . '</p>
						';

					if ( isset( $shortcode['desc'] ) && $shortcode['desc'] )
						$out .= '<p class="shortcode-desc">' . $shortcode['desc'] . '</p>';

					$out .= '
						<div class="form-wrap">
						<form method="get" action="">
						<table class="items-' . $settingsCount . '">
						';

					if ( $settings ) {
						$i = 0;
						foreach ( $settings as $id => $labelValue ) {
							$i++;
							$desc      = ( isset( $labelValue['desc'] ) ) ? ( esc_attr( $labelValue['desc'] ) ) : ( '' );
							$maxlength = ( isset( $labelValue['maxlength'] ) ) ? ( ' maxlength="' . absint( $labelValue['maxlength'] ) . '"' ) : ( '' );

							$out .= '<tr class="item-' . $i . '"><td>';
							$out .= '<label for="' . $shortcodeId . '-' . $id . '" title="' . $desc . '">' . $labelValue['label'] . '</label></td><td>';
							if ( is_array( $labelValue['value'] ) ) {
								$imageBefore  = ( isset( $labelValue['image-before'] ) && $labelValue['image-before'] ) ? ( '<div class="image-before"></div>' ) : ( '' );
								$shorterClass = ( $imageBefore ) ? ( ' class="shorter set-image"' ) : ( '' );

								$out .= $imageBefore . '<select name="' . $shortcodeId . '-' . $id . '" id="' . $shortcodeId . '-' . $id . '" title="' . $desc . '" data-attribute="' . $id . '"' . $shorterClass . '>';
								foreach ( $labelValue['value'] as $value => $valueName ) {
									if ( 'OPTGROUP' === substr( $value, 1 ) )
										$out .= '<optgroup label="' . $valueName . '">';
									elseif ( '/OPTGROUP' === substr( $value, 1 ) )
										$out .= '</optgroup>';
									else
										$out .= '<option value="' . $value . '">' . $valueName . '</option>';
								}
								$out .= '</select>';

							} else {

								$out .= '<input type="text" name="' . $shortcodeId . '-' . $id . '" value="' . $labelValue['value'] . '" id="' . $shortcodeId . '-' . $id . '" class="widefat" title="' . $desc . '"' . $maxlength . ' data-attribute="' . $id . '" /><img src="' . SP_BASE_URL . 'framework/assets/img/shortcodes/add16.png" alt="' . __( 'Apply changes', 'sptheme_admin' ) . '" title="' . __( 'Apply changes', 'sptheme_admin' ) . '" class="ico-apply" />';

							}
							$out .= '</td></tr>';
						}
					}

					$out .= '<tr><td>&nbsp;</td><td><p><a data-parent="' . $shortcodeId . '" class="send-to-generator button-primary">' . __( 'Insert into editor', 'sptheme_admin' ) . '</a></p></td></tr>';
					$out .= '
						</table>
						</form>
						';
					$out .= '<p><strong>' . __( 'Or copy and paste in this shortcode:', 'sptheme_admin' ) . '</strong></p>';
					$out .= '<form><textarea class="wm-shortcode-output' . $close . '" cols="30" rows="2" readonly="readonly" onfocus="this.select();" data-reference="' . esc_attr( $shortcodeOutput ) . '">' . esc_attr( $shortcodeOutput ) . '</textarea></form>';
					$out .= '<!-- /form-wrap --></div>';
					$out .= '<!-- /tab-content --></div>';

				}
				$out .= '<!-- /wm-tabs-content --></div>';

			}

			$out .= '
				<!-- /wm-shortcode-form --></div>
				<p class="credits"><small>&copy; <a href="http://www.webmandesign.eu" target="_blank">WebMan</a></small></p>
				<!-- /wm-shortcode-generator --></div>
				';

			echo $out;
		}
	} // /sp_add_generator_popup

