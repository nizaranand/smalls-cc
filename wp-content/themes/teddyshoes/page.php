<?php
get_header();
?>

<div id="content-wrapper">
<div id="main-content" class="container">	
<div class="margin">
	<div id="main-col">
			
<?php $wpdb;
if ( have_posts() )
while ( have_posts() ) :
	the_post();
	the_content();
	wp_link_pages( array( 'before' => '' . __( 'Pages:', 'flexishop' ), 'after' => '' ) );
	edit_post_link( __( 'Edit', 'flexishop' ), '', '' );
endwhile;

$Page		=	substr(	$_SERVER[	'REQUEST_URI'	],
							strlen( '/?page_id='   )
						);
$nPage	=	(	int	)	$Page;

if (  $nPage   != NULL  )
{  switch(  $nPage   )
   {  case  768:
         $szSQL   =  "SELECT	*
               		FROM		wp_posts
               		WHERE		post_type		=	'affiliate'";
         break;

      case   4005:
         $szSQL   =  "SELECT  *
                     FROM     wp_posts
                     WHERE    wp_posts.post_parent =  4005
                     AND      wp_posts.post_status =  'publish'
                     AND      wp_posts.post_type   =  'page'";
         break;  
   }
   
   $aryListing		=	$wpdb	->	get_results	(	$szSQL,
   														OBJECT_K
   													);
   
   foreach	(	$aryListing as $nPostID	)
   {	$szPostTitle	=	$nPostID	->	post_title;
   	$szPostURI		=	$nPostID	->	guid;
   	$szPostContent	=	$nPostID	->	post_content;
   	
   	echo
   		"<a	href	=	'$szPostURI'	>
   		<div	class	=	'affiliate'	>
   			<h3>	$szPostTitle	</h3>
   			$szPostContent
   		</div>	</a>";
}  }
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