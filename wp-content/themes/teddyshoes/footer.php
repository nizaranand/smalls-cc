<?php
$options = get_option('site_basic_options');

if (($options['footertop'] == '1') || ($options['footerbottom'] == '1')) :
?>

<div id="footer" class="container">
	<div class="margin">
		<?php if ($options['footertop'] == '1') : ?>
		<div id="footer-top">
			<?php if ( is_active_sidebar( 'blog-footer-top-widget-area' ) ) : ?>
					<div class="footer-top-left col-2">
						<div class="col-wrapper">
							<?php dynamic_sidebar( 'blog-footer--top-widget-area' ); ?>
						</div>
					</div>
			<?php else : ?>
			<div id="blog-panel" class="col-2">
				<div class="col-wrapper">
					<h3 class="widget-title">Latest News</h3>
					<ul class="blog-list">
						<?php query_posts('posts_per_page=1&post_type=post'); ?>
							<?php
					global $more;
					$more = 0;
					?>
						<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
						<li class="post">
							<div class="post-header">
								<a href="<?php the_permalink() ?>" rel="bookmark" class="thumbnail"><?php the_post_thumbnail(); ?></a>
								<h3><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h3>
								
								<div class="post-meta">
									<?php flexishop_posted_on(); ?>
								</div>
							</div>
							<!-- <div class="post-excerpt">
								<?php the_excerpt();?>
							</div> -->
							<div class="post-content">
								<?php the_content(__('Read more')); ?>
							</div>
						</li>
						<?php endwhile; endif; ?>
						<?php wp_reset_query(); ?>
					</ul>
				</div>
			</div>
			<?php endif; ?>
			<div class="footer-top-widgets col-2">
				<?php
					get_sidebar( 'footer-top' );
				?>
			</div>
			<br class="clear" />
		</div>
		<?php endif; ?>
<?php
/*`jonathan@smalls.cc	2012 April 29
I decided to do away with the entire bottom portion of the footer for now. I
can not find an appropriate use for it, and it just makes the site look bad
with redundant information.

if ($options['footerbottom'] == '1') : ?>
		<div id="footer-bottom">
			<?php
				get_sidebar( 'footer-bottom' );
			?>
			<br class="clear" />
		</div>
		<?php endif;
*/
?>
	</div>
</div>
<?php endif;
?>
<div id="copyright" class="container">
	<div class="margin">
	
<?php
/*	jonathan@smalls.cc	2012 April 28
I am not sure what this is for, but I removed it to avoid any ugly surprises
later in development.

echo	"<p>";
$options = get_option('site_basic_options'); echo $options['copyright'];
echo	"</p>";
*/
?>
	<table>	<tbody>
		<tr>
			<td>	Contact Us	</td>
			<td>
				Teddy Shoes						<br/>
				548 Massachusetts Avenue	<br/>
				Cambridge MA 02139
			</td>
			<td>
				617 547 0443	<br/>
				617 354 2987	<br/>
				<a	href	=	'mailto:TeddyShoes@AOL.com'	>
					TeddyShoes@AOL.com
				</a>
			</td>
		</tr>
	</tbody>	</table>
	<center>
	<img	class	=	'affiliation'
			href	=	'http://www.cambridgelocalfirst.org/'
			src	=	'http://teddyshoes.com/ad-logos/CLFlogo.gif?nxg_versionuid=published'
	/>
	<img	class	=	'affiliation'
			href	=	'http://www.centralsquarecambridge.com/'
			src	=	'http://teddyshoes.com/*site/scaled-images/web/ad-logos/CSBA%20LOGO-jpg-158x160.jpg?nxg_versionuid=published'
	/>
	<img	class	=	'affiliation'
			href	=	'http://www.nsra.org/'
			src	=	'http://teddyshoes.com/ad-logos/NSRAlogocolor500x.jpg?nxg_versionuid=published'
	/>
	<img	class	=	'affiliation'
			href	=	'http://www.retailersma.org/'
			src	=	'http://teddyshoes.com/Redesign/Retailers%20of%20Mass.logo.gif?nxg_versionuid=published'
	/>
	<img	class	=	'affiliation'
			href	=	'http://www.bostondancealliance.org/'
			src	=	'http://teddyshoes.com/Redesign/small-dance-alliance.jpg?nxg_versionuid=published'
	/>
	</center>
	</div>
</div>
<script id="googlecart-script" type="text/javascript"
  src="http://checkout.google.com/seller/gsc/v2/cart.js?mid=457158148794028"
  currency="USD"
  post-cart-to-sandbox="false">
</script>	
</body>
</html>