<?php
get_header();

while(	have_posts()	):
	the_post();
	the_content();
	
	$nPageID	=	get_the_ID();
	$szTitle	=	get_the_title();
endwhile;

if	(	true	==	stripos	(	$_SERVER	['REQUEST_URI'	],
						'project-management'
	)				)
{	$nPageID	=	25;
	$szATarget	=	'target	=	_blank';
}

$szSQL	=
	"SELECT	wp_posts.post_title,
		wp_posts.guid,
		wp_posts.ID,
		wp_posts.post_type
	FROM	wp_posts
	WHERE	wp_posts.post_status	=	'publish'
	AND	wp_posts.post_parent	=	$nPageID
	AND	wp_posts.post_type	=	'page'
	LIMIT	5";
$aryPages	=	$wpdb ->	get_results(	$szSQL	);

if(	0	<	count	(	$aryPages	))
{	echo	"<div	id	=	'secondsidebar'	>";

	foreach(	$aryPages	as	$objPage	)
	{	$szSubTitle	=	$objPage ->	post_title;
		$szURI		=	$objPage ->	guid;
		$nID		=	$objPage ->	ID;
		$szSQL		=
			"SELECT	guid
			FROM	wp_posts
			WHERE	wp_posts.post_type	=	'attachment'
			AND	wp_posts.post_parent	=	$nID";
		$aryImages	=	$wpdb ->	get_results(	$szSQL	);
		$szImageURI	=	$aryImages[	0	] ->	guid;
		
		echo	"<a	href	=	'$szURI'
				$szATarget
			>
			<div	class	=	'front-block'
				style	=	'background-image:	url(	$szImageURI	);
						background-size:	cover;'
			>
				<h4>	$szSubTitle	</h4>
			</div>	</a>";
	}

	echo	"</div>";
}

$szTitle	=	strtolower	(	$szTitle	);
$szSQL		=
	"SELECT	wp_posts.post_title,
		wp_posts.post_content,
		wp_posts.guid,
		wp_posts.ID,
		wp_posts.post_type
	FROM	wp_posts,
		wp_terms,
		wp_term_relationships
	WHERE	wp_posts.post_status	=	'publish'
	AND	wp_posts.post_type	=	'post'	
	AND	wp_posts.ID		=	wp_term_relationships.object_id
	AND	wp_terms.term_id	=
			wp_term_relationships.term_taxonomy_id
	AND	LOCATE(	wp_terms.name,
			'$szTitle'
			)	>	0";
$aryPages	=	$wpdb -> get_results	(	$szSQL	);

if	(	NULL	!=	$aryPages	)
{	$nXAxis		=	rand	(	0,
						count(	$aryPages	) - 1
					);
	$objPage	=	$aryPages [$nXAxis];
	$szTitle	=	$objPage -> post_title;
	$szContent	=	$objPage -> post_content;
	$szURI		=	$objPage -> guid;
	
	echo	"<div	class	=	'post-excerpt'	>
			<h4>	$szTitle	</h4>
				$szContent
		</div>";
}
 
flush();
get_footer();
?>
