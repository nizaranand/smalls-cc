<?php
/**
 * Template Name: FAQ
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
		
		<?php $faq = new WP_Query(array( 'post_type' => 'faq')); ?>
		
		<div class="questions">
			<dl>
				<?php while ($faq->have_posts() ) : $faq->the_post(); sl_post_meta(); ?>
					<dt><?php the_title(); ?></dt>
					<dd><?php the_content(); ?></dd>	
				<?php endwhile; ?>
			</dl>
		</div><!-- /questions -->
	
		<?php wp_reset_query(); ?>
		
	</div><!-- /main -->
	
	<?php if( $sl_sidebar == true ) { return; } else { get_sidebar('page'); } ?>
 
 <?php get_footer(); ?>