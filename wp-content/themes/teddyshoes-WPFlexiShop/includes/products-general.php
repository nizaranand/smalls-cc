<ul	class	=	'front-category-list'	>

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
This code is supposed to render the general products page. I think
that I want it to produce the product categories, and make people
choose that way. This code is pasted from /FUNCTIONS/FRONTCATEGORIES.PHP.

if ( have_posts() )
{	while ( have_posts() ) :
		the_post();			
		the_content();
	endwhile;
}
*/

$aryCategories	=	$wpdb -> get_results(
	"SELECT	$tblPosts.guid,
		$tblTerms.name,
		$tblTerms.slug
	FROM	$tblTerms,
		$tblRelationships,
		$tblTaxonomy,
		$tblPostMeta,
		$tblPosts
	WHERE	$tblTerms.term_id	=	$tblRelationships.term_taxonomy_id
	AND	$tblTerms.term_id	=	$tblTaxonomy.term_id
	AND	'wpsc_product_category'	=	$tblTaxonomy.taxonomy
	AND	$tblPostMeta.post_id	=	$tblRelationships.object_id
	AND	$tblPostMeta.meta_key	=	'_thumbnail_id'
	AND	$tblPostMeta.meta_value	=	$tblPosts.ID
	AND	$tblPosts.guid		!=	'http://teddyshoes.smalls.cc/wp-content/uploads/2012Mar26/'
	AND	$tblTaxonomy.parent	!=	241
	GROUP BY	$tblTerms.term_id
	
	ORDER BY	$tblTerms.name",
	OBJECT_K
						);

foreach(	$aryCategories as $objCategory	)
{	$szCategory	=	$objCategory -> name;
	$szCategoryURI	=	$szSiteURL
				.	'/'
				.	$objCategory ->	slug;
	$szImageURI	=	$objCategory -> guid;		

	echo	"<li	class	=	'col-right'	>
		<a	href	=	'$szCategoryURI'
			class	=	'category-thumbnail'
		>
		<div class='padding'>
			<img	src	=	'$szImageURI'
				alt	=	'$szCategory'
			/>
			<span	class	=	'category-name'	>
				$szCategory
			</span>
		</div>	</a>	</li>";
}
?>

</ul>
