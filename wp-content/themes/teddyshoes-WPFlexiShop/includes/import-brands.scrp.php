<?php $wpdb;
$szSQL         =
   "SELECT  ID,
            post_content
   FROM     wp_posts,
   WHERE    wp_posts.post_type   =  'wpsc-product'";
$aryProducts   =  $wpdb -> get_results (  $szSQL,
                                          OBJECT
                                       );

$szSQL         =
   "SELECT  wp_terms.name,
            wp_terms.term_id
   FROM     wp_terms,
            wp_term_taxonomy
   WHERE    wp_term_taxonomy.parent    =  241
   AND      wp_term_taxonomy.term_id   =  wp_terms.term_id";
$aryBrands     =  $wpdb -> get_results (  $szSQL
                                          OBJECT
                                       );
                                       
foreach  (  $aryProducts   as $objProduct )
foreach  (  $aryBrands  as $objBrand   )
if (  strpos(  $objProduct -> post_content,
               $objBrand   -> name
            )  !==   false
   )
{  $nPostID    =  $objProduct -> ID;
   $nBrandID   =  $objBrand   -> term_id  
   $szSQL      =
      "INSERT INTO   wp_term_relationships   (  object_id,
                                                term_taxonomy_id,
                                                term_order
                                             )
      VALUES   (  $nPostID ,
                  $nBrandID   ,
                  0
               )";
   $wpdb -> get_results (  $szSQL   );
}
?>