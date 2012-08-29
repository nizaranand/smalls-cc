=== WP-UserLogin ===
Contributors: Jerry Stephens
Donate link: http://wayofthegeek.org/donate/
Tags: userlogin, userslogin, wp-userlogin, login, users, user, dashboard, controlpanel, control-panel, panel, control, widget, openid, open-id, sidebar, register, password,stylesheet, css
Requires at least: 2.9
Tested up to: 3.*
Stable tag: 5.4


== Description ==

Front page login/logout and control panel with support for OpenID.

== Installation ==

Unzip and upload to /wp-content/plugins/ directory
Activate the plugin
Add the User Login widget to your sidebar
If your site doesn't support widgets simply add `<?php wpul_widget();?>` to your sidebar

== Frequently Asked Questions ==

= What does this plugin do, exactly? =

It builds a login form and control panel in the sidebar of your page.

= Do you need the OpenID plugin to use the WP-UserLogin plugin? =

Nope, it works all on it's own. But if you do have the [OpenID plugin](http://wordpress.org/extend/plugins/openid/ "Add OpenID to your site") installed you'll have an OpenID field in your login form.

= Can I edit the CSS for the form and control panel? =

Yes, as of v5.0 a stylesheet editor has been included. If you don't like that stylesheet, or you have your own already, you also have the option to use your own stylesheet.
== Screenshots ==

No screenshots available

== Changelog ==
= 5.3 =
*Corrected empty list item display bug
*Added one-line call for non-widgetized sites

= 5.2 =
*Correct array_diff/implode error message

= 5.1 =
*Added optional additionalÍ links function

= 5.0 =
* Added default stylesheet
* Added stylesheet editor
* Rebuilt look and feel of options page
* Gave plugin its own sidebar panel
* Integrated native Wordpress gravatar function
* Streamlined options saving
* Created uninstall function
* Cleaned up old database entries
* Changed function names to avoid conflicting with other plugins
* Changed element id and class names to avoid conflict with other plugins
* Configured redirect in/out URLs to relative URL instead of absolute

= 4.0 =
* Added logout redirection
* Streamlined needless processes

= 3.1.1 =
* Minor functionality correction

= 3.1 =
* Added I18n localization

= 3.0 =
* Added welcome message and parameters
* Added database propagation on plugin activation

= 2.3.2 =
* Minor functionality correction

= 2.3.1 =
* Minor functionality correction

= 2.3 =
* Added login redirection

= 2.2 =
* Tested for WordPress 2.5.1

= 2.1 =
* Minor functionality correction

= 2.0 =
* Improved user-role handling 
* Added Control Panel

= 1.2 =
* Minor functionality correction

= 1.1 =
* Improved Wordpress integration

= 1.0 =
* First stable release
* Added OpenID plugin integration

== Upgrade Notice ==
This upgrade removes the donate and links for further documentation, which are no longer kept or working.