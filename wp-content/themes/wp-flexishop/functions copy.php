<?php
/**
 * TwentyTen functions and definitions
 *
 * Sets up the theme and provides some helper functions. Some helper functions
 * are used in the theme as custom template tags. Others are attached to action and
 * filter hooks in WordPress to change core functionality.
 *
 * The first function, twentyten_setup(), sets up the theme by registering support
 * for various features in WordPress, such as post thumbnails, navigation menus, and the like.
 *
 * When using a child theme (see http://codex.wordpress.org/Theme_Development and
 * http://codex.wordpress.org/Child_Themes), you can override certain functions
 * (those wrapped in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before the parent
 * theme's file, so the child theme functions would be used.
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are instead attached
 * to a filter or action hook. The hook can be removed by using remove_action() or
 * remove_filter() and you can attach your own function to the hook.
 *
 * We can remove the parent theme's hook only after it is attached, which means we need to
 * wait until setting up the child theme:
 *
 * <code>
 * add_action( 'after_setup_theme', 'my_child_theme_setup' );
 * function my_child_theme_setup() {
 *     // We are providing our own filter for excerpt_length (or using the unfiltered value)
 *     remove_filter( 'excerpt_length', 'twentyten_excerpt_length' );
 *     ...
 * }
 * </code>
 *
 * For more information on hooks, actions, and filters, see http://codex.wordpress.org/Plugin_API.
 *
 * @package WordPress
 * @subpackage flexishop
 * @since flexishop 3.0
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * Used to set the width of images and content. Should be equal to the width the theme
 * is designed for, generally via the style.css stylesheet.
 */
if ( ! isset( $content_width ) )
	$content_width = 640;

/** Tell WordPress to run twentyten_setup() when the 'after_setup_theme' hook is run. */
add_action( 'after_setup_theme', 'twentyten_setup' );

if ( ! function_exists( 'twentyten_setup' ) ):
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * To override twentyten_setup() in a child theme, add your own twentyten_setup to your child theme's
 * functions.php file.
 *
 * @uses add_theme_support() To add support for post thumbnails and automatic feed links.
 * @uses register_nav_menus() To add support for navigation menus.
 * @uses add_custom_background() To add support for a custom background.
 * @uses add_editor_style() To style the visual editor.
 * @uses load_theme_textdomain() For translation/localization support.
 * @uses add_custom_image_header() To add support for a custom header.
 * @uses register_default_headers() To register the default custom header images provided with the theme.
 * @uses set_post_thumbnail_size() To set a custom post thumbnail size.
 *
 * @since Twenty Ten 1.0
 */
function twentyten_setup() {

	// This theme styles the visual editor with editor-style.css to match the theme style.
	add_editor_style();

	// This theme uses post thumbnails
	add_theme_support( 'post-thumbnails' );

	// Add default posts and comments RSS feed links to head
	add_theme_support( 'automatic-feed-links' );

	// Make theme available for translation
	// Translations can be filed in the /languages/ directory
	load_theme_textdomain( 'twentyten', TEMPLATEPATH . '/languages' );

	$locale = get_locale();
	$locale_file = TEMPLATEPATH . "/languages/$locale.php";
	if ( is_readable( $locale_file ) )
		require_once( $locale_file );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Navigation', 'twentyten' ),
	) );

	// This theme allows users to set a custom background
	add_custom_background();

	// Your changeable header business starts here
	define( 'HEADER_TEXTCOLOR', '' );
	// No CSS, just IMG call. The %s is a placeholder for the theme template directory URI.
	define( 'HEADER_IMAGE', '%s/images/headers/path.jpg' );

	// The height and width of your custom header. You can hook into the theme's own filters to change these values.
	// Add a filter to twentyten_header_image_width and twentyten_header_image_height to change these values.
	define( 'HEADER_IMAGE_WIDTH', apply_filters( 'twentyten_header_image_width', 75 ) );
	define( 'HEADER_IMAGE_HEIGHT', apply_filters( 'twentyten_header_image_height', 75 ) );

	// We'll be using post thumbnails for custom header images on posts and pages.
	// We want them to be 940 pixels wide by 198 pixels tall.
	// Larger images will be auto-cropped to fit, smaller ones will be ignored. See header.php.
	set_post_thumbnail_size( HEADER_IMAGE_WIDTH, HEADER_IMAGE_HEIGHT, true );
	add_image_size( 'promotion', 980, 375, true); // Feature size
	add_image_size( 'blog', 690, 282, true); // Permalink thumbnail size
	// Don't support text inside the header image.
	define( 'NO_HEADER_TEXT', true );

	// Add a way for the custom header to be styled in the admin panel that controls
	// custom headers. See twentyten_admin_header_style(), below.
	add_custom_image_header( '', 'twentyten_admin_header_style' );

	// ... and thus ends the changeable header business.

	// Default custom headers packaged with the theme. %s is a placeholder for the theme template directory URI.
	register_default_headers( array(
		'berries' => array(
			'url' => '%s/images/headers/flexishop.png',
			'thumbnail_url' => '%s/images/headers/flexishop-thumbnail.png',
			/* translators: header image description */
			'description' => __( 'flexishop', 'twentyten' )
		)
	) );
}
endif;

if ( ! function_exists( 'twentyten_admin_header_style' ) ) :
/**
 * Styles the header image displayed on the Appearance > Header admin panel.
 *
 * Referenced via add_custom_image_header() in twentyten_setup().
 *
 * @since Twenty Ten 1.0
 */
function twentyten_admin_header_style() {
?>
<style type="text/css">
/* Shows the same border as on front end */
#headimg {
	border-bottom: 1px solid #000;
	border-top: 4px solid #000;
}
/* If NO_HEADER_TEXT is false, you would style the text with these selectors:
	#headimg #name { }
	#headimg #desc { }
*/
</style>
<?php
}
endif;

/**
 * Makes some changes to the <title> tag, by filtering the output of wp_title().
 *
 * If we have a site description and we're viewing the home page or a blog posts
 * page (when using a static front page), then we will add the site description.
 *
 * If we're viewing a search result, then we're going to recreate the title entirely.
 * We're going to add page numbers to all titles as well, to the middle of a search
 * result title and the end of all other titles.
 *
 * The site title also gets added to all titles.
 *
 * @since Twenty Ten 1.0
 *
 * @param string $title Title generated by wp_title()
 * @param string $separator The separator passed to wp_title(). Twenty Ten uses a
 * 	vertical bar, "|", as a separator in header.php.
 * @return string The new title, ready for the <title> tag.
 */
/*function twentyten_filter_wp_title( $title, $separator ) {
	// Don't affect wp_title() calls in feeds.
	if ( is_feed() )
		return $title;

	// The $paged global variable contains the page number of a listing of posts.
	// The $page global variable contains the page number of a single post that is paged.
	// We'll display whichever one applies, if we're not looking at the first page.
	global $paged, $page;

	if ( is_search() ) {
		// If we're a search, let's start over:
		$title = sprintf( __( 'Search results for %s', 'twentyten' ), '"' . get_search_query() . '"' );
		// Add a page number if we're on page 2 or more:
		if ( $paged >= 2 )
			$title .= " $separator " . sprintf( __( 'Page %s', 'twentyten' ), $paged );
		// Add the site name to the end:
		$title .= " $separator " . get_bloginfo( 'name', 'display' );
		// We're done. Let's send the new title back to wp_title():
		return $title;
	}

	// Otherwise, let's start by adding the site name to the end:
	$title .= get_bloginfo( 'name', 'display' );

	// If we have a site description and we're on the home/front page, add the description:
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title .= " $separator " . $site_description;

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		$title .= " $separator " . sprintf( __( 'Page %s', 'twentyten' ), max( $paged, $page ) );

	// Return the new title to wp_title():
	return $title;
}
add_filter( 'wp_title', 'twentyten_filter_wp_title', 10, 2 );
*/
/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 *
 * To override this in a child theme, remove the filter and optionally add
 * your own function tied to the wp_page_menu_args filter hook.
 *
 * @since Twenty Ten 1.0
 */
function twentyten_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'twentyten_page_menu_args' );

/**
 * Sets the post excerpt length to 40 characters.
 *
 * To override this length in a child theme, remove the filter and add your own
 * function tied to the excerpt_length filter hook.
 *
 * @since Twenty Ten 1.0
 * @return int
 */
function twentyten_excerpt_length( $length ) {
	return 60;
}
//add_filter( 'excerpt_length', 'twentyten_excerpt_length' );

/**
 * Returns a "Continue Reading" link for excerpts
 *
 * @since Twenty Ten 1.0
 * @return string "Continue Reading" link
 */
function twentyten_continue_reading_link() {
	return ' <a href="'. get_permalink() . '">' . __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'twentyten' ) . '</a>';
}

/**
 * Replaces "[...]" (appended to automatically generated excerpts) with an ellipsis and twentyten_continue_reading_link().
 *
 * To override this in a child theme, remove the filter and add your own
 * function tied to the excerpt_more filter hook.
 *
 * @since Twenty Ten 1.0
 * @return string An ellipsis
 */
function twentyten_auto_excerpt_more( $more ) {
	return ' &hellip;' . twentyten_continue_reading_link();
}
add_filter( 'excerpt_more', 'twentyten_auto_excerpt_more' );

function content($num) {  
  $limit = $num+1;  
  $permalink = get_permalink();
  $content = str_split(get_the_content()); 
  $length = count($content);
  if ($length>=$num) {
    $content = array_slice( $content, 0, $num);  
    $content = implode("",$content)."<a href='$permalink'>Read More</a>";  
    echo $content;  
  } else { 
    the_content();
  }
}

/**
 * Adds a pretty "Continue Reading" link to custom post excerpts.
 *
 * To override this link in a child theme, remove the filter and add your own
 * function tied to the get_the_excerpt filter hook.
 *
 * @since Twenty Ten 1.0
 * @return string Excerpt with a pretty "Continue Reading" link
 */
function twentyten_custom_excerpt_more( $output ) {
	if ( has_excerpt() && ! is_attachment() ) {
		$output .= twentyten_continue_reading_link();
	}
	return $output;
}
//add_filter( 'get_the_excerpt', 'twentyten_custom_excerpt_more' );

/**
 * Remove inline styles printed when the gallery shortcode is used.
 *
 * Galleries are styled by the theme in Twenty Ten's style.css.
 *
 * @since Twenty Ten 1.0
 * @return string The gallery style filter, with the styles themselves removed.
 */
function twentyten_remove_gallery_css( $css ) {
	return preg_replace( "#<style type='text/css'>(.*?)</style>#s", '', $css );
}
add_filter( 'gallery_style', 'twentyten_remove_gallery_css' );

if ( ! function_exists( 'twentyten_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * To override this walker in a child theme without modifying the comments template
 * simply create your own twentyten_comment(), and that function will be used instead.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 * @since Twenty Ten 1.0
 */
function twentyten_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case '' :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<div id="comment-<?php comment_ID(); ?>" class="comment-wrapper">
		<div class="comment-author vcard">
			<?php echo get_avatar( $comment, 60 ); ?>
			<?php printf( __( '%s', 'twentyten' ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?>
		</div><!-- .comment-author .vcard -->
		<?php if ( $comment->comment_approved == '0' ) : ?>
			<em><?php _e( 'Your comment is awaiting moderation.', 'twentyten' ); ?></em>
			<br />
		<?php endif; ?>
		<div class="comment-body">
			<div class="comment-meta commentmetadata"><a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
				<?php
					/* translators: 1: date, 2: time */
					printf( __( '%1$s at %2$s', 'twentyten' ), get_comment_date(),  get_comment_time() ); ?></a><?php edit_comment_link( __( '(Edit)', 'twentyten' ), ' ' );
				?>
			</div><!-- .comment-meta .commentmetadata -->
	
			<div class="comment-text"><?php comment_text(); ?></div>
	
			<div class="reply">
				<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
			</div><!-- .reply -->
		</div>
		<br class="clear" />
		</div><!-- #comment-##  -->

	<?php
			break;
		case 'pingback'  :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', 'twentyten' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __('(Edit)', 'twentyten'), ' ' ); ?></p>
	<?php
			break;
	endswitch;
}
endif;

/**
 * Register widgetized areas, including two sidebars and four widget-ready columns in the footer.
 *
 * To override twentyten_widgets_init() in a child theme, remove the action hook and add your own
 * function tied to the init hook.
 *
 * @since Twenty Ten 1.0
 * @uses register_sidebar
 */
function twentyten_widgets_init() {
	// Area 1, located at the top of the sidebar.
	register_sidebar( array(
		'name' => __( 'Primary Widget Area', 'twentyten' ),
		'id' => 'primary-widget-area',
		'description' => __( 'The primary widget area', 'twentyten' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	// Area 2, located below the Primary Widget Area in the sidebar. Empty by default.
	register_sidebar( array(
		'name' => __( 'Secondary Widget Area', 'twentyten' ),
		'id' => 'secondary-widget-area',
		'description' => __( 'The secondary widget area', 'twentyten' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	// Area 3, located in the footer. Empty by default.
	register_sidebar( array(
		'name' => __( 'First Footer Widget Area', 'twentyten' ),
		'id' => 'first-footer-widget-area',
		'description' => __( 'The first footer widget area', 'twentyten' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	// Area 4, located in the footer. Empty by default.
	register_sidebar( array(
		'name' => __( 'Second Footer Widget Area', 'twentyten' ),
		'id' => 'second-footer-widget-area',
		'description' => __( 'The second footer widget area', 'twentyten' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	// Area 5, located in the footer. Empty by default.
	register_sidebar( array(
		'name' => __( 'Third Footer Widget Area', 'twentyten' ),
		'id' => 'third-footer-widget-area',
		'description' => __( 'The third footer widget area', 'twentyten' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	// Area 6, located in the footer. Empty by default.
	register_sidebar( array(
		'name' => __( 'Fourth Footer Widget Area', 'twentyten' ),
		'id' => 'fourth-footer-widget-area',
		'description' => __( 'The fourth footer widget area', 'twentyten' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	
	// Area 7, located in the footer. Empty by default.
	register_sidebar( array(
		'name' => __( 'Fifth Footer Widget Area', 'twentyten' ),
		'id' => 'fifth-footer-widget-area',
		'description' => __( 'The fifth footer widget area', 'twentyten' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	
	// Area 8, located in the footer. Empty by default.
	register_sidebar( array(
		'name' => __( 'First Footer Top Widget Area', 'twentyten' ),
		'id' => 'first-footer-top-widget-area',
		'description' => __( 'The first footer top widget area', 'twentyten' ),
		'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	
	// Area 9, located in the footer. Empty by default.
	register_sidebar( array(
		'name' => __( 'Second Footer Top Widget Area', 'twentyten' ),
		'id' => 'second-footer-top-widget-area',
		'description' => __( 'The second footer top widget area', 'twentyten' ),
		'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	
	// Area 10, located in the footer. Empty by default.
	register_sidebar( array(
		'name' => __( 'Third Footer Top Widget Area', 'twentyten' ),
		'id' => 'third-footer-top-widget-area',
		'description' => __( 'The third footer top widget area', 'twentyten' ),
		'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
}
/** Register sidebars by running twentyten_widgets_init() on the widgets_init hook. */
add_action( 'widgets_init', 'twentyten_widgets_init' );

/**
 * Removes the default styles that are packaged with the Recent Comments widget.
 *
 * To override this in a child theme, remove the filter and optionally add your own
 * function tied to the widgets_init action hook.
 *
 * @since Twenty Ten 1.0
 */
function twentyten_remove_recent_comments_style() {
	global $wp_widget_factory;
	remove_action( 'wp_head', array( $wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style' ) );
}
add_action( 'widgets_init', 'twentyten_remove_recent_comments_style' );

if ( ! function_exists( 'twentyten_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post—date/time and author.
 *
 * @since Twenty Ten 1.0
 */
function twentyten_posted_on() {
	printf( __( '<span class="%1$s">Posted on</span> %2$s <span class="meta-sep">by</span> %3$s', 'twentyten' ),
		'meta-prep meta-prep-author',
		sprintf( '<a href="%1$s" title="%2$s" rel="bookmark"><span class="entry-date">%3$s</span></a>',
			get_permalink(),
			esc_attr( get_the_time() ),
			get_the_date()
		),
		sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s">%3$s</a></span>',
			get_author_posts_url( get_the_author_meta( 'ID' ) ),
			sprintf( esc_attr__( 'View all posts by %s', 'twentyten' ), get_the_author() ),
			get_the_author()
		)
	);
}
endif;

if ( ! function_exists( 'twentyten_posted_in' ) ) :
/**
 * Prints HTML with meta information for the current post (category, tags and permalink).
 *
 * @since Twenty Ten 1.0
 */
function twentyten_posted_in() {
	// Retrieves tag list of current post, separated by commas.
	$tag_list = get_the_tag_list( '', ', ' );
	if ( $tag_list ) {
		$posted_in = __( 'This entry was posted in %1$s and tagged %2$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'twentyten' );
	} elseif ( is_object_in_taxonomy( get_post_type(), 'category' ) ) {
		$posted_in = __( 'This entry was posted in %1$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'twentyten' );
	} else {
		$posted_in = __( 'Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'twentyten' );
	}
	// Prints the string, replacing the placeholders.
	printf(
		$posted_in,
		get_the_category_list( ', ' ),
		$tag_list,
		get_permalink(),
		the_title_attribute( 'echo=0' )
	);
}
endif;


//Register Admin Styles and Scripts

add_action('admin_init', 'my_theme_styles');

function my_theme_styles()
    {
        /* Register our stylesheet. */
        wp_register_style('FlexiStoreStyle', get_bloginfo('template_url') . '/css/admin.css');
        wp_register_style('ColorPicker', get_bloginfo('template_url') . '/css/admin/colorpicker.css');
        wp_register_style('DatePicker', get_bloginfo('template_url') . '/css/admin/date_input.css');
        wp_register_script('FlexiStoreScript', get_bloginfo('template_url') . '/js/admin.js');
        wp_register_script('GoogleFont', get_bloginfo('template_url') . '/js/admin/google-font-api-font-chooser.min.js');
        wp_register_script('ColorPickerScript', get_bloginfo('template_url') . '/js/admin/colorpicker.js');
        wp_register_script('DatePickerScript', get_bloginfo('template_url') . '/js/admin/jquery.date_input.min.js');
        wp_register_script('AdminScript', get_bloginfo('template_url') . '/js/admin.js');
    }

require_once ( get_stylesheet_directory() . '/theme-options.php' );

add_action('admin_print_styles-post.php','FlexiStoreAdmin');

function getCategories($split){
	if (!$split)
		get_template_part( 'shop/categories', 'products' );
	else
		get_template_part( 'shop/splitcategories', 'products' );
}

function getBestSellers(){
	get_template_part('shop/bestsellers', 'products');
}

function getLatestProducts(){
	get_template_part('shop/latestproducts', 'products');
}

function getFrontCategories(){
	get_template_part('shop/frontcategories', 'products');
}

function getFeaturedProducts(){
	get_template_part('shop/featuredproducts', 'products');
}

function getFeaturedBlog(){
	get_template_part('shop/featuredblog', 'products');
}

function getCart(){
	get_template_part('shop/cart', 'products');
}

function getFullCategories(){
	get_template_part('shop/fullcategories', 'products');
}

function getGroupedCategories(){
	get_template_part('shop/groupedcategories', 'products');
}

function getTwitter(){
	get_template_part('shop/twitter', 'products');
}

function getBlogCategories(){
	$get_cats = wp_list_categories( 'echo=0&title_li=&depth=1' );
	$cat_array = explode('</li>',$get_cats);
	echo "<h3>Blog Categories</h3><ul class='category-list'>";
	foreach($cat_array as $category) {
		echo $category;
	}	
	echo "</ul>";

}

function getTestimonials(){
	get_template_part('shop/testimonials', 'products');
}

function getPromotions(){
	get_template_part('shop/promotions', 'products');
}

//load scripts

function change_category_description($description) {
	$new_category = str_replace("<p>", "<p class='category-description'>", $description);
	return $new_category;
}
add_filter('category_description','change_category_description');

function enqueue_scripts() {
    //wp_enqueue_script('jquery-google', 'http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js');
    //wp_register_script( 'jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js');
    wp_enqueue_script('featured.js', get_bloginfo('template_directory') . '/js/featured.js', array('jquery'));
    wp_enqueue_script('menu.js', get_bloginfo('template_directory') . '/js/menu.js', array('jquery'));
}
add_action('init', 'enqueue_scripts');

//add custom post types

add_action( 'init', 'create_promotion_type' );
function create_promotion_type() {
  register_post_type( 'promotion',
    array(
      'labels' => array(
        'name' => _x('Promotions', 'post type general name'),
		'singular_name' => _x('Shop Promotion', 'post type singular name'),
		'add_new' => _x('Add New', 'shop promotion'),
		'add_new_item' => __('Add New Shop Promotion'),
		'edit_item' => __('Edit Shop Promotion'),
		'new_item' => __('New Shop Promotion'),
		'view_item' => __('View Shop Promotion'),
		'search_items' => __('Search Promotions'),
		'not_found' =>  __('Nothing found'),
		'not_found_in_trash' => __('Nothing found in Trash'),
		'parent_item_colon' => ''
      ),
      'public' => true,
      'rewrite' => array('slug' => 'promotions'),
      'show_ui' => true,
		'capability_type' => 'post',
		'supports' => array('title', 'editor', 'thumbnail')
    )
  );
}

add_action( 'init', 'create_testimonial_type' );
function create_testimonial_type() {
  register_post_type( 'testimonial',
    array(
      'labels' => array(
        'name' => _x('Testimonials', 'post type general name'),
		'singular_name' => _x('Testimonial', 'post type singular name'),
		'add_new' => _x('Add New', 'customer testimonial'),
		'add_new_item' => __('Add New Testimonial'),
		'edit_item' => __('Edit Testimonial'),
		'new_item' => __('New Testimonial'),
		'view_item' => __('View Testimonials'),
		'search_items' => __('Search Testimonials'),
		'not_found' =>  __('Nothing found'),
		'not_found_in_trash' => __('Nothing found in Trash'),
		'parent_item_colon' => ''
      ),
      'public' => true,
      'rewrite' => array('slug' => 'testimonials'),
      'show_ui' => true,
		'capability_type' => 'post',
		'supports' => array('title', 'editor')
    )
  );
}

add_action("admin_init", "admin_init");
 
function admin_init(){
	//testimonial fields
  add_meta_box("author_meta", "Author", "author", "testimonial", "normal", "low");
  	//promotion fields
  add_meta_box("promotion_meta", "Promotion Details", "promotion_meta", "promotion", "normal", "low");
}
 
function author(){
  global $post;
  $custom = get_post_custom($post->ID);
  $author = $custom["testimonial_author"][0];
  ?>
  <label>Author</label>
  <input name="author" value="<?php echo $author; ?>" />
  <?php
}

function promotion_meta() {
	
  global $post;
  global $wpsc_query, $wpdb;
  $custom = get_post_custom($post->ID);
  $link = $custom["link"][0];
  $saving = $custom["saving"][0];
  $start_date = $custom["start_date"][0];
  $end_date = $custom["end_date"][0];
  $link_type = $custom["link_type"][0];
  $promotion_link = $custom["promotion_link"][0];
  $promotion_link_category = $custom["promotion_link_category"][0];
 	$category_data = $wpdb->get_results("SELECT  `id`, `name`, `nice-name`, `description`, `image` FROM `".WPSC_TABLE_PRODUCT_CATEGORIES,ARRAY_A);
	
	$link_type_options = array(
	'Product' => array(
		'value' => 'product',
		'label' => __( 'Link To Product' )
	),
	'Category' => array(
		'value' => 'category',
		'label' => __( 'Link To Category' )
	),
	'External' => array(
		'value' => 'external',
		'label' => __( 'External Link' )
	)
	);
	
	?>
			<?php
				if ( ! isset( $checked ) )
					$checked = '';
				foreach ( $link_type_options as $option ) {

					if ( '' != $link_type ) {
						if ( $link_type == $option['value'] ) {
							$checked = "checked=\"checked\"";
						} else {
							$checked = '';
						}
					}
					?>
					<label class="description"><input type="radio" name="link_type" value="<?php esc_attr_e( $option['value'] ); ?>" <?php echo $checked; ?> class="con-check" /> <?php echo $option['label']; ?></label><br />
					<?php
				}
			?>
			</fieldset>
	<div id="external" class="hidden-field">
  <p><label>Links To External:</label><br />
  <input cols="50" name="link" value="<?php echo $link; ?>" /></p>
  </div>
  <div id="product" class="hidden-field">
  <p><label>Links To Product:</label><br />
  <select name="promotion_link">
  <?php $wpsc_query = new WPSC_Query();
	while (wpsc_have_products()) : wpsc_the_product(); ?>
		<?php $currentlink = str_replace("&amp;", "&", wpsc_the_product_permalink()); ?>
  <option value="<?php echo wpsc_the_product_permalink(); ?>" <?php if($promotion_link == $currentlink) echo "selected = 'selected'"; ?>><?php echo wpsc_the_product_title(); ?></option>
  <?php endwhile; ?>
</select></p>
</div>
<div id="category" class="hidden-field">
<p><label>Links To Category:</label><br />
<select name="promotion_link_category">
<?php foreach($category_data as $category_row) {
	$name = $category_row['name'];
	$url = str_replace("&amp;", "&", wpsc_category_url($category_row['id']));
	?>
	<option value="<?php echo $url ?>" <?php if($promotion_link_category == $url) echo "selected = 'selected'" ?>><?php echo $name ?></option>
<?php } ?>
</select>
</p>
</div>
  <p><label>Savings:</label><br />
  <input cols="50" name="saving" value="<?php echo $saving; ?>" /></p>
  <p><label>Start Date:</label><br />
  <input name="start_date" value="<?php echo $start_date; ?>" class="date-input" /></p>
  <p><label>End Date:</label><br />
  <input name="end_date" value="<?php echo $end_date; ?>" class="date-input" /></p>
  <?php
}

add_action('save_post', 'save_details');

function save_details(){
  global $post;
 if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) 
    return $post_id;
  update_post_meta($post->ID, "testimonial_author", $_POST["author"]);
  update_post_meta($post->ID, "saving", $_POST["saving"]);
  update_post_meta($post->ID, "start_date", $_POST["start_date"]);
  update_post_meta($post->ID, "end_date", $_POST["end_date"]);
  update_post_meta($post->ID, "link_type", $_POST["link_type"]);
  update_post_meta($post->ID, "link", $_POST["link"]);
  update_post_meta($post->ID, "promotion_link", $_POST["promotion_link"]);
  update_post_meta($post->ID, "promotion_link_category", $_POST["promotion_link_category"]);
}

add_action("manage_posts_custom_column",  "testimonial_custom_columns");
add_filter("manage_edit-testimonial_columns", "testimonial_edit_columns");
 
function testimonial_edit_columns($columns){
  $columns = array(
    "cb" => "<input type=\"checkbox\" />",
    "title" => "Testimonial Title",
    "testimonial" => "Testimonial",
    "testimonial_author" => "Author",
  );
 
  return $columns;
}
function testimonial_custom_columns($column){
  global $post;
 
  switch ($column) {
    case "testimonial":
      the_content();
      break;
    case "testimonial_author":
      $custom = get_post_custom();
      echo $custom["testimonial_author"][0];
      break;
  }
}

add_action("manage_posts_custom_column",  "promotion_custom_columns");
add_filter("manage_edit-promotion_columns", "promotion_edit_columns");
 
function promotion_edit_columns($columns){
  $columns = array(
    "cb" => "<input type=\"checkbox\" />",
    "title" => "Promotion Title",
    "promotion" => "Promotion",
    "saving" => "Saving",
    "link" => "Links To",
    "start_date" => "Start Date",
    "end_date" => "End Date",
  );
 
  return $columns;
}
function promotion_custom_columns($column){
  global $post;
 
  switch ($column) {
    case "promotion":
      the_content();
      break;
    case "saving":
      $custom = get_post_custom();
      echo $custom["saving"][0];
      break;
    case "link":
      $custom = get_post_custom();
      echo $custom["link"][0];
      break;
    case "end_date":
      $custom = get_post_custom();
      echo $custom["end_date"][0];
      break;
    case "start_date":
      $custom = get_post_custom();
      echo $custom["start_date"][0];
      break;
  }
}

function pagination($pages = '', $range = 2)
{  
     $showitems = ($range * 2)+1;  

     global $paged;
     if(empty($paged)) $paged = 1;

     if($pages == '')
     {
         global $wp_query;
         $pages = $wp_query->max_num_pages;
         if(!$pages)
         {
             $pages = 1;
         }
     }   

     if(1 != $pages)
     {
         echo "<div class='pagination'>";
         if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<a href='".get_pagenum_link(1)."'>&laquo;</a>";
         if($paged > 1 && $showitems < $pages) echo "<a href='".get_pagenum_link($paged - 1)."'>&lsaquo;</a>";

         for ($i=1; $i <= $pages; $i++)
         {
             if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
             {
                 echo ($paged == $i)? "<span class='current'>".$i."</span>":"<a href='".get_pagenum_link($i)."' class='inactive' >".$i."</a>";
             }
         }

         if ($paged < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($paged + 1)."'>&rsaquo;</a>";  
         if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($pages)."'>&raquo;</a>";
         echo "</div>\n";
     }
}



?>