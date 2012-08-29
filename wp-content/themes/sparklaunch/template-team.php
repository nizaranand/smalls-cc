<?php
/**
 * Template Name: Team Members
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
		
		<?php $members = new WP_Query(array('post_type' => 'team')); ?>
		<?php while ($members->have_posts()) : $members->the_post(); sl_post_meta(); ?>
		
			<div class="member">
				<?php the_post_thumbnail('teammember'); ?>
				<h3><?php the_title(); ?></h3>
				<?php if(!empty($meta['title'])) { ?><h5><?php echo $meta['title']; ?></h5><?php } ?>
				<?php the_content(); ?>
			</div><!-- /member -->
		
		<?php endwhile; wp_reset_query(); ?>
		
	</div><!-- /main -->
	
	<?php if( $sl_sidebar == true ) { return; } else { get_sidebar('page'); } ?>

 <?php get_footer(); ?>