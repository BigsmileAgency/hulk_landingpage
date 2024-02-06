<?php
  $postid = get_the_ID();

  $seo_opti = get_field('search_engine_optimizations', $postid);
  $excerpt = $postid ? get_the_excerpt($postid) : null;
  
  $desc = get_bloginfo('description');

  if (!is_null($seo_opti) && $seo_opti != ""){
    $desc = trim_description($seo_opti);
  }elseif (!is_null($excerpt) && $excerpt != ""){
    $desc = trim_description($excerpt);
  }

?>

<meta name="description" content="<?= $desc ?>">