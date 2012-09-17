<div	id	=	"fb-root"	>	</div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<div	class	=	'product-single
			product'
>
	<div	class	=	'product-single-data'	>
    
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

$szSiteURL	=	get_bloginfo(	'wpurl'	);
/*	jonathan@smalls.cc	2012 March 30
 *	$NPAGE will only be greater than zero on individual product pages. Otherwise
 *	the REQUEST_URI is too long, and the integer will return as zero.
 */

/*	jonathan@smalls.cc	2012 April 4
 *	This code is intended to execute on an individual product page. It renders
 *	the whole shebang associated with an individual product.
 */

/*	jonathan@smalls.cc	2012 April 20
 *	You can probably see that I use Google Checkout for this site, because the
 *	WPSC shopping cart is not readily available to developers. Eff the police,
 *	I make my own rules.
 */

echo "2";
$aryProducts[ 0 ]	=	$wpdb -> get_results(
	"SELECT $tblPosts.ID,
		$tblPosts.guid
	FROM	$tblPosts
	WHERE	$tblPosts.post_type	=	'attachment'",
	OBJECT_K
							);
$aryProducts[ 1 ]	=	$wpdb -> get_results(
	"SELECT	$tblPosts.ID,
		$tblPosts.post_title,
		$tblPosts.guid,
		$tblPostMeta.meta_value,
		$tblPosts.post_content
	FROM	$tblPostMeta,
		$tblPosts,
		$tblTerms,
		$tblRelationships
	WHERE	$tblPostMeta.post_id	=	$tblPosts.ID
	AND	$tblPostMeta.meta_key	=	'_thumbnail_id'
	AND	$tblPosts.ID		=	$tblRelationships.object_id
	AND	$tblTerms.term_id	=	$tblRelationships.term_taxonomy_id
	AND	$tblTerms.slug		=	'$szCategory'",
	OBJECT_K
							);

echo "3";
$szPostContent	=	$aryProducts[ 1 ][ $nPage ] -> post_content;
$szPostName	=	$aryProducts[ 1 ][ $nPage ] -> post_name;
$szPostTitle	=	$aryProducts[ 1 ][ $nPage ] -> post_title;
$nImageID	=	$aryProducts[ 1 ][ $nPage ] -> meta_value;
$szImageURI	=	$szSiteURL
			.	'/wp-content/plugins/wp-e-commerce/wpsc-theme/wpsc-images/noimage.png';
if(	$aryProducts[ 0 ][ $nImageID ] -> guid	!=	NULL
&&	$aryProducts[ 0 ][ $nImageID ] -> guid	!=
		$szSiteURL
		.	'/wp-content/uploads/2012Mar26/'
	)
	$szImageURI	=	$aryProducts[ 0 ][ $nImageID ] -> guid;

echo	"<img	class	=	'product_detail
				product-image'
		src	=	'$szImageURI'
	/>
	<ul	class	=	'product-single-options'	>";

if(	strripos(	$szPostTitle,
			'shoe'
		)	!==	false
||	strripos(	$szPostTitle,
			'boot'
		)	!==	false
||	strripos(	$szPostTitle,
			'heel'
		)	!==	false
||	strripos(	$szPostTitle,
			'sneaker'
		)	!==	false
	)
	include	'options-shoes.php';
elseif(	strripos(	$szPostTitle,
			'pants'
		)	!==	false
	include	'options-pants.php';
{	$aryOption_Parents	=	$wpdb -> get_results(
		"SELECT	$tblTerms.name,
			$tblTerms.term_id
		FROM	$tblTerms,
			$tblTaxonomy
		WHERE	$tblTaxonomy.taxonomy	=	'wpsc-variation'
		AND	$tblTaxonomy.term_id	=	$tblTerms.term_id
		AND	$tblTaxonomy.parent	=	0
		ORDER BY	$tblTerms.term_id",
		OBJECT_K
								);

	foreach	(	$aryOption_Parents	as	$objTerm_Parent	)
	{	$szSlug	=	$objTerm_Parent	->	slug;
		$szName	=	$objTerm_Parent	->	name;
		$nTermID	=	$objTerm_Parent	->	term_id;
		$aryStock	=	$wpdb -> get_results(	
			"SELECT	$tblTerms.name,
				$tblTerms.slug
			FROM	$tblTerms,
				$tblTaxonomy
			WHERE	$tblTaxonomy.parent	=	$nTermID
			AND	$tblTaxonomy.term_id	=	$tblTerms.term_id"
								);
	
		echo	"<li>	<select>
					<option>	$szName	</option>";
	
		foreach	(	$aryOptions	as	$objTerm_ID	)
		if(	$objTerm_ID -> parent	   ==	$nTermID	)
		{	$szName	=	$objTerm_ID -> name;
		
			echo	"<option	class	=	'product-attr-$szSlug'	>
					$szName
				</option>";
		}
	
		echo	"</select>	</li>";
}	}

$objProductMeta	=	$wpdb -> get_results(
	"SELECT	$tblPostMeta.post_id,
		$tblPostMeta.meta_key,
		$tblPostMeta.meta_value
	FROM	$tblPostMeta
	WHERE	$tblPostMeta.meta_key	=	'_wpsc_price'
	AND	$tblPostMeta.post_id	=	$nPage",
	OBJECT_K
						);
$nProductPrice	=	$objProductMeta[ $nPage ] -> meta_value;

echo	"	<li	class	=	'product-price'		>
			Price:	$ $nProductPrice
			<div	alt		=	'Add to cart'
			   	class		=	'googlecart-add-button'
				role		=	'button'
				style		=	'float:	right;'
			   	tabindex	=	'0'
		   	>	</div>
		</li>
	</ul>";

if(	$bShoes	==	true	)
	include	'shoesize-conversion.php';
?>

	</div>
	<div	class	=	'product-single-details'	>

<?php
echo	"<h2	class	=	'product-title'	>	$szPostTitle	</h2>
		$szPostContent
		<br/>";
		
/*	jonathan@smalls.cc   2012 May 27
 * 	Wordpress clearly has built in comment functionality, but I choose not to
 * 	use it for several reasons. The biggest of which is that outsourcing
 * 	comments to Facebook, or Yelp eliminates the need to manage the comments
 * 	my self. The other is that it allows us to share comments between sites,
 * 	and populate the area with better endorsements. 
 */

$aryGroups	=	$wpdb -> get_results(
	"SELECT	$tblTaxonomy.parent,
		$tblTerms.slug
	FROM	$tblTerms,
		$tblRelationships,
		$tblTaxonomy
	WHERE	$nPage				=	$tblRelationships.object_id
	AND	$tblTaxonomy.term_taxonomy_id	=
			$tblRelationships.term_taxonomy_id
	AND	'wpsc_product_category'		=	$tblTaxonomy.taxonomy
	AND	$tblTerms.term_id		=
			$tblRelationships.term_taxonomy_id
	ORDER BY	$tblTaxonomy.parent	DESC"
						);
$nPosition	=	rand(	1,
				count(  $aryGroups  ) - 1
				);
$szProductSlug	=	$aryGroups[ 0 ] -> slug
			.	'-'
			.	$aryGroups[ $nPosition ] -> slug
			.	'.smalls.cc';

echo	"<div	class		=	'fb-comments'
		data-href	=	'$szProductSlug'
		data-num-posts	=	'5'
		data-width	=	400px
	>	</div>";

?>

	</div>
</div>
