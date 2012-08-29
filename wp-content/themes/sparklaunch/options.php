<?php
/**
 * A unique identifier is defined to store the options in the database and reference them from the theme.
 * By default it uses the theme name, in lowercase and without spaces, but this can be changed if needed.
 * If the identifier changes, it'll appear as if the options have been reset.
 * 
 */

function optionsframework_option_name() {

	// This gets the theme name from the stylesheet (lowercase and without spaces)
	$themename = get_theme_data(STYLESHEETPATH . '/style.css');
	$themename = $themename['Name'];
	$themename = preg_replace("/\W/", "", strtolower($themename) );
	
	$optionsframework_settings = get_option('optionsframework');
	$optionsframework_settings['id'] = $themename;
	update_option('optionsframework', $optionsframework_settings);
	
	// echo $themename;
}

/**
 * Defines an array of options that will be used to generate the settings page and be saved in the database.
 * When creating the "id" fields, make sure to use all lowercase and no spaces.
 *  
 */

function optionsframework_options() {
	
	// Pull all the categories into an array
	$options_categories = array();  
	$options_categories_obj = get_categories();
	foreach ($options_categories_obj as $category) {
    	$options_categories[$category->cat_ID] = $category->cat_name;
	}
	
	// Pull all the pages into an array
	$options_pages = array();  
	$options_pages_obj = get_pages('sort_column=post_parent,menu_order');
	$options_pages[''] = 'Select a page:';
	foreach ($options_pages_obj as $page) {
    	$options_pages[$page->ID] = $page->post_title;
	}
	
	// jQuery Cycle effects
	$options_effects = array('fade', 'scrollDown', 'scrollUp', 'scrollLeft', 'scrollRight', 'scrollHorz', 'scrollVert');
		
	// If using image radio buttons, define a directory path
	$imagepath =  get_bloginfo('stylesheet_directory') . '/_assets/img/';
		
	$options = array();
	
	$options[] = array( "name" => "General Settings",
						"type" => "heading");	
						
	$options[] = array( "name" => "Slider Settings",
						"type" => "heading");	
						
	$options[] = array( "name" => "Transition Effect",
						"desc" => "Transition effect for the slideshow.",
						"id" => "sl_effect",
						"type" => "select",
						"std" => "Select an effect:",
						"options" => $options_effects);
						
	$options[] = array( "name" => "Speed",
						"desc" => "Speed of the transition in miliseconds (1s = 1000)",
						"id" => "sl_speed",
						"std" => "500",
						"type" => "text");		
						
	$options[] = array( "name" => "Timeout",
						"desc" => "Time (in milliseconds) between slide transitions (0 to disable auto advance) ",
						"id" => "sl_timeout",
						"std" => "",
						"type" => "text");														
	
	// Insert all the required options here
																															
	return $options;
}