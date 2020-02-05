<?php 
  if(!function_exists('paprika_show_meta_cb')):
    function paprika_show_meta_cb($post) {
      $artists = get_posts(array('post_type' => 'artist', 'orderby'=>'title','order'=>'ASC', 'numberposts'=> -1));
      wp_nonce_field( basename( __FILE__ ), 'show_post_nonce' );
      $postMeta = get_post_meta($post->ID);
      echo paprika_render_festival($postMeta);
      echo paprika_render_artists_select($post);
      echo paprika_render_program_select($postMeta);
    }
  endif;
  
  if (!function_exists('paprika_show_metabox')):
    function paprika_show_metabox() {
      add_meta_box('show-meta-box', esc_html__('Show Details'), 'paprika_show_meta_cb', 'show', 'normal', 'low');
    }
  endif;
  
  if (!function_exists('paprika_save_show_meta')):
    function paprika_save_show_meta($post_id, $post) {
      if(!isset($_POST['show_post_nonce']) || !wp_verify_nonce($_POST['show_post_nonce'], basename(__FILE__))):
        return $post_id;
      endif;
      $fields = array(
        'festival' => '',
        'artistCount' => 0,
        'program' => '',
      );
      $fields = paprika_sanitize_fields($fields, $_POST);
      foreach($fields as $key=>$field):
        if (strlen($field) > 0):
          paprika_update_meta_fields($key, $field, $post_id);
        endif;
      endforeach;
      if (isset($_POST['artists'])):  
        $artists = paprika_update_artists_with_count($_POST['artists'], $_POST['artistCount']);
        $artists = array_unique($artists);
        paprika_update_artist_show($artists, $post_id);
      else :
        update_post_meta($post_id, 'artists', array());
      endif;
    }
  endif;