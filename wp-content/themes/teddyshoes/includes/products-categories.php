<?php
/*	jonathan@smalls.cc	2012 April 4
This code is intended to execute on a product category page. It renders a brief
description of all products in a certain category.
*/
$szQuery			=
	"SELECT	wp_term_relationships.object_id,
				wp_posts.post_title
	FROM		wp_terms,
				wp_term_relationships,
				wp_posts
	WHERE		wp_terms.slug		=	'$szPage'
	AND		wp_terms.term_id	=	wp_term_relationships.term_taxonomy_id
	AND		wp_posts.ID			=	wp_term_relationships.object_id
	ORDER BY	wp_posts.post_title";
$aryPostIDs		=	$wpdb	->	get_results	(	$szQuery	);

$szQuery			=
	"SELECT	post_id,
				meta_value
	FROM		wp_postmeta,
				wp_posts
	WHERE		wp_postmeta.post_id	=	wp_posts.ID
	AND		wp_postmeta.meta_key	=	'_thumbnail_id'";
$aryImageID		=	$wpdb	->	get_results	(	$szQuery,
														OBJECT_K
													);

for(	$nPosition	=	0;
		$nPosition	<	count(	$aryPostIDs	);
		$nPosition++
	)
{	$nPostID			=	$aryPostIDs	[	$nPosition	]	->	object_id;
	$szPostTitle	=	$aryListing	[	(	int	)	$nPostID	]	->	post_title;
	$szPostURI		=	$aryListing	[	(	int	)	$nPostID	]	->	guid;

	$nImageID		=	$aryImageID	[	$nPostID	]	->	meta_value;
	$szImageURI		=	$szSiteURL
							.	'/wp-content/plugins/wp-e-commerce/wpsc-theme/wpsc-images/noimage.png';
	if	(	$aryListing	[	(	int	)	$nImageID	]	->	guid	!=	NULL
	&&		$aryListing	[	(	int	)	$nImageID	]	->	guid	!=
				$szSiteURL
				.	'/wp-content/uploads/2012Mar26/'
		)
		$szImageURI		=	$aryListing	[	(	int	)	$nImageID	]	->	guid;

	echo
		"<a	href	=	'$szPostURI'	>
		<div	class	=	'product_overview padding'	>
			<img	src	=	'$szImageURI'	/>
			<span	class	=	'category-name'	>	$szPostTitle	</span>
		</div>	</a>";
}
?>