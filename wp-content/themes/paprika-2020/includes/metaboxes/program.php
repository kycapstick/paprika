<?php 
  if(!function_exists('paprika_program_meta_cb')):
    function paprika_program_meta_cb($post) {
      $artists = get_posts(array('post_type' => 'artist', 'orderby'=>'title','order'=>'ASC', 'numberposts'=> -1));
      $mentors = array_filter($artists, 'paprika_filter_mentors');
      wp_nonce_field( basename( __FILE__ ), 'program_post_nonce' );
      $postMeta = get_post_meta($post->ID);
      echo paprika_render_festival($postMeta);
      echo paprika_render_mentor_select($post);
      echo paprika_render_artists_select($post);
    }
  endif;
  
  if (!function_exists('paprika_program_metabox')):
    function paprika_program_metabox() {
      add_meta_box('program-meta-box', esc_html__('Festival Details'), 'paprika_program_meta_cb', 'program', 'side', 'low');
    }
  endif;
  
  if (!function_exists('paprika_save_program_meta')):
    function paprika_save_program_meta($post_id, $post) {
      if(!isset($_POST['program_post_nonce']) || !wp_verify_nonce($_POST['program_post_nonce'], basename(__FILE__))):
        return $post_id;
      endif;
      $fields = array(
        'festival' => '',
        'artistCount' => 0,
        'mentorCount' => 0,
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
        paprika_update_artist_program($artists, $post_id);
        update_post_meta($post_id, 'artists', $artists);
      endif;
      if (isset($_POST['mentors'])):  
        $mentors = paprika_update_mentors_with_count($_POST['mentors'], $_POST['mentorCount']);
        $mentors = array_unique($mentors);
        paprika_update_mentor_program($mentors, $post_id);
        update_post_meta($post_id, 'mentors', $mentors);
      endif;
    }
  endif;