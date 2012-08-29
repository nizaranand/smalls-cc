<?php get_header(); ?>

<?php
	$custom = get_post_custom($post->ID);
	$sl_sidebar = $custom["sl-meta-box-sidebar"][0];
?>
	
<div class="<?php if( $sl_sidebar == true ) { echo 'full '; } else { echo 'main '; } ?>group">

	<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
		<h2><?php the_title();?></h2>
		<?php the_content();?>
	<?php endwhile; ?>
	
</div>

<?php if( $sl_sidebar == true ) { return; } else { get_sidebar('page'); } ?>
<?php get_footer(); ?>
