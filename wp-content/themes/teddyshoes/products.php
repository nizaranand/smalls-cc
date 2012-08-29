<?php
/*	Template Name: Store
*/
get_header();
$szSiteURL	=	get_bloginfo(	'wpurl'	);
?>

<div 	id	='content-wrapper'	>
<div 	id		=	'products'
		class	=	'row container'
>
<div	class	=	'margin'	>

<?php
$szProduct	=	substr(	$_SERVER[	'REQUEST_URI'	],
								strlen(	'/?wpsc-product='	)
							);
$nPage		=	(	int	)	$szProduct;
$szPage		=	substr(	$_SERVER[	'REQUEST_URI'	],
								strlen(	'/?wpsc_product_category='	)
							);
							
global	$wpdb;
$szSQL		=
	"SELECT	ID,
				post_content,
				post_title,
				post_name,
				guid,
				post_type,
				post_mime_type
	FROM		wp_posts
	WHERE		(	wp_posts.post_type		=	'wpsc-product'
		AND		wp_posts.post_parent		=	0
				)
	OR			wp_posts.post_mime_type	=	'image/jpeg'";
$aryListing		=	$wpdb	->	get_results	(	$szSQL,
														OBJECT_K
													);
$nListingCount	=	count(	$aryListing	);

if	(	$nPage	!=	0
&&		$szPage	==	false
	)
	include	'includes/products-single.php';

if	(	$szPage	!=	false
&&		$nPage	==	0
	)
	include	'includes/products-categories.php';

if	(	$nPage		==	0
&&		$szProduct	==	false
	)
	include	'includes/products-general.php';
?>

</div>	</div>	</div>

<?php
get_footer();
?>