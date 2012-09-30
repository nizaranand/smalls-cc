<?php
function	SetTables()
/*	jonathan@smalls.cc	2012 September 26
 *	assigns database table names to  variables for use in custom queries
 *	initiates $WPDB object
 */
{	global	$wpdb;
	$aryTables;

/*	jonathan@smalls.cc	2012 Septmeber 26
 *	Wordpress default tables
 */
	$aryTables[ 'tblCommentMeta' ]
		=	$wpdb -> base_prefix . 'commentmeta';
	$aryTables[ 'tblComments' ]
		=	$wpdb -> base_prefix . 'comments';
	$aryTables[ 'tblLinks' ]
		=	$wpdb -> base_prefix . 'links';
	$aryTables[ 'tblOptions' ]
		=	$wpdb -> base_prefix . 'options';
	$aryTables[ 'tblPostMeta' ]
		=	$wpdb -> base_prefix . 'postmeta';
	$aryTables[ 'tblPosts' ]
		=	$wpdb -> base_prefix . 'posts';
	$aryTables[ 'tblTerms' ]
		=	$wpdb -> base_prefix . 'terms';
	$aryTables[ 'tblRelationships' ]
		=	$wpdb -> base_prefix . 'term_relationships';
	$aryTables[ 'tblTaxonomy' ]
		=	$wpdb -> base_prefix . 'term_taxonomy';
	$aryTables[ 'tblUserMeta' ]
		=	$wpdb -> base_prefix . 'usermeta';
	$aryTables[ 'tblUsers' ]
		=	$wpdb -> base_prefix . 'users';

	return	$aryTables;
}
?>
