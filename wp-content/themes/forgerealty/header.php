<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>  
<head>
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<meta name="rttheme_template_dir" content="<?php echo THEMEURI; ?>" />
<meta name="rttheme_slider_timeout" content="<?php echo get_option('rttheme_slider_timeout');?>" />
<meta name="rttheme_slider_effect" content="<?php echo get_option('rttheme_slider_effect');?>" />
<meta name="rttheme_slider_buttons" content="<?php echo get_option('rttheme_slider_buttons');?>" />

<?php if (get_option( 'rttheme_favicon_url')):?><link rel="icon" type="image/png" href="<?php echo get_option( 'rttheme_favicon_url');?>"><?php endif;?>

<title><?php if (is_home() || is_front_page() ): bloginfo('name'); else: wp_title('');endif; ?></title>
<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
<link rel="alternate" type="application/atom+xml" title="<?php bloginfo('name'); ?> Atom Feed" href="<?php bloginfo('atom_url'); ?>" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />


<?php if ( is_singular() && get_option( 'thread_comments' ) ) wp_enqueue_script( 'comment-reply' ); //thread comments?>		

<?php wp_head(); ?>  

<?php

#
#   Top bar OFF
#

if(!get_option(THEMESLUG.'_top_bar')){
	echo '<style type="text/css">#wrapper{ background-position:center 0px!important; }</style>';
}

#
#   Custom Body Font Color
#
$rttheme_body_font_color=get_option('rttheme_body_font_color');
if($rttheme_body_font_color){
	echo '<style type="text/css">	body {color:'.$rttheme_body_font_color.';}</style>';
}

#
#   Custom Body Font Size
#
$rttheme_body_font_size=get_option('rttheme_body_font_size');
if($rttheme_body_font_size){
	echo '<style type="text/css">	body {font-size:'.$rttheme_body_font_size.'px;line-height:160%;}</style>';
}

#
#   Custom Body Font Family
#
$rttheme_body_font_family=get_option('rttheme_body_font_family');
if($rttheme_body_font_family && !get_option(THEMESLUG.'_google_fonts')){
	echo '<style type="text/css">	body {font-family:'.$rttheme_body_font_family.';}</style>';
}

#
#   Custom Menu Font Size
#
$rttheme_menu_font_size=get_option('rttheme_menu_font_size');
if($rttheme_menu_font_size){
	echo '<style type="text/css">	#navigation > ul > li > a {font-size:'.$rttheme_menu_font_size.'px;}</style>';
}

#
#   Custom Menu Font Color
#
$rttheme_menu_font_color=get_option('rttheme_menu_font_color'); // menu item color
$rttheme_menu_font_color_hover=get_option('rttheme_menu_font_color_hover'); // menu item hover color
$rttheme_menu_font_color_active=get_option('rttheme_menu_font_color_active'); // menu active item color

if($rttheme_menu_font_color){// menu item color
	echo '<style type="text/css">';
	echo '#navigation, #navigation a,#navigation ul ul li.current-menu-item a{color:'.$rttheme_menu_font_color.';}';
	echo '</style>';
}


if($rttheme_menu_font_color_active){// menu active item color
	echo '<style type="text/css">';
	echo '#navigation ul li.current_page_item a, #navigation ul li.current-menu-ancestor a, #navigation ul ul li a {color:'.$rttheme_menu_font_color_active.' !important;}';	
	echo '</style>';
}


	
if($rttheme_menu_font_color_hover){// menu item hover color
	echo '<style type="text/css">';
	echo '#navigation a:hover, #navigation ul li.current_page_item a:hover {color:'.$rttheme_menu_font_color_hover.' !important;}';
	echo '</style>';
}
	

#
#   Custom Slider Height
#
$rttheme_slider_height=get_option('rttheme_slider_height');
if($rttheme_slider_height){
	echo '<style type="text/css">';
	echo '#slider, #slider_area, .slide{ height:'.$rttheme_slider_height.'px !important; }';
	echo '</style>';
}

#
#   Custom Heading Sizes
#
for ($i = 1; $i <= 6; $i++) {
	$this_heading=get_option('rttheme_h'.$i.'_font_size');
	if($this_heading){
		echo '<style type="text/css">';
		echo 'h'.$i.'{ font-size:'.$this_heading.'px;line-height:140%; }';
		echo '</style>';
	}
}

#
#   Custom Content Box Font Size
#
$rttheme_box_title_font_size=get_option('rttheme_box_title_font_size');
if($rttheme_menu_font_size){
	echo '<style type="text/css">	.title h4{font-size:'.$rttheme_box_title_font_size.'px;line-height:140%;}</style>';
}


#
#   Custom Main Theme Color
#
$rttheme_custom_theme_color=get_option('rttheme_custom_theme_color');
if($rttheme_custom_theme_color){
	echo '<style type="text/css">';
	
	echo 'body #container h1,body #container h2,body #container h3,body #container h4,body #container h5,body #container h6, body #container h1 a, body #container h2 a, body #container h3 a, body #container h4 a, body #container h5 a, body #container h6 a{color:'.$rttheme_custom_theme_color.' !important;}';
	echo 'body #container .content h1 a:hover,body #container .content h2 a:hover,body #container .content h3 a:hover,body #container .content h4 a:hover,body #container .content h5 a:hover,body #container .content h6 a:hover{ background:'.$rttheme_custom_theme_color.';color:#fff !important;}';
	echo 'body #container  #slider .desc span.text a  { color:'.$rttheme_custom_theme_color.' !important;}';
	echo 'body #container #slider .desc span.text a:hover, body #container  #slider .desc span.title a:hover{ color:#fff !important; background-color:'.$rttheme_custom_theme_color.'  !important;}';
	echo 'body #container #numbers a.activeSlide {background: '.$rttheme_custom_theme_color.' !important;}';
	echo 'body #container .coda-nav ul li a.current {background: '.$rttheme_custom_theme_color.' !important;}';
	echo 'body #container ::selection {background: '.$rttheme_custom_theme_color.';}';
	echo 'body #container ::-moz-selection {background: '.$rttheme_custom_theme_color.';}';
	echo 'body #container #footer  a:hover, body #container  .blog .date {color:'.$rttheme_custom_theme_color.'  !important;}';
	echo 'body #container  .widget .recent_posts .date{color:'.$rttheme_custom_theme_color.' !important;border:1px solid '.$rttheme_custom_theme_color.'  !important;}';
	echo 'body #container .sidebar_content .widget .recent_posts .date{background-color:'.$rttheme_custom_theme_color.'; border:0 !important; color:#fff !important;}';
	echo 'body #container  .sidebar_content h1,body #container  h2,body #container  .sidebar_content h3,body #container  .sidebar_content h4,body #container  .sidebar_content h5,body #container  .sidebar_content h6{ color:'.$rttheme_custom_theme_color.';}';
	echo 'body #container  .sidebar_content h1 a, body #container  .sidebar_content h2 a, body #container  .sidebar_content h3 a, body #container  .sidebar_content h4 a, body #container  .sidebar_content h5 a, body #container  .sidebar_content h6 a{ color:'.$rttheme_custom_theme_color.' !important;}';
	echo 'body #container  .sidebar_content h1 a:hover,body #container  .sidebar_content h2 a:hover,body #container  .sidebar_content h3 a:hover,body #container  .sidebar_content h4 a:hover,body #container  .sidebar_content h5 a:hover,body #container  .sidebar_content h6 a:hover{ background:'.$rttheme_custom_theme_color.';color:#fff !important;}';
	
	echo 'body #container  .content a:hover{ color:'.$rttheme_custom_theme_color.' !important;}';
	
	echo 'body #container  .widget ul a:hover{color:'.$rttheme_custom_theme_color.' !important;}';
	echo 'body #container  a.more_arrow{ color:'.$rttheme_custom_theme_color.' !important;}';
	echo 'body #container  a.read_more:hover{ color:'.$rttheme_custom_theme_color.' !important;}';
	echo 'body #container  .widget ul a:hover{ color:'.$rttheme_custom_theme_color.' !important;}';


	echo 'body #container .ppy-nav a:hover {background-color:'.$rttheme_custom_theme_color.';color:#fff !important;}';
	echo 'body #container .ppy-caption a {color:'.$rttheme_custom_theme_color.';}';
	echo 'body #container .ppy-text h5 a:hover {color:#fff !important;}';

	echo 'body #container .theme-default .nivo-caption .nivo-text a {color:'.$rttheme_custom_theme_color.'; background:transparent;}';
	echo 'body #container .theme-default .nivo-directionNav a { background-color:'.$rttheme_custom_theme_color.';color:#fff;}';
	echo 'body #container .theme-default .nivo-caption a:hover{ background-color:'.$rttheme_custom_theme_color.';color:#fff !important;}';
	echo 'body #container .theme-default .nivo-directionNav a:hover{ background-color:'.$rttheme_custom_theme_color.';color:#fff !important;opacity:0.5}';
	echo 'body #container .theme-default .nivo-caption .nivo-title a:hover{background-color:'.$rttheme_custom_theme_color.';color:#fff !important;}'; 	


	echo '</style>';
}


#
#   Custom Heading Colors
#
$rttheme_heading_color=get_option('rttheme_heading_color');
if($rttheme_heading_color){
	echo '<style type="text/css">';
	echo 'body #container h1,body #container h2,body #container h3,body #container h4,body #container h5,body #container h6, body #container h1 a, body #container h2 a, body #container h3 a, body #container h4 a, body #container h5 a, body #container h6 a{color:'.$rttheme_heading_color.' !important;}';
	echo 'body #container .content h1 a:hover,body #container .content h2 a:hover,body #container .content h3 a:hover,body #container .content h4 a:hover,body #container .content h5 a:hover,body #container .content h6 a:hover{ background:'.$rttheme_heading_color.';color:#fff !important;}';
	echo '</style>';
}


#
#   Custom CSS Codes
#
echo '<style type="text/css">';
echo get_option(THEMESLUG.'_custom_css');
echo '</style>';

	
#
#  Call Google Fonts
#
call_user_func(array('RTThemeSite', 'google_fonts'));


#
#  Call Cufon Fonts
#
call_user_func(array('RTThemeSite', 'cufon_fonts'));


#
# Add specific CSS class by filter
#
add_filter('body_class','rt_body_class_name');


#
#  Wordpress Background
#
$background 		= get_background_image();
$background_color 	= get_background_color();
  
?>

</head>
<body <?php body_class(); ?>>
 

<!-- background wrapper -->
<div id="container">
	
	<?php //if wordpress background tool not used
	if(!$background):
	?>
		<!-- background image -->
		<div class="background_pic_border">
		<div class="background_pic_holder">
			
			<?php
			$background_image= get_option( THEMESLUG.'_background_image_url' );
			$randomized_banckground_images =  trim(get_option( THEMESLUG.'_background_image_urls'));
			
			//Static 100% Bakcround
			if($background_image && !$randomized_banckground_images){
				echo '<img src="'.$background_image.'" width="100%" alt="" />';	
			}
	
			//Randomized 100% Backgrounds
			if($randomized_banckground_images){
			    $random_background = trim(preg_replace("/(^[\r\n]*|[\r\n]+)[\s\t]*[\r\n]+/", "\n", $randomized_banckground_images)); 
			    $images=explode("\n",  $random_background);    
			    $random_number = rand(0, count($images)-1);    
			    echo '<img src="'.$images[$random_number].'" width="100%" alt="" />'; 
			}
	
			?></div>
		
			<?php if(!get_option(THEMESLUG.'_remove_curvs')):?>
				<div class="back-curv"></div>
			<?php else:?>
				<div class="back-line"></div>
			<?php endif;?>
		
		</div>
	<?php endif;?>
	
	<!-- wrapper -->
	<div id="wrapper">
	
	<!-- sidebar -->
	<div id="sidebar">
	
	<?php if(!get_option(THEMESLUG.'_remove_curvs')):?><div class="sidebar_top"></div><?php endif;?>
	<div class="sidebar_content">
	
		<!-- logo -->
		<div id="logo">
			<?php if(get_option('rttheme_logo_url')):?>
				<a href="<?php echo BLOGURL; ?>" title="<?php echo bloginfo('name');?>"><img src="<?php echo get_option('rttheme_logo_url'); ?>" alt="<?php echo bloginfo('name');?>" class="png" /></a>
			<?php else:?>
				<h1 class="cufon logo"><a href="<?php echo BLOGURL; ?>" title="<?php echo bloginfo('name');?>"><?php echo bloginfo('name');?></a></h1>
			<?php endif;?>
		</div>
		<!-- /logo -->
		<div class="clear"></div>
		
		<?php
		 //WPML FLAGS
		if(get_option(THEMESLUG.'_show_flags')){
			if(function_exists('icl_get_languages')){
				echo '<div class="box flags">';
					languages_list();
				echo '</div><div class="clear"></div>';					
			}   
		}
		?>
		
		<!-- Navigation -->
		<?php            
		//call the main menu
		$menuVars = array(
			'menu'            => 'RT Theme Main Navigation Menu',  
			'menu_id'         => '',
			'menu_class'         => '',
			'echo'            => false,
			'container'       => 'div', 
			'container_class' => '', 
			'container_id'    => 'navigation',
			'theme_location'  => 'rt-theme-main-menu' 
		);
		
		$main_menu=wp_nav_menu($menuVars);
		echo add_class_first_item($main_menu);
		?>
		<!-- / Navigation --> 	

		<?php get_template_part( 'sidebar', 'sidebar_file' ); //sidebars ?>

		<?php
		//social media icons
		global $social_media_icons;
		$social_media_output ='';

		foreach ($social_media_icons as $key => $value){
			
			if($value=="email_icon"){//e-mail icon link 
				$link = 'mailto:'.str_replace("mailto:", "", get_option( THEMESLUG.'_'.$value ));
			}else{
				$link = get_option( THEMESLUG.'_'.$value );
			}
			
			//all icons
			if(get_option( THEMESLUG.'_'.$value )){
				$social_media_output .= '<li>';
				$social_media_output .= '<a target="_blank" href="'. $link .'" class="j_ttip" title="'.$key.'">';
				$social_media_output .= '<img src="'.THEMEURI.'/images/assets/social_media/icon-'.$value.'.png" alt="" />';
				$social_media_output .= '</a>';
				$social_media_output .= '</li>';
			}
		}
		if($social_media_output) echo '<div class="box"><ul class="social_media_icons">'.$social_media_output.'</ul></div>';
		?>			
		
	<div class="clear"></div>
	</div>
	<?php if(!get_option(THEMESLUG.'_remove_curvs')):?><div class="sidebar_bottom"></div><?php endif;?>
	</div>
	
	<!-- content -->
	<div id="content">
		<?php if(	(( get_option(THEMESLUG."_slider_active") && is_front_page()) || is_front_page() ) && (!get_option(THEMESLUG.'_remove_curvs')) ) echo '<div class="slider_cover"></div>';  ?>
		<div class="content_top <?php if(get_option(THEMESLUG.'_remove_curvs') && !is_front_page()):?>no_curv<?php endif;?> <?php if(get_option(THEMESLUG.'_remove_curvs') && is_front_page()):?>no_curv_home<?php endif;?> "></div>
		<div class="content"> 
			