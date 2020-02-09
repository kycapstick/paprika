<?php 

  if (!function_exists('paprika_save_post_class_meta')):
    function paprika_save_post_class_meta($post_id, $post) {
      if ($post['post_type'] === 'program') {
        paprika_save_program_meta($post_id, $post);
      } elseif ($post['post_type'] === 'staff') {
        paprika_save_staff_meta($post_id, $_POST);
      } elseif ($post['post_type'] === 'artist') {
        paprika_save_artist_meta($post_id, $_POST);
      } elseif ($post['post_type'] === 'festival') {
        paprika_save_festival_meta($post_id, $_POST);
      } elseif ($post['post_type'] === 'show') {
        paprika_save_show_meta($post_id, $_POST);
      } elseif ($post['post_type'] === 'date') {
        paprika_save_date_meta($post_id, $_POST);
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

  if (!function_exists('paprika_save_categories')):
    function paprika_save_categories($post_id) {
      if (isset($_POST) && isset($_POST['post_type'])):
        if ($_POST['post_type'] === 'program') {
          paprika_save_program_categories($post_id);
        } elseif ($_POST['post_type'] === 'artist') {
          paprika_save_artist_categories($post_id);
        } elseif ($_POST['post_type'] === 'show') {
          paprika_save_show_categories($post_id);
        } elseif ($_POST['post_type'] === 'date') {
          paprika_save_date_categories($post_id);
        }   
      endif;
      } 
  endif;

  add_action('save_post', 'paprika_save_categories');

  if (!function_exists('paprika_update_on_delete')):
    function paprika_update_on_delete($post_id) {
      $post_type = get_post_type($post_id);
      if (isset($post_type)):
        if ($post_type === 'show'):
          paprika_remove_show_relations($post_id);
        elseif ($post_type === 'artist'):
          paprika_remove_artist_relations($post_id);
        elseif ($post_type === 'program'):
          paprika_remove_program_relations($post_id);
        elseif ($post_type === 'festival'):
          paprika_remove_festival_relations($post_id);
        endif;
      endif;
    }
  endif;

  add_action('before_delete_post', 'paprika_update_on_delete', 10, 1);

  require_once( __DIR__ . '/render/artist-select.php');
  require_once( __DIR__ . '/render/festival-select.php');
  require_once( __DIR__ . '/render/mentor-select.php');
  require_once( __DIR__ . '/render/program-select.php');
  require_once( __DIR__ . '/render/show-select.php');
  require_once( __DIR__ . '/render/date-select.php');

  require_once( __DIR__ . '/program.php');
  require_once( __DIR__ . '/staff.php');
  require_once( __DIR__ . '/artist.php');
  require_once( __DIR__ . '/festival.php');
  require_once( __DIR__ . '/show.php');
  require_once( __DIR__ . '/date.php');

  require_once( __DIR__ . '/ajax_calls.php');
