<?php

function site_title($structuredData = false){
  $nom_general = get_field('nom_general_'.CURRENT_LANG, 'option');
  if (!$structuredData) {
    echo $nom_general; 
    echo !is_front_page() ?  ' | ' : '';
    echo wp_title('');
  }else{
    return $nom_general; !is_front_page() ?  ' | ' : ''; wp_title('');
  }
}

function site_description() {
  $description_specific = get_field('search_engine_optimizations');
  $description_general = get_field('description_'.CURRENT_LANG, 'option');

  if ($description_specific) {
    echo $description_specific;
  }else if($description_general) {
    echo $description_general;
  }else{
    echo bloginfo('description'); 
  }
}