<?php
if ( !defined( 'WP_UNINSTALL_PLUGIN' ) )
    exit ();

delete_option('themeforce_yelpbar_options');
delete_option('themeforce_yelpbar_json');
?>