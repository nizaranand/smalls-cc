<?php
/**
 * Template Name: Testimonials
 *
 * @package WordPress
 * @subpackage Spark Launch
 */
 
 get_header(); ?>
 
 <?php
 	$custom = get_post_custom($post->ID);
 	$sl_sidebar = $custom["sl-meta-box-sidebar"][0];
 ?>
 	
 <div class="<?php if( $sl_sidebar == true ) { echo 'full '; } else { echo 'main '; } ?>group">
 	
 	<div class="content">
 		<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
 			<?php the_content(); ?>
 		<?php endwhile; ?>
 	</div>
	
	<?php $testimonials = new WP_Query(array( 'post_type' => 'testimonial')); ?>
	<?php while ($testimonials->have_posts() ) : $testimonials->the_post(); sl_post_meta(); ?>

	<div class="testimonial">
	
		<blockquote>
			<?php the_content(); ?>
		</blockquote>
		
		<cite><?php the_title(); ?>, <a href="<?php echo $meta['sourceurl']; ?>"><?php echo $meta['sourcecompany']; ?></a>, <?php echo $meta['sourcelocation']; ?></cite>
							
	</div><!-- /testimonial -->
	
</div><!-- /main -->
	
	<?php endwhile; wp_reset_query(); ?>
	
	<?php if( $sl_sidebar == true ) { return; } else { get_sidebar('page'); } ?>
			
 <?php get_footer(); ?>