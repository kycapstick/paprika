<?php 
  if (!function_exists('paprika_artist_metabox')):
    function paprika_artist_metabox() {
      add_meta_box('artist-meta-box', esc_html__('Artist Details'), 'paprika_artist_meta_cb', 'artist', 'side', 'low');
    }
  endif;

  if (!function_exists('paprika_artist_meta_cb')):
    function paprika_artist_meta_cb($post) {
      paprika_console_log(get_post_meta($post->ID, 'show', true));
      $posts = get_posts(array('post_type' => 'program'));
      $postMeta = get_post_meta($post->ID);
      $mentor = get_post_meta($post->ID, 'mentor', true);
      wp_nonce_field( basename( __FILE__ ), 'artist_post_nonce' );
      echo paprika_render_festival($postMeta);
    ?>
      
      <div>
        <label for="role">Role</label>
        <select name="role" id="role">
          <option value="0" <?php echo (isset($postMeta['role']) && intval($postMeta['role'][0]) === 0 ? 'selected' : '')?>>Artist</option>
          <option value="1" <?php echo (isset($postMeta['role']) && intval($postMeta['role'][0]) === 1 ? 'selected' : '')?>>Mentor</option>
        </select>
      </div>
      <?php
    }
  endif;

  if (!function_exists('paprika_save_artist_meta')):
    function paprika_save_artist_meta($post_id, $post) {
      $fields = array(
        'role' => '',
        'festival' => '',
      );
      $fields = paprika_sanitize_fields($fields, $_POST);
      foreach($fields as $key=>$field):
        if (strlen($field) > 0):
          paprika_update_meta_fields($key, $field, $post_id);
        endif;
      endforeach;
    }
  endif;