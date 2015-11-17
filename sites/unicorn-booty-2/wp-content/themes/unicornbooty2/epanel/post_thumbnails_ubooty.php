<?php

/* sets predefined Post Thumbnail dimensions */
if ( function_exists( 'add_theme_support' ) ) {
   add_theme_support( 'post-thumbnails' );
      
   //entry image size
   add_image_size( 'thumb1', 186, 186, true );
   
   add_image_size( 'thumb2', 38, 38, true );
   
   add_image_size( 'thumb3', 466, 180, true );
   
   add_image_size( 'thumb3', 466, 180, true );
   
};
/* --------------------------------------------- */

?>