<?php
get_header();
?>

<div id="content-wrapper">
	<div id="main-content" class="container">	
		<div class="margin">
			<div id="main-col">
			
<?php
if ( have_posts() )
while ( have_posts() ) :
	the_post();
	the_content();
	wp_link_pages( array( 'before' => '' . __( 'Pages:', 'flexishop' ), 'after' => '' ) );
	edit_post_link( __( 'Edit', 'flexishop' ), '', '' );
endwhile;

/*
$nPageID	=	get_the_ID();
if	(	$nPageID	==	768	)
{	
}
*/
?>

			</div>
			<div id="sidebar">
			<div class="sidebar-inner">
				
<?php
get_sidebar();
?>

</div>	</div>	</div>	</div>	</div>

<?php
get_footer();
?>