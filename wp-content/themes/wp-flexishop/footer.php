<?php
	$options = get_option('site_basic_options');
	?>
<?php if (($options['footertop'] == '1') || ($options['footerbottom'] == '1')) : ?>
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
		<?php if ($options['footerbottom'] == '1') : ?>
		<div id="footer-bottom">
			<?php
				get_sidebar( 'footer-bottom' );
			?>
			<br class="clear" />
		</div>
		<?php endif; ?>
	</div>
</div>
<?php endif; ?>
<div id="copyright" class="container">
<div class="margin">
		<p>
		<?php $options = get_option('site_basic_options'); echo $options['copyright']; ?>
		</p>
		<table>	<tbody>
		<tr>
			<td>
				<ul>
					<li>
						Monday
						<span	class	=	'schedule'	>	1000am to 700pm </span>
					</li>
					<li>
						Tuesday
						<span	class	=	'schedule'	>	1000am to 700pm </span>
					</li>
					<li>
						Wednesday
						<span	class	=	'schedule'	>	1000am to 700pm </span>
					</li>
					<li>
						Thursday
						<span	class	=	'schedule'	>	1000am to 700pm </span>
					</li>
				</ul>
			</td>
			<td>
				<ul>
					<li>
						Friday
						<span	class	=	'schedule'	>	1000am to 800pm </span>
					</li>
					<li>
						Saturday
						<span	class	=	'schedule'	>	1000am to 600pm </span>
					</li>
					<li>
						Sunday
						<span	class	=	'schedule'	>	1200am to 500pm </span>
					</li>
				</ul>
			</td>
		</tr>
	</tbody>	</table>
</div>
<center	class	=	'associations'	>
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
</div>	</div>

</body>
</html>
<!--
	<?php
	wp_footer();
?>
-->