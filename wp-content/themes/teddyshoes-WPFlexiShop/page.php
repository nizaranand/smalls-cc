<?php
get_header();
?>

<div id="content-wrapper">
<div id="main-content" class="container">	
<div class="margin">
	<div id="main-col">
			
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

if(	have_posts()	)
while(	have_posts()	)
{	the_post();
	the_content();
//	wp_link_pages( array( 'before' => '' . __( 'Pages:', 'flexishop' ), 'after' => '' ) );
//	edit_post_link( __( 'Edit', 'flexishop' ), '', '' );
}

$szPage	=	substr(	$_SERVER[ 'REQUEST_URI' ],
			1
			);

if(	$wpdb -> get_results(
		"SELECT name
		FROM	$tblTerms
		WHERE	slug	=	'$szPage'"
				)	!=	NULL
	)
	include	'includes/products-categories.php';
else
{	$szCategory	=	substr(	$szPage,
					0,
					strpos(	$szPage,
						'/'
					)	);
	$nPage		=	( int ) substr(
		$szPage,
		strlen(	$szCategory	) + 1,
		-1
				);

	if(	$nPage	!=	NULL	)
		include	'includes/products-single.php';
}
?>

	</div>
	<div id="sidebar">
	<div class="sidebar-inner">
				
<?php
get_sidebar();
?>

	</div>	</div>
</div>	</div>	</div>

<?php
get_footer();
?>
