<?php
	get_currentuserinfo() ;
	global $user_login, $user_level, $current_user;
?><!DOCTYPE html>

<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<title><?php

	wp_title( '|', true, 'right' );

	?></title>
	<?php
	$options = get_option('site_basic_options');
	?>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php

	if ( is_singular() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );

	wp_head();
?>

<?php get_template_part('css/fonts/fonts'); ?>
<?php if($options['themelayout'] != 'simple') : ?>
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('template_url'); ?>/css/<?php echo $options['themelayout'] ?>layout.css" />
<?php endif; ?>
<?php if ($options['themelayout'] == "full") :
		get_template_part('css/userstyles/fulllayout', 'products');
	elseif ($options['themelayout'] == "simple") :
		get_template_part('css/userstyles/simplelayout', 'products');
	elseif ($options['themelayout'] == "boxed") :
		get_template_part('css/userstyles/boxedlayout', 'products');
	endif;
	if (empty($options['slidertrans']))
		$transition = "fade";
	else
		$transition = $options['slidertrans'];
?>

</head>

<?php
/* jonathan@smalls.cc   2012 June 17

-  http://developer.yahoo.com/performance/rules.html
   The above hyperlink suggests that FLUSH() right after the page header can
   improve responsiveness by allowing the client agent to partially load the
   page while the server assembles the rest of the document. 
*/
flush();
?>

<script src="<?php bloginfo( 'template_url' ); ?>/js/jquery.easing.1.3.js" type="text/javascript"></script>
<script src="<?php bloginfo( 'template_url' ); ?>/js/jquery.bxSlider.min.js" type="text/javascript"></script>

<body id="<?php echo $options['themelayout'] ?>" <?php body_class(); ?>>
<?php
/*	jonathan@smalls.cc	2012 April 24
I removed this shopping cart header, because I use Google Checkout rather than
the poorly documented WP E-Commerce cart.

	<div id="top-header">
		<div class="margin">
			<div id="top-header-nav">
				<div id="cart-top">
					<span class='checkout-top cartcount'><a target='_parent' href='<?php echo get_option('shopping_cart_url'); ?>'><img src="<?php bloginfo('template_url') ?>/images/basket.png" alt="shopping basket" /><span class='cartcount'><?php echo wpsc_cart_item_count(); ?> items</span></a></span>
					<span class='amount-top items'></span>
					<?php getCart(); ?>
				</div>
				<div id="header-categories">
					<h4 class="top-nav-header">Products</h4>
					<div class="header-categories-drop"><?php getGroupedCategories(); ?></div>
				</div>

			</div>
			
		</div>
	</div>
	
/*	jonathan@smalls.cc	2012 April 24
I commented out the user authentication header, because I want to use OpenID
rather than user names specific to this site.

	<div id="user-nav">
		<div class="margin">
		<ul>
			<?php if ($current_user->user_level > -1) : ?>
				<li class="no"><a class="black" href="<?php echo wp_logout_url(get_option('home')); ?>">Logout</a></li>
				<li><a href="<?php echo get_option('home'); ?>/producs-page/your-account/">Your Account</a></li>
			<?php else : ?>
				<li><a href="<?php echo get_option('home'); ?>/wp-login.php?action=register">Register</a></li>
				<li class="no"><a href="<?php echo get_option('home'); ?>/producs-page/your-account/">Sign In</a></li>
			<?php endif; ?>
		</ul>
		</div>
	</div>
*/
?>
	<div id="header-wrapper">
	<div id="header" class="container">
		<div class="margin">
			<div id="logo">
				<a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php if (!empty($options['sitelogo']['url'])) : ?><img src="<?php echo $options['sitelogo']['url'] ?>" alt="<?php bloginfo( 'name' ); ?>" /><?php else : ?><?php bloginfo( 'name' ); ?><?php endif; ?></a>
			</div>
			<table>	<tbody>
			<tr	valign	=	'top'	>
				<td>
					617 547 0443
					<ul>
						<li>
							Monday
							<span	class	=	'schedule'	>	1000am to 700pm </span>
						</li>
						<li>
							Tuesday
							<span	class	=	'schedule'	>	1000am to 700pm </span>
						</li>
						<li>
							Wednesday
							<span	class	=	'schedule'	>	1000am to 700pm </span>
						</li>
						<li>
							Thursday
							<span	class	=	'schedule'	>	1000am to 700pm </span>
						</li>
					</ul>
				</td>
				<td	valign	=	'top'	>
					617 354 2987
					<ul>
						<li>
							Friday
							<span	class	=	'schedule'	>	1000am to 800pm </span>
						</li>
						<li>
							Saturday
							<span	class	=	'schedule'	>	1000am to 600pm </span>
						</li>
						<li>
							Sunday
							<span	class	=	'schedule'	>	1200pm to 500pm </span>
						</li>
					</ul>
				</td>
			</tr>
		</tbody>	</table>	<br/>
			<div id="top-navigation" role="navigation">
				<?php wp_nav_menu( array( 'container_class' => 'menu-header', 'theme_location' => 'primary' ) ); ?>
			</div>
			<br class="clear" />
		</div>
	</div>
	<div id="leader" class="container">
		<div class="margin">	
<?php
if (is_front_page()) :
/*	jonathan@smalls.cc	2012 April 27
I reprogrammed the front page header image, because there was no guarantee
that the selected entry would have an image associated with it. I also wanted
more control over what items were featured without having to make separate
entries in the WP_POSTS table to achieve that.

				include 'leaders/featured.php';
*/
	include	'includes/frontpage-slides.php';
			elseif (is_category()) :
			?>
				<h1><?php printf( __( 'Category Archives: %s', 'flexishop' ), '' . single_cat_title( '', false ) . '' ); ?></h1>
				<?php $category_description = category_description();
					if ( ! empty( $category_description ) )
						echo $category_description ?>
			<?php elseif (is_archive()) : ?>
				<?php if ( is_day() ) : ?>
								<h1><?php printf( __( 'Daily Archives: %s', 'flexishop' ), get_the_date() ); ?></h1>
				<?php elseif ( is_month() ) : ?>
								<h1><?php printf( __( 'Monthly Archives: %s', 'flexishop' ), get_the_date('F Y') ); ?></h1>
				<?php elseif ( is_year() ) : ?>
								<h1><?php printf( __( 'Yearly Archives: %s', 'flexishop' ), get_the_date('Y') ); ?></h1>
				<?php endif; ?>
			<?php else: ?>
				<?php if(wpsc_display_products()): ?>
					<?php if(wpsc_is_in_category() && ((get_option('wpsc_category_description') &&  wpsc_category_description()) || (get_option('show_category_thumbnails') && wpsc_category_image()))) : ?>				
						<?php if(get_option('show_category_thumbnails') && wpsc_category_image()) : ?>
						<div class='group-thumbnail'>
								<img src='<?php echo wpsc_category_image(); ?>' alt='<?php echo wpsc_category_name(); ?>' title='<?php echo wpsc_category_name(); ?>' class="thumbnail" />
						</div>
						<?php endif; ?>
					<?php endif; ?>
					<?php if(wpsc_has_breadcrumbs()) :?>
							<div class='breadcrumb'>
								<a href='<?php echo get_option('product_list_url'); ?>'><?php echo get_option('blogname'); ?></a> &raquo;
								<?php while (wpsc_have_breadcrumbs()) : wpsc_the_breadcrumb(); ?>
									<?php if(wpsc_breadcrumb_url()) :?> 	   
										<a href='<?php echo wpsc_breadcrumb_url(); ?>'><?php echo wpsc_breadcrumb_name(); ?></a> &raquo;
									<?php else: ?> 
										<?php echo wpsc_breadcrumb_name(); ?>
									<?php endif; ?> 
								<?php endwhile; ?>
							</div>
						<?php endif; ?>
				<?php endif; ?>
				<h1><?php wp_title(''); ?><?php if(is_page('checkout')) : ?><span class="checkout_totals"> / <?php echo wpsc_cart_total(); ?></span> <?php endif; ?></h1>
				<?php if(wpsc_display_products()): ?>
					<?php do_action('wpsc_top_of_products_page'); // Plugin hook for adding things to the top of the products page, like the live search ?>
					<?php if(wpsc_is_in_category() && ((get_option('wpsc_category_description') &&  wpsc_category_description()) || (get_option('show_category_thumbnails') && wpsc_category_image()))) : ?>
						<div class='wpsc_category_details'>
							<?php if(get_option('wpsc_category_description') &&  wpsc_category_description()) : ?>
								<p class="category-description"><?php echo wpsc_category_description(); ?></p>
							<?php endif; ?>
						</div>
					<?php endif; ?>
				<?php endif; ?>
			<?php endif; ?>
<?php	/*
<br class="clear" />
*/	?>
		</div>
	</div>
	</div>
<div	class	=	'align-cart'
		id		=	'googlecart-widget'
		style	=	'width:	25%;
					position:	fixed;
						right:	0%;						
						top:		0%;'
>	</div>