<?php
$wpdb;

$arySizeOption	=	array	(	238	);
$aryCategories	=	array	(	39,	38,	35,	34,	33,	32,	31,	30,
									29,	28,	27,	26,	25,	22,	21,	20,
									19,	17,	16,	14,	13,	11,	10,	8,
									7,		5
								);
for(	$nOption	=	0;
		$nOption	<	count	(	$arySizeOption	);
		$nOption++		
	)
{	$thisOption	=	$arySizeOption[	$nOption	];
					
	for(	$nCategory	=	0;
			$nCategory	<	count	(	$aryCategories	);
			$nCategory++
		)
	{	$thisCategory		=	$aryCategories[	$nCategory	];
		$szSQL				=
			"SELECT	object_id
				FROM	wp_term_relationships,
						wp_posts
			WHERE		wp_posts.post_type							=	'wpsc-product'
				AND	wp_term_relationships.term_taxonomy_id	!=	$thisOption
			GROUP BY	object_id";
		$aryProductsAll	=	$wpdb	->	get_results	(	$szSQL,
																	OBJECT_K
																);

		$szSQL			=
			"SELECT	term_id
				FROM	wp_term_taxonomy
			WHERE		parent	=	$thisOption";
		$aryShoeLength	=	$wpdb	->	get_results	(	$szSQL,
																OBJECT_K
															);

		foreach	(	$aryProductsAll	as	$nPosition	)
		{	$nProductID	=	$nPosition	->	object_id;
			$szSQL		=
				"INSERT	INTO	wp_term_relationships
					(	object_id,
						term_taxonomy_id,
						term_order
					)	VALUES
					(	$nProductID	,
						$thisOption	,
						0
					)";
			$wpdb	->	query	(	$szSQL	);
	
			foreach	(	$aryShoeLength	as	$nTerm	)
			{	$nTermID	=	$nTerm	->	term_id;
				$szSQL	=
					"INSERT	INTO wp_term_relationships
						(	object_id,
							term_taxonomy_id,
							term_order
						)
					VALUES	(	$nProductID	,
									$nTermID	,
									0	
								)";
				$wpdb	->	query	(	$szSQL	);
}	}	}	}
?>