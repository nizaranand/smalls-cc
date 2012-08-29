<?php
/*	jonathan@smalls.cc	2012 April 29
These are the core functions associated with the custom theme.
*/

add_action	(	'init',
					'create_post_type'
				);
				
function	PostType	(	$szType,
							$nNumber
						)
/*	jonathan@smalls.cc	2012 February 28
This function pulls custom post types, and renders them to the page. Set
$nNumber to 0 to render a randomized post.
*/
{	global	$wpdb;
	$szQuery		=	"SELECT	$wpdb->posts.*
								FROM		$wpdb->posts
								WHERE		$wpdb->posts.post_type	=	'$szType'";
	$aryOutput	=	$wpdb	->	get_results	(	$szQuery,
														ARRAY_A
													);
	$nEntries	=	count(	$aryOutput	) - 1;

	for(	$nPosition	=	$nEntries;
			$nPosition	>	0;
			$nPosition--
		)
	if	(	$aryOutput[	$nPosition	][	'post_status'	]	==	'publish'	)
	{	if	(	$nNumber	==	0	)
			$nPosition	=	rand	(	0,	$nEntries	);
	
		$szEntryTitle	=	$aryOutput[	$nPosition	][	'post_title'	];
		$szEntryText	=	$aryOutput[	$nPosition	][	'post_content'	];
		$szEntryURL		=	$aryOutput[	$nPosition	][	'guid'			];
		
		if	(	is_page()	==	true	)
			$szEntryText	=	Truncate	(	$szEntryText,	1000	);
				
		if	(	$nPosition	>	$nEntries - $nNumber	)
		{	echo
				"<center>	<h3	class	=	'$szType'	>
					$szEntryTitle
				</h3>	</center>
				$szEntryText
				<a	href	=	'$szEntryURL'	>	Read More?	</a>";
		}
		if	(	$szType	=	quote	)
		{	$szReturn	=	"$szEntryTitle - $szEntryText";
			return	(	$szReturn	);
			break;
		}
}	}

function Truncate	(	$string,
							$limit,
							$break=".",
							$pad="..."
						)
/*	jonathan@smalls.cc	2012 February 29
	http://www.the-art-of-web.com/php/truncate/
I pulled this function from the preceding URL, because PHP seems to lack a
truncate function of its own. This look good enough to me though.
*/
{	if	(	strlen(	$string	)	<=	$limit	)
		return $string;

  // is $break present between $limit and the end of the string?
	if	(	false !==	(	$breakpoint	=	strpos	(	$string,	$break,	$limit	)))
	{	if	(	$breakpoint	<	strlen(	$string	)	-	1	)
		{	$string	=	substr	(	$string,	0,	$breakpoint	) . $pad;
	}	}
    
  return $string;
}
?>