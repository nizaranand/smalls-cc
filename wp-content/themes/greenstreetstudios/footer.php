<?php  
$content = ob_get_clean();
echo art_parse_template(art_page_template(), art_page_variables(array('content'=> $content)));
?>
    <div id="wp-footer">
	        <?php wp_footer(); ?>
	        <!-- <?php printf(__('%d queries. %s seconds.', THEME_NS), get_num_queries(), timer_stop(0, 3)); ?> -->
    </div>
<!-- Piwik --> 
 <script type="text/javascript">
 var pkBaseURL = (("https:" == document.location.protocol) ? "https://piwik.smalls.cc/" : "http://piwik.smalls.cc/");
 document.write(unescape("%3Cscript src='" + pkBaseURL + "piwik.js' type='text/javascript'%3E%3C/script%3E"));
 </script><script type="text/javascript">
 try {
 var piwikTracker = Piwik.getTracker(pkBaseURL + "piwik.php", 3);
 piwikTracker.trackPageView();
 piwikTracker.enableLinkTracking();
 } catch( err ) {}
 </script><noscript><p><img src="http://piwik.smalls.cc/piwik.php?idsite=3" style="border:0" alt="" /></p></noscript>
 <!-- End Piwik Tracking Code -->
</body>
</html>

