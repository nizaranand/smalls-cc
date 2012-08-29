<script type="text/javascript">
	jQuery(document).ready(function($) {
		$("a#checkout-next").click(function(){
			$("#shopping-cart-form").fadeIn();
			var checkoutWidth = $("#shopping-cart").width() + 30;
			$("#checkout-bar-in").animate({width:'+=50%'});
			$("#checkout-slider").animate({marginLeft:'-=' + checkoutWidth});
		});
		$("a#checkout-back").click(function(){
			$("#shopping-cart-form").fadeOut();
			var checkoutWidth = $("#shopping-cart").width() + 30;
			$("#checkout-bar-in").animate({width:'-=50%'});
			$("#checkout-slider").animate({marginLeft:'+=' + checkoutWidth});
		});
		<?php $post_count = wp_count_posts('slider'); if($post_count->publish > 1 ) : ?>
		$('ul.feature-list').bxSlider({
            mode: '<?php echo $transition ?>',
            auto: true,
            easing: 'jswing',
            autoControls: true,
            autoHover: true,
            pager: true,
            speed: 1500,
            pause: 4000,
            controls: true,
            pagerSelector: '#slider-controls'
    	});
    	<?php endif; ?>
    	$('div.front-category-slider').bxSlider({
    		easing: 'jswing',
    		speed: 1500,
            pause: 5000,
            autoHover: true,
    		auto: true
    	});
    	$('a.large-blog-image, a.category-thumbnail img, li.latest-product div.padding').hover(function(){
    		$(this).fadeTo('slow', 0.5);
    	},
    	function(){
    		$(this).fadeTo('slow', 1);
    	});
    	$('ul.product-list li div.product-meta').hover(function(){
    		$(this).find('img').fadeTo('slow', 0.3);
    		$(this).find('input.wpsc_buy_button').show();
    	},
    	function(){
    		$(this).find('img').fadeTo('slow', 1);
    		$(this).find('input.wpsc_buy_button').hide();
    	});
    	$('#sidebar ul.sidebar-widgets li ul li').hover(function(){
    		$(this).animate({
    			paddingLeft: "+10px"
    		}, 100, 'jswing');
    	},
    	function(){
    		$(this).animate({
    			paddingLeft: "0px"
    		}, 100, 'jswing');
    	});
    	$('li.feature').hover(function(){
    		$(this).find('div.feature-post-wrapper').slideDown();
    	},
    	function(){
    		$(this).find('div.feature-post-wrapper').slideUp();
    	});
    	
    	$('input.wpsc_buy_button').click(function(){
    		var cartCount = $('#cart-top a span.cartcount').text();
    		var cartInt = parseInt(cartCount);
    		var quantity = parseInt($('#wpsc_quantity_update').val());
    		if (quantity > 1)
    			cartInt += quantity;
    		else
    			cartInt++;
 			$('#cart-top a span.cartcount').text(cartInt + " items");
    	});
    	$('span.emptycart a').click(function(){
    		$('#cart-top a span.cartcount').text("0 items");
    	});
    	$('#header #top-navigation ul li, #header #top-navigation ul li').hover(function(){
    		$(this).find('ul.children, ul.sub-menu').fadeIn();	
    	},
    	function(){
    		$(this).find('ul.children, ul.sub-menu').fadeOut();	
    	});
    	$('input.wpsc_product_search').val("Search Products...");
    	$('input.wpsc_product_search').click(function(){
    		$('input.wpsc_product_search').val("");
    	});
	});
</script>

<div id='featured-slider'>
<div id='feature-wrapper'>
<div id='features'>
<ul class='feature-list'>

<?php
$szSQL			=
	"SELECT  *
		FROM	wp_posts,
				wp_terms,
				wp_term_relationships,
				wp_postmeta
	WHERE		wp_terms.name			=	'frontpage-slide'
		AND	wp_terms.term_id		=	wp_term_relationships.term_taxonomy_id
		AND	wp_posts.ID				=	wp_term_relationships.object_id
		AND	wp_posts.ID				=	wp_postmeta.post_id
		AND	wp_postmeta.meta_key	=	'_thumbnail_id'";
$arySlides		=	$wpdb	->	get_results	(	$szSQL,
														OBJECT_K
													);
$szSQL			=
	"SELECT	*
		FROM	wp_posts,
				wp_postmeta
	WHERE		wp_posts.post_type	=	'promotion'
		AND	wp_posts.post_status	=	'publish'
		AND	wp_posts.ID				=	wp_postmeta.post_id
		AND	wp_postmeta.meta_key	=	'_thumbnail_id'";
$arySlides	=	array_merge	(	$arySlides,
										$wpdb	->	get_results	(	$szSQL,
																		OBJECT_K
									)								);

foreach	(	$arySlides	as	$ID	)
{	if	(	$ID	->	meta_value	!=	NULL	)
	{	$szSQL		=
			"SELECT	guid
				FROM	wp_posts
			WHERE		wp_posts.ID	="
			.	$ID	->	meta_value;
		$aryImage	=	$wpdb	->	get_results	(	$szSQL,
															ARRAY_N
														);
		$szImageURI	=	$aryImage[	0	][	0	];
	}	else
	{	$szImageURI	=	NULL;
	}
	
	echo	"<li>	<a	href	=	'"
			.	$ID	->	guid
			.	"'	>
				<img	class	=	'slide-background'
						src	=	'$szImageURI' />
				<div	class	=	'slide-footer'	>
					<h2>"
			.		$ID	->	post_title
			.		"</h2>	<p>"
			.		$ID	->	post_content
			.		"</p>
				</div>
			</a>	</li>";
}
												
/*	jonathan@smalls.cc	2012 April 24
Here is what I saved of the original code for this front page slider. It was
cool originally, but I could not easily get the images to load after the first
time using it, so I just reprogrammed it altogether. 

$products		=	array();
$promotions		=	array();
$posts			=	array();
$options			=	get_option(	'site_basic_options'	);
$slider_query	=	new WP_Query(	'post_type=slider'	);

if	(	$slider_query	->	have_posts()	):
while	(	$slider_query	->	have_posts()	):
	$slider_query	->	the_post();
	$postid			=	get_the_ID();
	$custom			=	get_post_custom($postid); 
	$slider_type	=	$custom['sliderType'][0];

	if	(	$slider_type	==	'product'	)
	{	$slider_id	=	$custom['sliderProductId'][0];
		array_push	(	$products,
							$slider_id
						);
	}	else	if	(	$slider_type	==	'news'	)
	{	$slider_id	=	$custom[	'sliderPostId'	][	0	];
		array_push	(	$posts,
							$slider_id
						);
	}	else	if	(	$slider_type	==	'promotion'	)
	{	$slider_id	=	$custom[	'sliderPromotionId'	][	0	];
		array_push	(	$promotions,
							$slider_id
						);44162792
	}
endwhile;
endif;

$postsString = implode(',', $posts);
$productsString = implode(',', $products);
$promotionsString = implode(',', $promotions);
if(!empty($promotions)) getSliderPromotions($promotionsString);
if(!empty($products)) getSliderProducts($productsString);
if(!empty($posts)) getSliderPosts($postsString);
*/					
?>

</ul>	</div>
	<!-- <div class='feature-nav'>
		<a href='#' class='previous'>Previous</a>
		<a href='#' class='next'>Next</a>
	</div> -->
</div>	</div>
<div id	=	'slider-controls'	>	</div>