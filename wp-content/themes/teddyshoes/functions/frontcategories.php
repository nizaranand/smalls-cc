<div	class	=	'slider-mask'	>
<div	class	=	'front-category-slider'	>
<div	class	=	'full-width'	>
<ul	class	=	'front-category-list'	>

<?php
/*	jonathan@smalls.cc	2012 March 30
Eff their access keys. I just rewrote their functions to work without like a
true gangster.
*/
$SQL				=
	"SELECT  wp_posts.guid,
				wp_terms.name,
				wp_terms.slug
	FROM		wp_terms,
				wp_term_relationships,
				wp_term_taxonomy,
				wp_postmeta,
				wp_posts
	WHERE		wp_terms.term_id			=	wp_term_relationships.term_taxonomy_id
		AND	wp_terms.term_id			=	wp_term_taxonomy.term_id
		AND	'wpsc_product_category'	=	wp_term_taxonomy.taxonomy
		AND	wp_postmeta.post_id		=	wp_term_relationships.object_id
		AND	wp_postmeta.meta_key		=	'_thumbnail_id'
		AND	wp_postmeta.meta_value	=	wp_posts.ID
		AND	wp_posts.guid				!=	'http://teddyshoes.smalls.cc/wp-content/uploads/2012Mar26/'
		AND	wp_term_taxonomy.parent	!=	241
	GROUP BY	wp_terms.term_id
	ORDER BY	wp_terms.name
	LIMIT		50";
$aryCategories	=	$wpdb	->	get_results	(	$SQL,
														OBJECT_K
													);

$nPosition	=	0;
foreach	(	$aryCategories	as	$objSlide	)
{	$szImageURI		=	$objSlide	->	guid;
	$szCategory		=	$objSlide	->	name;
	$szCategoryURI	=	get_bloginfo(	'wpurl'	)
							.	'/?wpsc_product_category='
							.	$objSlide	->	slug;		

	echo
		"<li	class	=	'col-right'	>
		<a	href	=	'$szCategoryURI'
			class	=	'category-thumbnail'
		>
		<div class='padding'>
			<img	src	=	'$szImageURI'
					alt	=	'$szCategory'
			/>
			<span	class	=	'category-name'	>	$szCategory	</span>
		</div>	</a>	</li>";
		
	$nPosition++;
	if	(	$nPosition	==	10
	||		$nPosition	==	20
	||		$nPosition	==	30
	||		$nPosition	==	40
		)
		echo
			"</ul>	</div>
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
