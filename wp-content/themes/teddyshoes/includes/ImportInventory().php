<?php $wpdb;
set_time_limit(   0  );

$szFilePath    =  '/var/www/html/teddyshoes/wp-content/uploads/inventory-sizes.csv';
$aryInventory  =  file( $szFilePath );
for(  $nYAxis  =  1;
      $nYAxis  <  count(   $aryInventory  );
      $nYAxis++
   )
   $aryInventory[  $nYAxis  ] =  str_getcsv(  $aryInventory[   $nYAxis  ]);

$szSQL         =  "SELECT  ID,
                           post_name,
                           meta_value
                  FROM     wp_posts,
                           wp_postmeta
                  WHERE    wp_posts.post_type   =  'wpsc-product'
                  AND      wp_posts.post_parent != 0
                  AND      wp_postmeta.post_id  =  wp_posts.ID
                  AND      wp_postmeta.meta_key =  '_wpsc_sku'";
$aryVariations =  $wpdb -> get_results(   $szSQL   );

$szSQL         =  "SELECT  name
                  FROM     wp_terms,
                           wp_term_taxonomy
                  WHERE    wp_term_taxonomy.term_id   =  wp_terms.term_id
                  AND      wp_term_taxonomy.parent    =  237";
$aryShoeWidth  =  $wpdb -> get_results(   $szSQL   );
$szSQL         =  "SELECT  name
                  FROM     wp_terms,
                           wp_term_taxonomy
                  WHERE    wp_term_taxonomy.term_id   =  wp_terms.term_id
                  AND      wp_term_taxonomy.parent    =  238";
$aryShoeLength =  $wpdb -> get_results(   $szSQL   );
$aryShoeSize   =  array();

foreach( $aryShoeLength as $objShoeLength )
foreach( $aryShoeWidth  as $objShoeWidth  )
{  $szShoeSize    =  $objShoeLength -> name
                     .  $objShoeWidth  -> name;
   $aryShoeSize[] =  $szShoeSize;
}

foreach( $aryVariations as $objVariation  )
{  $szDatabaseSKU    =  $objVariation  -> meta_value;
   $szDatabaseName   =  $objVariation  -> post_name;
   $nDatabaseID      =  $objVariation  -> ID;

   foreach( $aryInventory  as $aryTableRow   )
   {  $szFileSKU   =  $aryTableRow[ 0  ];

      if(   $szFileSKU  ==  $szDatabaseSKU )
      foreach( $aryTableRow   as $szTableCell   )
      foreach( $aryShoeSize   as $szShoeSize )
      if(   strripos(   $szTableCell,
                        $szShoeSize
                    )   !==   false
        )
      {  $szSQL      =  "SELECT  meta_value
                        FROM     wp_postmeta
                        WHERE    meta_key =  '_wpsc_stock'
                        AND      post_id  =  $nDatabaseID";
         $objStock   =  $wpdb -> get_results(   $szSQL   );
         $nStock     =  $objStock[  0  ]   -> meta_value;
         $nStock     =  (  int   )  $nStock + 1;
         $nRows      =  $wpdb -> update(  'wp_postmeta',
                                          array(   'meta_value'   => $nStock  ),
                                          array(   'post_id'   => $nDatabaseID,
                                                   'meta_key'  => '_wpsc_stock'
                                       )       );
}  }  }
?>