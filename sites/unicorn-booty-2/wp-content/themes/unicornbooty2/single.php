<?php
  $post = $wp_query->post;

  if (in_category('11')) {
      include(TEMPLATEPATH.'/single1.php');
  } else {
      include(TEMPLATEPATH.'/single_default.php');
  }
?>