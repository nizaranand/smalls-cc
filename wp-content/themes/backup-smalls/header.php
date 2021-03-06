<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "//www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="//www.w3.org/1999/xhtml" dir="ltr" lang="en-US">

<head profile="//gmpg.org/xfn/11">

<?php if((is_home() && ($paged < 2 )) || is_single() || is_page()) { echo '<meta name="robots" content="index,follow" />'; } else { echo '<meta name="robots" content="noindex,follow" />'; } ?>

<?php if (is_single() || is_page() ) : if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
<meta name="description" content="<?php metaDesc(); ?>" />
<?php csv_tags(); ?>
<?php endwhile; endif; elseif(is_home()) : ?>
<meta name="description" content="<?php if(theme_option('site_description')) { echo trim(stripslashes(theme_option('site_description'))); } else { bloginfo('description'); } ?>" />
<meta name="keywords" content="<?php if(theme_option('keywords')) { echo trim(stripslashes(theme_option('keywords'))); } else { echo 'wordpress,c.bavota,magazine basic,custom theme,themes.bavotasan.com,premium themes'; } ?>" />
<?php endif; ?>

<title><?php wp_title(''); ?><?php if(wp_title('', false)) { echo ' | '; } ?><?php bloginfo('name'); if(is_home()) { echo ' | '; bloginfo('description'); } ?></title>

<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
<?php
/*	jonathan@smalls.cc	2012 July 3
-	removed dynamic style sheet
pbt_header_css();
*/
?>
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<!--[if IE]>
<link rel="stylesheet" type="text/css" href="<?php echo THEME_URL; ?>/iestyles.css" />
<![endif]-->
<?php if(is_singular() && get_option('thread_comments')) wp_enqueue_script( 'comment-reply' ); ?>
<?php wp_enqueue_script('jquery'); ?>
<?php
/*	jonathan@smalls.cc	2012 July 10
-	removing Javascript background image?

wp_head();
*/
?>
</head>

<body <?php body_class(); ?>>
<!-- begin header -->
<?php if(theme_option('user_login') != 2) { ?>

<!--	<div id="login">	</div>	-->

<?php 
}
$headeralign = theme_option('logo_location');
if($headeralign=="fl") $adfloat = ' class="fr"';
if($headeralign=="fr") $adfloat = ' class="fl"';
if($headeralign=="aligncenter") $adfloat = ' class="aligncenter"';
$float = ' class="'.$headeralign.'"';
?>
<div	class	=	"header"	>
<?php
/*	jonathan@smalls.cc	2012 July 3
-	removed suggestion of RSS feed

 if(theme_option('rss_button') != 2 && $headeralign!="aligncenter") { ?>
    <div id="header-rss"<?php if(!empty($adfloat)) echo $adfloat; ?>>
    	<a href="<?php bloginfo('rss2_url'); ?>"><img src="<?php echo THEME_URL; ?>/images/rss.png" alt="Subscribe to RSS Feed" /></a><p><?php _e('Subscribe to RSS', "feed-me-seymour"); ?></p>
    </div>

    <?php }
*/
?>
	<?php if (theme_option('logo_header')) { ?>
    	<a href="<?php echo home_url(); ?>/" class="headerimage"><img src="<?php echo theme_option('logo_header'); ?>" alt="<?php bloginfo('name'); ?>"<?php echo $float; ?> /></a>
    <?php } else { ?>
    <div id="title"<?php echo $float; ?>>
    	<a href="<?php echo home_url(); ?>/"><?php bloginfo('name'); ?></a>
    </div>
    <?php } ?>
    <div id="description"<?php echo $float; ?>>
        <?php if(theme_option('tag_line')!=2) bloginfo('description'); ?>
    </div> 
</div>
<!-- end header -->

<div id="mainwrapper">
<?php
/*	jonathan@smalls.cc	2012 June 19
-	removed sidebars to blank the page
	$loc = theme_option('sidebar_location');
	if($loc==1 || $loc==3 || $loc==5) {
		get_sidebar(); // calling the First Sidebar
	}
	if($loc==3) get_sidebar( "second" );
*/
?>
	<div id="leftcontent">
