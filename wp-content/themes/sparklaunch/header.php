<!DOCTYPE html>
<html>

	<head>
		<meta charset="UTF-8"/>
		
		<title><?php wp_title('&laquo;', true, 'right'); ?> <?php bloginfo('name'); ?></title>
		
		<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>"/>
		<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
		
		<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>
		<?php wp_head(); ?>
		<script	type	=	"text/javascript"
					src	=	"http://107.20.220.20/wordpress/wp-content/themes/sparklaunch/_assets/js/jquery.cycle.all.min.js"
		>	</script>
		<script>
			jQuery("document").ready(function() {
			
				<?php
					$sl_effect = of_get_option('sl_effect');
					
					if ($sl_effect == "0") { $slider_effect = "fade"; } else if ($sl_effect == "1") { $slider_effect = "scrollDown"; } else if ($sl_effect == "2") { $slider_effect = "scrollUp"; } else if ($sl_effect == "3") { $slider_effect = "scrollLeft"; } else if ($sl_effect == "4") { $slider_effect = "scrollRight"; } else if ($sl_effect == "5") { $slider_effect = "scrollHorz"; } else if ($sl_effect == "6") { $slider_effect = "scrollVert";}

					$slider_timeout = of_get_option('sl_timeout');
					$slider_speed = of_get_option('sl_speed');
				?>
			
				jQuery('#slideshow').cycle({ 
				    fx:     '<?php echo $slider_effect; ?>',
				    <?php if ($slider_timeout != "0") echo 'timeout: '.$slider_timeout.','; ?>
				    speed: <?php echo $slider_speed; ?> 
				});
				
			});
		</script>
	</head>
	
	<body <?php body_class(); ?>>
	
		<div id="header">
			<?php wp_nav_menu( array('menu' => 'Main Menu', 'container' => false, )); ?>
		</div>
