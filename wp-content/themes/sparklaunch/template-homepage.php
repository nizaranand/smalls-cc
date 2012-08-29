<?php
/**
 * Template Name: Homepage
 *
 * @package WordPress
 * @subpackage Spark Launch
 */
 
 get_header(); ?>
 
 	<div id="slideshow">
 
	 	<?php $slides = new WP_Query(array( 'post_type' => 'slide')); ?>
		<?php while ($slides->have_posts() ) : $slides->the_post(); sl_post_meta(); ?>
	
		<div class="slide">
		
			<?php the_post_thumbnail('slide'); ?>
			<h2><?php the_title(); ?></h2>
			<?php the_content(); ?>
		
			<?php if(!empty($meta['slidebutton'])) : ?>
				<a href="<?php echo $meta['slidebuttonlink']; ?>" class="button"><?php echo $meta['slidebutton']; ?></a></p>
			<?php endif; ?> 	
								
		</div><!-- /slide -->
		
		<?php endwhile; wp_reset_query(); ?>
		
	</div><!-- /slideshow --> 	
 	
 	<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
 		<?php the_content(); ?>
 	<?php endwhile; ?>
 	
 	<div class="widgetarea">
 		<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Homepage') ) : ?>
 		<?php endif; ?>
 	</div>
 
 <?php get_footer(); ?>