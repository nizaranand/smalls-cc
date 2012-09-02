<?php
/*	Template Name: Store
*/
get_header();
$szSiteURL	=	get_bloginfo( 'wpurl' );
?>

<div 	id	=	'content-wrapper'	>
<div 	id	=	'products'
	class	=	'row container'
>
<div	class	=	'margin'	>

<?php
global	$wpdb,
	$tblCommentMeta,
	$tblComments,
	$tblLinks,
	$tblOptions,
	$tblPostMeta,
	$tblPosts,
	$tblTerms,
	$tblRelationships,
	$tblTaxonomy,	
	$tblUserMeta,
	$tblUsers;

$szRequestURI	=	$_SERVER[ 'REQUEST_URI' ];
$aryListing	=	$wpdb -> get_results(
	"SELECT	ID,
		post_content,
		post_title,
		post_name,
		guid,
		post_type,
		post_mime_type
	FROM	$tblPosts
	WHERE	(	$tblPosts.post_type	=	'wpsc-product'
		AND	$tblPosts.post_parent	=	0
		)
	OR	$tblPosts.post_mime_type	=	'image/jpeg'",
	OBJECT_K
						);

include	'includes/products-general.php';
?>

</div>	</div>	</div>

<?php
get_footer();
?>
