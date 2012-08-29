<?php get_header(); ?>

<div class="main group">

	<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
	
		<div class="post">
			<h2><a href="<?php the_permalink(); ?>"><?php the_title();?></a></h2>
			<?php the_excerpt();?>
			<p class="meta">
				<span class="author">Author: <?php the_author_link(); ?></span>, Posted on: <a href="<?php the_permalink(); ?>" class="date"><?php the_time('M j, Y'); ?></a> and filed under <?php the_category(', '); ?> – <?php comments_popup_link('0 Comments', '1 Comment', '% Comments', 'comments', 'Comments off'); ?>
			</p>
		</div>
		
	<?php endwhile; ?>

</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
