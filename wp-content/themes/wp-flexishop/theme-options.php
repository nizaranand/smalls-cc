<?php

add_action( 'admin_init', 'theme_options_init' );
add_action( 'admin_menu', 'theme_options_add_page' );

/**
 * Init plugin options to white list our options
 */
function theme_options_init(){
	register_setting( 'site_options', 'site_basic_options', 'theme_options_validate' );
	add_settings_section('file_uploads', 'File Uploads', 'file_uploads_section', 'theme_options');
    add_settings_field('site_logo', 'File:', 'site_logo_upload', 'theme_options', 'file_uploads');
    add_settings_field('leader_image', 'File:', 'leader_image_upload', 'theme_options', 'file_uploads');
}

function theme_options_add_page() {
	$page = add_theme_page( __( 'Theme Options' ), __( 'WP FlexiShop' ), 'edit_theme_options', 'theme_options', 'theme_options_do_page' );
	add_action('admin_print_styles-' . $page,  'FlexiStoreAdmin');
}

function FlexiStoreAdmin()
    {
        /*
         * It will be called only on your plugin admin page, enqueue our script here
         */
        wp_enqueue_script('DatePickerScript');
        wp_enqueue_script('ColorPickerScript');
        wp_enqueue_script('AdminScript');
        wp_enqueue_style('FlexiStoreStyle');
        wp_enqueue_style('DatePicker');
        wp_enqueue_style('ColorPicker');
    }

/**
 * Create arrays for our select and radio options
 */
 
 $defaults = array(
 	'themelayout' => 'simple',
 	'aboutus' => 'This can be found in the theme options page under appearance, this is also a widget area',
 	'copyright' => 'Copyright 2010 FlexiShop',
 	'sitedesc' => 'This is a short paragraph which should be used to give an overview of your products. It can be found under in the theme options page',
 	'twitter' => 'extradollop',
 	'saledate' => '',
 	'sliderpromotions' => '1',
 	'sliderproducts' => '1',
 	'sliderposts' => '1',
 	'slidertrans' => 'fade',
 	'sliderbackground' => 'default',
 	'sliderbackgroundpos' => 'center',
 	'sliderbackgroundrepeat' => 'repeat',
 	'homepagecategories' => '0',
 	'homepagelatestproducts' => '1',
 	'homepagebestsellers' => '0',
 	'footertop' => '1',
 	'footerbottom' => '',
 	'sitelogo' => '',
 	'leaderimage' => '',
 	'bodysetting' => 'default',
 	'backgroundcol' => '',
 	'headercol' => '',
 	'boxedcol' => '',
 	'footercol' => '',
 	'copyrightcol' => '',
 	'headingcol' => '',
 	'paracolor' => '',
 	'linkcol' => '',
 	'footerheadercol' => '',
 	'footerlinkcol' => '',
 	'footerfontcol' => '',
 	'headerlinkcol' => '',
 	'copyrightfontcol' => '',
 	'headerfont' => 'MuseoSlab500',
 	'bodyfont' => 'serif'
 );
 
$select_options = array(
	'0' => array(
		'value' =>	'0',
		'label' => __( 'Zero' )
	),
	'1' => array(
		'value' =>	'1',
		'label' => __( 'One' )
	),
	'2' => array(
		'value' => '2',
		'label' => __( 'Two' )
	),
	'3' => array(
		'value' => '3',
		'label' => __( 'Three' )
	),
	'4' => array(
		'value' => '4',
		'label' => __( 'Four' )
	),
	'5' => array(
		'value' => '3',
		'label' => __( 'Five' )
	)
);

$theme_layout = array(
	'0' => array(
		'value' =>	'simple',
		'label' => __( 'Simple' )
	),
	'1' => array(
		'value' =>	'full',
		'label' => __( 'Full' )
	),
	'2' => array(
		'value' => 'boxed',
		'label' => __( 'Boxed' )
	)
);

$slider_transition = array(
	'0' => array(
		'value' =>	'fade',
		'label' => __( 'Fade' )
	),
	'1' => array(
		'value' =>	'horizontal',
		'label' => __( 'Horizontal Slide' )
	)
);

$fonts = array(
	'0' => array(
		'value' =>	'Cantarell',
		'label' => __( 'Cantarell' )
	),
	'1' => array(
		'value' =>	'Cardo',
		'label' => __( 'Cardo' )
	),
	'2' => array(
		'value' => 'Crimson+Text',
		'label' => __( 'Crimson Text' )
	),
	'3' => array(
		'value' => 'Cuprum',
		'label' => __( 'Cuprum' )
	),
	'4' => array(
		'value' => 'Droid+Sans',
		'label' => __( 'Droid Sans' )
	),
	'5' => array(
		'value' => 'Droid+Sans+Mono',
		'label' => __( 'Droid Sans Mono' )
	),
	'6' => array(
		'value' => 'Droid+Serif',
		'label' => __( 'Droid Serif' )
	),
	'7' => array(
		'value' => 'IM+Fell+DW+Pica',
		'label' => __( 'IM Fell DW Pica' )
	),
	'8' => array(
		'value' => 'Inconsolata',
		'label' => __( 'Inconsolata' )
	),
	'9' => array(
		'value' => 'Josefin+Sans+Std+Light',
		'label' => __( 'Josefin Sans Std Light' )
	),
	'10' => array(
		'value' => 'Lobster',
		'label' => __( 'Lobster' )
	),
	'11' => array(
		'value' => 'Molengo',
		'label' => __( 'Molengo' )
	),
	'12' => array(
		'value' => 'Neucha',
		'label' => __( 'Neucha' )
	),
	'13' => array(
		'value' => 'Nobile',
		'label' => __( 'Nobile' )
	),
	'14' => array(
		'value' => 'OFL+Sorts+Mill+Goudy+TT',
		'label' => __( 'OFL Sorts Mill Goudy TT' )
	),
	'15' => array(
		'value' => 'Old+Standard+TT',
		'label' => __( 'Old Standard TT' )
	),
	'16' => array(
		'value' => 'PT+Sans+Caption',
		'label' => __( 'PT Sans Caption' )
	),
	'17' => array(
		'value' => 'Philosopher',
		'label' => __( 'Philosopher' )
	),
	'18' => array(
		'value' => 'Reenie+Beanie',
		'label' => __( 'Reenie Beanie' )
	),
	'19' => array(
		'value' => 'Tangerine',
		'label' => __( 'Tangerine' )
	),
	'20' => array(
		'value' => 'Vollkorn',
		'label' => __( 'Vollkorn' )
	),
	'21' => array(
		'value' => 'Yanone+Kaffeesatz',
		'label' => __( 'Yanone Kaffeesatz' )
	),
	'22' => array(
		'value' => 'League+Gothic',
		'label' => __( 'League Gothic' )
	),
	'23' => array(
		'value' => 'MuseoSans500',
		'label' => __( 'Museo Sans' )
	),
	'24' => array(
		'value' => 'MuseoSlab500',
		'label' => __( 'Museo Slab' )
	)
	
);

$body_font = array(
	'0' => array(
		'value' =>	'serif',
		'label' => __( 'Serif' )
	),
	'1' => array(
		'value' =>	'sans-serif',
		'label' => __( 'Sans-Serif' )
	)
);

$slider_background_position = array(
	'0' => array(
		'value' =>	'left',
		'label' => __( 'Left' )
	),
	'1' => array(
		'value' =>	'center',
		'label' => __( 'Center' )
	),
	'2' => array(
		'value' =>	'right',
		'label' => __( 'Right' )
	)
);

$slider_background_repeat = array(
	'0' => array(
		'value' =>	'no-repeat',
		'label' => __( 'No Repeat' )
	),
	'1' => array(
		'value' =>	'repeat',
		'label' => __( 'Tile' )
	),
	'2' => array(
		'value' =>	'repeat-x',
		'label' => __( 'Tile Horizontally' )
	),
	'3' => array(
		'value' =>	'repeat-y',
		'label' => __( 'Tile Vertically' )
	)
);

$body_background = array(
	'default' => array(
		'value' => 'default',
		'label' => __( 'Default' )
	),
	'image' => array(
		'value' => 'image',
		'label' => __( 'Use Image' )
	),
	'color' => array(
		'value' => 'color',
		'label' => __( 'Use Color' )
	)
);

$slider_background = array(
	'default' => array(
		'value' => 'default',
		'label' => __( 'Default' )
	),
	'image' => array(
		'value' => 'image',
		'label' => __( 'Use Image' )
	),
	'color' => array(
		'value' => 'color',
		'label' => __( 'Use Color' )
	)
);

$products_sidebar = array(
	'yes' => array(
		'value' => 'yes',
		'label' => __( 'Enable' )
	),
	'no' => array(
		'value' => 'no',
		'label' => __( 'Disable' )
	)
);

$radio_options = array(
	'yes' => array(
		'value' => 'yes',
		'label' => __( 'Yes' )
	),
	'no' => array(
		'value' => 'no',
		'label' => __( 'No' )
	),
	'maybe' => array(
		'value' => 'maybe',
		'label' => __( 'Maybe' )
	)
);

/**
 * Create the options page
 */
function theme_options_do_page() {
	global $select_options, $theme_layout, $radio_options, $fonts, $slider_transition, $body_font, $body_background, $slider_background, $slider_background_repeat, $slider_background_position, $products_sidebar;
	$options = get_option( 'site_basic_options' );
	if ( ! isset( $_REQUEST['updated'] ) )
		$_REQUEST['updated'] = false;
	?>
	<div class="theme-options wrap">
		<?php if ( false !== $_REQUEST['updated'] ) : ?>
		<div class="updated fade"><p><strong><?php _e( 'Options saved' ); ?></strong></p></div>
		<?php endif; ?>
		<?php screen_icon(); echo "<h2 class='theme-options-heading'>" . get_current_theme() . __( ' Theme Options' ) . "</h2>"; ?>
		<h4 class="current-layout">
		<?php if($options['themelayout'] == "full")
			echo "Current Layout: Full Header and Footer";
		elseif($options['themelayout'] == "simple")
			echo "Current Layout: Simple";
		elseif($options['themelayout'] == "boxed")
			echo "Current Layout: Boxed"; ?>
		</h4>

		<form id="post-body-content" enctype="multipart/form-data" method="post" action="options.php">
			<?php settings_fields( 'site_options' ); ?>

			<fieldset>
				<h3><span class="expand-icon">+</span> <?php _e('General Options'); ?></h3><div class="fieldset-content">
				<div class="input select important">
					<label>Overall Theme Layout</label>
					<select id="theme-layout" name="site_basic_options[themelayout]">
						<?php
							$selected = $options['themelayout'];
							$p = '';
							$r = '';

							foreach ( $theme_layout as $option ) {
								$label = $option['label'];
								if ( $selected == $option['value'] ) // Make default first in list
									$p = "\n\t<option style=\"padding-right: 10px;\" selected='selected' value='" . esc_attr( $option['value'] ) . "'>$label</option>";
								else
									$r .= "\n\t<option style=\"padding-right: 10px;\" value='" . esc_attr( $option['value'] ) . "'>$label</option>";
							}
							echo $p . $r;
						?>
					</select>
					<small>Choose your overall theme layout style. Simple is a clean, elegant layout which is perfect for putting a focus on your products. Boxed allows you to change the overall look through backgrounds and colors, without compromising usability and readability. Full layout puts a background colour behind the header and footer areas.</small>
				</div>
				<div class="input text">
					<label class="description" for="site_basic_options[aboutus]"><?php _e( 'About Us' ); ?></label>
					<input id="site_basic_options[aboutus]" class="regular-text" type="text" name="site_basic_options[aboutus]" value="<?php esc_attr_e( $options['aboutus'] ); ?>" />
				</div>
				<div class="input text">
					<label class="description" for="site_basic_options[sitedesc]"><?php _e( 'Brief Company/Product Overview' ); ?></label>
					<input id="site_basic_options[sitedesc]" class="regular-text" type="text" name="site_basic_options[sitedesc]" value="<?php esc_attr_e( $options['sitedesc'] ); ?>" />
				</div>
				<div class="input text">
					<label class="description" for="site_basic_options[copyright]"><?php _e( 'Copyright Text' ); ?></label>
					<input id="site_basic_options[copyright]" class="regular-text" type="text" name="site_basic_options[copyright]" value="<?php esc_attr_e( $options['copyright'] ); ?>" />
				</div>
				<div class="input file">
					<label><?php _e( 'Site Logo Image' ); ?></label>	
					<input type="file" name="sitelogo" size="40" />
					<div class="image-preview">
						<span class="current">Current Image</span>
						<?php if ($file = $options['sitelogo']) {
					        // var_dump($file);
					        echo "<img src='{$file['url']}' />";
					    } ?>
				    </div>
				</div>
				<div class="input text">
					<label class="description" for="site_basic_options[twitter]"><?php _e( 'Twitter Username' ); ?></label>
					<input id="site_basic_options[twitter]" class="regular-text" type="text" name="site_basic_options[twitter]" value="<?php esc_attr_e( $options['twitter'] ); ?>" />
				</div>
				<div class="input text">
					<label class="description" for="site_basic_options[saledate]"><?php _e( 'Next Sale Date' ); ?></label>
					<input id="site_basic_options[saledate]" class="date-input" type="text" name="site_basic_options[saledate]" value="<?php esc_attr_e( $options['saledate'] ); ?>" />
				</div>
			</div></fieldset>
			<fieldset>
					<h3><span class="expand-icon">+</span> <?php _e('Homepage Feature Slider'); ?></h3><div class="fieldset-content">
					<div class="input checkboxes">
						<label class="group-label">Homepage Slider Content</label>
						<label class="inline-label" for="site_basic_options[sliderpromotions]">
						<input id="site_basic_options[sliderpromotions]" name="site_basic_options[sliderpromotions]" type="checkbox" value="1" <?php checked( '1', $options['sliderpromotions'] ); ?> />
						<?php _e( 'Promotions Slides' ); ?></label>
						<label class="inline-label" for="site_basic_options[sliderproducts]">
						<input id="site_basic_options[sliderproducts]" name="site_basic_options[sliderproducts]" type="checkbox" value="1" <?php checked( '1', $options['sliderproducts'] ); ?> />
						<?php _e( 'Featured Products' ); ?></label>
						<label class="inline-label" for="site_basic_options[sliderposts]">
						<input id="site_basic_options[sliderposts]" name="site_basic_options[sliderposts]" type="checkbox" value="1" <?php checked( '1', $options['sliderposts'] ); ?> />
						<?php _e( 'Featured Posts' ); ?></label>
					</div>
					<div class="input select">
						<label class="description" for="site_basic_options[slidertrans]"><?php _e( 'Slider Transition Effect' ); ?></label>
						<select name="site_basic_options[slidertrans]">
							<?php
								$selected = $options['slidertrans'];
								$p = '';
								$r = '';

								foreach ( $slider_transition as $option ) {
									$label = $option['label'];
									if ( $selected == $option['value'] ) // Make default first in list
										$p = "\n\t<option style=\"padding-right: 10px;\" selected='selected' value='" . esc_attr( $option['value'] ) . "'>$label</option>";
									else
										$r .= "\n\t<option style=\"padding-right: 10px;\" value='" . esc_attr( $option['value'] ) . "'>$label</option>";
								}
								echo $p . $r;
							?>
						</select>
					</div>
					<div id="slider-background" class="input radio full-only">
						<label class="group-label"><?php _e( 'Front Page Slider Background Setting' ); ?></label>
						<?php
							if ( ! isset( $checked ) )
								$checked = '';
							foreach ( $slider_background as $option ) {
								$setting = $options['sliderbackground'];

								if ( '' != $setting ) {
									if ( $options['sliderbackground'] == $option['value'] ) {
										$checked = "checked=\"checked\"";
									} else {
										$checked = '';
									}
								}
								?>
								<label class="description"><input type="radio" name="site_basic_options[sliderbackground]" value="<?php esc_attr_e( $option['value'] ); ?>" <?php echo $checked; ?> /> <?php echo $option['label']; ?></label>
								<?php
							}
						?>
					</div>
					<div class="input file slider-background-hide full-only">
						<label><?php _e( 'Frontpage Slider Background Image' ); ?></label>	
						<input type="file" name="leaderimage" size="40" />
						<div class="image-preview">
							<span class="current">Current Image</span>
							<?php if ($file = $options['leaderimage']) {
						        // var_dump($file);
						        echo "<img src='{$file['url']}' />";
						    } ?>
					    </div>
					</div>
					<div class="input select slider-background-hide full-only">
						<label class="description" for="site_basic_options[sliderbackpos]"><?php _e( 'Slider Background Position' ); ?></label>
						<select name="site_basic_options[sliderbackpos]">
							<?php
								$selected = $options['sliderbackpos'];
								$p = '';
								$r = '';

								foreach ( $slider_background_position as $option ) {
									$label = $option['label'];
									if ( $selected == $option['value'] ) // Make default first in list
										$p = "\n\t<option style=\"padding-right: 10px;\" selected='selected' value='" . esc_attr( $option['value'] ) . "'>$label</option>";
									else
										$r .= "\n\t<option style=\"padding-right: 10px;\" value='" . esc_attr( $option['value'] ) . "'>$label</option>";
								}
								echo $p . $r;
							?>
						</select>
					</div>
					<div class="input select slider-background-hide full-only">
						<label class="description" for="site_basic_options[sliderbackrepeat]"><?php _e( 'Slider Background Repeat' ); ?></label>
						<select name="site_basic_options[sliderbackrepeat]">
							<?php
								$selected = $options['sliderbackrepeat'];
								$p = '';
								$r = '';

								foreach ( $slider_background_repeat as $option ) {
									$label = $option['label'];
									if ( $selected == $option['value'] ) // Make default first in list
										$p = "\n\t<option style=\"padding-right: 10px;\" selected='selected' value='" . esc_attr( $option['value'] ) . "'>$label</option>";
									else
										$r .= "\n\t<option style=\"padding-right: 10px;\" value='" . esc_attr( $option['value'] ) . "'>$label</option>";
								}
								echo $p . $r;
							?>
						</select>
					</div>
					</div></fieldset>
					<fieldset>
						<h3><span class="expand-icon">+</span> <?php _e('Homepage'); ?></h3><div class="fieldset-content">
						<div class="input checkboxes">
							<label class="group-label">Homepage Content</label>
							<label class="inline-label" for="site_basic_options[homepagecategories]">
							<input id="site_basic_options[homepagecategories]" name="site_basic_options[homepagecategories]" type="checkbox" value="1" <?php checked( '1', $options['homepagecategories'] ); ?> />
							<?php _e( 'Product Categories' ); ?></label>
							<label class="inline-label" for="site_basic_options[homepagebestsellers]">
							<input id="site_basic_options[homepagebestsellers]" name="site_basic_options[homepagebestsellers]" type="checkbox" value="1" <?php checked( '1', $options['homepagebestsellers'] ); ?> />
							<?php _e( 'Best Sellers' ); ?></label>
							<label class="inline-label" for="site_basic_options[homepagelatestproducts]">
							<input id="site_basic_options[homepagelatestproducts]" name="site_basic_options[homepagelatestproducts]" type="checkbox" value="1" <?php checked( '1', $options['homepagelatestproducts'] ); ?> />
							<?php _e( 'Latest Products' ); ?></label>
						</div>
					</div></fieldset>
					<fieldset>
						<h3><span class="expand-icon">+</span> <?php _e('Products'); ?></h3><div class="fieldset-content">
						<div class="input radio">
							<label class="group-label">Products Page Sidebar</label>
							<?php
							if ( ! isset( $checked ) )
								$checked = '';
							foreach ( $products_sidebar as $option ) {
								$setting = $options['productssidebar'];
								if ( '' != $setting ) {
									if ( $options['productssidebar'] == $option['value'] ) {
										$checked = "checked=\"checked\"";
									} else {
										$checked = '';
									}
								}
								?>
								<label class="description"><input type="radio" name="site_basic_options[productssidebar]" value="<?php esc_attr_e( $option['value'] ); ?>" <?php echo $checked; ?> /> <?php echo $option['label']; ?></label>
								<?php
							}
							?>
						</div>
					</div></fieldset>
					<fieldset>
						<h3><span class="expand-icon">+</span> <?php _e('Footer'); ?></h3><div class="fieldset-content">
						<div class="input checkboxes">
							<label class="group-label"><?php _e( 'Footer Content' ); ?></label>
							<label class="inline-label" for="site_basic_options[footertop]">
							<input id="site_basic_options[footertop]" name="site_basic_options[footertop]" type="checkbox" value="1" <?php checked( '1', $options['footertop'] ); ?> />
							<?php _e( 'Footer Top' ); ?></label>
							<label class="inline-label" for="site_basic_options[footerbottom]">
							<input id="site_basic_options[footerbottom]" name="site_basic_options[footerbottom]" type="checkbox" value="1" <?php checked( '1', $options['footerbottom'] ); ?> />
							<?php _e( 'Footer Bottom' ); ?></label>
						</div>
					</div></fieldset>
					<fieldset>
						<h3><span class="expand-icon">+</span> <?php _e('Branding and Background Colours'); ?></h3><div class="fieldset-content">
						<div class="input radio">
							<label class="group-label"><?php _e( 'Body Background' ); ?></label>
							<?php
								if ( ! isset( $checked ) )
									$checked = '';
								foreach ( $body_background as $option ) {
									$setting = $options['bodysetting'];
	
									if ( '' != $setting ) {
										if ( $options['bodysetting'] == $option['value'] ) {
											$checked = "checked=\"checked\"";
										} else {
											$checked = '';
										}
									}
									?>
									<label class="description"><input type="radio" name="site_basic_options[bodysetting]" value="<?php esc_attr_e( $option['value'] ); ?>" <?php echo $checked; ?> /> <?php echo $option['label']; ?></label>
									<?php
								}
							?>
						</div>
						<div class="input color">
							<label class="description" for="site_basic_options[backgroundcol]"><?php _e( 'Background Color' ); ?></label>
							<input id="site_basic_options[backgroundcol]" class="color" type="text" name="site_basic_options[backgroundcol]" value="<?php esc_attr_e( $options['backgroundcol'] ); ?>" />
							<div class="colorSelector"><div style="background-color: <?php esc_attr_e( $options['backgroundcol'] ); ?>"></div></div>
							
						</div>
						<div class="input color boxed-only">
							<label class="description" for="site_basic_options[boxedcolor]"><?php _e( 'Boxed Background Color' ); ?></label>
							<input id="site_basic_options[boxedcolor]" class="color" type="text" name="site_basic_options[boxedcolor]" value="<?php esc_attr_e( $options['boxedcolor'] ); ?>" />
							<div class="colorSelector"><div style="background-color: <?php esc_attr_e( $options['boxedcolor'] ); ?>"></div></div>
							
						</div>
						<div class="input color full-only">
							<label class="description" for="site_basic_options[footercol]"><?php _e( 'Footer Background Color' ); ?></label>
							<input id="site_basic_options[footercol]" class="color" type="text" name="site_basic_options[footercol]" value="<?php esc_attr_e( $options['footercol'] ); ?>" />
							<div class="colorSelector"><div style="background-color: <?php esc_attr_e( $options['footercol'] ); ?>"></div></div>
						</div>
						<div class="input color full-only">
							<label class="description" for="site_basic_options[headercol]"><?php _e( 'Header Background Color' ); ?></label>
							<input id="site_basic_options[headercol]" class="color" type="text" name="site_basic_options[headercol]" value="<?php esc_attr_e( $options['headercol'] ); ?>" />
							<div class="colorSelector"><div style="background-color: <?php esc_attr_e( $options['headercol'] ); ?>"></div></div>
						</div>
						<div class="input color full-only boxed-only">
							<label class="description" for="site_basic_options[copyrightcol]"><?php _e( 'Copyright Background Color' ); ?></label>
							<input id="site_basic_options[copyrightcol]" class="color" type="text" name="site_basic_options[copyrightcol]" value="<?php esc_attr_e( $options['copyrightcol'] ); ?>" />
							<div class="colorSelector"><div style="background-color: <?php esc_attr_e( $color ); ?>"></div></div>
							
						</div>
					</div></fieldset>
					<fieldset>
						<h3><span class="expand-icon">+</span> <?php _e('Font Colours'); ?></h3><div class="fieldset-content">
						<div class="input-group">
							<h4>Body Section</h4>
							<div class="input color">
								<label class="description" for="site_basic_options[headingcol]"><?php _e( 'Body Heading Color' ); ?></label>
								<input id="site_basic_options[headingcol]" class="color" type="text" name="site_basic_options[headingcol]" value="<?php esc_attr_e( $options['headingcol'] ); ?>" />
								<div class="colorSelector"><div style="background-color: <?php esc_attr_e( $options['headingcol'] ); ?>"></div></div>
							</div>
							<div class="input color">
								<label class="description" for="site_basic_options[paracolor]"><?php _e( 'Body Paragraph Color' ); ?></label>
								<input id="site_basic_options[paracolor]" class="color" type="text" name="site_basic_options[paracolor]" value="<?php esc_attr_e( $options['paracolor'] ); ?>" />
								<div class="colorSelector"><div style="background-color: <?php esc_attr_e( $options['paracolor'] ); ?>"></div></div>
							</div>
							<div class="input color">
								<label class="description" for="site_basic_options[linkcol]"><?php _e( 'Default Link Color' ); ?></label>
								<input id="site_basic_options[linkcol]" class="color" type="text" name="site_basic_options[linkcol]" value="<?php esc_attr_e( $options['linkcol'] ); ?>" />
								<div class="colorSelector"><div style="background-color: <?php esc_attr_e( $options['linkcol'] ); ?>"></div></div>
							</div>
						</div>
						<div class="input-group">
							<h4>Footer Section</h4>
							<div class="input color">
								<label class="description" for="site_basic_options[footerfontcol]"><?php _e( 'Footer Font Color' ); ?></label>
								<input id="site_basic_options[footerfontcol]" class="color" type="text" name="site_basic_options[footerfontcol]" value="<?php esc_attr_e( $options['footerfontcol'] ); ?>" />
								<div class="colorSelector"><div style="background-color: <?php esc_attr_e( $options['footerfontcol'] ); ?>"></div></div>
							</div>
							<div class="input color">
								<label class="description" for="site_basic_options[footerheadercol]"><?php _e( 'Footer Heading Color' ); ?></label>
								<input id="site_basic_options[footerheadercol]" class="color" type="text" name="site_basic_options[footerheadercol]" value="<?php esc_attr_e( $options['footerheadercol'] ); ?>" />
								<div class="colorSelector"><div style="background-color: <?php esc_attr_e( $options['footerheadercol'] ); ?>"></div></div>
							</div>
							<div class="input color">
								<label class="description" for="site_basic_options[footerlinkcol]"><?php _e( 'Footer Link Color' ); ?></label>
								<input id="site_basic_options[footerlinkcol]" class="color" type="text" name="site_basic_options[footerlinkcol]" value="<?php esc_attr_e( $options['footerlinkcol'] ); ?>" />
								<div class="colorSelector"><div style="background-color: <?php esc_attr_e( $options['footerlinkcol'] ); ?>"></div></div>
							</div>
						</div>
						<div class="input-group">
							<h4>Header Section</h4>
							<div class="input color">
								<label class="description" for="site_basic_options[headerlinkcol]"><?php _e( 'Header Link Color' ); ?></label>
								<input id="site_basic_options[headerlinkcol]" class="color" type="text" name="site_basic_options[headerlinkcol]" value="<?php esc_attr_e( $options['headerlinkcol'] ); ?>" />
								<div class="colorSelector"><div style="background-color: <?php esc_attr_e( $options['headerlinkcol'] ); ?>"></div></div>
							</div>
						</div>
						<div class="input-group">
							<h4>Copyright Section</h4>
							<?php if($options['copyrightcol'])
								$color = $options['copyrightcol'];
							else
								$color = "#fff";
							?>
							
							<?php if($options['copyrightfontcol'])
								$color = $options['copyrightfontcol'];
							else
								$color = "#fff";
							?>
							<div class="input color">
								<label class="description" for="site_basic_options[copyrightfontcol]"><?php _e( 'Copyright Font Color' ); ?></label>
								<input id="site_basic_options[copyrightfontcol]" class="color" type="text" name="site_basic_options[copyrightfontcol]" value="<?php esc_attr_e( $options['copyrightfontcol'] ); ?>" />
								<div class="colorSelector"><div style="background-color: <?php esc_attr_e( $color ); ?>"></div></div>
							</div>
						</div>
					</div></fieldset>
					<fieldset>
					<h3><span class="expand-icon">+</span> <?php _e('Font Family'); ?></h3><div class="fieldset-content">
					<div class="input select">
						<label class="description" for="site_basic_options[headerfont]"><?php _e( 'Header Font Chooser' ); ?></label>
						<select name="site_basic_options[headerfont]">
							<?php
								$selected = $options['headerfont'];
								$p = '';
								$r = '';
								
								foreach ($fonts as $option ) {
									$label = $option['label'];
									if ( $selected == $option['value'] ) // Make default first in list
										$p = "\n\t<option style=\"padding-right: 10px;\" selected='selected' value='" . esc_attr( $option['value'] ) . "'>$label</option>";
									else
										$r .= "\n\t<option style=\"padding-right: 10px;\" value='" . esc_attr( $option['value'] ) . "'>$label</option>";
								}
								echo $p . $r;
							?>
						</select>
					</div>
					<div class="input select">
						<label class="description" for="site_basic_options[bodyfont]"><?php _e( 'Body Font Chooser' ); ?></label>
						<select name="site_basic_options[bodyfont]">
							<?php
								$selected = $options['bodyfont'];
								$p = '';
								$r = '';

								foreach ( $body_font as $option ) {
									$label = $option['label'];
									if ( $selected == $option['value'] ) // Make default first in list
										$p = "\n\t<option style=\"padding-right: 10px;\" selected='selected' value='" . esc_attr( $option['value'] ) . "'>$label</option>";
									else
										$r .= "\n\t<option style=\"padding-right: 10px;\" value='" . esc_attr( $option['value'] ) . "'>$label</option>";
								}
								echo $p . $r;
							?>
						</select>
					</div>
					</div></fieldset>

			<div class="input submit">
				<input name="submit" type="submit" class="button-primary" value="<?php _e( 'Save Options' ); ?>" />
			</div>
			<div class="input reset">
				<input name="submit" type="submit" class="button" value="<?php _e( 'Reset To Defaults' ); ?>" />
			</div>
		</form>
	</div>
	<?php
}

function file_uploads_section() {
    $options = get_option('site_basic_options');
    echo '<p>Upload your file here:</p>';
    if ($file = $options['leaderimage']) {
        // var_dump($file);
        echo "<img src='{$file['url']}' />";
    }
}

function site_logo_upload() {
    echo '<input type="file" name="sitelogo" size="40" />';
}


function leader_image_upload() {
    echo '<input type="file" name="leaderimage" size="40" />';
}

/**
 * Sanitize and validate input. Accepts an array, return a sanitized array.
 */
function theme_options_validate( $input ) {
	global $select_options, $radio_options, $theme_layout, $defaults;
	$options = get_option('site_basic_options');
	// Our checkbox value is either 0 or 1
	if ( ! isset( $input['option1'] ) )
		$input['option1'] = null;
	$input['option1'] = ( $input['option1'] == 1 ? 1 : 0 );

	// Say our text option must be safe text with no HTML tags
	$input['sometext'] = wp_filter_nohtml_kses( $input['sometext'] );

	// Our select option must actually be in our array of select options
	if ( ! array_key_exists( $input['selectinput'], $select_options ) )
		$input['selectinput'] = null;

	// Our radio option must actually be in our array of radio options
	if ( ! isset( $input['radioinput'] ) )
		$input['radioinput'] = null;
	if ( ! array_key_exists( $input['radioinput'], $radio_options ) )
		$input['radioinput'] = null;

	// Say our textarea option must be safe text with the allowed tags for posts
	$input['sometextarea'] = wp_filter_post_kses( $input['sometextarea'] );
	
	// Image Validation and Cleaner
	if (!$_FILES['sitelogo']['error']) { 
        $overrides = array('test_form' => false); 
        $file = wp_handle_upload($_FILES['sitelogo'], $overrides);
        $input['sitelogo'] = $file;
    }
    else {
        $input['sitelogo'] = $options['sitelogo'];
    }
    
    if (!$_FILES['leaderimage']['error']) { 
        $overrides = array('test_form' => false); 
        $file = wp_handle_upload($_FILES['leaderimage'], $overrides);
        $input['leaderimage'] = $file;
    }
    else {
        $input['leaderimage'] = $options['leaderimage'];
    }
    
    if ( isset( $_POST["submit"] ) && ( $_POST["submit"] == 'Reset To Defaults' ) ) {
    	return $defaults;
    }
	
	return $input;
}

// adapted from http://planetozh.com/blog/2009/05/handling-plugins-options-in-wordpress-28-with-register_setting/