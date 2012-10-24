<?php
/*	Template Name: Page - Front
*/
get_header();

if(	have_posts()	) :
while(	have_posts()	) :
	the_post();
	$nPageID	=	get_the_ID();
?>

<div class="posts">
<?php the_content(); ?>
<?php wp_link_pages(array('before' => '<p><strong>'.__('Pages', "feed-me-seymour").':</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
</div>

<?php
endwhile;
endif;

$aryTables	=	SetTables();
extract(	$aryTables	);
global	$wpdb;

$aryPages	=	$wpdb -> get_results(
	"SELECT	$tblPosts.post_title,
		$tblPosts.post_content,
		$tblPosts.guid,
		$tblPosts.ID
	FROM	$tblPosts
	WHERE	$tblPosts.post_parent	=	$nPageID
	AND	$tblPosts.post_type	=	'page'	
	AND	$tblPosts.post_status	=	'publish'"
						);

foreach(	$aryPages as $objPage	)
{	$szTitle	=	$objPage -> post_title;
	$szContent	=	$objPage -> post_content;
	$szURI		=	$objPage -> guid;
	$nID		=	$objPage -> ID;
	$aryImages	=	$wpdb -> get_results(
		"SELECT	$tblPosts.guid
		FROM	$tblPosts
		WHERE	$tblPosts.post_type	=	'attachment'
		AND	$tblPosts.post_parent	=	$nID"
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

flush();
get_footer();
?>
