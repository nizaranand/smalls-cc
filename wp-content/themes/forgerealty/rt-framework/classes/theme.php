<?php
#-----------------------------------------
#	RT-Theme theme.php
#	version: 1.2
#-----------------------------------------

#
#	Site Class
#
 
class RTThemeSite extends RTTheme {
 
	function theme_init(){ 
		
		//Loading Theme Scripts
		add_action('init', array(&$this,'load_scripts'));

		//Loading Theme Styles
		add_action('init', array(&$this,'load_styles'));

		//Flush rewrite rules
		add_action('init', 'flush_rewrite_rules');

		//Fix Content
		add_action('the_content', array(&$this,'fix_content'));		
		
		//Paging fix for custom post archives 
		add_action('init', array(&$this,'rt_modify_posts_per_page'));
	}  


	#
	# Loading Theme Scripts
	#
	
	function load_scripts(){
		
		wp_deregister_script( 'jquery' ); 
		wp_register_script('jquery', ("http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"), false, '');
		wp_enqueue_script('jquery-easing', THEMEURI  . '/js/jquery.easing.1.3.js', array('jquery') );
		wp_enqueue_script('jquery-cycle', THEMEURI  . '/js/jquery.cycle.all.min.js', array('jquery') );
		wp_enqueue_script('jquery-tools', THEMEURI  . '/js/jquery.tools.min.js', array('jquery') );
		wp_enqueue_script('jquery-prettyphoto', THEMEURI  . '/js/jquery.prettyPhoto.js', array('jquery') );
		
		if(get_option( 'rttheme_cufon_fonts')){
			wp_enqueue_script('jquery-cufon-yui', THEMEURI  . '/js/cufon-yui.js', array('jquery') );
			
			foreach($this->fonts as $font_file => $font_name){
				if(get_option('rttheme_cufon_font_file_heading')==$font_file || get_option('rttheme_cufon_font_file_menu')==$font_file ){ 
					wp_enqueue_script($font_file, THEMEURI  . '/js/fonts/'.$font_file.'.js', array('jquery') );
				}
			
			}	
		}
		
		wp_enqueue_script('jquery-menu-exp', THEMEURI  . '/js/menu_min.js', array('jquery') );
		wp_enqueue_script('jquery-colortip', THEMEURI  . '/js/colortip-1.0-jquery.js', array('jquery') );
		wp_enqueue_script('jquery-popeye', THEMEURI  . '/js/jquery.popeye-2.0.4.min.js', array('jquery') );
		wp_enqueue_script('jquery-coda-slider', THEMEURI  . '/js/jquery.coda-slider-2.0.js', array('jquery') );

		wp_enqueue_script('jquery-validate', THEMEURI  . '/js/jquery.validate.js', array('jquery') );
		wp_enqueue_script('jqueryform', THEMEURI  . '/js/jquery.form.js', array('jquery') );
	  
		wp_enqueue_script('jquery-tweet', THEMEURI  . '/js/jquery.tweet.js', array('jquery') );
		wp_enqueue_script('jquery-flickr', THEMEURI  . '/js/jflickrfeed.min.js', array('jquery') );
		if(get_option(THEMESLUG.'_home_slider_script')=="nivo") wp_enqueue_script('nivo-slider', THEMEURI  . '/js/jquery.nivo.slider.pack.js', array('jquery') );
		wp_enqueue_script('rt-theme-scripts', THEMEURI  . '/js/script.js', array('jquery') ); 
		wp_enqueue_script( 'jquery' );
	}
	
	#
	# Loading Theme Styles
	#
	
	function load_styles(){
		 

		wp_register_style('theme-style',get_bloginfo( 'stylesheet_url' ), 1 , false, 'all');
		wp_register_style('theme-style-all',THEMEURI . '/css/style.css', 2 , false, 'all');			
		wp_register_style('prettyPhoto',THEMEURI . '/css/prettyPhoto.css', 4 , false, 'screen');
		wp_enqueue_style('theme-reset', THEMEURI . '/css/reset.css');		
		
		wp_enqueue_style('theme-style-all');
		wp_enqueue_style('theme-style-colors');
		wp_enqueue_style('prettyPhoto');  
		wp_enqueue_style('jquery-popeye-style', THEMEURI . '/css/jquery.popeye.style.css');
		wp_enqueue_style('jquery-popeye', THEMEURI . '/css/jquery.popeye.css');
		wp_enqueue_style('jquery-colortip', THEMEURI . '/css/colortip-1.0-jquery.css');
		wp_enqueue_style('jquery-coda-slider', THEMEURI . '/css/coda-slider-2.0.css');
		
		if(get_option(THEMESLUG.'_home_slider_script')=="nivo")  wp_enqueue_style('nivo-slider', THEMEURI . '/css/nivo-slider.css'); 
		
		wp_register_style('theme-ie7',THEMEURI . '/css/ie7.css', 5 , false, 'screen');
		$GLOBALS['wp_styles']->add_data( 'theme-ie7', 'conditional', 'IE 7' );
		wp_enqueue_style('theme-ie7');

		wp_register_style('theme-lte8',THEMEURI . '/css/ie.css', 6 , false, 'screen');
		$GLOBALS['wp_styles']->add_data( 'theme-lte8', 'conditional', 'lte IE 8' );
		wp_enqueue_style('theme-lte8');
		
		wp_enqueue_style('theme-style');

	}


	#
	#   Cufon Fonts
	#
	
	function cufon_fonts(){ 
	global $fonts;

		$rttheme_cufon_font_file_menu=get_option('rttheme_cufon_font_file_menu');
		$rttheme_cufon_font_file_heading=get_option('rttheme_cufon_font_file_heading');
		
		if(get_option( 'rttheme_cufon_fonts' )):
		?>
		
		<script type="text/javascript">
		//cufon fonts 
		jQuery(document).ready(function(){		

			   Cufon.replace('h1.logo a', {
				fontFamily: '<?php echo $fonts[$rttheme_cufon_font_file_heading][0];?>',
				hover: false,		  
				textShadow: 'none' 
			   });

			   Cufon.replace('h1,h2,h3,h4,h5,h6', {
				fontFamily: '<?php echo $fonts[$rttheme_cufon_font_file_heading][0];?>',
				hover: true
			   });
				 
			   Cufon.replace('.desc .title,.banner a.big_button span,  .head_text, .banner .text', {
				fontFamily: '<?php echo $fonts[$rttheme_cufon_font_file_heading][0];?>',
				hover: true
			   });
		
			   Cufon.replace('.banner .text', {
				fontFamily: '<?php echo $fonts[$rttheme_cufon_font_file_heading][0];?>',
				hover: true 
			   });
						 
			   Cufon.replace('.desc .title,.cufon', {
				fontFamily: '<?php echo $fonts[$rttheme_cufon_font_file_heading][0];?>',
				hover: true
			   });		 
		
			   Cufon.replace('#navigation ul > li > a', {
				
				<?php if(trim($fonts[$rttheme_cufon_font_file_menu][0])=="Aller Light"):?>
					fontFamily: 'Aller',
				<?php else:?>
					fontFamily: '<?php echo $fonts[$rttheme_cufon_font_file_menu][0];?>',
				<?php endif;?>
			
				hover: true
			   });	   
		});  
		</script>
		
		<!--[if gte IE 9]>
		<script type="text/javascript">
		Cufon.set('engine', 'canvas');
		</script>
		<![endif]-->

		<?php endif;
		
		return $rttheme_cufon_font_file_menu=get_option('rttheme_cufon_font_file_menu');
	}	 
	
	#
	#   Google Fonts
	#
	
	function google_fonts(){ 
	global $google_fonts;
	

		if(get_option( 'rttheme_google_fonts' )){
	 
			$rttheme_google_fonts_body=get_option('rttheme_google_fonts_body'); 
			$rttheme_google_fonts_heading=get_option('rttheme_google_fonts_heading');
			$rttheme_google_fonts_menu=get_option('rttheme_google_fonts_menu');
			
			$google_fonts_array=array($rttheme_google_fonts_body,$rttheme_google_fonts_heading,$rttheme_google_fonts_menu);			
			
			foreach(array_unique($google_fonts_array) as $font_file){
				if($font_file){
					$font_file=str_replace("&","&amp;",$font_file);
					echo "\n".'<link href="http://fonts.googleapis.com/css?family='.$font_file.'" rel="stylesheet" type="text/css" />'."\n";
				}
			}
			
			//droid serif font manual
			echo "\n".'<link href="http://fonts.googleapis.com/css?family=Droid+Serif:400,400italic&amp;v2" rel="stylesheet" type="text/css" />'."\n";
			
			if($rttheme_google_fonts_body){
				echo '<style type="text/css">	.sidebar_content,.content{font-family:'.$google_fonts[$rttheme_google_fonts_body][0].', arial, serif !important;}</style>'."\n";				
			}
			 
			if($rttheme_google_fonts_heading){
				echo '<style type="text/css">	h1,h2,h3,h4,h5,h6,.desc .title,.nivo-title, .nivo-text, #slider .desc {font-family:'.$google_fonts[$rttheme_google_fonts_heading][0].', arial, serif;}</style>'."\n";	
			}
			 
			if($rttheme_google_fonts_menu){
				echo '<style type="text/css">	#navigation > ul > li > a {font-family:'.$google_fonts[$rttheme_google_fonts_menu][0].', arial, serif;}</style>'."\n";	
			}				
		}
	}

	#
	# Paging fix for custom post archives 
	#
	
	function rt_custom_post_limits( $value )
	{
		if(is_tax()){
			if(get_query_var('product_categories') || get_query_var('taxonomy')=="product_categories"){
				$post_per_page=get_option('rttheme_product_list_pager');
			}elseif(get_query_var('portfolio_categories') || get_query_var('taxonomy')=="portfolio_categories"){
				$post_per_page=get_option('rttheme_portf_pager');
			} 
			
			if($post_per_page>0){	
				return $post_per_page;
			}else{
				return $value;
			}
		
		}elseif(get_query_var('s')!=""){
			$post_per_page=20;
			return $post_per_page;
		}else{
			return $value;
		}
	}
	
	function rt_modify_posts_per_page() {
			add_filter( 'option_posts_per_page', array(&$this,'rt_custom_post_limits'));
	}
	
	
	#
	# Paging fix for custom post archives 
	#
	
	function fix_content( $content )
	{
		$content = str_replace('<p><br class="clear" /></p>', "<div class='clear'></div>", trim($content));
		$content = str_replace('<p></p>', "", trim($content));
		return $content;
	}

}


?>