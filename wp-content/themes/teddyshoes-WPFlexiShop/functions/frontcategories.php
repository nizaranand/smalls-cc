<div	class	=	'slider-mask'	>
<div	class	=	'front-category-slider'	>
<div	class	=	'full-width'	>
<ul	class	=	'front-category-list'	>

<?php
$tblCommentMeta		=	$GLOBALS[ 'tblCommentMeta' ];
$tblComments		=	$GLOBALS[ 'tblComments' ];
$tblLinks		=	$GLOBALS[ 'tblLinks' ];
$tblOptions		=	$GLOBALS[ 'tblOptions' ];
$tblPostMeta		=	$GLOBALS[ 'tblPostMeta' ];
$tblPosts		=	$GLOBALS[ 'tblPosts' ];
$tblTerms		=	$GLOBALS[ 'tblTerms' ];
$tblRelationships,	=	$GLOBALS[ 'tblRelationships' ];
$tblTaxonomy		=	$GLOBALS[ 'tblTaxonomy' ];
$tblUserMeta		=	$GLOBALS[ 'tblUserMeta' ];
$tblUsers		=	$GLOBALS[ 'tblUsers' ];

/*	jonathan@smalls.cc	2012 March 30
 *	Eff their access keys. I just rewrote their functions to work without like
 *	a true gangster.
 */

$aryCategories	=	$wpdb -> get_results(	
	"SELECT	$tblPosts.guid,
		$tblTerms.name,
		$tblTerms.slug
	FROM	$tblTerms,
		$tblRelationships,
		$tblTaxonomy,
		$tblPostMeta,
		$tblPosts
	WHERE	$tblTerms.term_id	=	$tblRelationships.term_taxonomy_id
	AND	$tblTerms.term_id	=	$tblTaxonomy.term_id
	AND	'wpsc_product_category'	=	$tblTaxonomy.taxonomy
	AND	$tblPostMeta.post_id	=	$tblRelationships.object_id
	AND	$tblPostMeta.meta_key	=	'_thumbnail_id'
	AND	$tblPostMeta.meta_value	=	$tblPosts.ID
	AND	$tblPosts.guid		!=
			'http://teddyshoes.smalls.cc/wp-content/uploads/2012Mar26/'
	AND	$tblTaxonomy.parent	!=	0
	AND	$tblTaxonomy.parent	!=	241
	GROUP BY	$tblTerms.term_id
	ORDER BY	$tblTerms.name
	LIMIT		40",
	OBJECT_K
						);

foreach	(	$aryCategories	as	$objSlide	)
{	$szImageURI	=	$objSlide -> guid;
	$szCategory	=	$objSlide -> name;

/*	jonathan@smalls.cc	2012 July 25
 *
 *	pointing slideshow categories to Prostores directory
 *	until the Wordpress database is good to go
 *
  	$szCategoryURI	=	get_bloginfo(	'wpurl'	)
 				.	'/'
 				.	$objSlide -> slug;
 */
	$szCategoryURI	=	'http://storesense1.mysuperpageshosting.com/teddyshoes_com/-strse-'
				.	$objSlide -> slug
				.	'/Categories.bok';

	echo	"<li	class	=	'col-right'	>
		<a	href	=	'$szCategoryURI'
			class	=	'category-thumbnail'
		>
		<div class='padding'>
			<img	src	=	'$szImageURI'
				alt	=	'$szCategory'
			/>
			<span	class	=	'category-name'	>
				$szCategory
			</span>
		</div>	</a>	</li>";
		
	$nPosition++;
	if	(	$nPosition	==	10
	||		$nPosition	==	20
	||		$nPosition	==	30
	||		$nPosition	==	40
		)
		echo	"</ul>	</div>
			<div	class	=	'full-width'	>
			<ul	class	=	'front-category-list'	>";

}
/*	jonathan@smalls.cc	2012 April 3
This was the corps of the original code, or at least what I saved of it. I hate
the way that these guys program any way. They enter, and escape PHP like that
is in some way simpler than an ECHO statement.

if	(	($i%5)==4	) echo 'class='col-right''>
			<div class='padding'>
				<a href='<?php echo $url ?>' class='category-thumbnail <?php if(empty($image)) echo 'no-cat-image'; ?>'><?php if(!empty($image)) : ?><img src='<?php echo $image ?>' alt='<?php echo $name ?>' /><?php endif; ?><span class='category-name'><?php echo $name ?></span></a>
			</div>
		</li>
		<?php if(($i%5)==4) echo '</div>' ?>
<?php } ?>
<?php if(($i%5)!=4) echo '</div></ul>' ?>
*/
?>

</ul>	</div>	</div>	</div>
