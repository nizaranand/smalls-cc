<?php
	echo	"<li>	<select>
			<option>	Size	</option>";

	$bShoes		=	true;
	$aryShoeWidth 	=	$wpdb -> get_results(   
		"SELECT	$tblTerms.name,
			$tblTerms.slug
		FROM	$tblTerms,
			$tblTaxonomy
		WHERE	$tblTaxonomy.term_id	=	$tblTerms.term_id
		AND	$tblTaxonomy.parent		=	237
		ORDER BY	$tblTerms.name"
   							);
	$aryShoeLength	=	$wpdb -> get_results(   
		"SELECT	$tblTerms.name,
			$tblTerms.slug
		FROM	$tblTerms,
			$tblTaxonomy
		WHERE	$tblTaxonomy.term_id	=	$tblTerms.term_id
		AND	$tblTaxonomy.parent	=	238
		ORDER BY	CAST( $tblTerms.name AS UNSIGNED INTEGER )"
   							);
	foreach(	$aryShoeLength as $objShoeLength	)
	foreach(	$aryShoeWidth as $objShoeWidth		)
	{	$objShoeSize		=	new	stdClass();
		$objShoeSize ->	name	=	$objShoeLength -> name
						.	$objShoeWidth  -> name;
		$objShoeSize ->	slug	=	$objShoeLength -> slug
						.	'-'
						.  $objShoeWidth  -> slug;
		$aryProduct[ 'size' ][]	=	$objShoeSize;
	}

	$aryProduct[ 'stock' ]	=	$wpdb -> get_results(
		"SELECT	$tblPosts.post_name,
			$tblPostMeta.meta_value
		FROM	$tblPosts,
			$tblPostMeta
		WHERE	$tblPosts.post_parent	=	$nPage
		AND	$tblPostMeta.post_id	=	$tblPosts.ID
		AND	$tblPostMeta.meta_key	=	'_wpsc_stock'
		AND	$tblPostMeta.meta_value	>	0"
								);

	foreach(	$aryProduct[ 'size' ] as $objSize	)
	foreach(	$aryProduct[ 'stock' ] as $objStock	)
	{	$szPostName	=	$objStock -> post_name;
		$szSizeName	=	$objSize -> name;
		$szSlug		=	$objSize -> slug;
		$szStock	=	'Back Ordered';
		if(	strripos(	$szPostName,
					"-$szSlug"
				)	!==	false
		&&	( int ) substr(	$szPostName,
					-1 * strlen(	"-$szSlug"	) - 1,
					1
					)	==	NULL
			)
			$szStock	=	NULL;

		echo	"<option	class	=	'product-attr-$szSlug'	>
				$szSizeName $szStock
			</option>";
	}

	echo	"</select>	</li>";
?>
