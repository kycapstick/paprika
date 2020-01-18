<?php 
  if (!function_exists('paprika_save_post_class_meta')):
    function paprika_save_post_class_meta($post_id, $post) {
      if ($post['post_type'] === 'program') {
        paprika_save_program_meta($post_id, $post);
      } elseif ($post['post_type'] === 'staff') {
        paprika_save_staff_meta($post_id, $_POST);
      } elseif ($post['post_type'] === 'artist') {
        paprika_save_artist_meta($post_id, $_POST);
      }
    }
  endif;

  if (!function_exists('paprika_update_meta_fields')):
    function paprika_update_meta_fields($meta_key, $new_meta_value, $post_id) {
      $meta_value = get_post_meta($post_id, $meta_key, true);
      if ($meta_value === $new_meta_value) {
        return $post_id;
      }
      if (strlen($meta_value) > 0) {
        update_post_meta($post_id, $meta_key, $new_meta_value);
      } else {
        add_post_meta($post_id, $meta_key, $new_meta_value, true);
      }
    }
  endif;

  add_action( 'pre_post_update', 'paprika_save_post_class_meta', 10, 2 );

