			<?php $category_data = $wpdb->get_results("SELECT  `id`, `name`, `nice-name`, `description`, `image` FROM `".WPSC_TABLE_PRODUCT_CATEGORIES . "` WHERE `active` = '1'",ARRAY_A); ?>
			<div class="slider-mask">
				<div class="front-category-slider">
					<?php foreach($category_data as $i => $category_row) {
						$name = $category_row['name'];
						$id = $category_row['id'];
						$description = $category_row['description'];
						$url = wpsc_category_url($category_row['id']);
						$image = wpsc_category_image($id);
						?>
							<?php if(($i%5)==0) echo '<div class="full-width"><ul class="front-category-list">' ?>
							<li <?php if(($i%5)==4) echo 'class="col-right"' ?>>
								<div class="padding">
									<a href="<?php echo $url ?>" class="category-thumbnail <?php if(empty($image)) echo 'no-cat-image'; ?>"><?php if(!empty($image)) : ?><img src="<?php echo $image ?>" alt="<?php echo $name ?>" /><?php endif; ?><span class="category-name"><?php echo $name ?></span></a>
								</div>
							</li>
							<?php if(($i%5)==4) echo '</div>' ?>
					<?php } ?>
					<?php if(($i%5)!=4) echo '</div></ul>' ?>
					</div>
			</div>