<?php 
/*
    Plugin Name: RSS Image
    Plugin URI: https://www.cakedivision.com
    Description: Mostrar Imagenes en el RSS como :media
    Author: Fabio Baccaglioni
    Version: 1.0
    Author URI: https://www.cakedivision.com
*/
 
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Salir si se accede directo
}

// Agregoe el namespace para media:image
add_filter( 'rss2_ns', function(){
    echo 'xmlns:media="http://search.yahoo.com/mrss/"';
  });
  
  // Inserto el objeto en el item de RSS
  add_action('rss2_item', function(){
    global $post;
    if (has_post_thumbnail($post->ID)){
      $thumbnail_ID = get_post_thumbnail_id($post->ID);
      $thumbnail = wp_get_attachment_image_src($thumbnail_ID, 'medium');
      if (is_array($thumbnail)) {
        echo '<media:content medium="image" url="' . $thumbnail[0]
          . '" width="' . $thumbnail[1] . '" height="' . $thumbnail[2] . '" />';
      }
    }
  });