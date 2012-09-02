<?php
/* jonathan@smalls.cc   2012 June 17
 * 
 * http://developer.yahoo.com/performance/rules.html
 * The above URL suggests that flushing the cache after the
 * header can make pages appear to load faster. I choose to do
 * it below the fold of the page.
 */

flush();

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
I decided to do away with the entire bottom portion of the footer
for now. I can not find an appropriate use for it, and it just
makes the site look bad with redundant information.

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
 *	I am not sure what this is for, but I removed it to avoid
 *	any ugly surprises later in development.
 *
 *	echo	"<p>";
 *	$options = get_option('site_basic_options'); echo $options['copyright'];
 *	echo	"</p>";
 */
?>

	<table>	<tbody>
	<tr>
		<td>	Contact Us	</td>
		<td>	Teddy Shoes			<br/>
			548 Massachusetts Avenue	<br/>
			Cambridge MA 02139
		</td>
		<td>	617 547 0443	<br/>
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
		src	=	'http://teddyshoes.com/wp-content/uploads/cambridge-local-first.png'
	/>
	<img	class	=	'affiliation'
		href	=	'http://www.centralsquarecambridge.com/'
		src	=	'http://teddyshoes.com/wp-content/uploads/CSBA-logo.jpg'
	/>
	<img	class	=	'affiliation'
		href	=	'http://www.nsra.org/'
		src	=	'http://teddyshoes.com/wp-content/uploads/nsra_logo_cmyk.png'
	/>
	<img	class	=	'affiliation'
		href	=	'http://www.retailersma.org/'
		src	=	'http://teddyshoes.com/wp-content/uploads/logo.gif'
	/>
	<img	class	=	'affiliation'
		href	=	'http://www.bostondancealliance.org/'
		src	=	'http://teddyshoes.com/wp-content/uploads/BostonDanceAlliance.jpg'
	/>
	</center>
</div>	</div>

<div	class	=	'align-cart'
	id	=	'googlecart-widget'
	style	=	'width:		25%;
			position:	fixed;
			right:	0%;
			top:	0%;'
>	</div>

<script src="<?php bloginfo( 'template_url' ); ?>/js/jquery.easing.1.3.js" type="text/javascript"></script>
<script src="<?php bloginfo( 'template_url' ); ?>/js/jquery.bxSlider.min.js" type="text/javascript"></script>
<script id="googlecart-script" type="text/javascript"
  src="http://checkout.google.com/seller/gsc/v2/cart.js?mid=457158148794028"
  currency="USD"
  post-cart-to-sandbox="false">
</script>
<script src="http://yui.yahooapis.com/3.5.1/build/yui/yui-min.js"></script>
<!-- Piwik --> 
 <script type="text/javascript">
 var pkBaseURL = (("https:" == document.location.protocol) ? "https://piwik.smalls.cc/" : "http://piwik.smalls.cc/");
 document.write(unescape("%3Cscript src='" + pkBaseURL + "piwik.js' type='text/javascript'%3E%3C/script%3E"));
 </script><script type="text/javascript">
 try {
 var piwikTracker = Piwik.getTracker(pkBaseURL + "piwik.php", 2);
 piwikTracker.trackPageView();
 piwikTracker.enableLinkTracking();
 } catch( err ) {}
 </script><noscript><p><img src="http://piwik.smalls.cc/piwik.php?idsite=2" style="border:0" alt="" /></p></noscript>
 <!-- End Piwik Tracking Code -->

</body>
</html>
