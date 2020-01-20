<?php

  if (!function_exists('paprika_console_log')):
    function paprika_console_log($value) {
      error_log(print_r($value, true));
    }
  endif;

  if (!function_exists('paprika_add_meta_data')):
    function paprika_add_meta_data($array) {
      foreach($array as $index=>$item):
        var_dump($index, $item);
      endforeach;
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

  if (!function_exists('paprika_filter_mentors')):
    function paprika_filter_mentors($item) {
      return intval(get_post_meta($item->ID, 'role', true)) === 1;
    }
  endif;

  if (!function_exists('paprika_filter_artists')):
    function paprika_filter_artists($item) {
      return intval(get_post_meta($item->ID, 'role', true)) === 0;
    }
  endif;



  add_action( 'pre_post_update', 'paprika_save_post_class_meta', 10, 2 );