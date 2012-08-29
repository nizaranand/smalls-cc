<?php
 /** 
* Class implements plugin's work "social essentials buttons" in particular its activation, deactivation and HTML code generation. Plugin "social essentials buttons" places buttons  at the top of each post/page.
*
* @author Best Web Soft <bestwebsoft.com>
* @version 1.0
*/

class social_essentials
{
	/**
   * Plugin title is displayed in admin section at the page of plugin options
   * 
   * @page_title (string)
   */
	var $page_title;						
	
	/**
   * Menu title of plugin in admin section 
   * 
   * @menu_title (string)
   */
	var $menu_title;						
	
	/**
   * Access level for plugin 
   * 
   * @access_level (int)
   */
	var $access_level;						
	
	/**
   * Where in admin panel a link to plugin is displayed
   * 
   * @add_page_to (int)
   */
	var $add_page_to;						
	
	/**
	* Plugin's description which is displayed below the title in admin section at the page of plugin's options.
	* 
	* @short_description (string)
	*/
	var $short_description;						
	
	/**
	* Site admin twitter name
	* 
	* @twitter_username (string)
	*/
	var $twitter_username; 			
	
	/**
	* Facebook API key
	* 
	* @feb_app_id (string)
	*/
	var $feb_app_id = '';
  	
	/**
	* Enable or disable "Call to action text"
	* 
	* @call_to_action (bool)
	*/
    var $call_to_action;
	
	/**
	* Style of call to action text bold
	* 
	* @call_to_action_text_style (bool)
	*/
    var $call_to_action_text_style_bold;
	
	/**
	* Style of call to action text italic
	* 
	* @call_to_action_text_style (bool)
	*/
    var $call_to_action_text_style_italic;
	
	/**
	* Style of call to action text underline
	* 
	* @call_to_action_text_style (bool)
	*/
    var $call_to_action_text_style_underline;
	
	/**
	* Hex color ['#000000']
	* 
	* @text_call_to_action_color (string)
	*/
    var $text_call_to_action_color;
	
	/**
	* Contains the name of html tag ['h1','h2', ...]
	* 
	* @call_to_action_text_size (string)
	*/
    var $call_to_action_text_size;
	
	/**
	* Position of call to actiob text ['left', 'right']
	* 
	* @call_to_action_position (string)
	*/
    var $call_to_action_position;
	
	/**
	* Call to action text
	* 
	* @call_to_action_text (string)
	*/
    var $call_to_action_text;
	
	/**
	* Buttons icons aligment ['left', 'right', 'center', 'float left', 'float right']
	* 
	* @icon_aligment (string)
	*/
    var $icon_aligment;
	
	/**
	* Buttons icon size ['small', 'large']
	* 
	* @icon_size (string)
	*/
    var $icon_size;
	
	/**
	* Cutom css field
	* 
	* @custom_css (string)
	*/
    var $custom_css;
	
	/**
	* Button names separated by comma
	* 
	* @buttons_order (string)
	*/
    var $buttons_order;	
	
	/**
	* ULR to arrow image
	* 
	* @text_call_to_action_arrow (string)
	*/
    var $text_call_to_action_arrow;	
	
	/**
	* Contains section of page where should be buttons placed
	* 
	* @display (array)
	*/
	var $display = array();
	
	/**
	* Content button names in items keys
	* 
	* @show_buttons (array)
	*/
    var $show_buttons = array();
	
	/**
	* Count of RSS feed posts in sidebar
	* 
	* @count_posts (int)
	*/
    var $count_posts = 5;
    
    /**
	* Custom margins
	* 
	* @count_posts (array)
	*/
    var $margins = array();		
	
	/**
	* Method initialize object of a class with variables from wp-option table
	*    
	* @return void
	*/
	function social_essentials()
	{			
				
		if (get_option('se_show_twitter'))   	$this->show_buttons['twitter']   = get_option('se_show_twitter');
		if (get_option('se_show_fb_like'))   	$this->show_buttons['fb_like']   = get_option('se_show_fb_like');
		if (get_option('se_show_fb_share'))  	$this->show_buttons['fb_share']  = get_option('se_show_fb_share');
		if (get_option('se_show_google'))    	$this->show_buttons['google'] 	  = get_option('se_show_google');
		if (get_option('se_show_pinterest')) 	$this->show_buttons['pinterest'] = get_option('se_show_pinterest');
		if (get_option('se_show_stumbleupon')) 	$this->show_buttons['stumbleupon'] = get_option('se_show_stumbleupon');
		
		if (get_option('se_display_above_posts'))  $this->display['above_posts']   = get_option('se_display_above_posts');
		if (get_option('se_display_below_posts'))  $this->display['below_posts']   = get_option('se_display_below_posts');
		if (get_option('se_display_above_pages'))  $this->display['above_pages']   = get_option('se_display_above_pages');
		if (get_option('se_display_below_pages'))  $this->display['below_pages']   = get_option('se_display_below_pages');
		if (get_option('se_display_above_home'))   $this->display['above_home']   = get_option('se_display_above_home');
		if (get_option('se_display_below_home'))   $this->display['below_home']   = get_option('se_display_below_home');
		
		$this->icon_size 					= get_option('se_icon_size');
		$this->icon_aligment 				= get_option('se_icon_aligment');
		$this->call_to_action_text 			= get_option('se_call_to_action_text');
		$this->call_to_action_position 		= get_option('se_call_to_action_position');
		$this->call_to_action_text_size 	= get_option('se_call_to_action_text_size');
		$this->text_call_to_action_color 	= get_option('se_text_call_to_action_color');
		$this->call_to_action_text_style_bold 	= get_option('se_call_to_action_text_style_bold');
		$this->call_to_action_text_style_italic 	= get_option('se_call_to_action_text_style_italic');
		$this->call_to_action_text_style_underline 	= get_option('se_call_to_action_text_style_underline');
		$this->call_to_action 				= get_option('se_call_to_action');				
		$this->text_call_to_action_arrow	= get_option('se_text_call_to_action_arrow');
		
		$this->twitter_username 			= get_option('se_settings_twitter_username');
		$this->feb_app_id 					= get_option('se_settings_fb_app_id');
		$this->custom_css 					= get_option('se_custom_css');
		$this->buttons_order 				= get_option('se_buttons_order');
        
        $this->margins                      = get_option('se_margins');
		
		add_action( 'wp_ajax_se_preview', array(&$this, 'preview_buttons' ));		
		add_action( 'wp_ajax_se_stats', array(&$this, 'get_stats_table' ));		
		add_action( 'wp_ajax_se_stats_top', array(&$this, 'get_stats_top_table' ));		
		add_action( 'wp_ajax_se_stats_last_top', array(&$this, 'get_stats_last_top_table' ));						
		add_filter( 'the_content', array(&$this, 'generate_buttons' ));						
		add_action( 'update_stats', array(&$this, 'update_stats'));
		add_shortcode( 'social_essentials', array(&$this, 'get_shortcode' ));
		
		// Register scripts for social buttons
		wp_register_script( 'se-fb-share', WP_PLUGIN_URL . '/social-essentials/js/FB.Share.js' );
		wp_register_script( 'se-pinterest', 'http://assets.pinterest.com/js/pinit.js' );
		wp_register_script( 'se-twitter', 'http://platform.twitter.com/widgets.js' );
		wp_register_script( 'se-plusone', 'http://apis.google.com/js/plusone.js' );
		wp_register_script( 'se-stumbleupon', 'http://platform.stumbleupon.com/1/widgets.js' );
		
		add_action( 'wp_footer', array(&$this, 'add_footer_scripts' ) );
	}	
	
	/**
	* Method which defines what section in admin panel loads a link for plugin settings
	*    
	* @return void
	*/
	function add_admin_menu()
	{				
		add_menu_page($this->page_title, $this->menu_title, $this->access_level, basename(__FILE__), array(&$this, 'stats_page'));
		
		add_submenu_page(basename(__FILE__), "Setup - Social Essentials", "Setup", "activate_plugins", 'Setup', array(&$this, 'admin_page'));					
	}
	
	/**
	* This method attaches js and css files in admin panel for plugin
	*    
	* @return void
	*/
	function add_admin_head()
	{
		wp_register_script( 'se-jqgrid-locale', WP_PLUGIN_URL . '/social-essentials/js/grid.locale-en.js' );		
		wp_register_script( 'se-jqgrid', WP_PLUGIN_URL . '/social-essentials/js/jquery.jqGrid.min.js' );
		wp_register_script( 'social-essentials', WP_PLUGIN_URL . '/social-essentials/script.js' );
		wp_register_style( 'se-jqgrid', WP_PLUGIN_URL . '/social-essentials/css/ui.jqgrid.css' );
		wp_register_style( 'se-jqgrid-redmond', WP_PLUGIN_URL . '/social-essentials/css/redmond/jquery-ui-1.8.18.custom.css' );
		wp_enqueue_style( array( 'farbtastic', 'se-jqgrid', 'se-jqgrid-redmond' ) );	
		wp_enqueue_script( array( 'jquery', 'jquery-ui-core', 'jquery-ui-sortable', 'jquery-ui-draggable', 'farbtastic', 'social-essentials', 'se-jqgrid-locale', 'se-jqgrid', 'se-fb-share', 'se-twitter', 'se-plusone', 'se-stumbleupon' ) );   								
	}
	
	/**
	* This method atached js file for social buttons in frontend
	*    
	* @return void
	*/
	function add_footer_scripts()
	{
		if (!empty($this->show_buttons) && !empty($this->display) )
		{
			foreach (explode(',', $this->buttons_order) as $button) 
			{
				if (!empty($this->show_buttons[trim($button)]))
				{
					switch (trim($button))
					{												
						case 'twitter':
							wp_enqueue_script( 'se-twitter' );
							break;
						case 'fb_share':
							wp_enqueue_script( 'se-fb-share' );									
							break;
						case 'google':
							wp_enqueue_script( 'se-plusone' );
							break;
						case 'pinterest':
							wp_enqueue_script( 'se-pinterest' );
							break;	
						case 'stumbleupon':
							wp_enqueue_script( 'se-stumbleupon' );
							break;
					}
				}
			}
		}								
	}
		
	/**
	* This method checks current plugin options and generates  html for share buttons
	*    
	* @return string html for share buttons
	*/
	function get_shortcode()
	{	

		$options = array(
			'display' => array( 'above_posts' => 1, 'above_pages' => 1 )
		);
		
		return $this->generate_buttons('', false, $options);
	}
		
	/**
	* This method checks current plugin options and generates  html for share buttons
	*    
	* @return string html for share buttons
	*/
	function generate_buttons($content = '', $preview = false, $options = array())
	{
		if (!$preview)	
			global $post;
		
		if (!empty($options))
		{
			foreach ($options as $option => $value)
			{
				$this->{$option} = $value;				
			}
		}
			
		$html = '<div id="social-essentials" class="se_'.$this->icon_aligment.'">';
		
		$plink   = (!$preview) ? get_permalink($post->ID) : $preview;
		$eplink  = (!$preview) ? urlencode($plink) : urlencode($preview);
		$ptitle  = (!$preview) ? get_the_title($post->ID) : $this->page_title;
		$eptitle = (!$preview) ? str_replace(array(">","<"), "", $ptitle) : $this->page_title;
		
		if (!empty($this->show_buttons) && (!empty($this->display) || $preview))
		{
			foreach (explode(',', $this->buttons_order) as $button) 
			{
				if (!empty($this->show_buttons[trim($button)]))
				{
				
					switch (trim($button))
					{												
						case 'twitter':

							$layout = $this->icon_size == 'small' ? 'horizontal' : 'vertical' ;
							
							$html .= '<div class="se_button'.(($this->icon_size == 'large') ? ' se_button_large' : ' se_button_small').'" style="width:'.(($this->icon_size == 'large') ? '65' : '85').'px;margin:'.$this->margins['button']->getMarginString().'"><a href="https://twitter.com/share" class="twitter-share-button" data-url="'.$plink.'" data-text="'.$eptitle.'" data-via="'.$this->twitter_username.'" data-counturl="'.$plink.'" data-count="'.$layout.'" data-lang="en">Tweet</a></div>';
							
							break;
						case 'fb_like':
							
							$layout = $this->icon_size == 'small' ? 'button_count' : 'box_count' ;							
							
							$html .= '<div class="se_button'.(($this->icon_size == 'large') ? ' se_button_large' : ' se_button_small').'" style="margin:'.$this->margins['button']->getMarginString().'"><iframe src="//www.facebook.com/plugins/like.php?locale=en_US&href='.$eplink.'&amp;send=false&amp;layout='.$layout.'&amp;show_faces=false&amp;action=like&amp;colorscheme=light&amp;font" scrolling="no" frameborder="0" allowTransparency="true" style="width:'.(($this->icon_size == 'small') ? '72' : '47').'px; height:'.(($this->icon_size == 'small') ? '21' : '63').'px;"></iframe></div>';
														
							break;
						case 'fb_share':
							
							if ($this->icon_size == "large" ) $tp  = "box_count"; else $tp= "button_count";							

							$html .= '<div class="se_button'.(($this->icon_size == 'large') ? ' se_button_large' : ' se_button_small').'" style="margin:'.$this->margins['button']->getMarginString().'"><a name="fb_share" type="'.$tp.'" share_url="'.$eplink.'">Share</a></div>';							
																		
							break;
						case 'google':
							
							if ($this->icon_size == "large" ) $tp="tall"; else $tp="medium";	
							
							$html .= '<div class="se_button'.(($this->icon_size == 'large') ? ' se_button_large' : ' se_button_small').'" style="width:'.(($this->icon_size == 'large') ? '53' : '60').'px;margin:'.$this->margins['button']->getMarginString().'"><g:plusone size="'.$tp.'" href="'.$plink.'" count="true"></g:plusone></div>';
                            
                            break;
						case 'pinterest':							

							$classSize = $this->icon_size == 'small' ? 'horizontal' : 'vertical' ;

							$html .= '<div class="se_button'.(($this->icon_size == 'large') ? ' se_button_large' : ' se_button_small').'" style="width:'.(($this->icon_size == 'large') ? '45' : '65').'px;margin:'.$this->margins['button']->getMarginString().'"><a href="http://pinterest.com/pin/create/button/?url='.$eplink.'" class="pin-it-button" always-show-count="true" count-layout="'.$classSize.'">Pin It</a>';	
							
							if ($preview)
								$html .= '<script type="text/javascript" src="http://assets.pinterest.com/js/pinit.js"></script>';
                                
                            $html .= '</div>';    
							
							break;
						case 'stumbleupon':
							
							$classSize = $this->icon_size == 'small' ? 1 : 5 ;
														
							$html .= '<div class="se_button'.(($this->icon_size == 'large') ? ' se_button_large' : ' se_button_small').'" style="margin:'.$this->margins['button']->getMarginString().'"><su:badge layout="'.$classSize.'"></su:badge></div>';

							break;
					}
				}
			}						
			
			if ($this->call_to_action)
			{											
				$classes = array();
				array_push($classes, 'se_text');
				if (!empty($this->call_to_action_text_style_bold)) array_push($classes, 'se_bold');
				if (!empty($this->call_to_action_text_style_italic)) array_push($classes, 'se_italic');
				if (!empty($this->call_to_action_text_style_underline)) array_push($classes, 'se_underline');
				
				switch ($this->call_to_action_position)
				{					
					
					case 'left':
						$call_to_action_html = '<'.$this->call_to_action_text_size.' class="'.implode(' ', $classes).'" style="color:'.$this->text_call_to_action_color.'; float:left;margin:'.$this->margins['text']->getMarginString().'">'.$this->call_to_action_text.'</'.$this->call_to_action_text_size.'>';
						$html = '<div class="call_to_action" style="float:left;margin:'.$this->margins['arrow']->getMarginString().'">'.$call_to_action_html.((!empty($this->text_call_to_action_arrow)) ? '<img src="'.$this->text_call_to_action_arrow.'"/></div>' : '</div>').$html;
						break;
					case 'right':
						$call_to_action_html = '<'.$this->call_to_action_text_size.' class="'.implode(' ', $classes).'" style="color:'.$this->text_call_to_action_color.'; float:right;margin:'.$this->margins['text']->getMarginString().'">'.$this->call_to_action_text.'</'.$this->call_to_action_text_size.'>';
						$html .= ((!empty($this->text_call_to_action_arrow)) ? '<div class="call_to_action" style="margin:'.$this->margins['arrow']->getMarginString().'"><img src="'.$this->text_call_to_action_arrow.'"/>' : '<div id="call_to_action">').$call_to_action_html.'</div>';
						break;
				}
			}
			
			$html .= '</div>';
			
			if ($this->icon_aligment == 'left' || $this->icon_aligment == 'right' || $this->icon_aligment == 'center') $html .= '<div class="clear"></div>';
			
			
			if (!$preview)
			{
				foreach ($this->display as $key => $display)
				{				
					switch ($key)
					{
						case 'above_posts':
							if ($post->post_type == 'post' && !is_home())  $content = $html.$content;
							break;
						case 'below_posts':
							if ($post->post_type == 'post' && !is_home()) $content .= $html;
							break;
						case 'above_pages':
							if ($post->post_type == 'page' && !is_home()) $content = $html.$content;
							break;
						case 'below_pages':
							if ($post->post_type == 'page' && !is_home()) $content .= $html;
							break;
						case 'above_home':
							if (is_home()) $content = $html.$content;
							break;
						case 'below_home':
							if (is_home()) $content .= $html;
							break;					
					}
				}
			}
			else $content .= $html;
			
			if ($this->custom_css)
			{				
				$content .= '<style type="text/css">'.$this->custom_css.'</style>';
			}
			
		}									
		
		return $content;
	}		
	
	/**
	* This method checks current plugin options and generates  html for share buttons
	*    
	* @return string html for share buttons
	*/
	function preview_buttons()
	{		
		$myposts = get_posts(array( 'numberposts' => 1));
		
		$options = array();
		
		if ($_POST)
		{
            $options['show_buttons']['twitter']       = isset($_POST['show_twitter']) ? $_POST['show_twitter'] : 0;
            $options['show_buttons']['fb_like']       = isset($_POST['show_fb_like']) ? $_POST['show_fb_like'] : 0;
            $options['show_buttons']['fb_share']      = isset($_POST['show_fb_share']) ? $_POST['show_fb_share'] : 0;
            $options['show_buttons']['google']        = isset($_POST['show_google']) ? $_POST['show_google'] : 0;
            $options['show_buttons']['pinterest']     = isset($_POST['show_pinterest']) ? $_POST['show_pinterest'] : 0;
            $options['show_buttons']['stumbleupon']   = isset($_POST['show_stumbleupon']) ? $_POST['show_stumbleupon'] : 0;
			
			$options['icon_size'] 							= $_POST['icon_size'];
			$options['icon_aligment'] 						= $_POST['icon_aligment'];
			$options['call_to_action_text'] 				= $_POST['call_to_action_text'];
			$options['call_to_action_position'] 			= $_POST['call_to_action_position'];
			$options['call_to_action_text_size'] 			= $_POST['call_to_action_text_size'];
			$options['text_call_to_action_color'] 			= $_POST['text_call_to_action_color'];
			$options['call_to_action_text_style_bold'] 		= $_POST['call_to_action_text_style_bold'];
			$options['call_to_action_text_style_italic'] 	= $_POST['call_to_action_text_style_italic'];
			$options['call_to_action_text_style_underline'] = $_POST['call_to_action_text_style_underline'];
			$options['call_to_action'] 						= $_POST['call_to_action'];				
			$options['text_call_to_action_arrow']			= $_POST['text_call_to_action_arrow'];
			
			$options['twitter_username'] 					= $_POST['settings_twitter_username'];
			$options['feb_app_id'] 							= $_POST['settings_fb_app_id'];
			$options['custom_css'] 							= $_POST['custom_css'];
			$options['buttons_order'] 						= $_POST['buttons_order'];
		}
		
		exit($this->generate_buttons('', 'http://imimpact.com/', $options));	
		
	}
	
	/**
	* This method attaches css file for plugin
	*    
	* @return void
	*/
	function init()
	{		
		wp_enqueue_style('social-essentials', WP_PLUGIN_URL . '/social-essentials/style.css');	   											
	}

	/**
	* Plugin activation. Adds default settings in wp-options table
	*    
	* @return void
	*/
	function activate()
	{

		add_option('se_show_twitter', '0');
		add_option('se_show_fb_like', '0');
		add_option('se_show_fb_share', '0');
		add_option('se_show_google', '0');		
		add_option('se_show_pinterest', '0');		
		add_option('se_show_stumbleupon', '0');
		
		add_option('se_icon_size', 'small');
		add_option('se_icon_aligment', 'left');
		add_option('se_call_to_action_text', '');
		add_option('se_call_to_action_position', 'right');
		add_option('se_call_to_action_text_size', 'h4');
		add_option('se_text_call_to_action_color', '#000');
		add_option('se_call_to_action_text_style_bold', '1');
		add_option('se_call_to_action_text_style_italic', '');
		add_option('se_call_to_action_text_style_underline', '');

		add_option('se_call_to_action', '0');

		add_option('se_display_above_posts', '0');
		add_option('se_display_below_posts', '0');
		add_option('se_display_above_pages', '0');
		add_option('se_display_below_pages', '0');
		add_option('se_display_above_home', '0');
		add_option('se_display_below_home', '0');
		
		add_option('se_settings_twitter_username', '');
		add_option('se_settings_fb_app_id', '');
		add_option('se_custom_css', '#call_to_action h4{padding:0px 5px;}');
		
		// Default arrow image for call to action
		add_option('se_text_call_to_action_arrow', '' );
		add_option('se_buttons_order', 'twitter, fb_like, fb_share, google, pinterest, stumbleupon');
        
        // Default margins
        add_option('se_margins', array( 'button' => new Margins(), 'arrow' => new Margins(), 'text' => new Margins() ) );
		
		wp_schedule_event(time(), 'daily', 'update_stats');		
	}
	
	/**
	* Plugin deactivation. Removes default settings from wp-options table
	*    
	* @return void
	*/
	function deactivate()
	{
		delete_option('se_show_twitter');
		delete_option('se_show_fb_like');
		delete_option('se_show_fb_share');
		delete_option('se_show_google');				
		delete_option('se_show_pinterest');
		delete_option('se_show_stumbleupon');
		delete_option('se_icon_size');
		delete_option('se_icon_aligment');
		delete_option('se_call_to_action_text');
		delete_option('se_call_to_action_position');
		delete_option('se_call_to_action_text_size');
		delete_option('se_text_call_to_action_color');
		delete_option('se_call_to_action_text_style_bold');
		delete_option('se_call_to_action_text_style_italic');
		delete_option('se_call_to_action_text_style_underline');
		delete_option('se_call_to_action');
		delete_option('se_display_above_posts');
		delete_option('se_display_below_posts');
		delete_option('se_display_above_pages');
		delete_option('se_display_below_pages');
		delete_option('se_display_above_home');
		delete_option('se_display_below_home');
		delete_option('se_settings_twitter_username');
		delete_option('se_settings_fb_app_id');
		delete_option('se_custom_css');
		delete_option('se_text_call_to_action_arrow');
		delete_option('se_buttons_order');
        delete_option('se_margins');
		
		wp_clear_scheduled_hook('update_stats'); 
		
	}
	
	/**
	* Method for admin page plugin (main function of the class)
	*    
	* @return void
	*/
	function admin_page()
	{
		?>
		
		<div class='wrap'>
			<h2>
				<?php echo $this->page_title;?> - Setup
			</h2>
			
			<?php			
			if ($_POST) {
				
				//Select buttons to show
				if (isset($_POST['se_show_twitter']) && $_POST['se_show_twitter'] == 'on') 			update_option('se_show_twitter','1'); 		else update_option('se_show_twitter','0');
				if (isset($_POST['se_show_fb_like']) && $_POST['se_show_fb_like'] == 'on') 			update_option('se_show_fb_like','1'); 		else update_option('se_show_fb_like','0');
				if (isset($_POST['se_show_fb_share']) && $_POST['se_show_fb_share'] == 'on') 		update_option('se_show_fb_share','1'); 		else update_option('se_show_fb_share','0');
				if (isset($_POST['se_show_google']) && $_POST['se_show_google'] == 'on') 			update_option('se_show_google','1'); 		else update_option('se_show_google','0');
				if (isset($_POST['se_show_pinterest']) && $_POST['se_show_pinterest'] == 'on') 		update_option('se_show_pinterest','1'); 	else update_option('se_show_pinterest','0');
				if (isset($_POST['se_show_stumbleupon']) && $_POST['se_show_stumbleupon'] == 'on') 	update_option('se_show_stumbleupon','1'); 	else update_option('se_show_stumbleupon','0');
				
				//Icon Size				
				if (isset($_POST['se_icon_size'])) 	update_option('se_icon_size',$_POST['se_icon_size']);
				
				//Icons alignment
				if (isset($_POST['se_icon_aligment'])) 	update_option('se_icon_aligment',$_POST['se_icon_aligment']);				
				
				//Call to Action
				if (isset($_POST['se_call_to_action']) && $_POST['se_call_to_action'] == 'on') 	update_option('se_call_to_action','1'); else update_option('se_call_to_action','0');
				if (isset($_POST['se_call_to_action_text'])) 		update_option('se_call_to_action_text',$_POST['se_call_to_action_text']);
				if (isset($_POST['se_call_to_action_position'])) 	update_option('se_call_to_action_position',$_POST['se_call_to_action_position']);
				if (isset($_POST['se_call_to_action_text_size'])) 	update_option('se_call_to_action_text_size',$_POST['se_call_to_action_text_size']);
				if (isset($_POST['se_text_call_to_action_color'])) 	update_option('se_text_call_to_action_color',$_POST['se_text_call_to_action_color']);
				if (isset($_POST['se_call_to_action_text_style_bold'])) 	update_option('se_call_to_action_text_style_bold','1'); else update_option('se_call_to_action_text_style_bold','0');
				if (isset($_POST['se_call_to_action_text_style_italic'])) 	update_option('se_call_to_action_text_style_italic','1'); else update_option('se_call_to_action_text_style_italic','0');
				if (isset($_POST['se_call_to_action_text_style_underline'])) 	update_option('se_call_to_action_text_style_underline','1'); else update_option('se_call_to_action_text_style_underline','0');
				
				//Display options
				if (isset($_POST['se_display_above_posts']) && $_POST['se_display_above_posts'] == 'on')	update_option('se_display_above_posts','1'); else update_option('se_display_above_posts','0');
				if (isset($_POST['se_display_below_posts']) && $_POST['se_display_below_posts'] == 'on')	update_option('se_display_below_posts','1'); else update_option('se_display_below_posts','0');
				if (isset($_POST['se_display_above_pages']) && $_POST['se_display_above_pages'] == 'on')	update_option('se_display_above_pages','1'); else update_option('se_display_above_pages','0');
				if (isset($_POST['se_display_below_pages']) && $_POST['se_display_below_pages'] == 'on')	update_option('se_display_below_pages','1'); else update_option('se_display_below_pages','0');
				if (isset($_POST['se_display_above_home']) && $_POST['se_display_above_home'] == 'on') 		update_option('se_display_above_home','1');  else update_option('se_display_above_home','0');
				if (isset($_POST['se_display_below_home']) && $_POST['se_display_below_home'] == 'on') 		update_option('se_display_below_home','1');  else update_option('se_display_below_home','0');
				
				//Additional Information
				if (isset($_POST['se_settings_twitter_username'])) 	update_option('se_settings_twitter_username',$_POST['se_settings_twitter_username']);
				if (isset($_POST['se_settings_fb_app_id'])) 		update_option('se_settings_fb_app_id',$_POST['se_settings_fb_app_id']);
				if (isset($_POST['se_custom_css'])) 		update_option('se_custom_css',$_POST['se_custom_css']);
				if (isset($_POST['se_buttons_order'])) 		update_option('se_buttons_order',$_POST['se_buttons_order']);
				if (isset($_POST['se_text_call_to_action_arrow'])) 		update_option('se_text_call_to_action_arrow',$_POST['se_text_call_to_action_arrow']);
				if (isset($_POST['se_settings_feb_app_id'])) 		update_option('se_settings_feb_app_id',$_POST['se_settings_feb_app_id']);
                
                //Margins options
                if (isset($_POST['se_btn_margin'])) $this->margins['button']->parseMarginString($_POST['se_btn_margin']);
                if (isset($_POST['se_arw_margin'])) $this->margins['arrow']->parseMarginString($_POST['se_arw_margin']);
                if (isset($_POST['se_txt_margin'])) $this->margins['text']->parseMarginString($_POST['se_txt_margin']);
                
                update_option('se_margins',$this->margins);
				
				?>

				<div class='updated'>Configuration successfully saved.</div>

				<?php
			}

			$this->view_options_page();

		echo '</div>';
	}

	/**
	* Method for loading of plugin's options view in admin section
	*    
	* @return void
	*/
	function view_options_page()
	{
		?>
		
		<div id="options_form" class="se_admin_page">			
			
			<form id="se" method="post" action="" enctype="multipart/form-data">
				
				<div class="se_options">

					<fieldset>
						<legend>Additional Information</legend>
						<div class="labels">
							<label>Twitter Username </label><br/>
						</div>
						<div class="inputs">
							<p><input type="text" name="se_settings_twitter_username" value="<?php if (get_option('se_settings_twitter_username')) echo get_option('se_settings_twitter_username');?>"/></p>												
						</div>
					</fieldset>
					
					<fieldset>
						<legend>Select buttons to show</legend>
					
						<table id="se_show_buttons">
							<?php 																
								
								foreach (explode(',', $this->buttons_order) as $button)
								{
									switch(trim($button))
									{
										case 'twitter':
											?>
											<tr>
												<td>Twitter</td>
												<td><input name="se_show_twitter" rel="twitter" type="checkbox" <?php if (get_option('se_show_twitter')) echo "checked='checked'";?>/></td>
											</tr>
											<?php
											break;
										case 'fb_like':
											?>
											<tr>
												<td>Facebook like</td>
												<td><input name="se_show_fb_like" rel="fb_like" type="checkbox" <?php if (get_option('se_show_fb_like')) echo "checked='checked'";?>/></td>
											</tr>
											<?php
											break;
										case 'fb_share':
											?>
											<tr>
												<td>Facebook share</td>
												<td><input name="se_show_fb_share" rel="fb_share" type="checkbox" <?php if (get_option('se_show_fb_share')) echo "checked='checked'";?>/></td>
											</tr>
											<?php
											break;
										case 'google':
											?>
											<tr>
												<td>Google +1</td>
												<td><input name="se_show_google" rel="google" type="checkbox" <?php if (get_option('se_show_google')) echo "checked='checked'";?>/></td>
											</tr>
											<?php
											break;
										case 'pinterest':
											?>
											<tr>
												<td>Pinterest</td>
												<td><input name="se_show_pinterest" rel="pinterest" type="checkbox" <?php if (get_option('se_show_pinterest')) echo "checked='checked'";?>/></td>
											</tr>
											<?php
											break;
										case 'stumbleupon':
											?>
											<tr>
												<td>Stumbleupon</td>
												<td><input name="se_show_stumbleupon" rel="stumbleupon" type="checkbox" <?php if (get_option('se_show_stumbleupon')) echo "checked='checked'";?>/></td>
											</tr>
											<?php
											break;
									}
								}
							?>																																										
						</table>
						<p style="font-size:10px; color:#333;">To setup buttons order - You can use drag and drop. Please click SAVE after changes.</p>
					</fieldset>
					
					<input type="hidden" name="se_buttons_order" value="<?php if (get_option('se_buttons_order')) echo get_option('se_buttons_order');?>"/>
					
					<fieldset>
						<legend>Icon Size</legend>
						<div class="checkboxes">					
							<div class="checkboxes-inputs">
								<p><input name="se_icon_size" value="large" type="radio" <?php if (get_option('se_icon_size') == "large") echo "checked='checked'";?>/><span>Large icons</span></p>
								<p><input name="se_icon_size" value="small" type="radio" <?php if (get_option('se_icon_size') == "small") echo "checked='checked'";?>/><span>Small icons</span></p>
							</div>
						</div>
					</fieldset>
					
					<fieldset>
						<legend>Icons alignment</legend>
						<div class="checkboxes">					
							<div class="checkboxes-inputs">
								<p><input name="se_icon_aligment" value="left" type="radio" <?php if (get_option('se_icon_aligment') == "left") echo "checked='checked'";?>/><span>Left</span></p>
								<p><input name="se_icon_aligment" value="right" type="radio" <?php if (get_option('se_icon_aligment') == "right") echo "checked='checked'";?>/><span>Right</span></p>
								<p><input name="se_icon_aligment" value="center" type="radio" <?php if (get_option('se_icon_aligment') == "center") echo "checked='checked'";?>/><span>Center</span></p>
								<p><input name="se_icon_aligment" value="float-left" type="radio" <?php if (get_option('se_icon_aligment') == "float-left") echo "checked='checked'";?>/><span>Float Left</span></p>
								<p><input name="se_icon_aligment" value="float-right" type="radio" <?php if (get_option('se_icon_aligment') == "float-right") echo "checked='checked'";?>/><span>Float Right</span></p>
							</div>
						</div>
					</fieldset>										
					<div class="clear"></div>
					<fieldset>
						<legend>Custom CSS field</legend>
						<textarea name="se_custom_css" cols="75" rows="10"><?php if (get_option('se_custom_css')) echo get_option('se_custom_css');?></textarea>
					</fieldset>
					
				</div>
				
				<div class="se_options">					
					<fieldset>
						<legend>Call to Action</legend>
						<div class="checkboxes">					
							<div class="checkboxes-inputs">
								<p><input name="se_call_to_action" type="checkbox" <?php if (get_option('se_call_to_action')) echo "checked='checked'";?>/><span>Activate/Deactivate</span></p>
							</div>
						</div>
						<div class="labels">
							<label>Enter text for call to action</label><br/>					
							<label>Enter position of call to action</label><br/>					
							<label>Text size</label><br/>					
							<label>Text color</label><br/>
							<div id="label_for_down_picker" style="height:200px;display:none;"></div>					
							<label>Text style</label><br/>				
							<label>Arrow graphics</label><br/>					
						</div>
						<div class="inputs">
							<p><input type="text" name="se_call_to_action_text" value="<?php if (get_option('se_call_to_action_text')) echo get_option('se_call_to_action_text');?>"/></p>					
							<p style="padding-top:10px;">						
								<input name="se_call_to_action_position" value="left" type="radio" <?php if (get_option('se_call_to_action_position') == "left") echo "checked='checked'";?>/><span>Left</span>
								<input name="se_call_to_action_position" value="right" type="radio" <?php if (get_option('se_call_to_action_position') == "right") echo "checked='checked'";?>/><span>Right</span>
							</p>
							<p style="padding-top:10px;">						
								<input name="se_call_to_action_text_size" value="h1" type="radio" <?php if (get_option('se_call_to_action_text_size') == "h1") echo "checked='checked'";?>/><span>H1</span>
								<input name="se_call_to_action_text_size" value="h2" type="radio" <?php if (get_option('se_call_to_action_text_size') == "h2") echo "checked='checked'";?>/><span>H2</span>
								<input name="se_call_to_action_text_size" value="h3" type="radio" <?php if (get_option('se_call_to_action_text_size') == "h3") echo "checked='checked'";?>/><span>H3</span>
								<input name="se_call_to_action_text_size" value="h4" type="radio" <?php if (get_option('se_call_to_action_text_size') == "h4") echo "checked='checked'";?>/><span>H4</span>
								<input name="se_call_to_action_text_size" value="h5" type="radio" <?php if (get_option('se_call_to_action_text_size') == "h5") echo "checked='checked'";?>/><span>H5</span>
							</p>					
							<p>
								<input type="text" id="se_text_call_to_action_color" name="se_text_call_to_action_color"  value="<?php if (get_option('se_text_call_to_action_color')) echo get_option('se_text_call_to_action_color');?>"/>
								<div id="ilctabscolorpicker" style="display:none;"></div>
							</p>
							<p style="padding-top:10px;">						
								<input name="se_call_to_action_text_style_bold" type="checkbox" <?php if (get_option('se_call_to_action_text_style_bold')) echo "checked='checked'";?>/><span>Bold</span>
								<input name="se_call_to_action_text_style_italic" type="checkbox" <?php if (get_option('se_call_to_action_text_style_italic')) echo "checked='checked'";?>/><span>Italic</span>
								<input name="se_call_to_action_text_style_underline" type="checkbox" <?php if (get_option('se_call_to_action_text_style_underline')) echo "checked='checked'";?>/><span>Underline</span>
							</p>
							<p>
								<div style="width: 252px;">
									<div>
										<div id="se_call_to_action_block_current_arrow">
										<?php if ( get_option( 'se_text_call_to_action_arrow'  ) ) : ?>
											<img id="se_call_action_to_current_arrow" src="<?php echo get_option( 'se_text_call_to_action_arrow' ); ?>"/>
										<?php endif; ?>
										</div>
										<input type="button" value="More..." id="se_call_to_action_more_arrows"/>
										<div class="clear"></div>
									</div>	
									<div id="se_call_to_action_block_arrows">
										<?php
											$dir_arrows_path = plugin_dir_path( __FILE__ ).'images/arrows';
											if ( is_dir( $dir_arrows_path ) && ( $resource_dir = opendir( $dir_arrows_path ) ) ) {
												while ( false !== ( $file = readdir( $resource_dir ) ) ) {
													if ( $file != '.' && $file != '..' && is_file( $dir_arrows_path . '/' . $file ) && preg_match( '/\.(png|jpg|jpeg|gif)$/ui', $file ) ) : ?>
														<div class="se_call_to_action_image_arrow">
															<img src="<?php echo plugins_url( 'images/arrows/' . $file , __FILE__ ); ?>" alt="<?php echo $file; ?>" />
														</div>	
													<?php endif;
												}
												closedir($resource_dir);
											}
										?>
										<div class="clear"></div>
									</div>
									<input type="hidden" id="se_call_action_to_arrow" name="se_text_call_to_action_arrow" value="<?php if ( get_option( 'se_text_call_to_action_arrow' ) ) echo get_option( 'se_text_call_to_action_arrow' ); ?>" />
								</div>
							</p>
						</div>
					</fieldset>
					
					<fieldset>
						<legend>Display options</legend>
						<div class="checkboxes">					
							<div class="checkboxes-inputs">
								<p><input name="se_display_above_posts" type="checkbox" <?php if (get_option('se_display_above_posts')) echo "checked='checked'";?>/><span>Above content on posts</span></p>
								<p><input name="se_display_below_posts" type="checkbox" <?php if (get_option('se_display_below_posts')) echo "checked='checked'";?>/><span>Below content on posts</span></p>
								<p><input name="se_display_above_pages" type="checkbox" <?php if (get_option('se_display_above_pages')) echo "checked='checked'";?>/><span>Above content on pages</span></p>
								<p><input name="se_display_below_pages" type="checkbox" <?php if (get_option('se_display_below_pages')) echo "checked='checked'";?>/><span>Below content on pages</span></p>
								<p><input name="se_display_above_home" type="checkbox" <?php if (get_option('se_display_above_home')) echo "checked='checked'";?>/><span>Above content on homepage</span></p>						
								<p><input name="se_display_below_home" type="checkbox" <?php if (get_option('se_display_below_home')) echo "checked='checked'";?>/><span>Below content on homepage</span></p>						
							</div>
						</div>
					</fieldset>																				
				</div>
				<?php $this->show_sidebar();?>
				<div style="position:relative; clear:both;">
                    <fieldset>
						<legend>Set Margins</legend>
                        <div id="se_control">
                            <div class="se_control_margins">
                                <div class="se_control_title"><span>Set Button Margins:</span></div>
                                <div class="se_control_margins_top"></div>
                                <div class="se_control_margins_left_right">
                                    <div class="se_control_margins_left">
                                        <input type="button" value="&nbsp;" onclick="se_set_margin('se_btn_margin_left'); return false;" />
                                        <input id="se_btn_margin_left" onkeyup="se_set_margin_value(this);" onblur="se_set_margin_blur(this);" type="text" value="<?php echo $this->margins['button']->getMarginLeft(); ?>" />
                                        <span>px</span>
                                        <input type="hidden" id="se_btn_margin_left_default" value="<?php echo $this->margins['button']->getMarginLeft(); ?>" />
                                    </div>    
                                    <div class="se_control_margins_right">
                                        <input id="se_btn_margin_right" onkeyup="se_set_margin_value(this);" onblur="se_set_margin_blur(this);" type="text" value="<?php echo $this->margins['button']->getMarginRight(); ?>" />
                                        <span>px</span>
                                        <input type="button" value="&nbsp;" onclick="se_set_margin('se_btn_margin_right'); return false;" />
                                        <input type="hidden" id="se_btn_margin_right_default" value="<?php echo $this->margins['button']->getMarginRight(); ?>" />
                                    </div>
                                    <div class="clear"></div>    
                                </div>
                                <div class="se_control_margins_bottom"></div>
                                <input type="hidden" id="se_btn_margin" name="se_btn_margin" value="<?php echo $this->margins['button']->getMarginString(); ?>" />
                            </div>
                            
                            <div class="se_control_margins">
                                <div class="se_control_title"><span>Set Arrow Margins:</span></div>
                                <div class="se_control_margins_top">
                                    <input type="button" value="&nbsp;" onclick="se_set_margin('se_arw_margin_top'); return false;" /><br/>
                                    <input id="se_arw_margin_top" onkeyup="se_set_margin_value(this);" onblur="se_set_margin_blur(this);" type="text" value="<?php echo $this->margins['arrow']->getMarginTop(); ?>" />
                                    <span>px</span>
                                    <input type="hidden" id="se_arw_margin_top_default" value="<?php echo $this->margins['arrow']->getMarginTop(); ?>" />
                                </div>
                                <div class="se_control_margins_left_right">
                                    <div class="se_control_margins_left">
                                        <input type="button" value="&nbsp;" onclick="se_set_margin('se_arw_margin_left'); return false;" />
                                        <input id="se_arw_margin_left" onkeyup="se_set_margin_value(this);" onblur="se_set_margin_blur(this);" type="text" value="<?php echo $this->margins['arrow']->getMarginLeft(); ?>" />
                                        <span>px</span>
                                        <input type="hidden" id="se_arw_margin_left_default" value="<?php echo $this->margins['arrow']->getMarginLeft(); ?>" />
                                    </div>
                                    <div class="se_control_margins_right">
                                        <input id="se_arw_margin_right" onkeyup="se_set_margin_value(this);" onblur="se_set_margin_blur(this);" type="text" value="<?php echo $this->margins['arrow']->getMarginRight(); ?>" />
                                        <span>px</span>
                                        <input type="button" value="&nbsp;" onclick="se_set_margin('se_arw_margin_right'); return false;" />
                                        <input type="hidden" id="se_arw_margin_right_default" value="<?php echo $this->margins['arrow']->getMarginRight(); ?>" />
                                    </div>
                                    <div class="clear"></div>    
                                </div>
                                <div class="se_control_margins_bottom">
                                    <input id="se_arw_margin_bottom" onkeyup="se_set_margin_value(this);" onblur="se_set_margin_blur(this);" type="text" value="<?php echo $this->margins['arrow']->getMarginBottom(); ?>" />
                                    <span>px</span><br/>
                                    <input type="button" value="&nbsp;" onclick="se_set_margin('se_arw_margin_bottom'); return false;" />
                                    <input type="hidden" id="se_arw_margin_bottom_default" value="<?php echo $this->margins['arrow']->getMarginBottom(); ?>" />
                                </div>
                                <input type="hidden" id="se_arw_margin" name="se_arw_margin" value="<?php echo $this->margins['arrow']->getMarginString(); ?>" />
                            </div>
                            
                            <div class="se_control_margins">
                                <div class="se_control_title"><span>Set Text Margins:</span></div>
                                <div class="se_control_margins_top">
                                    <input type="button" value="&nbsp;" onclick="se_set_margin('se_txt_margin_top'); return false;" /><br/>
                                    <input id="se_txt_margin_top" onkeyup="se_set_margin_value(this);" onblur="se_set_margin_blur(this);" type="text" value="<?php echo $this->margins['text']->getMarginTop(); ?>" />
                                    <span>px</span>
                                    <input type="hidden" id="se_txt_margin_top_default" value="<?php echo $this->margins['text']->getMarginTop(); ?>" />
                                </div>
                                <div class="se_control_margins_left_right">
                                    <div class="se_control_margins_left">
                                        <input type="button" value="&nbsp;" onclick="se_set_margin('se_txt_margin_left'); return false;" />
                                        <input id="se_txt_margin_left" onkeyup="se_set_margin_value(this);" onblur="se_set_margin_blur(this);" type="text" value="<?php echo $this->margins['text']->getMarginLeft(); ?>" />
                                        <span>px</span>
                                        <input type="hidden" id="se_txt_margin_left_default" value="<?php echo $this->margins['text']->getMarginLeft(); ?>" />
                                    </div>
                                    <div class="se_control_margins_right">
                                        <input id="se_txt_margin_right" onkeyup="se_set_margin_value(this);" onblur="se_set_margin_blur(this);" type="text" value="<?php echo $this->margins['text']->getMarginRight(); ?>" />
                                        <span>px</span>
                                        <input type="button" value="&nbsp;" onclick="se_set_margin('se_txt_margin_right'); return false;" />
                                        <input type="hidden" id="se_txt_margin_right_default" value="<?php echo $this->margins['text']->getMarginRight(); ?>" />
                                    </div>
                                    <div class="clear"></div>    
                                </div>
                                <div class="se_control_margins_bottom">
                                    <input id="se_txt_margin_bottom" onkeyup="se_set_margin_value(this);" onblur="se_set_margin_blur(this);" type="text" value="<?php echo $this->margins['text']->getMarginBottom(); ?>" />
                                    <span>px</span><br/>
                                    <input type="button" value="&nbsp;" onclick="se_set_margin('se_txt_margin_bottom'); return false;" />
                                    <input type="hidden" id="se_txt_margin_bottom_default" value="<?php echo $this->margins['text']->getMarginBottom(); ?>" />
                                </div>
                                <input type="hidden" id="se_txt_margin" name="se_txt_margin" value="<?php echo $this->margins['text']->getMarginString(); ?>" />
                            </div>
                            <input type="button" value="Reset" id="se_reset_margin" />
                            <div class="clear"></div>
                        </div>
					</fieldset>
					<fieldset>
						<legend>Preview</legend>
						<a href="javascript:void(0);" id="se_preview">Show</a>
						<p>&nbsp;</p>
						<div id="live_preview"></div>
					</fieldset>
					<input type="submit" value="Save" class="btn-submit"/>
				</div>
			</form>													
			
		</div>	
		
		<?php
	}
	
	/**
	* Method for admin page plugin (main function of the class)
	*    
	* @return void
	*/
	function stats_page()
	{				
		?>
		<div class='wrap'>
			<h2><?php echo $this->page_title;?> - Stats </h2>
			<div id="options_form" style="margin:20px;">						
				<form id="se" method="post" action="" enctype="multipart/form-data">
					<div style="width:70%; float:left;">																														
						<fieldset style="border:none; border-top:1px solid #ccc;">
							<legend>Top 10</legend>
							<a href="javascript:void(0);" id="posts_top_stats" class="se_top_filter se_selected">Posts</a>&nbsp;|&nbsp;<a href="javascript:void(0);" class="se_top_filter" id="pages_top_stats">Pages</a><br/><br/>
							<div id="se_stats_top">
								<?php echo $this->get_stats_top_table('post')?>
							</div>
						</fieldset>							
						<fieldset style="border:none; border-top:1px solid #ccc;">
							<legend>Latest Posts/Pages</legend>
							<a href="javascript:void(0);" id="posts_stats" class="se_filter se_selected">Posts</a>&nbsp;|&nbsp;<a href="javascript:void(0);" class="se_filter" id="pages_stats">Pages</a><br/><br/>
							<div id="se_stats_table">
								<?php $this->get_stats_table('post')?>
							</div>
						</fieldset>						
						<fieldset style="border:none; border-top:1px solid #ccc;">
							<legend>Last 30 days</legend>
							<a href="javascript:void(0);" id="posts_last_top_stats" class="se_last_top_filter se_selected">Posts</a>&nbsp;|&nbsp;<a href="javascript:void(0);" class="se_last_top_filter" id="pages_last_top_stats">Pages</a><br/><br/>
							<div id="se_stats_last_top">
								<?php echo $this->get_stats_last_top_table('post')?>
							</div>
						</fieldset>						
					</div>		
					<?php $this->show_sidebar();?>
				</form>
			</div>
		</div>				
		<?php
	}
	
	function show_sidebar(){
	?>
		<div id="se_sidebar">
			
			<fieldset style="background:#dfdfdf; border:1px solid #333;">
				<legend>Social Essentials plugin</legend>
					<p>Thank you for using Social Essentials!</p>

					<p>This is a free plugin and our goal is to make it the most useful social sharing plugin you've ever seen. We are not asking for donations, but it would be supremely cool of you if you linked back to our plugin page. Write a quick review and let your readers know about the awesome plugin you're using! :)</p>

					<p>Also, remember to share this with your friends, if you like it. Thanks!</p>
								
					<div>
						<div class="se_button" style="width:80px">
							<a href="https://twitter.com/share" class="twitter-share-button" data-url="http://imimpact.com/free-stuff/social-essentials" data-text="social essentials" data-via="<?php echo $this->twitter_username; ?>" data-counturl="http://imimpact.com/free-stuff/social-essentials" data-count="horizontal">Tweet</a>
							<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
						</div>
						<div class="se_button">
							<iframe src="//www.facebook.com/plugins/like.php?href=http://imimpact.com/free-stuff/social-essentials&amp;send=false&amp;layout=button_count&amp;show_faces=false&amp;action=like&amp;colorscheme=light&amp;font" scrolling="no" frameborder="0" allowTransparency="true" style="width:72px; height:40px;"></iframe>
						</div>
						<div class="se_button" style="width:50px"><g:plusone size="small" href="http://imimpact.com/free-stuff/social-essentials" count="true"></g:plusone></div>

						<script type="text/javascript">
						(function() {
							var po = document.createElement("script"); po.type = "text/javascript"; po.async = true;
							po.src = "https://apis.google.com/js/plusone.js";
							var s = document.getElementsByTagName("script")[0]; s.parentNode.insertBefore(po, s);
						})();
						</script>
					</div>
			</fieldset>
			
			<fieldset style="background:#dfdfdf; border:1px solid #333;">
				<legend>Latest IM Impact Posts</legend>
				<?php 
					$db = readDatabase('http://feeds.feedburner.com/imimpact'); 
					
					foreach ($db as $key => $row):
						if (preg_match_all('[src=".+?(jpg|gif|png|jpeg)"]i', $row->description, $imgs))
						{					
							$src = str_replace("src=","",str_replace("\"", "", $imgs[0]));										
							
							list($width, $height, $type, $attr) = getimagesize($src[0]);										
												
							$new_height  = round(60*($height/$width));
							
							echo '
							<div class="feed_item">
								<div class="feed_img">
									<img src="'.$src[0].'" width="60" height="'.$new_height.'"/>
								</div>
								<div class="feed_content">
									<div class="feed_item_title">
										<a target="_blank" href="'.$row->link.'?utm_source=sociale1&utm_medium=plugin&utm_campaign=plugin">'.$row->title.'</a>
									</div>										
								</div>
							</div>';
												
						}
						else
						{
							echo '
							<div class="feed_item">
								<div class="feed_item_title">
									<a target="_blank" href="'.$row->link.'?utm_source=sociale1&utm_medium=plugin&utm_campaign=plugin">'.$row->title.'</a>
								</div>									
							</div>';
						}
						
						if ($key == $this->count_posts) break;
						
					endforeach;
				?>
			</fieldset>
		</div>
	<?php
	}
	
	function get_stats_table($type = 'post')
	{
		$type =  (isset($_POST['type'])) ? $_POST['type'] : $type;
		ob_start();
		?>
			<table id="se_table_stats"></table>
			<div id="se_stats_pager"></div>
			<script type="text/javascript">
				jQuery(document).ready(function(){
					var col_names = [ '<?php echo ucfirst($type); ?>', 'Facebook like', 'Facebook share', 'Twitter', 'Google +1', 'Stumbleupon', 'Pinterest', 'Total' ];
					var col_model = [
	                    {name:'name', index:'name', sortable:false, width:150},
	                    {name:'facebook_like', index:'facebook_like', align:"center",  sorttype:"integer", width:95},
	                    {name:'facebook_share', index:'facebook_share', align:"center", sorttype:"integer", width:95},
	                    {name:'twitter', index:'twitter', align:"center", sorttype:"integer", width:70},
	                    {name:'google', index:'google', sorttype:"integer", align:"center", sorttype:"integer", width:70},
						{name:'stumbleupon', index:'stumbleupon', align:"center", sorttype:"integer", width:80},
						{name:'printerest', index:'printerest', align:"center", sorttype:"integer", width:70},
						{name:'total', index:'total', align:"center", sorttype:"integer", width:70}
	                ];
					var gridData = [
					<?php
						$posts_array = get_posts(array('post_status' => 'publish', 'post_type' => $type, 'numberposts' => -1));
						foreach ($posts_array as $post) :
							$share_all_data = json_decode(get_post_meta($post->ID, 'share_all_data', true), true);
							$permalink = '\'<a href="'.get_permalink($post->ID).'">'.htmlspecialchars(addslashes($post->post_title)).'</a>\'';
					?>
						{ 
							name: <?php echo $permalink; ?>, 
							facebook_like: <?php if ( ! is_integer( $share_all_data['like_count'] ) ) echo "''"; else echo $share_all_data['like_count']; ?>,
							facebook_share: <?php if ( ! is_integer( $share_all_data['share_count'] ) ) echo "''"; else echo $share_all_data['share_count']; ?>,
							twitter: <?php if ( ! is_integer( $share_all_data['twitter'] ) ) echo "''"; else echo $share_all_data['twitter']; ?>,
							google: <?php if ( ! is_integer( $share_all_data['plusone'] ) ) echo "''"; else echo $share_all_data['plusone']; ?>,
							stumbleupon: <?php if ( ! is_integer( $share_all_data['stumble'] ) ) echo "''"; else echo $share_all_data['stumble']; ?>,
							printerest: <?php if ( ! is_integer( $share_all_data['pinit'] ) ) echo "''"; else echo $share_all_data['pinit']; ?>,
							total: <?php if ( ! is_integer( $share_all_data['count'] ) ) echo "''"; else echo $share_all_data['count']; ?>
						},
					<?php endforeach; ?>
					];
					jQuery("#se_table_stats").jqGrid({       
		                datatype: "local",
		                data: gridData,
		                autowidth: true,
						height: '100%',
		                colNames: col_names,
		                colModel: col_model,
		                rowNum:10,
		                rowList:[10,20,50,100],
		                pager: '#se_stats_pager',
		                gridview:true,
		                rownumbers:true,
		                viewrecords: true,
						loadonce: true,
		                sortorder: 'desc'
		            });
				});	
			</script>
		<?php
		$html = ob_get_contents();
		ob_end_clean();	
		if ($_POST) exit($html); else echo $html;
	}		
	
	function get_stats_top_table($type = 'post')
	{
		$type =  (isset($_POST['type'])) ? $_POST['type'] : $type;
		ob_start();
		?>
			<table id="se_table_top_stats"></table>
			<div id="se_stats_top_pager"></div>
			<script type="text/javascript">
				jQuery(document).ready(function(){
					var col_names = [ '<?php echo ucfirst($type); ?>', 'Facebook like', 'Facebook share', 'Twitter', 'Google +1', 'Stumbleupon', 'Pinterest', 'Total' ];
					var col_model = [
	                    {name:'name', index:'name', sortable:false, width:150},
	                    {name:'facebook_like', index:'facebook_like', align:"center",  sorttype:"integer", width:95},
	                    {name:'facebook_share', index:'facebook_share', align:"center", sorttype:"integer", width:95},
	                    {name:'twitter', index:'twitter', align:"center", sorttype:"integer", width:70},
	                    {name:'google', index:'google', sorttype:"integer", align:"center", sorttype:"integer", width:70},
						{name:'stumbleupon', index:'stumbleupon', align:"center", sorttype:"integer", width:80},
						{name:'printerest', index:'printerest', align:"center", sorttype:"integer", width:70},
						{name:'total', index:'total', align:"center", sorttype:"integer", width:70}
	                ];
					var gridData = [
					<?php
						$posts_array = get_posts(array('post_status' => 'publish', 'post_type' => $type, 'numberposts' => -1));
						foreach ($posts_array as $key=>$post) : 				
							$share_all_data = json_decode(get_post_meta($post->ID, 'share_all_data', true), true);
							$posts_array[$key]->share_count = $share_all_data['count'];
						endforeach;
						
						usort($posts_array, array(&$this, "sort"));
						
						foreach ($posts_array as $key => $post) :
							$share_all_data = json_decode(get_post_meta($post->ID, 'share_all_data', true), true);
							$permalink = '\'<a href="'.get_permalink($post->ID).'">'.htmlspecialchars(addslashes($post->post_title)).'</a>\'';
						?>
							{ 
								name: <?php echo $permalink; ?>, 
								facebook_like: <?php if ( ! is_integer( $share_all_data['like_count'] ) ) echo "''"; else echo $share_all_data['like_count']; ?>,
								facebook_share: <?php if ( ! is_integer( $share_all_data['share_count'] ) ) echo "''"; else echo $share_all_data['share_count']; ?>,
								twitter: <?php if ( ! is_integer( $share_all_data['twitter'] ) ) echo "''"; else echo $share_all_data['twitter']; ?>,
								google: <?php if ( ! is_integer( $share_all_data['plusone'] ) ) echo "''"; else echo $share_all_data['plusone']; ?>,
								stumbleupon: <?php if ( ! is_integer( $share_all_data['stumble'] ) ) echo "''"; else echo $share_all_data['stumble']; ?>,
								printerest: <?php if ( ! is_integer( $share_all_data['pinit'] ) ) echo "''"; else echo $share_all_data['pinit']; ?>,
								total: <?php if ( ! is_integer( $share_all_data['count'] ) ) echo "''"; else echo $share_all_data['count']; ?>
							},
						<?php if ($key > 9) break; endforeach; ?>
					];
					jQuery("#se_table_top_stats").jqGrid({       
		                datatype: "local",
		                data: gridData,
		                autowidth: true,
						height: '100%',
		                colNames: col_names,
		                colModel: col_model,
		                rowNum:10,
		                pager: '#se_stats_top_pager',
						pgbuttons: false,
						pginput: false,
		                gridview:true,
		                rownumbers:true,
		                viewrecords: true,
						loadonce: true,
		                sortorder: 'desc'
		            });
				});	
			</script>
		<?php
		$html = ob_get_contents();
		ob_end_clean();	
		if ($_POST) exit($html); else echo $html;
		
	}
	
	function get_stats_last_top_table($type = 'post')
	{
		$type =  (isset($_POST['type'])) ? $_POST['type'] : $type;
		
		ob_start();
		?>
			<table id="se_table_last_top_stats"></table>
			<div id="se_stats_last_top_pager"></div>
			<script type="text/javascript">
				jQuery(document).ready(function(){
					var col_names = [ '<?php echo ucfirst($type); ?>', 'Facebook like', 'Facebook share', 'Twitter', 'Google +1', 'Stumbleupon', 'Pinterest', 'Total' ];
					var col_model = [
	                    {name:'name', index:'name', sortable:false, width:150},
	                    {name:'facebook_like', index:'facebook_like', align:"center",  sorttype:"integer", width:95},
	                    {name:'facebook_share', index:'facebook_share', align:"center", sorttype:"integer", width:95},
	                    {name:'twitter', index:'twitter', align:"center", sorttype:"integer", width:70},
	                    {name:'google', index:'google', sorttype:"integer", align:"center", sorttype:"integer", width:70},
						{name:'stumbleupon', index:'stumbleupon', align:"center", sorttype:"integer", width:80},
						{name:'printerest', index:'printerest', align:"center", sorttype:"integer", width:70},
						{name:'total', index:'total', align:"center", sorttype:"integer", width:70}
	                ];
					var gridData = [
					<?php
						$posts_array = get_posts(array('post_status' => 'publish', 'post_type' => $type, 'numberposts' => -1));
					
						foreach ($posts_array as $key=>$post) :
							$posts_array[$key]->share_count = get_post_meta($post->ID, 'share_count', true);
						endforeach;
						
						usort($posts_array, array(&$this, "sort"));
						
						foreach ($posts_array as $key => $post) :
							$counts = json_decode(get_post_meta($post->ID, 'share_data', true), true);
							$permalink = '\'<a href="'.get_permalink($post->ID).'">'.htmlspecialchars(addslashes($post->post_title)).'</a>\'';
						?>
							{ 
								name: <?php echo $permalink; ?>, 
								facebook_like: <?php echo $this->array_sum_key($counts ,'like_count'); ?>,
								facebook_share: <?php echo $this->array_sum_key($counts ,'share_count'); ?>,
								twitter: <?php echo $this->array_sum_key($counts ,'twitter'); ?>,
								google: <?php echo $this->array_sum_key($counts ,'plusone'); ?>,
								stumbleupon: <?php echo $this->array_sum_key($counts ,'stumble'); ?>,
								printerest: <?php echo $this->array_sum_key($counts ,'pinit'); ?>,
								total: <?php echo $post->share_count; ?>
							},
						<?php endforeach; ?>
					];
					jQuery("#se_table_last_top_stats").jqGrid({       
		                datatype: "local",
		                data: gridData,
		                autowidth: true,
						height: '100%',
		                colNames: col_names,
		                colModel: col_model,
		                rowNum:10,
		                rowList:[10,20,50,100],
		                pager: '#se_stats_last_top_pager',
		                gridview:true,
		                rownumbers:true,
		                viewrecords: true,
						loadonce: true,
		                sortorder: 'desc'
		            });
				});	
			</script>
		<?php
		$html = ob_get_contents();
		ob_end_clean();	
		if ($_POST) exit($html); else echo $html;
		
	}
	
	function update_stats()
	{		
		
		$types = array(
			'post',
			'page'
		);
		
		foreach ($types as $type)
		{
		
			$posts_array = get_posts(array('post_status' => 'publish', 'post_type' => $type, 'numberposts' => -1));
				
			foreach ($posts_array as $key=>$post) : 
					
				$xml = simplexml_load_string(file_get_contents('http://api.facebook.com/method/fql.query?query=select%20%20like_count,%20total_count,%20share_count,%20click_count%20from%20link_stat%20where%20url=%22'.
				
				get_permalink($post->ID).'%22'));
				
				$json = json_encode($xml);
				
				$array = json_decode($json,TRUE);
				
				$counts = $this->slick_stats_count(get_permalink($post->ID));
				
				$data = array(
					'like_count' => $array['link_stat']['like_count'],
					'share_count' => $array['link_stat']['share_count'],
					'twitter' => $counts['twitter'],
					'plusone' => $counts['plusone'],
					'stumble' => $counts['stumble'],
					'pinit' => $counts['pinit'],
					'count' => array_sum($counts) + $array['link_stat']['like_count'] + $array['link_stat']['share_count'],
					'time'  => time()
				);
				
				$share_data = get_post_meta($post->ID, 'share_data', true);						
				
				if (empty($share_data))
				{
					add_post_meta($post->ID, 'share_data', json_encode($data));
					add_post_meta($post->ID, 'share_all_data', json_encode($data));
					add_post_meta($post->ID, 'share_count', $data['count']);
				}
				else
				{
					update_post_meta($post->ID, 'share_all_data', json_encode($data));
					
					$share_data = json_decode($share_data, true);
					
					$data = array(
						'like_count'  => $array['link_stat']['like_count'] - $this->array_sum_key($share_data, 'like_count'),
						'share_count' => $array['link_stat']['share_count'] - $this->array_sum_key($share_data, 'share_count'),
						'twitter' => $counts['twitter'] - $this->array_sum_key($share_data, 'twitter'),
						'plusone' => $counts['plusone'] - $this->array_sum_key($share_data, 'plusone'),
						'stumble' => $counts['stumble'] - $this->array_sum_key($share_data, 'stumble'),
						'pinit'   => $counts['pinit'] - $this->array_sum_key($share_data, 'pinit'),
						'count'   => array_sum($counts) + $array['link_stat']['like_count'] + $array['link_stat']['share_count'] - get_post_meta($post->ID, 'share_count', true),
						'time'    => time()
					);
					
					array_push($share_data, $data);

					foreach ($share_data as $key=>$item)
					{						
						if (strtotime('- 1 month') > strtotime($item['time']))
						{
							unset($share_data[$key]);
						}
					}					
					
					$new_count = 0;
					
					foreach ($share_data as $item)
					{
						$new_count += $item['count'];				
					}
					
					update_post_meta($post->ID, 'share_data', json_encode($share_data));					
					update_post_meta($post->ID, 'share_count', $new_count);
					
				}
				
			endforeach;
		}
	}
	
	function array_sum_key( $arr, $index = null ){
		if(!is_array( $arr ) || sizeof( $arr ) < 1){
			return 0;
		}
		$ret = 0;
		foreach( $arr as $id => $data ){
			if ($id == $index)			
				$ret += (isset( $arr[$index] )) ? $arr[$index] : 0;			
		}
		return $ret;
	}
	
	function sort($a,$b) {					
		
		if ($a->share_count == $b->share_count) {
			return 0;
		} else { 			
			if($a->share_count < $b->share_count) {
				return 1;
			} else {
				return -1;
			}
		}
	}
	
	function slick_stats_count($link){
	
		$url = $link;
		@$json = file_get_contents("http://api.sharedcount.com/?url=" . rawurlencode($link));
		$counts = json_decode($json, true);
		$count = Array();
		
		$count['twitter'] = $counts["Twitter"];		
		$count['plusone'] = $counts["GooglePlusOne"];		
		$count['stumble'] = $counts["StumbleUpon"];		

		$url_json = esc_url_raw('http://api.pinterest.com/v1/urls/count.json?callback=&url='.$link, array('http', 'https'));
		$response = wp_remote_get($url_json);
		
		$code = wp_remote_retrieve_response_code($response);
		$pinit = 0;
		if ($code == 200){
				$data = $response['body'];
				$data = str_replace(')', '', str_replace('(', '', $data));
				$data = json_decode($data);
				$pinit = $data->{'count'} != '' ? $data->{'count'} : 0 ;
		}
		$count['pinit'] = $pinit;

		return $count;
	}
	
}

class Margins {
    var $top;
    var $right;
    var $bottom;
    var $left;
    
    function Margins( $top = 0, $right = 0, $bottom = 0, $left = 0 ){
        $this->top = is_integer( $top ) ? $top : 0;
        $this->right = is_integer( $right ) ? $right : 0;
        $this->bottom = is_integer( $bottom ) ? $bottom : 0;
        $this->left = is_integer( $left ) ? $left : 0;
    }
    public function getMarginTop(){
        return $this->top;
    }
    public function getMarginRight(){
        return $this->right;
    }
    public function getMarginBottom(){
        return $this->bottom;
    }
    public function getMarginLeft(){
        return $this->left;
    }
    public function getMarginString(){
        return $this->top.'px '.$this->right.'px '.$this->bottom.'px '.$this->left.'px';
    }
    public function parseMarginString( $string ){
        if (preg_match('/^([\-]?[\d]+)px\s([\-]?[\d]+)px\s([\-]?[\d]+)px\s([\-]?[\d]+)px$/ui',$string)){
            $string = str_replace('px','',$string);
            $margins = explode(' ',$string);
            $this->top = $margins[0];
            $this->right = $margins[1];
            $this->bottom = $margins[2];
            $this->left = $margins[3];
        }
        else{
            $this->top = 0;
            $this->right = 0;
            $this->bottom = 0;
            $this->left = 0;
        }
    }
}

class RssItem {
	var $title;  
	var $link;    
	var $descroption;
	var $guid;  
	var $pubdate;  
	
	function RssItem ($aa) 
	{
		foreach ($aa as $k=>$v)
			$this->$k = $aa[$k];
	}
}

function readDatabase($filename) 
{		
	$data = file_get_contents($filename);
	$parser = xml_parser_create();
	xml_parser_set_option($parser, XML_OPTION_CASE_FOLDING, 0);
	xml_parser_set_option($parser, XML_OPTION_SKIP_WHITE, 1);
	xml_parse_into_struct($parser, $data, $values, $tags);
	xml_parser_free($parser);
	
	foreach ($tags as $key=>$val) {
		if ($key == "item") {
			$molranges = $val;				
			for ($i=0; $i < count($molranges); $i+=2) {
				$offset = $molranges[$i] + 1;
				$len = $molranges[$i + 1] - $offset;
				$tdb[] = parseMol(array_slice($values, $offset, $len));
			}
		} else {
			continue;
		}
	}
	return $tdb;
}

function parseMol($mvalues) 
{
	for ($i=0; $i < count($mvalues); $i++) {
		(!empty($mvalues[$i]["value"])) ? $mol[$mvalues[$i]["tag"]] = $mvalues[$i]["value"] : $mol[$mvalues[$i]["tag"]] = '';
	}
	return new RssItem($mol);
}

function sub_text($text,$maxwords = 10, $maxchar = 0) {
	
	$words = explode(' ',$text);
	$text='';
	foreach ($words as $key => $word) {
		if ($maxwords)
		{
			if ($key != $maxwords)
			{
				$text.=' '.$word;
			}
			else
			{
				$text.='...';
				break;
			}
		}
		if ($maxchar)
		{
			if (mb_strlen($text.' '.$word)<$maxchar) {
				$text.=' '.$word;
			}
			else {
				$text.='...';
				break;
			}
		}			
	}
	return $text;
}
?>