<?php 
  if (!function_exists('paprika_artist_metabox')):
    function paprika_artist_metabox() {
      add_meta_box('artist-meta-box', esc_html__('Artist Details'), 'paprika_artist_meta_cb', 'artist', 'side', 'low');
    }
  endif;

  if (!function_exists('paprika_artist_meta_cb')):
    function paprika_artist_meta_cb($post) {
      $posts = get_posts(array('post_type' => 'program'));
      $postMeta = get_post_meta($post->ID);
      wp_nonce_field( basename( __FILE__ ), 'artist_post_nonce' );
      ?>
      <div>
        <label for="role">Role</label>
        <input 
          type="text" 
          name="role" 
          id="role" 
          value="<?php echo ($postMeta['role'][0] ?? '') ?>""
        >
      </div>
      <div>
        <label for="program">Program</label>
        <select name="program" id="program">
          <?php
            foreach($posts as $post) {
          ?>
            <option value="<?php echo $post->ID ?>" <?php echo (intval($postMeta['program'][0]) === intval($post->ID) ? 'selected' : '') ?>><?php echo $post->post_title ?></option>
          <?php
            }
          ?>
        </select>
      </div>
      <?php
    }
  endif;

  if (!function_exists('paprika_save_artist_meta')):
    function paprika_save_artist_meta($post_id, $post) {
      $fields = array(
        'role' => '',
        'program' => '',
      );
      $fields = paprika_sanitize_fields($fields, $_POST);
      foreach($fields as $key=>$field):
        if (strlen($field) > 0):
          paprika_update_meta_fields($key, $field, $post_id);
        endif;
      endforeach;
    }
  endif;