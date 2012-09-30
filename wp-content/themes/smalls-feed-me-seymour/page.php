<?php get_header();
if (have_posts()) : while (have_posts()) : the_post();
	$nPageID	=	get_the_ID();
?>
		<h1 class="catheader"><?php the_title(); ?></h1>

		<div class="posts">
			<?php the_content(); ?>
   			<?php wp_link_pages(array('before' => '<p><strong>'.__('Pages', "feed-me-seymour").':</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
		</div>

<?php
endwhile;
endif;

$szATarget	=	'target	=	_blank';
if(	true	==	is_page()	)
{	$aryTables	=	SetTables();
	extract(	$aryTables	);
	global	$wpdb;

	$aryPages	=	$wpdb -> get_results(
		"SELECT	$tblPosts.post_title,
			$tblPosts.guid,
			$tblPosts.ID,
			$tblPosts.post_type
		FROM	$tblPosts
		WHERE	$tblPosts.post_status	=	'publish'
		AND	$tblPosts.post_parent	=	$nPageID
		AND	$tblPosts.post_type	=	'page'"
							);

	if(	0	<	count(	$aryPages	))
	{	echo	"<div	id	=	'secondsidebar'	>";

		$aryImages	=	$wpdb -> get_results(
			"SELECT	$tblPosts.post_parent,
				$tblPosts.guid
			FROM	$tblPosts
			WHERE	$tblPosts.post_type	=	'attachment'
			AND	$tblPosts.post_parent	!=	0",
			OBJECT_K
								);

		foreach(	$aryPages as $objPage	)
		{	$szSubTitle	=	$objPage -> post_title;
			$szURI		=	$objPage -> guid;
			$szImageURI	=	$aryImages[ $objPage -> ID ] -> guid;
			$szStyle	=	"style	=	'background-image:	url( $szImageURI );'";
		
		echo	"<a	href	=	'$szURI'
				$szATarget
			>
			<div	class	=	'front-block'
				$szStyle	
			>
				<h4>	$szSubTitle	</h4>
			</div>	</a>";
		}

		echo	"</div>";

}	}

get_footer();
?>
