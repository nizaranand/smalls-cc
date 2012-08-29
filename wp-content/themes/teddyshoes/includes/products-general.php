<ul	class	=	'front-category-list'	>

<?php
/*	jonathan@smalls.cc	2012 April 4
This code is supposed to render the general products page. I think that I want
it to produce the product categories, and make people choose that way. This
code is pasted from /FUNCTIONS/FRONTCATEGORIES.PHP.

if ( have_posts() )
{	while ( have_posts() ) :
		the_post();			
		the_content();
	endwhile;
}
*/

$SQL				=
	"SELECT  wp_posts.guid,
				wp_terms.name,
				wp_terms.slug
	FROM		wp_terms,
				wp_term_relationships,
				wp_term_taxonomy,
				wp_postmeta,
				wp_posts
	WHERE		wp_terms.term_id			=	wp_term_relationships.term_taxonomy_id
		AND	wp_terms.term_id			=	wp_term_taxonomy.term_id
		AND	'wpsc_product_category'	=	wp_term_taxonomy.taxonomy
		AND	wp_postmeta.post_id		=	wp_term_relationships.object_id
		AND	wp_postmeta.meta_key		=	'_thumbnail_id'
		AND	wp_postmeta.meta_value	=	wp_posts.ID
		AND	wp_posts.guid				!=	'http://teddyshoes.smalls.cc/wp-content/uploads/2012Mar26/'
		AND	wp_term_taxonomy.parent	!=	241
	GROUP BY	wp_terms.term_id
	ORDER BY	wp_terms.name";
$aryCategories	=	$wpdb	->	get_results	(	$SQL,
														OBJECT_K
													);

foreach	(	$aryCategories	as	$objCategory	)
{	$szCategory		=	$objCategory	->	name;
	$szCategoryURI	=	$szSiteURL
							.	'?wpsc_product_category='
							.	$objCategory	->	slug;
	$szImageURI	=	$objCategory	->	guid;		

	echo
		"<li	class	=	'col-right'	>
		<a	href	=	'$szCategoryURI'
			class	=	'category-thumbnail'
		>
		<div class='padding'>
			<img	src	=	'$szImageURI'
					alt	=	'$szCategory'
			/>
			<span	class	=	'category-name'	>	$szCategory	</span>
		</div>	</a>	</li>";

}
?>

</ul>