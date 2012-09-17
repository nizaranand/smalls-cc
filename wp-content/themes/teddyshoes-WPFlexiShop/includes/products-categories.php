<?php
$tblCommentMeta		=	$GLOBALS[ 'tblCommentMeta' ];
$tblComments		=	$GLOBALS[ 'tblComments' ];
$tblLinks		=	$GLOBALS[ 'tblLinks' ];
$tblOptions		=	$GLOBALS[ 'tblOptions' ];
$tblPostMeta		=	$GLOBALS[ 'tblPostMeta' ];
$tblPosts		=	$GLOBALS[ 'tblPosts' ];
$tblTerms		=	$GLOBALS[ 'tblTerms' ];
$tblRelationships,	=	$GLOBALS[ 'tblRelationships' ];
$tblTaxonomy		=	$GLOBALS[ 'tblTaxonomy' ];
$tblUserMeta		=	$GLOBALS[ 'tblUserMeta' ];
$tblUsers		=	$GLOBALS[ 'tblUsers' ];

/*	jonathan@smalls.cc	2012 April 4
 *	This code is intended to execute on a product category
 *	page. It renders a brief description of all products in
 *	a certain category.
 */

$aryProducts[ 0 ]	=	$wpdb -> get_results(
	"SELECT $tblPosts.ID,
		$tblPosts.guid
	FROM	$tblPosts
	WHERE	$tblPosts.post_type	=	'attachment'",
	OBJECT_K
							);
$aryProducts[ 1 ]	=	$wpdb -> get_results(
	"SELECT	$tblPosts.post_title,
		$tblPosts.guid,
		$tblPostMeta.meta_value
	FROM	$tblPostMeta,
		$tblPosts,
		$tblTerms,
		$tblRelationships
	WHERE	$tblPostMeta.post_id	=	$tblPosts.ID
	AND	$tblPostMeta.meta_key	=	'_thumbnail_id'
	AND	$tblPosts.ID		=	$tblRelationships.object_id
	AND	$tblTerms.term_id	=	$tblRelationships.term_taxonomy_id
	AND	$tblTerms.slug		=	'$szPage'"
							);

foreach(	$aryProducts[ 1 ] as	$objProduct	)
{	$szPostTitle	=	$objProduct -> post_title;
	$szPostURI	=	$objProduct -> guid;

	$nImageID	=	$objProduct -> meta_value;
	$szImageURI	=	$szSiteURL
		.	'/wp-content/plugins/wp-e-commerce/wpsc-theme/wpsc-images/noimage.png';
	
	if(	$aryProducts[ 0 ][ $nImageID ] -> guid	!=
			NULL
	&&	$aryProducts[ 0 ][ $nImageID ] -> guid	!=
			'http://teddyshoes.com/wp-content/uploads/2012Mar26/'
		)
		$szImageURI =	$aryProducts[ 0 ][ $nImageID ] -> guid;

	echo	"<a	href	=	'$szPostURI'	>
		<div	class	=	'product_overview
					padding'
			style	=	'background-image:	url( $szImageURI );
					background-size:	cover;'
		>
			<span	class	=	'category-name'	>
				$szPostTitle
			</span>
		</div>	</a>";
}
?>
