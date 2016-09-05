<?php

add_action('init','of_options');

if (!function_exists('of_options'))
{
	function of_options()
	{
		//Access the WordPress Categories via an Array
		$of_categories = array();  
		$of_categories_obj = get_categories('hide_empty=0');
		foreach ($of_categories_obj as $of_cat) {
		    $of_categories[$of_cat->cat_ID] = $of_cat->cat_name;}
		$categories_tmp = array_unshift($of_categories, "Select a category:");    
	       
		//Access the WordPress Pages via an Array
		$of_pages = array();
		$of_pages_obj = get_pages('sort_column=post_parent,menu_order');    
		foreach ($of_pages_obj as $of_page) {
		    $of_pages[$of_page->ID] = $of_page->post_name; }
		$of_pages_tmp = array_unshift($of_pages, "Select a page:");       
	
		//Testing 
		$of_options_select = array("one","two","three","four","five"); 
		$of_options_radio = array("one" => "One","two" => "Two","three" => "Three","four" => "Four","five" => "Five");
		
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
				"placebo" => "placebo", //REQUIRED!
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
		$bg_images_path = STYLESHEETPATH. '/images/bg/'; // change this to where you store your bg images
		$bg_images_url = get_bloginfo('template_url').'/images/bg/'; // change this to where you store your bg images
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
		$uploads_arr = wp_upload_dir();
		$all_uploads_path = $uploads_arr['path'];
		$all_uploads = get_option('of_uploads');
		$other_entries = array("Select a number:","1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","16","17","18","19");
		$body_repeat = array("no-repeat","repeat-x","repeat-y","repeat");
		$body_pos = array("top left","top center","top right","center left","center center","center right","bottom left","bottom center","bottom right");
		
		// Image Alignment radio box
		$of_options_thumb_align = array("alignleft" => "Left","alignright" => "Right","aligncenter" => "Center"); 
		
		// Image Links to Options
		$of_options_image_link_to = array("image" => "The Image","post" => "The Post"); 


		/*-----------------------------------------------------------------------------------*/
		/* The Options Array */
		/*-----------------------------------------------------------------------------------*/
	

		##############################################
		// Load general common functions
		require_once (TEMPLATEPATH . '/lib/general.php');

		$themename = "King Size WP Template";
		$shortname = "wm";
		$path = get_template_directory_uri();
		##############################################

		// Set the Options Array
		global $of_options;
		$of_options = array();

		//------------------------------------------------------------------------------------------
		
		$of_options[] = array( "name" => "General Settings",
							"type" => "heading");

		#-----------------------------------------------------------------------#
		###################### King Size *WP* Logo Options ######################
		#-----------------------------------------------------------------------#

		$of_options[] = array(  "name" => "Logo Upload",
					  "id" => $shortname."_logo",
					  "std" => "<h3 style=\"margin: 0 0 10px;\">Logo Upload &amp; Settings</h3>",
					  "type" => "info");
			
		$of_options[] = array(
					'name' => 'Logo image',
					'id' => $shortname . '_logo_upload',
					'type' => 'upload',
					'img_w' => '220',
					'img_h' => '200',
					'std' => $path . '/images/logo_back.png',
					"helpicon"=> "help.png",
					'parent_heading'=> $shortname."_logo",
					'desc' => 'Upload a logo, or specify the image address. Best results when using 180(h) x 200(w) px.'
				);

		#-----------------------------------------------------------------------#
		###################### King Size *WP* Favicon Options ######################
		#-----------------------------------------------------------------------#

		$of_options[] = array(  "name" => "Favicon Upload",
					  "id" => $shortname."_favicon",
					  "std" => "<h3 style=\"margin: 0 0 10px;\">Favicon Upload</h3>",
					  "type" => "info");
			
		$of_options[] = array(
					'name' => 'Favicon image',
					'id' => $shortname . '_favicon_upload',
					'type' => 'upload',
					'img_w' => '16',
					'img_h' => '16',
					'std' => $path . '/images/favicon.png',
					"helpicon"=> "help.png",
					'parent_heading'=> $shortname."_favicon",
					'desc' => 'Upload a favicon, or specify the png image address. Best results when using 16(h) x 16(w) px.'
				);
				
						
		#---------------------------------------------------------------------------------#
		###################### King Size *WP* Background Preferences ######################
		#---------------------------------------------------------------------------------#		

		$of_options[] = array(  "name" => "Global Background Preferences",
					  "id" => $shortname."_background",
					  "std" => "<h3 style=\"margin: 0 0 10px;\">Global Background Preferences</h3>",
					  "type" => "info");
			
		$of_options[] = array(
					  'name' => 'Background image',
					  'id' => $shortname . '_background_image',
					  'type' => 'upload',
					  'img_w' => '250',
					  'img_h' => '150',
					  'std' => $path . '/images/background/default.jpg',
					  "helpicon"=> "help.png",
					  'parent_heading'=> $shortname."_background",
					  'desc' => 'Upload a global background, or specify the image address <i>[ie., http://www.yoursite.com/yourimage.jpg]</i><p><b style="color: red;">Important Reminder</b>: Set the following folder permissions to <b>777</b>:<br /> /wp-content/themes/kingsize/<b>cache</b><br /> /wp-content/themes/kingsize/images/<b>upload</b><br /> /wp-content/<b>uploads</b></p><p>Forgetting this important step will result in images not properly displaying throughout your website.</p> <p>For best results, we recommend you optimize your images, using 1400(w) x 900(h) px, or 900(w) x 500(h) px and a max 1.5MB\'s size.</p>'
					  );	
					  
		//$of_options[] = array(  "name" => "Enable Background Overlay on all Inner-pages",
					  //"desc" => "Check this box if you want to enable the Background Grid Overlay feature.",
					  //"id" => $shortname."_grid_hide_enabled",
					  //"type" => "checkbox",
					  //"helpicon"=> "help.png",
					  //"parent_heading" => $shortname."_background",
					  //"std" => "1");
					  
		$of_options[] =	array( "name" => "Background Grid Overlay Options",
					  "id" => $shortname."_grid_hide_enabled",
					  "type" => "select",
					  "options" => array("grid_hide_enabled"=>"Enable the Grid Overlay on All Inner Pages", "grid_disabled"=>"Disable Grid Overlay on All Pages", "grid_global_enable"=>"Enable the Grid Overlay on All Pages"),
					  "std" => "Enable the Grid Overlay on All Inner Pages",
					  "helpicon"=> "help.png",
					  "desc" => "Here you can choose to enable the grid on \"ALL\" pages (including Homepage) or to only enable this on \"Inner\" pages, or to disable the Grid Overlay all together so it does not show.",
					  "parent_heading" => $shortname."_background");
					  


		#----------------------------------------------------------------------------------------#
		###################### King Size *WP* Navigation / Menu Preferences ######################
		#----------------------------------------------------------------------------------------#		

		$of_options[] = array(  "name" => "Navigation Menu Preferences",
					  "id" => $shortname."_navigation_menu",
					  "std" => "<h3 style=\"margin: 0 0 10px;\">Navigation / Menu Preferences</h3>",
					  "type" => "info");
					  
		//$of_options[] = array(  "name" => "Sublevel Navigation Width",
					 // "desc" => "Longer sublevel menu items? Change the default width of the sublevel menu.",
					 // "id" => $shortname."_subnav_width",
					 // "type" => "text",
					 // "mod" => "mini",
					 // "helpicon"=> "help.png",
					 // "parent_heading" => $shortname."_navigation_menu",
					 // "std" => "180");
					  
		$of_options[] =	array( "name" => "Hide/Show Navigation Options",
					  "id" => $shortname."_navigation_hide_enabled",
					  "type" => "select",
					  "options" => array("nav_default"=>"Show the Navigation on All Pages", "nav_all_hidden"=>"Hide the Navigation on All Pages", "nav_hide_home_only"=>"Hide the Navigation only on Homepage"),
					  "std" => "Show the Navigation on All Pages",
					  "helpicon"=> "help.png",
					  "desc" => "Here you can choose how the Navigation should appear. <strong>A.)</strong> Shown by Default, <strong>B.)</strong> Hidden by Default, or <strong>C.)</strong> Hidden only on the Homepage but shown on all other pages.",
					  "parent_heading" => $shortname."_navigation_menu");
			
		$of_options[] = array(  "name" => "Enable Menu Hide / Show",
					  "desc" => "Check this box if you want to enable the Hide/Show menu feature.",
					  "id" => $shortname."_menu_hide_enabled",
					  "type" => "checkbox",
					  "helpicon"=> "help.png",
					  "parent_heading" => $shortname."_navigation_menu",
					  "std" => "1");
					  
		$of_options[] = array(  "name" => "Enable the Menu Tooltip",
					  "desc" => "Check this box if you want to enable the Hide/Show menu tooltip.",
					  "id" => $shortname."_menu_tooltip_enabled",
					  "type" => "checkbox",
					  "helpicon"=> "help.png",
					  "parent_heading" => $shortname."_navigation_menu",
					  "std" => "1");
		
		$of_options[] =	array( "name" => "Image Thumbnail Options",
					  "id" => $shortname."_thumbnail_generator",
					  "type" => "select",
					  "options" => array("enable_timthumb"=>"Enable TimThumb","enable_image_resize"=>"Enable WP Image Resize"),
					  "std" => "Thumbnail generator of Gallery/Portfolio",
					  "helpicon"=> "help.png",
					  "desc" => "Timthumb is enabled by default. Here you can select to use the WordPress image resizer, or Timthumb.",
					  "parent_heading" => $shortname."_navigation_menu");


		//---------------------------------------------------------------------------------------------

		#----------------------------------------------------------------------------------------#
		###################### King Size *WP* Background Slider Preferences ######################
		#----------------------------------------------------------------------------------------#	
		
		$of_options[] = array( "name" => "Home Settings",
					  "type" => "heading");
			
		$of_options[] = array( "name" => "Homepage Background Slider Preferences",
					  "desc" => "",
					  "id" => $shortname."_slider",
					  "std" => "<h3 style=\"margin: 0 0 10px;\">Homepage Background Slider Preferences</h3>",
					  "icon" => true,
					  "type" => "info");

		$of_options[] =	array( "name" => "Background Type for Homepage",
					  "id" => $shortname."_background_type",
					  "type" => "select",
					  "options" => array("slider_background"=>"Image Slider", "video_background"=>"Video Background"),
					  "std" => "slider_background",
					  "helpicon"=> "help.png",
					  "desc" => "Choose either image slider background or video background for the homepage.",
					  "parent_heading" => $shortname."_background");
					  
		$of_options[] =	array(  "name" => "Assign Homepage Slider Category",
					  "id" => $shortname."_slider_hp_category",
					  "std" => "",
					  "helpicon"=> "help.png",
					  "mod" => "mini",
					  "desc" => "Assign the category of your choice for the use of the Homepage Slider. By leaving this area blank, you will display ALL slides added. To limit the slides by Category, insert the Slider Category ID here <i>(for multiple categories, separate with a comma - for example: 3,7,9)</i>.",
					  "parent_heading" => $shortname."_slider",
					  "type" => "text");

		$of_options[] =	array(  "name" => "Assign the Number of Slider Items",
					  "id" => $shortname."_slider_show_number",
					  "std" => "",
					  "helpicon"=> "help.png",
					  "mod" => "mini",
					  "desc" => "Assign the number of slider images you want to show on the homepage <i>(ie., 10)</i>. If blank then it will show all available slider images.",
					  "parent_heading" => $shortname."_slider",
					  "type" => "text");
					  
		$of_options[] =	array(  "name" => "Slider Intrevals (Milliseconds) <i style=\"color: red;\">*REQUIRED*</i>",
					  "id" => $shortname."_slider_seconds",
					  "std" => "5000",
					  "helpicon"=> "help.png",
					  "mod" => "mini",
					  "desc" => "This requires being defined in 'Milliseconds' otherwise the slider will not work properly <i style=\"color: red;\">(ie., 5 seconds = 5000 milliseconds)</i>.",
					  "parent_heading" => $shortname."_slider",
					  "type" => "text");
					  
		$of_options[] =	array(  "name" => "Slider Transitions (Milliseconds) <i style=\"color: red;\">*REQUIRED*</i>",
					  "id" => $shortname."_slider_transition_seconds",
					  "std" => "700",
					  "helpicon"=> "help.png",
					  "mod" => "mini",
					  "desc" => "This requires being defined in 'Milliseconds' otherwise the slider will not work properly <i style=\"color: red;\">(ie., 5 seconds = 5000 milliseconds)</i>.",
					  "parent_heading" => $shortname."_slider",
					  "type" => "text");
					  
		$of_options[] =	array( "name" => "Slider Transition Type",
					  "id" => $shortname."_slider_transition_type",
					  "type" => "select",
					  "options" => array("1"=>"Fade", "2"=>"Slide Top", "3"=>"Slide Right", "4"=>"Slide Bottom", "5"=>"Slide Left", "6"=>"Carousel Right", "7"=>"Carousel Left"),
					  "std" => "Fade",
					  "helpicon"=> "help.png",
					  "desc" => "Select the type of Transitions you're wanting your Slider to use <i>(ie., Fade, Caoursel, etc)</i>.",
					  "parent_heading" => $shortname."_slider");
					  
		$of_options[] =	array( "name" => "Slider Order",
					  "id" => $shortname."_slider_display",
					  "type" => "select",
					  "options" => array("default"=>"Default DESC (by Date)", "rand"=>"Random Order", "custom_id"=>"Custom ID Order", "asc_order"=>"ASC (by Date)"),
					  "std" => "Default DESC (by Date)",
					  "helpicon"=> "help.png",
					  "desc" => "Displays by default in order of date posted. Select here if you wish to customize that preference <i>(ie., Random, by ID, ASC, etc)</i>.",
					  "parent_heading" => $shortname."_slider");
					  
		$of_options[] =	array( "name" => "Slide Titles & Descriptions",
					  "id" => $shortname."_slider_contents",
					  "type" => "select",
					  "options" => array("no_contents"=>"Display only Slider Images", "display_contents"=>"Display Title & Description", "display_title"=>"Display Title", "display_description"=>"Display Description"),
					  "std" => "Display only Slider Images",
					  "helpicon"=> "help.png",
					  "desc" => "If you would like to include a 'Title' and 'Description' on your homepage slider images, you can modify the selection here to enable it.",
					  "parent_heading" => $shortname."_slider");
					  
		$of_options[] =	array(  "name" => "Adjust the Width of the Slider Caption",
					  "id" => $shortname."_slide_caption",
					  "std" => "550",
					  "helpicon"=> "help.png",
					  "mod" => "mini",
					  "desc" => "Here you can define the 'width' of the slider caption/text area. By default this is set to 550px. Enter only the number and leave out the 'px'. So you'd enter '600' for example.",
					  "parent_heading" => $shortname."_slider",
					  "type" => "text");
					  
		$of_options[] =	array( "name" => "Slide Controllers",
					  "id" => $shortname."_slider_controllers",
					  "type" => "select",
					  "options" => array("no_controls"=>"Disable Slider Controls", "display_controls"=>"Enable Slider Controls"),
					  "std" => "Display Slider Controls",
					  "helpicon"=> "help.png",
					  "desc" => "If you wish to display the Slider Controls <i>(ie., Play/Pause, Next/Previous)</i> you can enable those here <i>(disabled by default)</i>.",
					  "parent_heading" => $shortname."_slider");
					  
		$of_options[] =	array( "name" => "Slide Controller Position",
					  "id" => $shortname."_slider_controller_position",
					  "type" => "select",
					  "options" => array("display_controls_top"=>"Display Controls on Top of Slider Content", "display_controls_bottom"=>"Display Controls on Bottom of Slider Content"),
					  "std" => "Display Controls on Top of Slider Content",
					  "helpicon"=> "help.png",
					  "desc" => "Here you can assign where the controllers for the Slider are positioned. When using lots of text in your slider items, it's best to display this on the bottom of your Slider Content for better appearance <i>(default display is on top)</i>.",
					  "parent_heading" => $shortname."_slider");


		#----------------------------------------------------------------------------------------#
		###################### King Size *WP* Video Background Preferences #######################
		#----------------------------------------------------------------------------------------#			

		$of_options[] = array( "name" => "Homepage Video Background Preferences",
					  "desc" => "",
					  "id" => $shortname."_video",
					  "std" => "<h3 style=\"margin: 0 0 10px;\">Homepage Video Background Preferences</h3>",
					  "icon" => true,
					  "type" => "info");

		$of_options[] =	array(  "name" => "Youtube / Vimeo / MP4 URL",
					  "id" => $shortname."_video_url",
					  "std" => "",
					  "helpicon"=> "help.png",
					  "parent_heading" => $shortname."_video",
					  "desc" => "Insert your Youtube/Vimeo/MP4 Video URL here. If you're using videos, be sure to enable that with the option defined at the very top of this <i>(ie., Slider Image or Background Video)</i>. <strong>Note</strong>: Does not support the use of Secure URLs, ie., \"https://\" Use only \"http://\" for this.",
					  "type" => "text");

		$of_options[] =	array(  "name" => "Enable / Disable AutoPlay",
					  "desc" => "Check this box if you want to enable auto play <i>(this option only applies to the homepage)</i>.",
					  "id" => $shortname."_autoplay_video",
					  "type" => "checkbox",
					  "helpicon"=> "help.png",
					  "parent_heading" => $shortname."_video",
					  "std" => "1");

		$of_options[] =	array(  "name" => "Enable / Disable Controlbar",
						  "desc" => "Check this box to hide the video control bar <i>(this option only applies to YouTube)</i>.",
						  "id" => $shortname."_controlbar_video",
						  "type" => "checkbox",
						  "helpicon"=> "help.png",
						  "parent_heading" => $shortname."_video",
						  "std" => "1");

		$of_options[] =	array(  "name" => "Enable / Disable Video Repeat",
						  "desc" => "Check this box if you want to repeat / loop the video for continuous play <i>(homepage only)</i>.",
						  "id" => $shortname."_repeat_video",
						  "type" => "checkbox",
						  "helpicon"=> "help.png",
						  "parent_heading" => $shortname."_video",
						  "std" => "1");

		//---------------------------------------------------------------------------------------------

		#----------------------------------------------------------------------------#
		###################### King Size *WP* Style Preferences ######################
		#----------------------------------------------------------------------------#	
		
		$of_options[] = array( "name" => "Styling Options",
					  "type" => "heading");

		$of_options[] = array( "name" => "Style Preferences",
					  "desc" => "",
					  "id" => $shortname."_style_prefs",
					  "std" => "<h3 style=\"margin: 0 0 10px;\">Various Template Styling Options</h3>",
					  "icon" => true,
					  "type" => "info");
					  
		$of_options[] = array(  "name" => "Google Web Fonts (URL)",
					  "id" => $shortname."_google_fonts",
					  "std" => "",
					  "desc" => "Go to <a href=\"http://www.google.com/webfonts/\" title=\"Google Web Fonts\" target=\"blank\">Google Web Fonts</a> and copy the font URL and paste here to customize your font preferences. Default font is PTSans Narrow.",
					  "helpicon"=> "help.png",
					  "parent_heading" => $shortname."_style_prefs",
					  "type" => "text");

		$of_options[] = array(  "name" => "Google Web Fonts Name (CSS)",
					  "id" => $shortname."_google_fonts_name",
					  "std" => "",
					  "desc" => "When using <a href=\"http://www.google.com/webfonts/\" title=\"Google Web Fonts\" target=\"blank\">Google Web Fonts</a> (with the option above) you're <em><strong>required</strong></em> to insert the font-name into the CSS. So when grabbing the font, it states 'Integrate Into CSS:', copy the font-family name, ie., <strong>'PT Sans'</strong> - Need help? Watch this <a href=\"http://screenr.com/lAb8\" target=\"blank\">Video Tutorial</a> for more details!",
					  "helpicon"=> "help.png",
					  "parent_heading" => $shortname."_style_prefs",
					  "type" => "text");
					  
		$of_options[] = array(  "name" => "Add Transparency / Opacity",
					  "id" => $shortname."_enable_opacity",
					  "std" => "Default",
					  "options" => array("default"=>"Default", "90"=>"0.9 Opacity", "80"=>"0.8 Opacity", "70"=>"0.7 Opacity"),
					  "desc" => "Included are 3 pre-defined Transparency / Opacity options. Here you can select from 0.7, 0.8, 0.9 or default (no opacity).",
					  "helpicon"=> "help.png",
					  "parent_heading" => $shortname."_style_prefs",
					  "type" => "select");	

		$of_options[] = array(  "name" => "Sub-menu Colour",
					  "id" => $shortname."_submenu_color",
					  "std" => "#000000",
					  "helpicon"=> "help.png",
					  "parent_heading" => $shortname."_style_prefs",
					  "type" => "color");	
					  
		$of_options[] = array(  "name" => "Sub-menu Border Colour",
					  "id" => $shortname."_submenu_border_color",
					  "std" => "#2F2F2F",
					  "helpicon"=> "help.png",
					  "parent_heading" => $shortname."_style_prefs",
					  "type" => "color");	

		$of_options[] = array(  "name" => "Global Link Colour",
					  "id" => $shortname."_link_color",
					  "std" => "#D2D2D2",
					  "helpicon"=> "help.png",
					  "parent_heading" => $shortname."_style_prefs",
					  "type" => "color");
					  
		$of_options[] = array(  "name" => "Global Link Mouse-over Colour",
					  "id" => $shortname."_link_color_hover",
					  "std" => "#FFFFFF",
					  "helpicon"=> "help.png",
					  "parent_heading" => $shortname."_style_prefs",
					  "type" => "color");	
					  
		$of_options[] = array(  "name" => "Section (Page / Post) Header Title Colour",
					  "id" => $shortname."_section_header_titles_color",
					  "std" => "#FFFFFF",
					  "helpicon"=> "help.png",
					  "parent_heading" => $shortname."_style_prefs",
					  "type" => "color");
					  
		$of_options[] = array(  "name" => "Portfolio / Post Title Colour",
					  "id" => $shortname."_post_title_color",
					  "std" => "#FFFFFF",
					  "helpicon"=> "help.png",
					  "parent_heading" => $shortname."_style_prefs",
					  "type" => "color");
					  
		$of_options[] = array(  "name" => "Portfolio / Post Title Mouse-over Colour",
					  "id" => $shortname."_post_title_color_hover",
					  "std" => "#D2D2D2",
					  "helpicon"=> "help.png",
					  "parent_heading" => $shortname."_style_prefs",
					  "type" => "color");

		$of_options[] = array(  "name" => "Body Text Colour",
					  "id" => $shortname."_color_text",
					  "std" => "#CCCCCC",
					  "helpicon"=> "help.png",
					  "parent_heading" => $shortname."_style_prefs",
					  "type" => "color");
					  
		$of_options[] = array(  "name" => "h1",
					  "id" => $shortname."_heading_text_color_h1",
					  "std" => "#FFFFFF",
					  "helpicon"=> "help.png",
					  "parent_heading" => $shortname."_style_prefs",
					  "type" => "color");
					  
		$of_options[] = array(  "name" => "h2",
					  "id" => $shortname."_heading_text_color_h2",
					  "std" => "#FFFFFF",
					  "helpicon"=> "help.png",
					  "parent_heading" => $shortname."_style_prefs",
					  "type" => "color");
					  
		$of_options[] = array(  "name" => "h3",
					  "id" => $shortname."_heading_text_color_h3",
					  "std" => "#FFFFFF",
					  "helpicon"=> "help.png",
					  "parent_heading" => $shortname."_style_prefs",
					  "type" => "color");
					  
		$of_options[] = array(  "name" => "h4",
					  "id" => $shortname."_heading_text_color_h4",
					  "std" => "#FFFFFF",
					  "helpicon"=> "help.png",
					  "parent_heading" => $shortname."_style_prefs",
					  "type" => "color");
					  
		$of_options[] = array(  "name" => "h5",
					  "id" => $shortname."_heading_text_color_h5",
					  "std" => "#FFFFFF",
					  "helpicon"=> "help.png",
					  "parent_heading" => $shortname."_style_prefs",
					  "type" => "color");
					  
		$of_options[] = array(  "name" => "h6",
					  "id" => $shortname."_heading_text_color_h6",
					  "std" => "#FFFFFF",
					  "helpicon"=> "help.png",
					  "parent_heading" => $shortname."_style_prefs",
					  "type" => "color");
					  
		$of_options[] = array(  "name" => "h2 - Slider Titles (Homepage)",
					  "id" => $shortname."_heading_text_color_h2_slider",
					  "std" => "#FFFFFF",
					  "helpicon"=> "help.png",
					  "parent_heading" => $shortname."_style_prefs",
					  "type" => "color");
					  
		$of_options[] = array(  "name" => "Slider Description Text (Homepage)",
					  "id" => $shortname."_text_color_slider",
					  "std" => "#FFFFFF",
					  "helpicon"=> "help.png",
					  "parent_heading" => $shortname."_style_prefs",
					  "type" => "color");
					  
		$of_options[] = array(  "name" => "Slider Link Colour (Homepage)",
					  "id" => $shortname."_text_color_slider_link",
					  "std" => "#FFFFFF",
					  "helpicon"=> "help.png",
					  "parent_heading" => $shortname."_style_prefs",
					  "type" => "color");
					  
		$of_options[] = array(  "name" => "Slider Mouse-over Link Colour (Homepage)",
					  "id" => $shortname."_text_color_slider_link_hover",
					  "std" => "#FFFFFF",
					  "helpicon"=> "help.png",
					  "parent_heading" => $shortname."_style_prefs",
					  "type" => "color");
					  
		$of_options[] = array(  "name" => "Menu Text Colour",
					  "id" => $shortname."_menu_text_color",
					  "std" => "#A3A3A3",
					  "helpicon"=> "help.png",
					  "parent_heading" => $shortname."_style_prefs",
					  "type" => "color");
					  
		$of_options[] = array(  "name" => "Active Menu",
					  "id" => $shortname."_menu_active_color",
					  "std" => "#FFFFFF",
					  "helpicon"=> "help.png",
					  "parent_heading" => $shortname."_style_prefs",
					  "type" => "color");
					  
		$of_options[] = array(  "name" => "Menu Description Colour",
					  "id" => $shortname."_menu_description_text_color",
					  "std" => "#555555",
					  "helpicon"=> "help.png",
					  "parent_heading" => $shortname."_style_prefs",
					  "type" => "color");
					  
		$of_options[] = array(  "name" => "Active Menu Description",
					  "id" => $shortname."_menu_active_description_color",
					  "std" => "#A3A3A3",
					  "helpicon"=> "help.png",
					  "parent_heading" => $shortname."_style_prefs",
					  "type" => "color");
	
		$of_options[] = array(  "name" => "Contact Success Message",
					  "id" => $shortname."_success_color",
					  "std" => "#05CA00",
					  "helpicon"=> "help.png",
					  "parent_heading" => $shortname."_style_prefs",
					  "type" => "color");	
					  
		//---------------------------------------------------------------------------------------------

		#------------------------------------------------------------------------------------#
		###################### King Size *WP* Page and Post Preferences ######################
		#------------------------------------------------------------------------------------#	
		
		$of_options[] = array( "name" => "Pages &frasl; Posts",
					  "type" => "heading");
					  
		$of_options[] = array(  "name" => "Enable Rich Text Excerpts",
					  "desc" => "Check this box to enable Rich Text Formating in Blog Excerpts. <em><strong>*WARNING*</strong> this will disable the current 'Excerpts' used by default (with no formatting) and will enable the use of the '<strong>&lt;!--more--&gt;</strong>' tags in posts - allowing for the custom assigned excerpts and Rich Text Formatting use (ie., Links, Images, lists, etc).</em>",
					  "id" => $shortname."_enable_rtf_excerpts",
					  "type" => "checkbox",
					  "helpicon"=> "help.png",
					  "parent_heading" => $shortname."_blog_prefs",
					  "std" => "");
				
		$of_options[] = array(  "name" => "Enable / Disable the Blog / Post Sidebar",
					  "desc" => "Uncheck this box if you want to disable the sidebar in KingSize Archives and Posts. <i><strong>Note</strong>: This will enable Fullwidth blog/posts</i>.",
					  "id" => $shortname."_sidebar_enabled",
					  "type" => "checkbox",
					  "helpicon"=> "help.png",
					  "parent_heading" => $shortname."_blog_prefs",
					  "std" => "1");
					  
		$of_options[] = array(  "name" => "Enable / Disable Post Dates",
					  "desc" => "Check this box if you want to enable dates in posts/blogs/archives and search results.",
					  "id" => $shortname."_date_enabled",
					  "type" => "checkbox",
					  "helpicon"=> "help.png",
					  "parent_heading" => $shortname."_blog_prefs",
					  "std" => "1");
					  
		$of_options[] = array(  "name" => "Enable / Disable Widget Ready Footer",
					  "desc" => "Check this box if you want to enable the Widget Ready Footer.",
					  "id" => $shortname."_show_footer",
					  "type" => "checkbox",
					  "helpicon"=> "help.png",
					  "parent_heading" => $shortname."_blog_prefs",
					  "std" => "1");
					  
		$of_options[] = array(  "name" => "Enable / Disable Gallery Page Comments",
					  "desc" => "Check this box if you want to enable the Comments on Galleries.",
					  "id" => $shortname."_show_comments",
					  "type" => "checkbox",
					  "helpicon"=> "help.png",
					  "parent_heading" => $shortname."_blog_prefs",
					  "std" => "1");
					  
		$of_options[] = array(  "name" => "Custom Read More Text",
					  "id" => $shortname."_read_more_text",
					  "std" => "Read more...",
					  "desc" => "This, as well other common used labels can be modified by changing the Language files with use of Poedit. For instructions on how to do this, please read the documentation.",
					  "helpicon"=> "help.png",
					  "parent_heading" => $shortname."_blog_prefs",
					  "type" => "text");
					  
		$of_options[] = array(  "name" => "Default Excerpt - Character Count",
					  "desc" => "Define the number (default is 600) of characters used in the default Excerpts (not applicable when using RTF excerpts).",
					  "id" => $shortname."_blog_words_count",
					  "type" => "text",
					  "mod" => "mini",
					  "helpicon"=> "help.png",
					  "parent_heading" => $shortname."_blog_prefs",
					  "std" => "600");

		$of_options[] = array(  "name" => "Enable / Disable single page / post image Gallery Next Prev",
					  "id" => $shortname."_img_gallery_nxt_prev",
					  "std" => "1",
					  "helpicon"=> "help.png",
					  "desc" => "Check this box if you want to enable the next previus of Images Galleries post/page.",
					  "parent_heading" => $shortname."_blog_prefs",
					  "type" => "checkbox");

		$of_options[] = array(  "name" => "Enable / Disable Blog Overview Image Gallery Next Prev",
					  "id" => $shortname."_blog_img_gallery_nxt_prev",
					  "std" => "1",
					  "helpicon"=> "help.png",
					  "desc" => "Check this box if you want to enable the next previus of Images Galleries Blog overview.",
					  "parent_heading" => $shortname."_blog_prefs",
					  "type" => "checkbox");
		
					  
		//---------------------------------------------------------------------------------------------
				  
		#--------------------------------------------------------------------------------#
		###################### King Size *WP* Portfolio Preferences ######################
		#--------------------------------------------------------------------------------#	
		
		$of_options[] = array( "name" => "Gallery &frasl; Portfolio",
					  "type" => "heading");
					  
		$of_options[] = array(  "name" => "Portfolio Preferences",
					  "id" => $shortname."_portfolio_prefs",
					  "std" => "<h3 style=\"margin: 0 0 10px;\">Portfolio Preferences / Settings</h3>",
					  "type" => "info");
					  
		$of_options[] = array(  "name" => "Number of Items to Display",
					  "desc" => "Here you can define the number of Portfolio Items to display within your Portfolio pages.",
					  "id" => $shortname."_portfolio_num_items",
					  "type" => "text",
					  "mod" => "mini",
					  "helpicon"=> "help.png",
					  "parent_heading" => $shortname."_portfolio_prefs",
					  "std" => "10");
					  
		$of_options[] = array(  "name" => "Portfolio Item Height",
					  "desc" => "Here you can define the height for Portfolio Items to display within your Portfolio pages. This can be useful for when wanting larger excerpts or shorter excerpts (ie., 400px).",
					  "id" => $shortname."_portfolio_height",
					  "type" => "text",
					  "mod" => "mini",
					  "helpicon"=> "help.png",
					  "parent_heading" => $shortname."_portfolio_prefs",
					  "std" => "400");
					  
		#---------------------------------------------------------------------------------#
		###################### King Size *WP* Galleries Preferences #######################
		#---------------------------------------------------------------------------------#
		
		$of_options[] = array( "name" => "Gallery Preferences",
					  "desc" => "",
					  "id" => $shortname."_galleries_prefs",
					  "std" => "<h3 style=\"margin: 0 0 10px;\">Gallery Preferences / Settings</h3>",
					  "icon" => true,
					  "type" => "info");
					  
		$of_options[] =	array( "name" => "Enable / Disable <strong>Colorbox</strong> Gallery Titles",
					  "id" => $shortname."_gallery_titles_colorbox",
					  "type" => "select",
					  "options" => array("colorbox_titles_enabled"=>"Enable Colorbox Titles", "colorbox_titles_disabled"=>"Disable Colorbox Titles"),
					  "std" => "Enable Colorbox Titles",
					  "helpicon"=> "help.png",
					  "desc" => "",
					  "parent_heading" => $shortname."_galleries_prefs");
					  
		$of_options[] =	array( "name" => "Enable / Disable <strong>Fancybox</strong> Gallery Titles",
					  "id" => $shortname."_gallery_titles_fancybox",
					  "type" => "select",
					  "options" => array("fancybox_titles_enabled"=>"Enable Fancybox Titles", "fancybox_titles_disabled"=>"Disable Fancybox Titles"),
					  "std" => "Enable Fancybox Titles",
					  "helpicon"=> "help.png",
					  "desc" => "",
					  "parent_heading" => $shortname."_galleries_prefs");
					  
		$of_options[] =	array( "name" => "Enable / Disable <strong>Galleria</strong> Gallery Titles",
					  "id" => $shortname."_gallery_titles_galleria",
					  "type" => "select",
					  "options" => array("galleria_titles_enabled"=>"Enable Galleria Titles", "galleria_titles_disabled"=>"Disable Galleria Titles"),
					  "std" => "Enable Galleria Titles",
					  "helpicon"=> "help.png",
					  "desc" => "",
					  "parent_heading" => $shortname."_galleries_prefs");
					  
		$of_options[] =	array( "name" => "Enable / Disable <strong>PrettyPhoto</strong> Gallery Titles",
					  "id" => $shortname."_gallery_titles_prettyphoto",
					  "type" => "select",
					  "options" => array("prettyphoto_titles_enabled"=>"Enable PrettyPhoto Titles", "prettyphoto_titles_disabled"=>"Disable PrettyPhoto Titles"),
					  "std" => "Enable PrettyPhoto Titles",
					  "helpicon"=> "help.png",
					  "desc" => "",
					  "parent_heading" => $shortname."_galleries_prefs");
					  
		$of_options[] =	array( "name" => "Enable / Disable <strong>SlideViewer</strong> Gallery Titles",
					  "id" => $shortname."_gallery_titles_slideviewer",
					  "type" => "select",
					  "options" => array("slideviewer_titles_enabled"=>"Enable SlideViewer Titles", "slideviewer_titles_disabled"=>"Disable SlideViewer Titles"),
					  "std" => "Enable SlideViewer Titles",
					  "helpicon"=> "help.png",
					  "desc" => "",
					  "parent_heading" => $shortname."_galleries_prefs");
					  
		$of_options[] = array(  "name" => "PrettyPhoto Share Options",
					  "id" => $shortname."_prettybox_share_option",
					  "options" => array("prettyphoto_share_enabled"=>"Enable PrettyPhoto Share", "prettyphoto_share_disabled"=>"Disable PrettyPhoto Share"),
					  "std" => "Enable PrettyPhoto Share",
					  "helpicon"=> "help.png",
					  "desc" => "Here you can choose to disable the 'Sharing' options whenever lightbox for PrettyPhoto galleries is opened. By default this is enabled.",
					  "parent_heading" => $shortname."_galleries_prefs",
					  "type" => "select");
					  
		//---------------------------------------------------------------------------------------------

		#--------------------------------------------------------------------------#
		###################### King Size *WP* Contact Options ######################
		#--------------------------------------------------------------------------#
		
		$of_options[] = array( "name" => "Contact Page",
					  "type" => "heading");

		$of_options[] = array(  "name" => "Your Email Address",
					  "id" => $shortname."_contact_email",
					  "std" => "",
					  "helpicon"=> "help.png",
					  "parent_heading" => $shortname."_misc",
					  "type" => "text");
					  
					  
		$of_options[] = array(  "name" => "Contact Success Message",
					  "id" => $shortname."_contact_email_template",
					  "std" => "Thank you for contacting us! Your message has been successfully delivered and we will be getting in touch real soon!",
					  "helpicon"=> "help.png",
					  "parent_heading"=> $shortname."_misc",
					  "type" => "textarea");
					  
		//---------------------------------------------------------------------------------------------

		#---------------------------------------------------------------------------------#
		###################### King Size *WP* Social Network Options ######################
		#---------------------------------------------------------------------------------#		
		
		$of_options[] = array( "name" => "Social Networks",
					  "type" => "heading");

		$of_options[] = array(  "name" => "Twitter URL",
					  "id" => $shortname."_social_twitter",
					  "icon" => "twitter_16.png",
					  "desc" => "<img src='".get_template_directory_uri()."/images/social/twitter_16.png' alt='twitter'/>",
					  "std" => "",
					  "parent_heading" => $shortname."_misc_social",
					  "type" => "text");		
					  
		$of_options[] = array(  "name" => "Facebook URL",
					  "id" => $shortname."_social_facebook",
					  "icon" => "facebook_16.png",
					  "desc" => "<img src='".get_template_directory_uri()."/images/social/facebook_16.png' alt='facebook'/>",
					  "parent_heading" => $shortname."_misc_social",
					  "std" => "",
					  "type" => "text");	
					  
		$of_options[] = array(  "name" => "LinkedIn URL",
					  "id" => $shortname."_social_linkedin",
					  "parent_heading" => $shortname."_misc_social",
					  "icon" => "linkedin_16.png",
					  "desc" => "<img src='".get_template_directory_uri()."/images/social/linkedin_16.png' alt='linkedin'/>",
					  "std" => "",
					  "type" => "text");
					  
		$of_options[] = array(  "name" => "Google+ URL",
					  "id" => $shortname."_social_googleplus",
					  "icon" => "googleplus_16.png",
					  "desc" => "<img src='".get_template_directory_uri()."/images/social/googleplus_16.png' alt='googleplus'/>",
					  "parent_heading" => $shortname."_misc_social",
					  "std" => "",
					  "type" => "text");
					  
		$of_options[] = array(  "name" => "Pinterest URL",
					  "id" => $shortname."_social_pinterest",
					  "icon" => "pinterest_16.png",
					  "desc" => "<img src='".get_template_directory_uri()."/images/social/pinterest_16.png' alt='pinterest'/>",
					  "parent_heading" => $shortname."_misc_social",
					  "std" => "",
					  "type" => "text");
					  
		$of_options[] = array(  "name" => "Delicious URL",
					  "id" => $shortname."_social_delicious",
					  "parent_heading" => $shortname."_misc_social",
					  "icon" => "delicious_16.png",
					  "desc" => "<img src='".get_template_directory_uri()."/images/social/delicious_16.png' alt='delicious'/>",
					  "std" => "",
					  "type" => "text");
					  
		$of_options[] = array(  "name" => "Deviant Art URL",
					  "id" => $shortname."_social_deviant",
					  "parent_heading" => $shortname."_misc_social",
					  "icon" => "deviantart_16.png",
					  "desc" => "<img src='".get_template_directory_uri()."/images/social/deviantart_16.png' alt='deviant'/>",
					  "std" => "",
					  "type" => "text");
					  
		$of_options[] = array(  "name" => "Digg URL",
					  "id" => $shortname."_social_digg",
					  "parent_heading" => $shortname."_misc_social",
					  "icon" => "digg_alt_16.png",
					  "desc" => "<img src='".get_template_directory_uri()."/images/social/digg_alt_16.png' alt='digg'/>",
					  "std" => "",
					  "type" => "text");
					  
		$of_options[] = array(  "name" => "Dribbble URL",
					  "id" => $shortname."_social_dribble",
					  "parent_heading" => $shortname."_misc_social",
					  "icon" => "dribbble_16.png",
					  "desc" => "<img src='".get_template_directory_uri()."/images/social/dribbble_16.png' alt='dribble'/>",
					  "std" => "",
					  "type" => "text");
					  
		$of_options[] = array(  "name" => "Flickr URL",
					  "id" => $shortname."_social_flickr",
					  "parent_heading" => $shortname."_misc_social",
					  "icon" => "flickr_16.png",
					  "desc" => "<img src='".get_template_directory_uri()."/images/social/flickr_16.png' alt='flickr'/>",
					  "std" => "",
					  "type" => "text");
					  
		$of_options[] = array(  "name" => "Forrst URL",
					  "id" => $shortname."_social_forrst",
					  "parent_heading" => $shortname."_misc_social",
					  "icon" => "forrst_16.png",
					  "desc" => "<img src='".get_template_directory_uri()."/images/social/forrst_16.png' alt='forrst'/>",
					  "std" => "",
					  "type" => "text");
					  
		$of_options[] = array(  "name" => "Google URL",
					  "id" => $shortname."_social_google",
					  "parent_heading" => $shortname."_misc_social",
					  "icon" => "google_16.png",
					  "desc" => "<img src='".get_template_directory_uri()."/images/social/google_16.png' alt='google'/>",
					  "std" => "",
					  "type" => "text");
					  
		$of_options[] = array(  "name" => "Google Talk URL",
					  "id" => $shortname."_social_googletalk",
					  "parent_heading" => $shortname."_misc_social",
					  "icon" => "googletalk_16.png",
					  "desc" => "<img src='".get_template_directory_uri()."/images/social/googletalk_16.png' alt='googletalk'/>",
					  "std" => "",
					  "type" => "text");
					  
		$of_options[] = array(  "name" => "MySpace URL",
					  "id" => $shortname."_social_myspace",
					  "parent_heading" => $shortname."_misc_social",
					  "icon" => "myspace_16.png",
					  "desc" => "<img src='".get_template_directory_uri()."/images/social/myspace_16.png' alt='myspace'/>",
					  "std" => "",
					  "type" => "text");
					  
		$of_options[] = array(  "name" => "PayPal URL",
					  "id" => $shortname."_social_paypal",
					  "parent_heading" => $shortname."_misc_social",
					  "icon" => "paypal_16.png",
					  "desc" => "<img src='".get_template_directory_uri()."/images/social/paypal_16.png' alt='paypal'/>",
					  "std" => "",
					  "type" => "text");
					  
		$of_options[] = array(  "name" => "Picasa URL",
					  "id" => $shortname."_social_picasa",
					  "parent_heading" => $shortname."_misc_social",
					  "icon" => "picasa_16.png",
					  "desc" => "<img src='".get_template_directory_uri()."/images/social/picasa_16.png' alt='picasa'/>",
					  "std" => "",
					  "type" => "text");
					  
		$of_options[] = array(  "name" => "Reddit URL",
					  "id" => $shortname."_social_reddit",
					  "parent_heading" => $shortname."_misc_social",
					  "icon" => "reddit_16.png",
					  "desc" => "<img src='".get_template_directory_uri()."/images/social/reddit_16.png' alt='reddit'/>",
					  "std" => "",
					  "type" => "text");
					  
		$of_options[] = array(  "name" => "RSS URL",
					  "id" => $shortname."_social_rss",
					  "parent_heading" => $shortname."_misc_social",
					  "icon" => "rss_16.png",
					  "desc" => "<img src='".get_template_directory_uri()."/images/social/rss_16.png' alt='rss'/>",
					  "std" => "",
					  "type" => "text");
					  
		$of_options[] = array(  "name" => "Skype URL",
					  "id" => $shortname."_social_skype",
					  "parent_heading" => $shortname."_misc_social",
					  "icon" => "skype_16.png",
					   "desc" => "<img src='".get_template_directory_uri()."/images/social/skype_16.png' alt='skype'/>",
					  "std" => "",
					  "type" => "text");
					  
		$of_options[] =  array(  "name" => "Stumble Upon URL",
					  "id" => $shortname."_social_stumble",
					  "parent_heading" => $shortname."_misc_social",
					  "icon" => "stumbleupon_16.png",
					  "desc" => "<img src='".get_template_directory_uri()."/images/social/stumbleupon_16.png' alt='stumble'/>",
					  "std" => "",
					  "type" => "text");
					  
		$of_options[] = array(  "name" => "Tumblr URL",
					  "id" => $shortname."_social_tumblr",
					  "parent_heading" => $shortname."_misc_social",
					  "icon" => "tumblr_16.png",
					  "desc" => "<img src='".get_template_directory_uri()."/images/social/tumblr_16.png' alt='tumblr'/>",
					  "std" => "",
					  "type" => "text");
					  
		$of_options[] = array(  "name" => "Vimeo URL",
					  "id" => $shortname."_social_vimeo",
					  "parent_heading" => $shortname."_misc_social",
					  "icon" => "vimeo_16.png",
					  "desc" => "<img src='".get_template_directory_uri()."/images/social/vimeo_16.png' alt='vimeo'/>",
					  "std" => "",
					  "type" => "text");
					  
		$of_options[] = array(  "name" => "WordPress URL",
					  "id" => $shortname."_social_wordpress",
					  "parent_heading" => $shortname."_misc_social",
					  "desc" => "<img src='".get_template_directory_uri()."/images/social/wordpress_16.png' alt='wordpress'/>",
					  "std" => "",
					  "type" => "text");
					  
		$of_options[] = array(  "name" => "Yahoo URL",
					  "id" => $shortname."_social_yahoo",
					  "parent_heading" => $shortname."_misc_social",
					  "icon" => "yahoo_16.png",
					  "desc" => "<img src='".get_template_directory_uri()."/images/social/yahoo_16.png' alt='yahoo'/>",
					  "std" => "",
					  "type" => "text");
					  
		$of_options[] = array(  "name" => "Youtube URL",
					  "id" => $shortname."_social_youtube",
					  "parent_heading" => $shortname."_misc_social",
					  "icon" => "youtube_16.png",
					  "desc" => "<img src='".get_template_directory_uri()."/images/social/youtube_16.png' alt='youtube'/>",
					  "std" => "",
					  "type" => "text");
					  
		//---------------------------------------------------------------------------------------------

		#--------------------------------------------------------------------------------#
		###################### King Size *WP* Miscellaneous Options ######################
		#--------------------------------------------------------------------------------#
		
		$of_options[] = array( "name" => "Miscellaneous",
					  "type" => "heading");
					  
		$of_options[] = array(  "name" => "CSS Overrides / Overwrites",
					  "desc" => "Insert your custom CSS overrides here. CSS entered into this area will overwrite the defaults defined inside style.css - This is useful when updating so your CSS changes are not overwritten after updating the template files. This is the recommended use.",
					  "id" => $shortname."_custom_css",
					  "type" => "textarea",
					  "helpicon"=> "help.png",
					  "parent_heading" => $shortname."_css_prefs",
					  "std" => "");

		$of_options[] = array(  "name" => "&lsaquo;head&rsaquo; Include Code",
					  "id" => $shortname."_head_include",
					  "std" => "",
					  "desc" => "This area is used for when you need to include new scripts into your header without needing to make changes to the \"header.php\" file. It's recommended you use this to avoid overwriting your changes when updating the template files during updates.",
					  "helpicon"=> "help.png",
					  "parent_heading" => $shortname."_misc_setting",
					  "type" => "textarea");
					  
		$of_options[] = array(  "name" => "404 Error Page Header",
					  "id" => $shortname."_custom_404_title",
					  "std" => "",
					  "desc" => "Personalize the 404 Header title.",
					  "helpicon"=> "help.png",
					  "parent_heading" => $shortname."_misc_setting",
					  "type" => "text");	
					  
		$of_options[] = array(  "name" => "404 Error Page Message",
					  "id" => $shortname."_custom_404",
					  "std" => "",
					  "desc" => "Personalize the 404 Error Message.",
					  "helpicon"=> "help.png",
					  "parent_heading" => $shortname."_misc_setting",
					  "type" => "textarea");	
					  
		$of_options[] = array(  "name" => "Insert Google Analytics ID",
					  "id" => $shortname."_google_analytics_id",
					  "std" => "",
					  "desc" => "Insert the Google ID from your Google Analytics code. This is also known as the \"Property ID\" in Google Analytics. Should look similar to\"UA-10423610-7\".",
					  "helpicon"=> "help.png",
					  "parent_heading" => $shortname."_misc_setting",
					  "type" => "text");	
					  
		$of_options[] = array(  "name" => "Enable / Disable Right-Clicks",
					  "desc" => "Check this box if you want to enable the No-Right-Click option.",
					  "id" => $shortname."_no_rightclick_enabled",
					  "type" => "checkbox",
					  "helpicon"=> "help.png",
					  "parent_heading" => $shortname."_misc_setting",
					  "std" => "1");

		#----------------------------------------------------------------------------#
		###################### King Size *WP* Copyright Options ######################
		#----------------------------------------------------------------------------#	

		$of_options[] = array(  "name" => "Small Footer Copyright",
					  "desc" => "Insert Footer text (ie., Copyrights).",
					  "id" => $shortname."_footer_copyright",
					  "std" => "&copy; 2010 - 2011 King Size Theme",
					  "helpicon"=> "help.png",
					  "parent_heading" => $shortname."_misc_Copyright",
					  "type" => "textarea");
					
	}
}
?>
