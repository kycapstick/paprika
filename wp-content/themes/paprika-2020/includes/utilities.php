<?php 
  if (!function_exists('paprika_add_meta_data')):
    function paprika_add_meta_data($array) {
      foreach($array as $index=>$item):
        var_dump($index, $item);
      endforeach;
      die();
    }
  endif;

  if (!function_exists('paprika_sanitize_fields')):
    function paprika_sanitize_fields($fields, $post) {
      foreach($fields as $key=>$field):
        if (isset($post[$key])):
          $fields[$key] = sanitize_text_field($post[$key]);
        endif;
      endforeach;
      return $fields;
    }
  endif;

  add_action( 'pre_post_update', 'paprika_save_post_class_meta', 10, 2 );