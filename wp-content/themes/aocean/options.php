<?php
/**
 * A unique identifier is defined to store the options in the database and reference them from the theme.
 * By default it uses the theme name, in lowercase and without spaces, but this can be changed if needed.
 * If the identifier changes, it'll appear as if the options have been reset.
 */

function optionsframework_option_name() {

	// This gets the theme name from the stylesheet
	$themename = wp_get_theme();
	$themename = preg_replace("/\W/", "_", strtolower($themename) );

	$optionsframework_settings = get_option( 'optionsframework' );
	$optionsframework_settings['id'] = $themename;
	update_option( 'optionsframework', $optionsframework_settings );
}

/**
 * Defines an array of options that will be used to generate the settings page and be saved in the database.
 * When creating the 'id' fields, make sure to use all lowercase and no spaces.
 *
 * If you are making your theme translatable, you should replace 'options_framework_theme'
 * with the actual text domain for your theme.  Read more:
 * http://codex.wordpress.org/Function_Reference/load_theme_textdomain
 */

function optionsframework_options() {

	// Test data
	$test_array = array(
		'one' => __('One', 'options_framework_theme'),
		'two' => __('Two', 'options_framework_theme'),
		'three' => __('Three', 'options_framework_theme'),
		'four' => __('Four', 'options_framework_theme'),
		'five' => __('Five', 'options_framework_theme')
	);

	// Multicheck Array
	$multicheck_array = array(
		'one' => __('French Toast', 'options_framework_theme'),
		'two' => __('Pancake', 'options_framework_theme'),
		'three' => __('Omelette', 'options_framework_theme'),
		'four' => __('Crepe', 'options_framework_theme'),
		'five' => __('Waffle', 'options_framework_theme')
	);

	// Multicheck Defaults
	$multicheck_defaults = array(
		'one' => '1',
		'five' => '1'
	);

	// Background Defaults
	$background_defaults = array(
		'color' => '',
		'image' => '',
		'repeat' => 'repeat',
		'position' => 'top center',
		'attachment'=>'scroll' );

	// Typography Defaults
	$typography_defaults = array(
		'size' => '15px',
		'face' => 'georgia',
		'style' => 'bold',
		'color' => '#bada55' );

	// Typography Options
	$typography_options = array(
		'sizes' => array( '6','12','14','16','20' ),
		'faces' => array( 'Helvetica Neue' => 'Helvetica Neue','Arial' => 'Arial' ),
		'styles' => array( 'normal' => 'Normal','bold' => 'Bold' ),
		'color' => false
	);

	// Pull all the categories into an array
	$options_categories = array();
	$options_categories_obj = get_categories();
	foreach ($options_categories_obj as $category) {
		$options_categories[$category->cat_ID] = $category->cat_name;
	}

	// Pull all tags into an array
	$options_tags = array();
	$options_tags_obj = get_tags();
	foreach ( $options_tags_obj as $tag ) {
		$options_tags[$tag->term_id] = $tag->name;
	}


	// Pull all the pages into an array
	$options_pages = array();
	$options_pages_obj = get_pages('sort_column=post_parent,menu_order');
	$options_pages[''] = 'Select a page:';
	foreach ($options_pages_obj as $page) {
		$options_pages[$page->ID] = $page->post_title;
	}

	// If using image radio buttons, define a directory path
	$imagepath =  get_template_directory_uri() . '/images/';

	$options = array();
	
	// -----------------------------
	// General Tab
	// -----------------------------

	$options[] = array(
		'name' => __('General', 'options_framework_theme'),
		'type' => 'heading');
	
	$options[] = array(
		'name' => __('Custom Favicon', 'options_framework_theme'),
		'desc' => __('Upload a 16x16px Png/Gif image that will be your favicon.', 'options_framework_theme'),
		'id' => 'favicon',
		'type' => 'upload');
		
	$options[] = array(
		'name' => __('Custom CSS', 'options_framework_theme'),
		'desc' => __('Want to add any custom CSS code? Put in here.', 'options_framework_theme'),
		'id' => 'custom_css',
		'std' => '',
		'type' => 'textarea');

	$options[] = array(
		'name' => __('Tracking Code', 'options_framework_theme'),
		'desc' => __('Paste your tracking code here. It will be inserted before the closing body tag of your theme.', 'options_framework_theme'),
		'id' => 'tracking_code',
		'std' => 'Default Text',
		'type' => 'textarea');


	// -----------------------------
	// Header
	// -----------------------------

	$options[] = array(
		'name' => __('Header', 'options_framework_theme'),
		'type' => 'heading');

	$options[] = array(
		'name' => __('Custom Logo', 'options_framework_theme'),
		'desc' => __('Upload custom logo image.', 'options_framework_theme'),
		'id' => 'custom_logo',
		'type' => 'upload');
	
	$options[] = array(
		'name' 		=> __( 'Site Title color', 'options_framework_theme' ),
		'desc' 		=> __( 'You can change the site title color.', 'options_framework_theme' ),
		'id' 			=> 'logo_text_color',
		'std' 		=> '',
		'type' 		=> 'color' 
	);
	
	$options[] = array(
		'name' 		=> __( 'Site Description color', 'options_framework_theme' ),
		'desc' 		=> __( 'You can change the site description color.', 'options_framework_theme' ),
		'id' 			=> 'site_description_color',
		'std' 		=> '',
		'type' 		=> 'color' 
	);

	
	$options[] = array(
		'name' => __('Site Description', 'options_framework_theme'),
		'desc' => __('If you want to hide the description that appears next to your logo.', 'options_framework_theme'),
		'id' => 'site_description',
		'std' => '',
		'type' => 'checkbox');
		
	// -----------------------------
	// Styling Tab
	// -----------------------------
	
		
	$options[] = array(
		'name' => __('Styling', 'options_framework_theme'),
		'type' => 'heading');

	$options[] = array(
		'name' 		=> __( 'Theme color', 'options_framework_theme' ),
		'desc' 		=> __( 'You can change the theme color. This will reflect in links, buttons and many others.', 'options_framework_theme'),
		'id' 			=> 'theme_primary_color',
		'std' 		=> '',
		'type' 		=> 'color' 
	);
	
	$options[] = array(
		'name' => __('Social Icon Color', ''),
		'desc' => __('Chnage Your Social Icon Color', ''),
		'id' => 'social_icon_bg_color',
		'std' => '',
		'type' => 'color');
	
	$options[] = array(
		'name' =>  __('Header Background', 'options_framework_theme'),
		'desc' => __('Change the Header background color or upload background image.', 'options_framework_theme'),
		'id' => 'header_color',
		'std' => $background_defaults,
		'type' => 'background' );

	$options[] = array(
		'name' =>  __('Footer Widget Background', 'options_framework_theme'),
		'desc' => __('Change the Footer Widget background color or upload background image.', 'options_framework_theme'),
		'id' => 'footer_widget_color',
		'std' => $background_defaults,
		'type' => 'background' );

	$options[] = array(
		'name' =>  __('Footer Background', 'options_framework_theme'),
		'desc' => __('Change the Footer background color or upload background image.', 'options_framework_theme'),
		'id' => 'footer_color',
		'std' => $background_defaults,
		'type' => 'background' );
		
	
	// -----------------------------
	// Advertising Tab
	// -----------------------------
		
	$options[] = array(
		'name' => __('Advertising', ''),
		'type' => 'heading');
	
	$options[] = array(
		'name' => __('Ad size is 468 X 60', ''),
		'desc' => __('Add your banner\'s code. It appears on header', ''),
		'id' => 'header_ad_468',
		'std' => '',
		'type' => 'textarea');
		
	$options[] = array(
		'name' => __('Ad size is 728 X 90', ''),
		'desc' => __('Add your banner\'s code. It appears on footer', ''),
		'id' => 'footer_ad_728',
		'std' => '',
		'type' => 'textarea');
		
	// -----------------------------
	// Footer Tab
	// -----------------------------

		
	$options[] = array(
		'name' => __('Footer', 'options_framework_theme'),
		'type' => 'heading');
		
	$options[] = array(
		'name' 		=> __( 'Footer Widget Heading Text color', 'options_framework_theme' ),
		'desc' 		=> __( 'You can change the theme footer widget heading text color.', 'options_framework_theme'),
		'id' 			=> 'footer_widget_text_color',
		'std' 		=> '',
		'type' 		=> 'color' 
	);
	
	$options[] = array(
		'name' 		=> __( 'Footer Widget Link color', 'options_framework_theme' ),
		'desc' 		=> __( 'You can change the theme footer widget link color.', 'options_framework_theme'),
		'id' 			=> 'footer_widget_link_color',
		'std' 		=> '',
		'type' 		=> 'color' 
	);
	
	$options[] = array(
		'name' => __('Footer Copyright', 'options_framework_theme'),
		'desc' => __('Replace the footer copyright text.', 'options_framework_theme'),
		'id' => 'copyright',
		'std' => '',
		'type' => 'textarea');
	


	/**
	 * For $settings options see:
	 * http://codex.wordpress.org/Function_Reference/wp_editor
	 *
	 * 'media_buttons' are not supported as there is no post to attach items to
	 * 'textarea_name' is set by the 'id' you choose
	 */

	$wp_editor_settings = array(
		'wpautop' => true, // Default
		'textarea_rows' => 5,
		'tinymce' => array( 'plugins' => 'wordpress' )
	);


	return $options;
}