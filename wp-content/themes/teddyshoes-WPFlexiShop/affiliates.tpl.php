<?php
/*	Template Name:	Affiliates
 */

get_header();
?>

<div id="content-wrapper">
<div id="main-content" class="container">	
<div class="margin">
	<div id="main-col">
			
<?php
if(	have_posts()	)
while(	have_posts()	)
{	the_post();
	the_content();
//	wp_link_pages( array( 'before' => '' . __( 'Pages:', 'flexishop' ), 'after' => '' ) );
//	edit_post_link( __( 'Edit', 'flexishop' ), '', '' );
}

switch(  $_SERVER[ 'REQUEST_URI' ])
{	case	'/affiliates/':
	$szSQL	=
		"SELECT	wp_posts.post_title,
			wp_posts.guid,
			wp_posts.post_content,
			wp_posts.ID
		FROM	wp_posts
       	       	WHERE	post_type	=	'affiliate'";
        break;

	case	'/dress-codes/':
	$szSQL	=
		"SELECT	wp_posts.post_title,
			wp_posts.guid,
			wp_posts.post_content,
			wp_posts.ID
		FROM	wp_posts
		WHERE	wp_posts.post_parent	=	4005
		AND	wp_posts.post_status	=	'publish'
		AND	wp_posts.post_type	=	'page'";
}
   
$aryListing	=	$wpdb -> get_results(	$szSQL	);
$aryAttachment	=	$wpdb -> get_results(
	"SELECT	wp_posts.post_parent,
		wp_posts.guid
	FROM	wp_posts
	WHERE	wp_posts.post_type	=	'attachment'
	AND	wp_posts.post_parent	!=	0",
	OBJECT_K
						);
foreach(	$aryListing as $objPostID	)
{	$szPostTitle	=	$objPostID -> post_title;
	$szPostURI	=	$objPostID -> guid;
	$szPostContent	=	$objPostID -> post_content;
	$nPostID	=	$objPostID -> ID;
		
	if(	NULL	!=	$aryAttachment[ $nPostID ]	)
	{	$szImageURI	= $aryAttachment[ $nPostID ] -> guid;

   		echo	"<a	href	=	'$szPostURI'	>
			<div	class	=	'affiliate'	>
				<img	src	=	'$szImageURI'	>
				<h3>	$szPostTitle	</h3>
   				$szPostContent
			</div>	</a>";
	}
	else
   		echo	"<a	href	=	'$szPostURI'	>
			<div	class	=	'affiliate'	>
				<h3>	$szPostTitle	</h3>
   				$szPostContent
   			</div>	</a>";
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
