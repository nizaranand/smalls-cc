		<div class="clear"></div>
		</div>
		<?php if(!get_option(THEMESLUG.'_remove_curvs')):?><div class="content_bottom"></div><?php endif;?>
		</div>
	</div>
	<div class="clear"></div>

	<!-- footer --> 
	<div id="footer">		  			 
			<!-- footer links -->
			    <?php 
			    
			    //call the footer menu
			    $topmenuVars = array(
				   'menu'            => 'RT Theme Footer Navigation Menu',
				   'depth'		 => 1,
				   'menu_id'         => '',
				   'menu_class'      => 'footer_links', 
				   'echo'            => false,
				   'container'       => '', 
				   'container_class' => '', 
				   'container_id'    => '',
				   'theme_location'  => 'rt-theme-footer-menu' 
			    );
			    
			    $footer_menu=wp_nav_menu($topmenuVars);
			    echo add_class_first_item($footer_menu);
			    ?>
	  
			<!-- / footer links -->
				
			<!-- copyright text -->
			<div class="copyright"><?php echo wpml_t(THEMESLUG, 'Footer Copyright Text', get_option(THEMESLUG.'_footer_copy'));?></div>
			<!-- / copyright text -->
			<div  id =  'smalls-plugins'  >
				<script	src	=	"//platform.linkedin.com/in.js"
							type	=	"text/javascript"
				>	</script>
				<script	type				=	"IN/RecommendProduct"
							data-company	=	"24013162"
							data-counter	=	"right"
				>	</script>
				
				<div id="fb-root"></div>
				<script>(function(d, s, id) {
				  var js, fjs = d.getElementsByTagName(s)[0];
				  if (d.getElementById(id)) return;
				  js = d.createElement(s); js.id = id;
				  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
				  fjs.parentNode.insertBefore(js, fjs);
				}(document, 'script', 'facebook-jssdk'));</script>
				<div class="fb-like" data-href="https://www.facebook.com/pages/Forge-Realty/260964437299005?ref=ts" data-send="false" data-layout="button_count" data-show-faces="true" data-action="recommend"></div>
         </div>			
	</div>
	<!-- / footer --> 
	
</div>
<!-- / background wrapper --> 

<?php echo get_option( THEMESLUG.'_google_analytics');?>
</body>
</html>

<?php wp_footer();?>