<?php 
  if (!function_exists('paprika_artist_metabox')):
    function paprika_artist_metabox() {
      add_meta_box('artist-meta-box', esc_html__('Artist Details'), 'paprika_artist_meta_cb', 'artist', 'normal', 'low');
    }
  endif;

  if (!function_exists('paprika_artist_meta_cb')):
    function paprika_artist_meta_cb($post) {
      $posts = get_posts(array('post_type' => 'program'));
      $postMeta = get_post_meta($post->ID);
      $mentor = get_post_meta($post->ID, 'mentor', true);
      $title = get_post_meta($post->ID, 'artist_title', true);
      wp_nonce_field( basename( __FILE__ ), 'artist_post_nonce' );
      $nonce = wp_create_nonce("update_value_nonce");
      echo paprika_render_festival($post);
    ?>
      
      <div>
        <label for="role">Role</label>
        <select class="custom-input" name="role" id="role">
          <option value="0" <?php echo (isset($postMeta['role']) && intval($postMeta['role'][0]) === 0 ? 'selected' : '')?>>Artist</option>
          <option value="1" <?php echo (isset($postMeta['role']) && intval($postMeta['role'][0]) === 1 ? 'selected' : '')?>>Mentor</option>
        </select>
        <button id="update-role" data-selector="role" data-nonce="<?php echo $nonce ?>" data-id="<?php echo $post->ID ?>">Update Role</button>

        <label for="artist_title">Title</label>
        <input class="custom-input" type="text" name="artist_title" id="artist_title" value="<?php echo ($title ?? '') ?>">
        <button id="update-title" data-selector="artist_title" data-nonce="<?php echo $nonce ?>" data-id="<?php echo $post->ID ?>">Update Title</button>
        
      </div>
      <?php
    }
  endif;

  if (!function_exists('paprika_save_artist_meta')):
    function paprika_save_artist_meta($post_id, $post) {
      $fields = array(
        'role' => '',
        'festival' => '',
        'artist_title' => '',
      );
      $fields = paprika_sanitize_fields($fields, $_POST);
      $taxonomy = 'category';
      foreach($fields as $key=>$field):
        if (strlen($field) > 0):
          paprika_update_meta_fields($key, $field, $post_id);
        endif;
      endforeach;
    }
  endif;

  if (!function_exists('paprika_save_artist_categories')):
    function paprika_save_artist_categories($post_id) {
      paprika_add_festival_category($post_id);
      $taxonomy = 'category';
      $parent_id = get_cat_id('Role');
      if (intval($parent_id) === 0):
        $parent_id = wp_insert_term('Role', $taxonomy);
        $parent_id = $parent_id['term_id'];
      endif;
      wp_set_post_categories($post_id, $parent_id, $taxonomy);

      $role = get_post_meta($post_id, 'role', true);
      if(intval($role) === 0):
        $artist_id = get_cat_id('Artist');
        if (intval($artist_id) === 0):
          $artist_id = wp_insert_term('Artist', $taxonomy, array('parent' => $parent_id));
        endif;
        wp_set_post_categories( $post_id, $artist_id, $taxonomy, true);
      elseif(intval($role) === 1):
        $mentor_id = get_cat_id('Mentor');
        if (intval($mentor_id) === 0):
          $mentor_id = wp_insert_term('Mentor', $taxonomy, array('parent' => $parent_id));
        endif;
        wp_set_post_categories( $post_id, $mentor_id, $taxonomy);
      endif;
    }
  endif;