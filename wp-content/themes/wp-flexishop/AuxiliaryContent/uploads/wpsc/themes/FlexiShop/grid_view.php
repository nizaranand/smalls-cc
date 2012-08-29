<?php
global $wpsc_query, $wpdb;
/*
 * Most functions called in this page can be found in the wpsc_query.php file
 */
?>
<?php
	$options = get_option('site_basic_options');
	if($options['productssidebar'] == 'yes')
		$products = 4;
	else
		$products = 5;
?>
<div id='products_page_container' class="wrap wpsc_container <?php if($options['productssidebar'] == 'yes') : ?>products-sidebar<?php endif; ?>">
	
	<?php do_action('wpsc_top_of_products_page'); // Plugin hook for adding things to the top of the products page, like the live search ?>
	<?php if($options['productssidebar'] == 'yes') : ?>
		<div id="products-sidebar">
			<div class="sidebar-categories">
				<?php getGroupedCategories(); ?>
			</div>	 
			<?php if ( is_active_sidebar( 'products-sidebar' ) ) : ?>
				<ul class="xoxo">
					<?php dynamic_sidebar( 'products-sidebar' ); ?>
				</ul>
			<?php endif; ?>	
		</div>
	<?php endif; ?>
	

	
	<?php if(wpsc_display_products()): ?>
		<!-- Start Pagination -->
		<?php if ( ( get_option( 'use_pagination' ) == 1 && ( get_option( 'wpsc_page_number_position' ) == 1 || get_option( 'wpsc_page_number_position' ) == 3 ) ) ) : ?>
			<div class="wpsc_page_numbers">
				<?php if ( wpsc_has_pages() ) : ?>
					Pages: <?php echo wpsc_first_products_link( '&laquo; First', true ); ?> <?php echo wpsc_previous_products_link( '&laquo; Previous', true ); ?> <?php echo wpsc_pagination( 10 ); ?> <?php echo wpsc_next_products_link( 'Next &raquo;', true ); ?> <?php echo wpsc_last_products_link( 'Last &raquo;', true ); ?>
				<?php endif; ?>
			</div>
		<?php endif; ?>		
		<!-- End Pagination -->
		
		
		<?php $i = 1; /** start the product loop here */?>
		<ul class="product-list">
		<?php while (wpsc_have_products()) :  wpsc_the_product(); ?>
			<?php if(($i % $products) == 1) echo "<div class='row'>"; ?>
			<li class="product-listing<?php if(!wpsc_the_product_thumbnail()) echo " no-image"; else echo " yes-image"; ?> default_product_display product_view_<?php echo wpsc_the_product_id(); ?> <?php echo wpsc_category_class(); ?> <?php if(($i % $products) == 0) echo 'col-right'; ?>">      	
			<div class="padding">
						<?php							
							do_action('wpsc_product_before_description', wpsc_the_product_id(), $wpsc_query->product);
							do_action('wpsc_product_addons', wpsc_the_product_id());
						?>
						
						
					
						<div class="product-meta">
							<?php if(get_option('show_thumbnails')) :?>
							<div class="imagecol">
							<?php if(wpsc_the_product_thumbnail()) :?>
								<a rel="<?php echo str_replace(array(" ", '"',"'", '&quot;','&#039;'), array("_", "", "", "",''), wpsc_the_product_title()); ?>" class="thickbox preview_link" href="<?php echo wpsc_the_product_image(); ?>">
									<img class="product_image" id="product_image_<?php echo wpsc_the_product_id(); ?>" alt="<?php echo wpsc_the_product_title(); ?>" title="<?php echo wpsc_the_product_title(); ?>" src="<?php echo wpsc_the_product_thumbnail(); ?>"/>
								</a>
							<?php else: ?>
								<div class="item_no_image">
									<a href="<?php echo wpsc_the_product_permalink(); ?>">
									<span>No Image Available</span>
									</a>
								</div>
							<?php endif; ?>
							</div>
							<?php endif; ?>
							<?php if(wpsc_product_external_link(wpsc_the_product_id()) != '') : ?>
							<?php	$action =  wpsc_product_external_link(wpsc_the_product_id()); ?>
							<?php else: ?>
							<?php	$action =  htmlentities(wpsc_this_page_url(),ENT_QUOTES); ?>					
							<?php endif; ?>
							<form class='product_form'  enctype="multipart/form-data" action="<?php echo $action; ?>" method="post" name="product_<?php echo wpsc_the_product_id(); ?>" id="product_<?php echo wpsc_the_product_id(); ?>" >
							<?php do_action('wpsc_product_addon_after_descr', wpsc_the_product_id()); ?>
							<input type="hidden" value="add_to_cart" name="wpsc_ajax_action"/>
							<input type="hidden" value="<?php echo wpsc_the_product_id(); ?>" name="product_id"/>
							<?php if((get_option('hide_addtocart_button') == 0) && (get_option('addtocart_or_buynow') !='1')) : ?>
						<?php if(wpsc_product_has_stock()) : ?>
							<?php if(wpsc_product_external_link(wpsc_the_product_id()) != '') : ?>
										<?php	$action =  wpsc_product_external_link(wpsc_the_product_id()); ?>
										<input class="wpsc_buy_button" type='button' value='<?php echo __('Buy Now', 'wpsc'); ?>' onclick='gotoexternallink("<?php echo $action; ?>")'>
										<?php else: ?>
										<input type="submit" value="<?php echo __('Add To Cart', 'wpsc'); ?>" name="Buy" class="wpsc_buy_button" id="product_<?php echo wpsc_the_product_id(); ?>_submit_button"/>
										<?php endif; ?>
							
							<div class='wpsc_loading_animation'>
								<img title="Loading" alt="Loading" src="<?php echo WPSC_URL ;?>/images/indicator.gif" class="loadingimage" />
								<?php echo __('Updating cart...', 'wpsc'); ?>
							</div>
							
						<?php else : ?>
							<p class='soldout'><?php echo __('This product has sold out.', 'wpsc'); ?></p>
						<?php endif ; ?>
						<?php endif ; ?>
							</form>
							<div class="wpsc_product_price <?php if(wpsc_product_on_special()) echo "product-sale" ?>">
								<?php if(wpsc_product_is_donation()) : ?>
									<label for='donation_price_<?php echo wpsc_the_product_id(); ?>'><?php echo __('Donation', 'wpsc'); ?>:</label>
									<input type='text' id='donation_price_<?php echo wpsc_the_product_id(); ?>' name='donation_price' value='<?php echo $wpsc_query->product['price']; ?>' size='6' />
								<?php else : ?>
									<?php if($wpsc_query->product['price'] - $wpsc_query->product['special_price'] > 0 && $wpsc_query->product['special_price'] > 0) : ?>
										<span class="sale-icon">Sale!</span>
										<!-- <span class='oldprice'><?php echo __('Price', 'wpsc'); ?>: <?php echo wpsc_product_normal_price(get_option('wpsc_hide_decimals')); ?></span>-->
									<?php endif; ?>
									<span id="product_price_<?php echo wpsc_the_product_id(); ?>" class="pricedisplay <?php if($wpsc_query->product['price'] - $wpsc_query->product['special_price'] > 0 && $wpsc_query->product['special_price'] > 0) echo "sale-price" ?>"><?php echo wpsc_the_product_price(get_option('wpsc_hide_decimals')); ?></span>					
								<?php endif; ?>
							</div>
						</div>
						<div class="producttext">
							<h3 class="prodtitles">
								<?php if(get_option('hide_name_link') == 1) : ?>
									<span><?php echo wpsc_the_product_title(); ?></span>
								<?php else: ?> 
									<a class="wpsc_product_title" href="<?php echo wpsc_the_product_permalink(); ?>"><?php echo wpsc_the_product_title(); ?></a>
								<?php endif; ?> 				
								<?php echo wpsc_edit_the_product_link(); ?>
							</h3>
							<?php if(wpsc_the_product_additional_description()) : ?>
							<div class="description">
	            			<?php
								$value = '';
								$the_addl_desc = wpsc_the_product_additional_description();
								if( is_serialized($the_addl_desc) ) {
									$addl_descriptions = @unserialize($the_addl_desc);
								} else {
									$addl_descriptions = array('addl_desc', $the_addl_desc);
								}
								
								if( isset($addl_descriptions['addl_desc']) ) {
									$value = $addl_descriptions['addl_desc'];
								}
	
				            	if( function_exists('wpsc_addl_desc_show') ) {
				            		echo wpsc_addl_desc_show( $addl_descriptions );
				            	} else {
												echo stripslashes( wpautop($the_addl_desc, $br=1));
				            	}
				            ?>
							</div>
							<?php endif; ?>
							
								<?php
								if(function_exists('gold_shpcrt_display_gallery')) :					
									echo gold_shpcrt_display_gallery(wpsc_the_product_id(), true);
								endif;
								?>
						</div>
					</div>
		</li>
		<?php if(($i % $products) == 0) echo "<br class='clear' /></div>"; ?>
		<?php $i++; endwhile; ?>
		<?php if(($i % $products) != 1) echo "<br class='clear' /></div>"; ?>
		<?php /** end the product loop here */?>
		</ul>
		
		<?php if(wpsc_product_count() < 1):?>
			<p><?php  echo __('There are no products in this group.', 'wpsc'); ?></p>
		<?php endif ; ?>

	<?php

	if(function_exists('fancy_notifications')) {
		echo fancy_notifications();
	}
	?>
		
		
		<!-- Start Pagination -->
		<?php if ( ( get_option( 'use_pagination' ) == 1 && ( get_option( 'wpsc_page_number_position' ) == 2 || get_option( 'wpsc_page_number_position' ) == 3 ) ) ) : ?>
			<div class="wpsc_page_numbers">
				<?php if ( wpsc_has_pages() ) : ?>
					Pages: <?php echo wpsc_previous_products_link( '&laquo', true ); ?> <?php echo wpsc_pagination( 10 ); ?> <?php echo wpsc_next_products_link( '&raquo;', true ); ?>
				<?php endif; ?>
			</div>
		<?php endif; ?>
		<!-- End Pagination -->
		
		
	<?php endif; ?>
</div>