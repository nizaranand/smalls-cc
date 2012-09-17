<?php

get_header(); ?>

<div id="content-wrapper">
	<div id="main-content" class="container">	
		<div class="margin">
			<div id="main-col">
				
				<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>	
						<div id="single-post">	
							<div class="post-meta">
								<p>Posted on <?php the_time('F j, Y'); ?></p>
							</div>
							<?php if(has_post_thumbnail()) { ?>
								<a href="<?= $link ?>" title="<?php the_title(); ?>" class="large-blog-image"><?php the_post_thumbnail( 'blog' ); ?></a>
							<?php } ?>
<!--
							<div class="post-excerpt">
							<?php the_excerpt(); ?>
							</div>
-->
							
							<div class="post-content">
							<?php the_content(); ?>
							</div>
							<?php wp_link_pages( array( 'before' => '' . __( 'Pages:', 'flexishop' ), 'after' => '' ) ); ?>
							<?php edit_post_link( __( 'Edit', 'flexishop' ), '', '' ); ?>
						</div>
					<?php comments_template( '', true ); ?>
	
				<?php endwhile; ?>
				
			</div>
			<div id="sidebar">
				<div class="sidebar-inner">
					<?php get_sidebar(); ?>
				</div>
			</div>
		</div>
	</div>
</div>

<?php get_footer(); ?>