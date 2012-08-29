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
/*	jonathan@smalls.cc	2012 March 30
$NPAGE will only be greater than zero on individual product pages. Otherwise
the REQUEST_URI is too long, and the integer will return as zero.

/*	jonathan@smalls.cc	2012 April 4
This code is intended to execute on an individual product page. It renders the
whole shebang associated with an individual product.

	jonathan@smalls.cc	2012 April 20
You can probably see that I use Google Checkout for this site, because the
WPSC shopping cart is not readily available to developers. Eff the police, I
make my own rules.
*/

$szPostContent	=	$aryListing[	$nPage	]	->	post_content;
$szPostTitle	=	$aryListing[   $nPage	]	->	post_title;
$szPostID		=	$aryListing[	$nPage	]	->	ID;
$szSQL			=
	"SELECT	meta_key,
				meta_value
		FROM	wp_postmeta	INNER JOIN wp_posts
		ON		wp_postmeta.post_id	=	wp_posts.ID
	WHERE		wp_postmeta.post_id	=	$nPage";
$aryImageID		=	$wpdb	->	get_results	(	$szSQL,
														OBJECT_K
													);
$nProductPrice	=	$aryImageID	[	'_wpsc_price'		]	->	meta_value;
$nImageID		=	$aryImageID	[	'_thumbnail_id'	]	->	meta_value;
$szImageURI		=	$szSiteURL
						.	'/wp-content/plugins/wp-e-commerce/wpsc-theme/wpsc-images/noimage.png';
	if	(	$aryListing	[	(	int	)	$nImageID	]	->	guid	!=	NULL
	&&		$aryListing	[	(	int	)	$nImageID	]	->	guid	!=
				$szSiteURL
				.	'/wp-content/uploads/2012Mar26/'
		)
		$szImageURI		=	$aryListing	[	(	int	)	$nImageID	]	->	guid;
		
echo	"<img	class	=	'product_detail
							product-image'
				src	=	'$szImageURI'
		/>";
echo	"<ul	class	=	'product-single-options'	>";

if	(	strripos	(	$szPostTitle,
						'shoe'
					)  !==   false
||		strripos	(	$szPostTitle,
						'boot'
					)  !==   false
||		strripos	(	$szPostTitle,
						'heel'
					)  !==   false
   )
{	$bShoes	=	true;

	$szSQL         =  "SELECT  wp_terms.name,
										wp_terms.slug
	                  FROM     wp_terms,
	                           wp_term_taxonomy
	                  WHERE    wp_term_taxonomy.term_id   =  wp_terms.term_id
	                  AND      wp_term_taxonomy.parent    =  237
	                  ORDER BY	wp_terms.name";
	$aryShoeWidth  =  $wpdb -> get_results(   $szSQL   );
	$szSQL         =  "SELECT  wp_terms.name,
										wp_terms.slug
	                  FROM     wp_terms,
	                           wp_term_taxonomy
	                  WHERE    wp_term_taxonomy.term_id   =  wp_terms.term_id
	                  AND      wp_term_taxonomy.parent    =  238
	                  ORDER BY	CAST(	wp_terms.name	AS	UNSIGNED INTEGER	)";
	$aryShoeLength =  $wpdb -> get_results(   $szSQL   );
	$aryShoeSize   =  array();
	foreach( $aryShoeLength as $objShoeLength )
	foreach( $aryShoeWidth  as $objShoeWidth  )
	{  $szShoeSize    			=  $objShoeLength -> name
	                     			.  $objShoeWidth  -> name;
		$szShoeSlug    			=  $objShoeLength -> slug
											.	'-'
	                     			.  $objShoeWidth  -> slug;
		$objShoeSize				=	new	stdClass();
		$objShoeSize	->	name	=	$szShoeSize;
		$objShoeSize	->	slug	=	$szShoeSlug;
		$aryShoeSize[]				=	$objShoeSize;
	}
	
	echo	"<li>	<select>
					<option>	Size	</option>";

	foreach	(	$aryShoeSize	as	$objShoeSize	)
	{	$szName		=	$objShoeSize	->	name;
		$szSlug		=	$objShoeSize	->	slug;
		$szSQLSlug	=	'-'
							.	$szSlug;
		$szSQL		=	"SELECT	wp_posts.ID
							FROM		wp_posts,
										wp_postmeta
							WHERE		LOCATE	(	'$szSlug',
														wp_posts.post_name
													)					>	0
							AND		wp_posts.post_parent		=	$szPostID
							AND		wp_postmeta.post_id		=	wp_posts.ID
							AND		wp_postmeta.meta_key		=	'_wpsc_stock'
							AND		wp_postmeta.meta_value	>	0";
		$aryStock	=	$wpdb	->	get_results	(	$szSQL	);
		$nResults	=	count(	$aryStock	);

		if	(	$nResults	==	1	)
			echo	"<option	class	=	'product-attr-$szSlug'	>	$szName	</option>";
	}

	echo	"</select>	</li>";
}/*	else
{	$szSQL					=
	   "SELECT	wp_terms.name,
					wp_terms.term_id
	   FROM		wp_terms,
					wp_term_taxonomy
		WHERE		wp_term_taxonomy.taxonomy	=	'wpsc-variation'
		AND		wp_term_taxonomy.term_id	=	wp_terms.term_id
		AND		wp_term_taxonomy.parent		=	0
		ORDER BY	wp_terms.term_id";
	$aryOption_Parents	=	$wpdb	->	get_results	(	$szSQL,
																OBJECT_K
															);
															
	foreach	(	$aryOption_Parents	as	$objTerm_Parent	)
	{	$szSlug	=	$objTerm_Parent	->	slug;
		$szName	=	$objTerm_Parent	->	name;
		$nTermID	=	$objTerm_Parent	->	term_id;
		$szSQL		=
			"SELECT	wp_terms.name,
						wp_terms.slug
			FROM		wp_terms,
						wp_term_taxonomy
			WHERE		wp_term_taxonomy.parent		=	$nTermID
			AND		wp_term_taxonomy.term_id	=	wp_terms.term_id";
		$aryStock	=	$wpdb	->	get_results	(	$szSQL	);
	
		echo	"<li>	<select>
					<option>	$szName	</option>";
	
		foreach	(	$aryOptions	as	$objTerm_ID	)
	   if (  $objTerm_ID	->	parent	   ==	$nTermID	)
		{	$szName	=	$objTerm_ID	->	name;
		
			echo	"<option	class	=	'product-attr-$szSlug'	>	$szName	</option>";
		}
	
		echo	"</select>	</li>";
}	}*/
		
echo	"<li	class	=	'product-price'		>	Price:	$ $nProductPrice	</li>";
?>

			<li>	<div	alt		=	'Add to cart'
		   				class		=	'googlecart-add-button'
		   				role		=	'button'
		   				tabindex	=	'0'
	   			>
	   	</div>	</li>
		</ul>
		
<?php
if (  $bShoes	==	true	)
   include  'shoesize-conversion.php';
?>

	</div>
	<div	class	=	'product-single-details'	>

<?php
echo	"<h2	class	=	'product-title'	>	$szPostTitle	</h2>
		$szPostContent
		<br/>";
		
$nPostID       =  (  int   )  $szPostID;
$szSQL         =
   "SELECT  wp_term_taxonomy.parent,
            wp_terms.slug
   FROM     wp_terms,
            wp_term_relationships,
            wp_term_taxonomy
   WHERE    $nPostID                =  wp_term_relationships.object_id
   AND      wp_term_relationships.term_taxonomy_id  =
               wp_term_taxonomy.term_taxonomy_id
   AND      'wpsc_product_category' =  wp_term_taxonomy.taxonomy
   AND      wp_terms.term_id        =  wp_term_relationships.term_taxonomy_id
   ORDER BY wp_term_taxonomy.parent	DESC";
$aryGroups		=	$wpdb	->	get_results	(	$szSQL	);
$nGroups       =  count (  $aryGroups  );
$nPosition     =  rand  (  1,
                           $nGroups - 1
                        );

/* jonathan@smalls.cc   2012 May 27
Wordpress clearly has built in comment functionality, but I choose not to use
it for serveral reasons. The biggest of which is that outsourcing comments to
Facebook, or Yelp eliminates the need to manage the comments my self. The other
is that it allows us to share comments between sites, and populate the area
with better endorsements. 
*/
$szBrand       =  $aryGroups[ 0   ]  -> slug;
$szType        =  $aryGroups[ $nPosition  ]  -> slug;
$szProductSlug =  $szBrand
                  .  '-'
                  .  $szType
                  .  '.smalls.cc';
   
echo	"<div	class				=	'fb-comments'
				data-href		=	'$szProductSlug'
				data-num-posts	=	'2'
		>	</div>";
?>

	</div>
</div>