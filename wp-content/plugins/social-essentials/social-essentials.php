<?php

/** 
Plugin Name: Social Essentials
Plugin URI: http://imimpact.com/social-essentials/
Description: Social engagement stats and social sharing buttons for your site.
Version: 1.1
Author: Shane Melaugh
Author URI: http://imimpact.com/
License: GPL2
*/
/*  Copyright 2012  whitesquare GmbH  (email : shane@imimpact.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

include_once('social-essentials.class.php'); // include social-essentials class

$se = new social_essentials(); // create new object of social-essentials class

	$path_to_php_file_plugin = dirname(__FILE__); // variable for saved path to the plugin
	 
	$se->page_title = 'Social Essentials'; // plugin title in admin panel 
	 
	$se->menu_title = 'Social Essentials'; // plugin menu title in admin section
	 
	$se->short_description = 'Social Essentials description'; // description plugin, displayed lower of the plugin title in admin panel
	 
	$se->access_level = 10; // access level for plugin (10 - administrator access)
	 
	$se->add_page_to = 1; // in what section in admin panel displayed a plugin link
 
add_action('admin_menu', array($se, 'add_admin_menu')); // hook for displayed admin menu

add_action('deactivate_' . $path_to_php_file_plugin, array($se, 'deactivate')); // hook for deactivate plugin

add_action('activate_' . $path_to_php_file_plugin, array($se, 'activate')); // hook for acivate plugin

register_activation_hook( __FILE__, array($se, 'activate')); // registration activation hook

register_deactivation_hook(__FILE__, array($se, 'deactivate')); // registration deactivation hook

add_action('admin_init', array($se,'init')); // hook for atached css file for social essentials plugin in admin section

add_action('admin_init', array($se,'add_admin_head')); // hook for atached js and css files for social essentials plugin in admin section

add_action('wp_print_styles', array($se,'init')); // hook for atached css file for social essentials plugin in frontend

?>