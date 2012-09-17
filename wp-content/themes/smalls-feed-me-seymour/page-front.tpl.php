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
<?php smalls_cc_link_pages(array('before' => '<p><strong>'.__('Pages', "feed-me-seymour").':</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
</div>

<?php
endwhile;
endif;

/*
$aryPages	=	$wpdb -> get_results(	
	"SELECT	smalls_cc_posts.post_title,
		smalls_cc_posts.post_content,
		smalls_cc_posts.guid,
		smalls_cc_posts.ID
	FROM	smalls_cc_posts
	WHERE	smalls_cc_posts.post_parent	=	$nPageID
	AND	smalls_cc_posts.post_type	=	'page'	
	AND	smalls_cc_posts.post_status	=	'publish'"
						);
var_dump($aryPages);

foreach(	$aryPages as $objPage	)
{	$szTitle	=	$objPage -> post_title;
	$szContent	=	$objPage -> post_content;
	$szURI		=	$objPage -> guid;
	$nID		=	$objPage -> ID;
	$aryImages	=	$wpdb -> get_results(	
		"SELECT	smalls_cc_posts.guid
		FROM	smalls_cc_posts
		WHERE	smalls_cc_posts.post_type	=	'attachment'
		AND	smalls_cc_posts.post_parent	=	$nID"
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
