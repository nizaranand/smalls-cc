<?php
/*
Plugin Name:  LinkedIn Share Button
Description:  Add a LinkedIn Share button to your blog posts
Version:      1.3
Plugin URI:   http://frankprendergast.ie/resources/linkedin-button-for-wordpress/
Author:       <a href="http://johnblackbourn.com/">John Blackbourn</a> & <a href="http://frankprendergast.ie/">Frank Prendergast</a>

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

*/

class LinkedInButton {

	var $plugin;
	var $settings;
	var $print_js;
	var $defaults = array(
		'placement' => array(
			'is_single' => 1,
			'is_page'   => 1
		),
		'position' => 'top',
		'float'    => 'right'
	);

	function LinkedInButton() {
		add_action( 'linkedin_button', 'linkedin_button', 10, 2 );
		add_action( 'plugins_loaded',  array( $this, 'register_plugin' ) );
		add_action( 'init',            array( $this, 'add_support' ) );
		add_action( 'admin_menu',      array( $this, 'menu' ) );
		add_action( 'add_meta_boxes',  array( $this, 'meta_boxes' ) );
		add_action( 'save_post',       array( $this, 'save' ), 10, 2 );
		add_filter( 'the_content',     array( $this, 'content' ) );
		add_filter( 'wp_footer',       array( $this, 'print_js' ) );
	}

	function print_js() {
		if ( $this->print_js ) {
			wp_enqueue_script(
				'linkedinbutton',
				$this->plugin->url . '/linkedin-share-button.js',
				array(),
				null,
				true
			);
			# http://core.trac.wordpress.org/ticket/11944:
			wp_print_scripts( 'linkedinbutton' );
		}
	}

	function add_support() {
		add_post_type_support( 'post', 'linkedinbutton' );
		add_post_type_support( 'page', 'linkedinbutton' );
	}

	function meta_boxes( $post_type ) {

		if ( post_type_supports( $post_type, 'linkedinbutton' ) ) {
			add_meta_box(
				'linkedinbutton',
				__( 'LinkedIn Share Button', 'linkedinbutton' ),
				array( $this, 'meta_box' ),
				$post_type,
				'side'
			);
		}

	}

	function save( $post_id, $post ) {

		if ( defined( 'DOING_AJAX' ) and DOING_AJAX )
			return;
		if ( !post_type_supports( $post->post_type, 'linkedinbutton' ) )
			return;

		if ( isset( $_POST['linkedinbutton'] ) ) {
			if ( $_POST['linkedinbutton'] )
				update_post_meta( $post_id, 'linkedinbutton', $_POST['linkedinbutton'] );
			else
				delete_post_meta( $post_id, 'linkedinbutton' );
		}

	}

	function options() {
		$buttons = $this->get_buttons();
		if ( !isset( $this->settings['button'] ) )
			$this->settings['button'] = current( $buttons );
		?>	
		<div class="wrap">

		<?php screen_icon(); ?>
		<h2><?php _e( 'LinkedIn Button Settings', 'linkedinbutton' ); ?></h2>

		<form action="options.php" method="post">
		<?php settings_fields( 'linkedinbutton', 'linkedinbutton' ); ?>

		<table class="form-table">

		<tr valign="top">
			<th scope="row"><?php _e( 'Automatic Button Display', 'linkedinbutton' ); ?></th>
			<td>
				<p><label><input value="1" type="checkbox" name="linkedinbutton[placement][is_single]" <?php checked( $this->settings['placement']['is_single'] ); ?> /> <?php _e( 'Display on posts', 'linkedinbutton' ); ?></label></p>
				<p><label><input value="1" type="checkbox" name="linkedinbutton[placement][is_page]" <?php checked( $this->settings['placement']['is_page'] ); ?> /> <?php _e( 'Display on pages', 'linkedinbutton' ); ?></label></p>
				<p><label><input value="1" type="checkbox" name="linkedinbutton[placement][is_home]" <?php checked( $this->settings['placement']['is_home'] ); ?> /> <?php _e( 'Display on posts on the home page', 'linkedinbutton' ); ?></label></p>
				<p><label><input value="1" type="checkbox" name="linkedinbutton[placement][is_archive]" <?php checked( $this->settings['placement']['is_archive'] ); ?> /> <?php _e( 'Display on posts in archive listings', 'linkedinbutton' ); ?></label></p>
				<p><label><input value="1" type="checkbox" name="linkedinbutton[placement][is_search]" <?php checked( $this->settings['placement']['is_search'] ); ?> /> <?php _e( 'Display on posts in search results', 'linkedinbutton' ); ?></label></p>

				<p class="description"><?php printf( __( 'If you choose not to display the button automatically, you will need to add the %s template tag to your template.', 'linkedinbutton' ), "<code>&lt;?php do_action('linkedin_button'); ?&gt;</code>" ); ?></p>
			</td>
		</tr>
		<tr valign="top">
			<th scope="row"><?php _e( 'Button Style', 'linkedinbutton' ); ?></th>
			<td>
				<?php foreach ( $buttons as $button ) { ?>
					<div style="float:left;width:70px;position:relative;height:80px;">
						<label style="text-align:center;position:absolute;bottom:0px;display:block;">
							<img style="margin-bottom:5px" src="<?php echo esc_url( $button ); ?>" alt="" /><br /><input value="<?php echo esc_url( $button ); ?>" type="radio" name="linkedinbutton[button]" <?php checked( $this->settings['button'] === esc_url( $button ) ); ?> />
						</label>
					</div>
				<?php } ?>
				<div style="float:left;width:70px;position:relative;height:80px;">
					<label style="text-align:center;position:absolute;bottom:0px;display:block;">
						<img style="margin-bottom:5px" src="<?php echo $this->plugin->url . '/buttons/example/top.png'; ?>" alt="" /><br /><input value="top" type="radio" name="linkedinbutton[button]" <?php checked( $this->settings['button'] === 'top' ); ?> />
					</label>
				</div>
				<div style="float:left;width:110px;position:relative;height:80px;">
					<label style="text-align:center;position:absolute;bottom:0px;display:block;">
						<img style="margin-bottom:5px" src="<?php echo $this->plugin->url . '/buttons/example/right.png'; ?>" alt="" /><br /><input value="right" type="radio" name="linkedinbutton[button]" <?php checked( $this->settings['button'] === 'right' ); ?> />
					</label>
				</div>
			</td>
		</tr>
		<tr valign="top">
			<th scope="row"><?php _e( 'Button Position', 'linkedinbutton' ); ?></th>
			<td>
				<select name="linkedinbutton[position]">
					<option <?php selected( $this->settings['position'] === 'top' ); ?> value="top"><?php _e( 'Beginning of post', 'linkedinbutton' ); ?>&nbsp;</option>
					<option <?php selected( $this->settings['position'] === 'bottom' ); ?> value="bottom"><?php _e( 'End of post', 'linkedinbutton' ); ?>&nbsp;</option>
				</select>
				<select name="linkedinbutton[float]">
					<option <?php selected( $this->settings['float'] === 'right' ); ?> value="right"><?php _e( 'Floated right', 'linkedinbutton' ); ?>&nbsp;</option>
					<option <?php selected( $this->settings['float'] === 'left' ); ?> value="left"><?php _e( 'Floated left', 'linkedinbutton' ); ?>&nbsp;</option>
					<option <?php selected( $this->settings['float'] === 'none' ); ?> value="none"><?php _e( 'Displayed inline', 'linkedinbutton' ); ?>&nbsp;</option>
				</select>
			</td>
		</tr>

		</table>

		<p class="submit">
			<input type="submit" class="button-primary" value="<?php _e( 'Save Changes' ); ?>" />
		<p>

		</form>

		</div>
		<?php
	}

	function meta_box( $post ) {
		$pto = get_post_type_object( $post->post_type );
		?>
		<p class="howto"><?php printf( __( 'You can override the default LinkedIn Share Button settings for this %s:', 'linkedinbutton' ), $pto->labels->singular_name ); ?></p>
		<p><label><input type="radio" name="linkedinbutton" <?php checked( !get_post_meta( $post->ID, 'linkedinbutton', true ) ); ?> value="0" /> <?php _e( 'Use the default setting', 'linkedinbutton' ); ?></label><br />
		<label><input type="radio" name="linkedinbutton" <?php checked( get_post_meta( $post->ID, 'linkedinbutton', true ), 'yes' ); ?> value="yes" /> <?php _e( 'Show the button', 'linkedinbutton' ); ?></label><br />
		<label><input type="radio" name="linkedinbutton" <?php checked( get_post_meta( $post->ID, 'linkedinbutton', true ), 'no' ); ?> value="no" /> <?php _e( 'Do not show the button', 'linkedinbutton' ); ?></label></p>
		<?php
	}

	function menu() {
		add_options_page(
			__( 'LinkedIn Button Settings', 'linkedinbutton' ),
			__( 'LinkedIn Button', 'linkedinbutton' ),
			'manage_options',
			'linkedinbutton',
			array( $this, 'options' )
		);
	}

	function get_buttons() {

		$buttons = array();

		if ( $d = opendir( $this->plugin->dir . '/buttons/' ) ) {
			while ( ( $button = readdir( $d ) ) !== false ) {
				if ( in_array( substr( $button, -4 ), array( '.png', '.gif' ) ) )
					$buttons[] =  $this->plugin->url . '/buttons/' . $button;
			}
			closedir( $d );
		}

		$themedir = get_stylesheet_directory();
		$themeurl = get_stylesheet_directory_uri();

		if ( file_exists( $themedir . '/images/linkedin-button.png' ) )
			$buttons[] = $themeurl . '/images/linkedin-button.png';
		if ( file_exists( $themedir . '/images/linkedin-button.gif' ) )
			$buttons[] = $themeurl . '/images/linkedin-button.gif';

		return $buttons;

	}

	function content( $content ) {

		global $post;

		if ( !post_type_supports( $post->post_type, 'linkedinbutton' ) )
			return $content;
		if ( !in_array( $post->post_status, array( 'publish', 'draft' ) ) )
			return $content;

		$override = get_post_meta( $post->ID, 'linkedinbutton', true );
		$show = false;

		if ( !empty( $this->settings['placement'] ) ) {
			foreach ( $this->settings['placement'] as $key => $p ) {
				if ( $p and $key() ) {
					$show = true;
					break;
				}
			}
		}

		if ( is_singular() and ( 'no' === $override ) )
			$show = false;
		if ( is_singular() and ( 'yes' === $override ) )
			$show = true;

		if ( !$show )
			return $content;

		if ( !isset( $this->settings['button'] ) )
			$this->settings['button'] = $this->plugin->url . '/buttons/01.png';

		if ( 'right' == $this->settings['float'] )
			$style = 'float:right;margin:0px 0px 10px 10px';
		else if ( 'left' == $this->settings['float'] )
			$style = 'float:left;margin:0px 10px 10px 0px';
		else
			$style = '';

		$button = '<div class="linkedin_share_container" style="' . $style . '">' . $this->button( $post->ID ) . '</div>';

		if ( 'bottom' == $this->settings['position'] )
			$content = $content . $button;
		else
			$content = $button . $content;

		return $content;

	}

	function get_the_excerpt( $post_id ) {

		# This is a clone of WordPress' wp_trim_excerpt() function without
		# the 'the_content' filter.
		# Why aren't we just using WordPress' get_the_excerpt() function?
		# http://lists.automattic.com/pipermail/wp-hackers/2010-June/032424.html

		$post = get_post( $post_id );
		$text = trim( $post->post_excerpt );

		if ( '' == $text ) {

			$text = $post->post_content;
			$text = strip_shortcodes( $text );

			/* ******************************************** */
			/* $text = apply_filters('the_content', $text); */
			$text = trim( wpautop( $text ) );
			/* ******************************************** */

			$text = str_replace(']]>', ']]&gt;', $text);
			$text = strip_tags($text);
			$excerpt_length = apply_filters('excerpt_length', 55);
			$excerpt_more = apply_filters('excerpt_more', ' ' . '[...]');
			$words = explode(' ', $text, $excerpt_length + 1);
			if (count($words) > $excerpt_length) {
				array_pop($words);
				$text = implode(' ', $words);
				$text = $text . $excerpt_more;
			}
		}

		return $text;

	}

	function button( $post_id = 0, $echo = false ) {

		$post    = get_post( $post_id );
		$url     = urlencode( get_permalink( $post->ID ) );
		$title   = urlencode( get_the_title( $post->ID ) );
		$summary = urlencode( $this->get_the_excerpt( $post->ID ) );
		$source  = urlencode( get_bloginfo( 'name' ) );

		$link = 'http://www.linkedin.com/shareArticle?mini=true&amp;url=' . $url . '&amp;title=' . $title . '&amp;summary=' . $summary . '&amp;source=' . $source;

		if ( 'right' === $this->settings['button'] ) {
			$button = '<script type="text/javascript" src="http://platform.linkedin.com/in.js"></script><script type="in/share" data-url="' . esc_attr( get_permalink( $post->ID ) ) . '" data-counter="right"></script>';
		} else if ( 'top'  === $this->settings['button'] ) {
			$button = '<script type="text/javascript" src="http://platform.linkedin.com/in.js"></script><script type="in/share" data-url="' . esc_attr( get_permalink( $post->ID ) ) . '" data-counter="top"></script>';
		} else {
			$button = '<a href="' . $link . '" onclick="return popupLinkedInShare(this.href,\'console\',400,570)" class="linkedin_share_button"><img src="' . $this->settings['button'] . '" alt="" /></a>';
			$this->print_js = true;
		}

		if ( $echo )
			echo $button;

		return $button;

	}

	/*
		Generic plugin functionality by John Blackbourn
		20101202
	*/

	function register_plugin() {
		$this->plugin = (object) array(
			'url' => WP_PLUGIN_URL . '/' . basename( dirname( __FILE__ ) ),
			'dir' => WP_PLUGIN_DIR . '/' . basename( dirname( __FILE__ ) )
		);
		$this->settings = get_option( 'linkedinbutton' );
		if ( !$this->settings ) {
			add_option( 'linkedinbutton', $this->defaults, true, true );
			$this->settings = $this->defaults;
		}
		load_plugin_textdomain(
			'linkedinbutton', false, basename( dirname( __FILE__ ) )
		);
		add_action( 'admin_init', array( $this, 'register_setting' ) );
	}

	function register_setting() {
		if ( $callback = method_exists( $this, 'sanitize' ) )
			$callback = array( $this, 'sanitize' );
		register_setting(
			'linkedinbutton', 'linkedinbutton', $callback
		);
	}

}

function linkedin_button( $post_id = 0, $echo = true ) {
	return $GLOBALS['linkedinbutton']->button( $post_id, $echo );
}

$linkedinbutton = new LinkedInButton();

?>