	</div>
    <?php
		$loc = theme_option('sidebar_location');
		if($loc==2 || $loc==4) {
			get_sidebar(); // calling the First Sidebar
		}
		if(theme_option('sidebar_width2')!=0 && $loc!=3) get_sidebar( "second" ); // calling the Second Sidebar
	?>
</div>
<!-- begin footer -->
<div  id =  "footer" >  
</div>
<?php wp_footer(); ?>
<script type="text/javascript" src="<?php echo THEME_URL; ?>/js/effects.js"></script> 
<script type="text/javascript">
/* <![CDATA[ */
jQuery(function(){
	jQuery("ul.cats").superfish({ 
		delay:       600,
		speed:       250 
	});	});
/* ]]> */
</script>
<?php
if(theme_option('google_analytics')) { echo stripslashes(theme_option('google_analytics')); }


wp_nav_menu(	array(
	'container'	=>	false,
	'depth'		=>	1,
	'menu'		=>	'top-navigation'
		)	);
?>

<table	class		=	"contact"
	summary	=	"contact information"
>
<tr>
<td>
	<script src="//platform.linkedin.com/in.js" type="text/javascript"></script>
	<script type="IN/Share" data-url="//smalls.cc" data-counter="right"></script>
</td>
<td>
	<div	 class		=  "g-plusone"
		data-href	=  "//smalls.cc"
	>  </div>
	<script type="text/javascript" src="//apis.google.com/js/plusone.js">
		{parsetags: 'explicit'}
	</script>
	<script type="text/javascript">gapi.plusone.go();</script>
</td>
<td>
	<script	type  =  'text/javascript' >
		reddit_target  =  'forhire'
		reddit_title	=  'web development: Smalls Support'
	</script>
	<script  src	=  "//www.reddit.com/static/button/button1.js?url=smalls.cc&newwindow=1&styled=off"
		type  =  "text/javascript"
	>  </script>
</td>
<td	class	=	"secondary-colour"	>
<a	href	=	'mailto:jonathan@smalls.cc'	>
	jonathan@smalls.cc
</a>
	857 472 2772
</td>
<td	class	=	'secondary-colour'	>
	serving Boston MA	<br/>
	New England
</td>
</tr>
</table>

<script	src	=	'//code.jquery.com/jquery-1.7.2.min.js'
	type	=	'text/javascript'
>	</script>
<script	src	=	"//smalls.cc/wp-content/scripts/organictabs.jquery.js"
	type	=	'text/javascript'
>	</script>
<script>
	$(function() {
		$("#OrganicTabs").organicTabs({
			"speed": 100,
			"param": "tab"
		});

</script>
<!-- Piwik --> 
 <script type="text/javascript">
 var pkBaseURL = (("https:" == document.location.protocol) ? "https://piwik.smalls.cc/" : "http://piwik.smalls.cc/");
 document.write(unescape("%3Cscript src='" + pkBaseURL + "piwik.js' type='text/javascript'%3E%3C/script%3E"));
 </script><script type="text/javascript">
 try {
 var piwikTracker = Piwik.getTracker(pkBaseURL + "piwik.php", 1);
 piwikTracker.trackPageView();
 piwikTracker.enableLinkTracking();
 } catch( err ) {}
 </script><noscript><p><img src="http://piwik.smalls.cc/piwik.php?idsite=1" style="border:0" alt="" /></p></noscript>
 <!-- End Piwik Tracking Code -->

</body>
</html>
