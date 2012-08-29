<?php

get_header(); ?>

<div id="content-wrapper">
	<div id="main-content" class="container">	
		<div class="margin">
			<div id="main-col">
					<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					<div class="blog-post blog-overview">
						<div class="post-header">
							<h2 class="post-title"><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h2>
							<div class="post-meta">
								<p>Posted on <?php the_time('F j, Y'); ?><?php comments_popup_link('0', '1', '%', 'comment-count'); ?></p>
							</div>
							<?php if(has_post_thumbnail()) { ?>
								<a href="<?php the_permalink() ?>" title="<?php the_title(); ?>" class="large-blog-image"><?php the_post_thumbnail( 'blog' ); ?></a>
							<?php } ?>
							
							<br class="clear" />
						</div>
						<div class="post-content">
						<?php the_content(__('Read more'));?>
						</div>
					</div>
					<?php endwhile; ?>
					<?php else : ?>
						<h2><?php _e( 'Nothing Found', 'flexishop' ); ?></h2>
						<p><?php _e( 'Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'flexishop' ); ?></p>
						<?php get_search_form(); ?>
					<?php endif; ?>
					<?php pagination(); ?>
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
