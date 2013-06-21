<?php

add_action('init','of_options');

if (!function_exists('of_options'))
{
	function of_options()
	{
		//Access the WordPress Categories via an Array
		$of_categories 		= array();  
		$of_categories_obj 	= get_categories('hide_empty=0');
		foreach ($of_categories_obj as $of_cat) {
		    $of_categories[$of_cat->cat_ID] = $of_cat->cat_name;}
		$categories_tmp 	= array_unshift($of_categories, "Select a category:"); 

		//Access the WordPress Catgories Taxonomy of Custom Post Type Menu
		$of_cats         = array();
		$args = array(
                'type'          => 'sp_menu',
                'orderby'       => 'name', 
                'taxonomy'      => 'menu-category',
            );
            $of_cats_obj = get_categories( $args ); 
        foreach ($of_cats_obj as $cat){
             $of_cats[$cat->cat_ID] = $cat->cat_name;
        } 
        $cat_tmp 	= array_unshift($of_cats, "Select a category:");   
	       
		//Access the WordPress Pages via an Array
		$of_pages 			= array();
		$of_pages_obj 		= get_pages('sort_column=post_parent,menu_order');    
		foreach ($of_pages_obj as $of_page) {
		    $of_pages[$of_page->ID] = $of_page->post_name; }
		$of_pages_tmp 		= array_unshift($of_pages, "Select a page:");       
	
		//Testing 
		$of_options_select 	= array("one","two","three","four","five"); 
		$of_options_radio 	= array("one" => "One","two" => "Two","three" => "Three","four" => "Four","five" => "Five");
		
		//Sample Homepage blocks for the layout manager (sorter)
		$of_options_homepage_blocks = array
		( 
			"disabled" => array (
				"placebo" 		=> "placebo", //REQUIRED!
				"block_one"		=> "Block One",
				"block_two"		=> "Block Two",
				"block_three"	=> "Block Three",
			), 
			"enabled" => array (
				"placebo" 		=> "placebo", //REQUIRED!
				"block_four"	=> "Block Four",
			),
		);


		//Stylesheets Reader
		$alt_stylesheet_path = LAYOUT_PATH;
		$alt_stylesheets = array();
		
		if ( is_dir($alt_stylesheet_path) ) 
		{
		    if ($alt_stylesheet_dir = opendir($alt_stylesheet_path) ) 
		    { 
		        while ( ($alt_stylesheet_file = readdir($alt_stylesheet_dir)) !== false ) 
		        {
		            if(stristr($alt_stylesheet_file, ".css") !== false)
		            {
		                $alt_stylesheets[] = $alt_stylesheet_file;
		            }
		        }    
		    }
		}


		//Background Images Reader
		$bg_images_path = SP_BASE_DIR. 'framework/assets/img/bg/'; // change this to where you store your bg images
		$bg_images_url = SP_BASE_URL.'framework/assets/img/bg/'; // change this to where you store your bg images
		$bg_images = array();
		
		if ( is_dir($bg_images_path) ) {
		    if ($bg_images_dir = opendir($bg_images_path) ) { 
		        while ( ($bg_images_file = readdir($bg_images_dir)) !== false ) {
		            if(stristr($bg_images_file, ".png") !== false || stristr($bg_images_file, ".jpg") !== false) {
		                $bg_images[] = $bg_images_url . $bg_images_file;
		            }
		        }    
		    }
		}
		

		/*-----------------------------------------------------------------------------------*/
		/* TO DO: Add options/functions that use these */
		/*-----------------------------------------------------------------------------------*/
		
		//More Options
		$uploads_arr 		= wp_upload_dir();
		$all_uploads_path 	= $uploads_arr['path'];
		$all_uploads 		= get_option('of_uploads');
		$other_entries 		= array("Select a number:","1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","16","17","18","19");
		$body_repeat 		= array("no-repeat","repeat-x","repeat-y","repeat");
		$body_pos 			= array("top left","top center","top right","center left","center center","center right","bottom left","bottom center","bottom right");
		
		// Image Alignment radio box
		$of_options_thumb_align = array("alignleft" => "Left","alignright" => "Right","aligncenter" => "Center"); 
		
		// Image Links to Options
		$of_options_image_link_to = array("image" => "The Image","post" => "The Post"); 
		
		//cycle Slider
		$cycle_effects = array('fade' => 'fade', 'blindX' => 'blindX', 'blindY' => 'blindY', 'blindZ' => 'blindZ', 'cover' => 'cover', 'curtainX' => 'curtainX','curtainY' => 'curtainY', 'fadeZoom' => 'fadeZoom', 'growX' => 'growX', 'growY' => 'growY', 
	 'none' => 'none', 'scrollUp' => 'scrollUp', 'scrollDown' => 'scrollDown', 'scrollLeft' => 'scrollLeft', 
	 'scrollRight' => 'scrollRight', 'scrollHorz' => 'scrollHorz', 'scrollVert' => 'scrollVert',
	'shuffle' => 'shuffle', 'slideX' => 'slideX', 'slideY' => 'slideY', 'toss' => 'toss', 
	 'turnUp' => 'turnUp', 'turnDown' => 'turnDown', 'turnLeft' => 'turnLeft', 'turnRight' => 'turnRight', 'uncover' => 'uncover', 'wipe' => 'wipe', 'zoom' => 	'zoom');


/*-----------------------------------------------------------------------------------*/
/* The Options Array */
/*-----------------------------------------------------------------------------------*/

// Set the Options Array
global $of_options;
$of_options = array();

//General Settings
$of_options[] = array( 	"name" 		=> "General Settings",
						"type" 		=> "heading"
				);
				
$of_options[] = array( "name" => "Custom logo upload",
					"desc" => "Upload your own logo (.png)",
					"id" => "theme_logo",
					"std" => SP_BASE_URL . "images/logo.png",
					"mod" => "min",
					"type" => "upload"
				);
				
$of_options[] = array( 	"name" 		=> "Custom Favicon",
						"desc" 		=> "Upload a 16px x 16px Png/Gif image that will represent your website's favicon.",
						"id" 		=> "custom_favicon",
						"std" => SP_BASE_URL . "favicon.ico",
						"mod" => "min",
						"type" 		=> "upload"
				); 
				
$of_options[] = array( 	"name" 		=> "Tracking Code",
						"desc" 		=> "Paste your Google Analytics (or other) tracking code here. This will be added into the footer template of your theme.",
						"id" 		=> "google_analytics",
						"std" 		=> "",
						"type" 		=> "textarea"
				);			
				
$of_options[] = array( 	"name" 		=> "Footer Text",
						"desc" 		=> "",
						"id" 		=> "footer_text",
						"std" 		=> "© 2013 Popteacambodia.com .",
						"type" 		=> "textarea"
				);
				
//Feature Slide
/*$of_options[] = array( "name" => 'Featured Slideshow',
						"type" => "heading",
						"slug" => "feature"
						);

$of_options[] = array( "name" => 'Animation & Effects',
					"desc" => "",
					"id" => "introduction",
					"std" => "<h3 style=\"margin: 0 0 10px;\">Animation & Effects</h3>",
					"icon" => true,
					"type" => "info",
					);

$of_options[] = array( "name" => 'Effect',
					"desc" => 'name of transition effect',
					"id" => "cycle_effect",
					"std" => "fade",
					"type" => "select",
					"options" => $cycle_effects
					);

$of_options[] = array( "name" => 'Speed',
					"desc" => 'speed of the transition',
					"id" => "cycle_speed",
					"std" => "5000",
					"type" => "text",
					);

$of_options[] = array( "name" => 'timeout',
					"desc" => 'milliseconds between slide transitions',
					"id" => "cycle_timeout",
					"std" => "5000",
					"type" => "text",
					);*/

// Pop Tea Top 12

$of_options[] = array( "name" => "Poptea Our Top 12",
					"type" => "heading");

$of_options[] = array( "name" => 'Select Page Our Top 12',
					"id" => "page_special",
					"type" => "select",
					"options" => $of_pages
					);
$of_options[] = array( "name" => 'Top 12 products',
					"id" => "cat_special",
					"type" => "select",
					"desc" => "Select Category that you want to show as TOP 12",
					"options" => $of_cats
					);
					
$of_options[] = array( "name" => "Title of Top 12 products",
					"id" => "title_top_12",
					"std" => "OUR TOP 12",
					"desc" => "Put the title of Our Top 12",
					"type" => "text"
					);
$of_options[] = array( "name" => "Number of products",
					"id" => "num-post-top-12",
					"std" => "8",
					"desc" => "Limit number of posts to display Our Top 12",
					"type" => "text"
					);					


// Pop Tea Menu

$of_options[] = array( "name" => "Poptea Menu",
					"type" => "heading");

$of_options[] = array( "name" => 'Select Page Menu',
					"id" => "page_menu",
					"type" => "select",
					"options" => $of_pages
					);
					
$of_options[] = array( "name" => 'Select Category Menu Option 1',
					"id" => "cat_menu_opt_1",
					"type" => "select",
					"options" => $of_cats
					);
					
$of_options[] = array( "name" => 'Select Category Menu Option 2',
					"id" => "cat_menu_opt_2",
					"type" => "select",
					"options" => $of_cats
					);					

	// Choose Size and Sweetness
$of_options[] = array( "name" => 'Setup cup size',
					"desc" => "",
					"id" => "introduction",
					"std" => "<h3 style=\"margin: 0 0 10px;\">Setup cup size</h3>",
					"icon" => true,
					"type" => "info",
					);
	
$of_options[] = array( "name" => "Input text for Title Size",
					"id" => "txt_title_size",
					"std" => "",
					"desc" => "(Optional): If you don't input. Default: Choose your size",
					"type" => "text"
					);
$of_options[] = array( 	"name" 		=> "Icon Size or Capacity",
						"desc" 		=> "Upload a 16px x 16px Png/Gif image that represent Size.",
						"id" 		=> "icon_size",
						"std" => SP_BASE_URL . "images/capacity-tea.png",
						"mod" => "min",
						"type" 		=> "upload"
				);
$of_options[] = array( "name" => "Choose Your Size Options",
					"desc" => "Capacity of Poptea e.g: 500cc or 700cc..",
					"id" => "addoption_size",
					"std" => "",
					"type" => "addoption");


$of_options[] = array( "name" => 'Setup Sweetness or Sugar',
					"desc" => "",
					"id" => "introduction",
					"std" => "<h3 style=\"margin: 0 0 10px;\">Setup Sweetness or Sugar</h3>",
					"icon" => true,
					"type" => "info",
					);
					
$of_options[] = array( "name" => "Input text for Title Sweetness",
					"id" => "txt_title_sweet",
					"std" => "",
					"desc" => "(Optional): If you don't input. Default: Choose your sweetness",
					"type" => "text"
					);
$of_options[] = array( 	"name" 		=> "Icon Sweetness",
						"desc" 		=> "Upload a 16px x 16px Png/Gif image that represent Sweetness.",
						"id" 		=> "icon_sweet",
						"std" => SP_BASE_URL . "images/sugar_cube.png",
						"mod" => "min",
						"type" 		=> "upload"
				); 
$of_options[] = array( "name" => "Choose Your Sweetness Options",
					"desc" => "Sweetness of Poptea e.g: 0% free , 50% sweet, 100% sweet(normal), 150% sweet.",
					"id" => "addoption_sweet",
					"std" => "",
					"type" => "addoption");

//Sidebar Settings

$of_options[] = array( "name" => "Sidebar Settings",
					"type" => "heading");

$of_options[] = array( "name" => "Sidebar Options",
					"desc" => "",
					"id" => "sidebar_options",
					"std" => "",
					"type" => "sidebar");
																	
// Contact

$of_options[] = array( "name" => "Contact",
					"type" => "heading");

$of_options[] = array( "name" => 'Select Page Contact',
					"id" => "page_contact",
					"type" => "select",
					"options" => $of_pages
					);
					
/*$of_options[] = array( "name" => "Latitude",
					"desc" => "Latitude of google map see <a href='http://itouchmap.com'>itouchmap.com</a>",
					"id" => "map_lat",
					"std" => "11.558384",
					"type" => "text"
					);

$of_options[] = array( "name" => "Longitude",
					"desc" => "Longitude of google map see <a href='http://itouchmap.com'>itouchmap.com</a>",
					"id" => "map_long",
					"std" => "104.919965",
					"type" => "text"
					);*/										
					
$of_options[] = array( "name" => "Address",
					"desc" => "Enter your company or organization address",
					"id" => "address",
					"std" => "Phnom Penh Tower 10th floor 445, Preah Monivong Boulevard, Phnom Penh - Cambodia",
					"type" => "text"
					);	
					
$of_options[] = array( "name" => "Telephone line 1",
					"desc" => "",
					"id" => "tel_1",
					"std" => "+855 23 955 500",
					"type" => "text"
					);	
					
$of_options[] = array( "name" => "Telephone line 2",
					"desc" => "",
					"id" => "tel_2",
					"std" => "+855 77 222 677",
					"type" => "text"
					);																								
					
$of_options[] = array( "name" => "Business hours line 1",
					"desc" => "",
					"id" => "opent_time_1",
					"std" => "Mon - Fri / 8pm to 19pm",
					"type" => "text"
					);

$of_options[] = array( "name" => "Business hours line 2",
					"desc" => "",
					"id" => "opent_time_2",
					"std" => "Sat - Sun / 8pm to 17pm",
					"type" => "text"
					);					
					
$of_options[] = array( "name" => "Email",
					"desc" => "",
					"id" => "email",
					"std" => "info@popteacambodia.com",
					"type" => "text"
					);	

				
// Backup Options
$of_options[] = array( 	"name" 		=> "Backup Options",
						"type" 		=> "heading"
				);
				
$of_options[] = array( 	"name" 		=> "Backup and Restore Options",
						"id" 		=> "of_backup",
						"std" 		=> "",
						"type" 		=> "backup",
						"desc" 		=> 'You can use the two buttons below to backup your current options, and then restore it back at a later time. This is useful if you want to experiment on the options but would like to keep the old settings in case you need it back.',
				);
				
$of_options[] = array( 	"name" 		=> "Transfer Theme Options Data",
						"id" 		=> "of_transfer",
						"std" 		=> "",
						"type" 		=> "transfer",
						"desc" 		=> 'You can tranfer the saved options data between different installs by copying the text inside the text box. To import data from another install, replace the data in the text box with the one from another install and click "Import Options".',
				);
				
	}//End function: of_options()
}//End chack if function exists: of_options()
?>
