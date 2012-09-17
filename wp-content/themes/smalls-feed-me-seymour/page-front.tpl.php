<?php
/*	Template Name: Page - Front
*/
get_header();

if(	have_posts()	) :
while(	have_posts()	) :
	the_post();
?>
		<h1 class="catheader"><?php the_title(); ?></h1>

		<div class="posts">
			<?php the_content(); ?>
   			<?php wp_link_pages(array('before' => '<p><strong>'.__('Pages', "feed-me-seymour").':</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
		</div>

<?php
endwhile;
endif;

/*
$aryPages	=	$wpdb -> get_results(	
	"SELECT	wp_posts.post_title,
		wp_posts.post_content,
		wp_posts.guid,
		wp_posts.ID
	FROM	wp_posts
	WHERE	wp_posts.post_parent	=	227
	AND	wp_posts.post_type	=	'page'	
	AND	wp_posts.post_status	=	'publish'"
						);

foreach(	$aryPages as $objPage	)
{	$szTitle	=	$objPage -> post_title;
	$szContent	=	$objPage -> post_content;
	$szURI		=	$objPage -> guid;
	$nID		=	$objPage -> ID;
	$aryImages	=	$wpdb -> get_results(	
		"SELECT	wp_posts.guid
		FROM	wp_posts
		WHERE	wp_posts.post_type	=	'attachment'
		AND	wp_posts.post_parent	=	$nID"
							);
	$szImageURI	=	$aryImages[ rand(	0,
							count(	$aryImages	) - 1
							)] -> guid;
	
	echo	"<a	href	=	'$szURI'	>
		<div	class	=	'front-block'
			style	=	'background-image:	url(	$szImageURI	);
					background-size:		cover;'
		>
			<h4>	$szTitle	</h4>
		</div>	</a>";	
}
 */

flush();
get_footer();
?>
