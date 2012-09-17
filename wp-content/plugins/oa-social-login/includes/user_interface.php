<?php

/**
 * Include the Social Library
 */
function oa_social_login_add_javascripts ()
{
	if (!wp_script_is ('oa_social_library', 'registered'))
	{
		//Read settings
		$settings = get_option ('oa_social_login_settings');

		if (!empty ($settings ['api_subdomain']))
		{
			//Include in header, without having the version appended
			wp_register_script ("oa_social_library", ((oa_social_login_https_on () ? 'https' : 'http') . '://' . $settings ['api_subdomain'] . '.api.oneall.com/socialize/library.js'), array (), null, false);
		}
	}
	wp_print_scripts ('oa_social_library');
}
add_action ('login_head', 'oa_social_login_add_javascripts');
add_action ('wp_head', 'oa_social_login_add_javascripts');


/**
 * Setup Shortcode handler
 */
function oa_social_login_shortcode_handler ($args)
{
	return (is_user_logged_in () ? '' : oa_social_login_render_login_form ('shortcode'));
}
add_shortcode ('oa_social_login', 'oa_social_login_shortcode_handler');


/**
 * Hook to display custom avatars
 */
function oa_social_login_custom_avatar ($avatar, $mixed, $size, $default, $alt = '')
{
	//The social login settings
	static $oa_social_login_settings = null;
	if (is_null ($oa_social_login_settings))
	{
		$oa_social_login_settings = get_option ('oa_social_login_settings');
	}

	//Check if we are in a comment
	if (isset ($oa_social_login_settings ['plugin_show_avatars_in_comments']) AND $oa_social_login_settings ['plugin_show_avatars_in_comments'] == '1')
	{
		//Current comment
		global $comment;

		//Chosen user
		$user_id = null;

		//Check if we are in a comment
		if (is_object ($comment) AND property_exists ($comment, 'user_id') AND !empty ($comment->user_id))
		{
			$user_id = $comment->user_id;
		}
		//Check if we have an user identifier
		elseif (is_numeric($mixed))
		{
			if ($mixed > 0)
			{
				$user_id = $mixed;
			}
		}
		//Check if we have an email
		elseif (is_string($mixed) && ($user = get_user_by( 'email', $mixed)))
		{
			$user_id = $user->ID;
		}
		//Check if we have an user object
		else if(is_object($mixed))
		{
			if (property_exists ($mixed, 'user_id') AND is_numeric ($mixed->user_id))
			{
				$user_id = $mixed->user_id;
			}
		}

		//User found?
		if ( ! empty ($user_id))
		{
			if (($user_thumbnail = get_user_meta ($user_id, 'oa_social_login_user_thumbnail', true)) !== false)
			{
				if (strlen (trim ($user_thumbnail)) > 0)
				{
					return '<img alt="'. oa_social_login_esc_attr($alt) .'" src="'.$user_thumbnail.'" class="avatar avatar-social-login avatar-'.$size.' photo" height="'.$size.'" width="'.$size.'" />';
				}
			}
		}
	}

	//Default
	return $avatar;
}
add_filter ('get_avatar', 'oa_social_login_custom_avatar', 10, 5);


/**
 * Show Social Login below "you must be logged in ..."
 */
function oa_social_login_filter_comment_form_defaults($default_fields)
{
	//No need to go further if comments disabled or user loggedin
	if (is_array ($default_fields) AND comments_open () AND !is_user_logged_in ())
	{
		//Read settings
		$settings = get_option ('oa_social_login_settings');

		//Display buttons if option not set or disabled
		if ( ! empty($settings['plugin_comment_show_if_members_only']))
		{
			if ( ! isset ($default_fields['must_log_in']))
			{
				$default_fields['must_log_in'] = '';
			}
			$default_fields['must_log_in'] .=  oa_social_login_render_login_form ('comments');
		}
	}
	return $default_fields;
}
add_filter('comment_form_defaults', 'oa_social_login_filter_comment_form_defaults');



/**
 * Display the provider grid for comments
 */
function oa_social_login_render_login_form_comments ()
{
	//Comments are open and the user is not logged in
	if (comments_open () && !is_user_logged_in ())
	{
		//Read settings
		$settings = get_option ('oa_social_login_settings');

		//Display buttons if option not set or not disabled
		if (!isset ($settings ['plugin_comment_show']) OR ! empty ($settings ['plugin_comment_show']))
		{
			echo oa_social_login_render_login_form ('comments');
		}
	}
}
add_action ('comment_form_top', 'oa_social_login_render_login_form_comments');


/**
 * Display the provider grid for registration
 */
function oa_social_login_render_login_form_registration ()
{
	//Users may register
	if (get_option ('users_can_register') === '1')
	{
		//Read settings
		$settings = get_option ('oa_social_login_settings');

		//Display buttons if option not set or enabled
		if (!isset ($settings ['plugin_display_in_registration_form']) OR ! empty ($settings ['plugin_display_in_registration_form']))
		{
			echo oa_social_login_render_login_form ('registration');
		}
	}
}
add_action ('register_form', 'oa_social_login_render_login_form_registration');


/**
 * Display the provider grid for login
 */
function oa_social_login_render_login_form_login ()
{
	//Read settings
	$settings = get_option ('oa_social_login_settings');

	//Display buttons if option not set or enabled
	if (!isset ($settings ['plugin_display_in_login_form']) OR $settings ['plugin_display_in_login_form'] == '1')
	{
		echo oa_social_login_render_login_form ('login');
	}
}
add_action ('login_form', 'oa_social_login_render_login_form_login');


/**
 * Display a custom grid for login
 */
function oa_social_login_render_custom_form_login ()
{
	if (!is_user_logged_in ())
	{
		echo oa_social_login_render_login_form ('custom');
	}
}
add_action ('oa_social_login', 'oa_social_login_render_custom_form_login');


/**
 * Alternative for custom forms, where the output is not necessarily required at the place of calling
 * $oa_social_login_form = apply_filters('oa_social_login_custom', '');
 */
function oa_social_login_filter_login_form_custom ($value = 'custom')
{
	return (is_user_logged_in () ? '' : oa_social_login_render_login_form ($value));
}
add_filter ('oa_social_login_custom', 'oa_social_login_filter_login_form_custom');


/**
 * Display the provider grid
 */
function oa_social_login_render_login_form ($source, $args = array())
{
	//Import providers
	GLOBAL $oa_social_login_providers;

	//Container for returned value
	$output = '';

	//Read settings
	$settings = get_option ('oa_social_login_settings');

	//API Subdomain
	$api_subdomain = (!empty ($settings ['api_subdomain']) ? $settings ['api_subdomain'] : '');

	//API Subdomain Required
	if (!empty ($api_subdomain))
	{
		//Build providers
		$providers = array ();
		if (is_array ($settings ['providers']))
		{
			foreach ($settings ['providers'] AS $settings_provider_key => $settings_provider_name)
			{
				if (isset ($oa_social_login_providers [$settings_provider_key]))
				{
					$providers [] = $settings_provider_key;
				}
			}
		}

		//Themes are served from the CDN
		$theme_uri_prefix = (oa_social_login_https_on () ? 'https://secure.oneallcdn.com' : 'http://public.oneallcdn.com');

		//Themes
		$css_theme_uri_small = $theme_uri_prefix . '/css/api/socialize/themes/wordpress/small.css';
		$css_theme_uri_default = $theme_uri_prefix . '/css/api/socialize/themes/wordpress/default.css';

		//Widget
		if ($source == 'widget')
		{
			//Read widget settings
			$widget_settings = (is_array ($args) ? $args : array ());

			//Dont show the title - this is handled insided the widget
			$plugin_caption = '';

			//Buttons size
			$css_theme_uri = ((array_key_exists ('widget_use_small_buttons', $widget_settings) AND !empty ($widget_settings ['widget_use_small_buttons'])) ? $css_theme_uri_small : $css_theme_uri_default);
		}
		//Other places
		else
		{
			//Show title if set
			$plugin_caption = (!empty ($settings ['plugin_caption']) ? $settings ['plugin_caption'] : '');

			//Buttons size
			$css_theme_uri = (!empty ($settings ['plugin_use_small_buttons']) ? $css_theme_uri_small : $css_theme_uri_default);
		}

		//No providers selected
		if (count ($providers) == 0)
		{
			$output = '<div style="color:white;background-color:red;">[Social Login] '.__ ('Please enable at least one social network!').'</div>';
		}
		//Providers selected
		else
		{
			//Random integer
			$rand = mt_rand (99999, 9999999);

			//Setup output
			$output = array ();
			$output [] = '<div class="oneall_social_login">';

			//Add the caption?
			if (!empty ($plugin_caption))
			{
				$output [] = ' <div class="oneall_social_login_label" style="margin-bottom: 3px;"><label>' . __ ($plugin_caption) . '</label></div>';
			}

			//Add the Plugin
			$output [] = ' <div class="oneall_social_login_providers" id="oneall_social_login_providers_' . $rand . '"></div>';
			$output [] = ' <script type="text/javascript">';
			$output [] = '  oneall.api.plugins.social_login.build("oneall_social_login_providers_' . $rand . '", {';
			$output [] = '   "providers": ["' . implode ('","', $providers) . '"], ';
			$output [] = '   "callback_uri": (window.location.href + ((window.location.href.split(\'?\')[1] ? \'&amp;\':\'?\') + "oa_social_login_source=' . $source . '")), ';
			$output [] = '   "css_theme_uri": "' . $css_theme_uri . '" ';
			$output [] = '  });';
			$output [] = ' </script>';
			$output [] = ' <!-- oneall.com / Social Login for Wordpress / v3.0 -->';
			$output [] = '</div>';

			//Done
			$output = implode ("\n", $output);
		}

		//Return a string and let the calling function do the actual outputting
		return $output;
	}
}



/**
 * Request email from user
 */
function oa_social_login_request_email()
{
	//Get the current user
	$current_user = wp_get_current_user();

	//Check if logged in
	if ( ! empty ($current_user->ID) AND is_numeric ($current_user->ID))
	{
		//Current user
		$user_id = $current_user->ID;

		//Check if email has to be requested
		$oa_social_login_request_email = get_user_meta($user_id, 'oa_social_login_request_email', true);
		if ( ! empty ($oa_social_login_request_email))
		{
			//Display modal dialog?
			$display_modal = true;

			//Messaging
			$message = '';

			//Form submitted
			if ( isset ($_POST) AND ! empty ($_POST['oa_social_login_action']) AND $_POST['oa_social_login_action'] == 'confirm_email')
			{
				$user_email = (empty ($_POST['oa_social_login_email']) ? '' : trim ($_POST['oa_social_login_email']));
				if (empty ($user_email))
				{
					$message = __('Please enter your email address','oa_social_login');
				}
				else
				{
					if (!is_email ($user_email))
					{
						$message = __('This email is not valid','oa_social_login');
					}
					elseif (email_exists ($user_email))
					{

						$message = __('This email is already used by another account','oa_social_login');
					}
					else
					{
						wp_update_user(array ('ID' => $user_id, 'user_email' => $user_email));
						delete_user_meta($user_id, 'oa_social_login_request_email');
						$display_modal = false;
					}
				}
			}

			//Display modal dialog?
			if ($display_modal === true)
			{
				//Read Settings
				$oa_social_login_settings = get_option ('oa_social_login_settings');

				//Read the social network
				$oa_social_login_identity_provider = get_user_meta($user_id, 'oa_social_login_identity_provider', true);

				//Caption
				$caption = (isset ($oa_social_login_settings['plugin_require_email_text']) ? $oa_social_login_settings['plugin_require_email_text'] : __('<strong>We unfortunately could not retrieve your email address from %s.</strong> Please enter your email address in the form below in order to continue.', 'oa_social_login'));

				//Add CSS
				oa_social_login_add_site_css();

				//Show email request form
				?>
					<div id="oa_social_login_overlay"></div>
					<div id="oa_social_login_modal">
						<div class="oa_social_login_modal_outer">
							<div class="oa_social_login_modal_inner">
			 					<div class="oa_social_login_modal_title">
			 						<?php printf (__ ('You have successfully connected with %s!', 'oa_social_login'), '<strong>'.$oa_social_login_identity_provider.'</strong>'); ?>
			 					</div>
			 					<?php
			 						if (strlen (trim ($caption)) > 0)
			 						{
			 							?>
			 								<div class="oa_social_login_modal_notice"><?php printf ($caption, $oa_social_login_identity_provider); ?></div>
			 							<?php
			 						}
			 					?>
			 					<div class="oa_social_login_modal_body">
				 					<div class="oa_social_login_modal_subtitle">
				 						Your email address:
				 					</div>
									<form method="post" action="">
										<fieldset>
											<div>
												<input type="text" name="oa_social_login_email" class="inputtxt" value="<?php echo ( ! empty ($_POST['oa_social_login_email']) ? oa_social_login_esc_attr($_POST['oa_social_login_email']) : '');  ?>" />
												<input type="hidden" name="oa_social_login_action" value="confirm_email" size="30" />
											</div>
											<div class="oa_social_login_modal_error">
												<?php  echo $message; ?>
											</div>
											<div class="oa_social_login_modal_button">
												<input type="submit" value="Confirm my email address" class="inputbutton" />
											</div>
										</fieldset>
									</form>
								</div>
							</div>
						</div>
					</div>
				<?php
			}
		}
	}
}
add_action('wp_footer', 'oa_social_login_request_email');
add_action('admin_footer', 'oa_social_login_request_email');