<ul class="category-list">

<?php	global	$tblTerms,
		$tblTaxonomy;
$aryCategories	=	$wpdb -> get_results(	
	"SELECT	*
	FROM	$tblTerms,
		$tblTaxonomy
	WHERE	$tblTerms.term_id	= $tblTaxonomy.term_id
	AND	$tblTaxonomy.taxonomy	=	'wpsc_product_category'
	AND	$tblTaxonomy.parent	=  3
	AND	$tblTerms.term_id	!=	3
	ORDER BY	$tblTerms.name",
	OBJECT_K
						);

foreach	(	$aryCategories	as	$objObjectID	)
{	$szCategory		=	$objObjectID -> name;
	$szCategoryURI	=	get_bloginfo(	'wpurl'	)
				.	'/'
				.	$objObjectID	->	slug;		

	echo
		"<a	href	=	'$szCategoryURI'	>	<li>
		$szCategory
		</li>	</a>";
}
/*	jonathan@smalls.cc	2012 April 7
 *	The standard code gets you up, and running, but I find that it is pretty
 *	limiting. For instance I only want this list to render parent categories,
 *	no children.

<?php wpsc_start_category_query($category_settings); ?>
		<li class='wpsc_category_<?php wpsc_print_category_id();?>'>
			<a href="<?php wpsc_print_category_url();?>" class='wpsc_category_image_link'>
				<?php wpsc_print_category_image(45, 25); ?>
			</a>

			<a href="<?php wpsc_print_category_url();?>" class="wpsc_category_link <?php wpsc_print_category_classes(); ?>">
				<?php wpsc_print_category_name();?>
				<?php if (get_option('show_category_count') == 1) : ?>
					<?php wpsc_print_category_products_count("(",")"); ?>
				<?php endif;?>
			</a>
			<?php wpsc_print_product_list(); ?>
			<?php wpsc_print_subcategory("<ul>", "</ul>"); ?>
		</li>
<?php wpsc_end_category_query(); ?>
 */
?>

</ul>
