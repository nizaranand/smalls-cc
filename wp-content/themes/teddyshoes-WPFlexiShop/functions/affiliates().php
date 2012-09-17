<?php
/*	jonathan@smalls.cc	2012 March 13
Steve has many relationships with local businesses, and likes to link
to them from his affiliates page.
*/
register_post_type(	'affiliate',
			array(
	'labels'	=>	array(
		'name'		=>	'Affiliates',
		'singular_name'	=>	'Affiliate',
					),
	'public'	=>	true,
	'supports'	=>	array(
		'excerpt',
		'thumbnail'
		)	)	);
?>
