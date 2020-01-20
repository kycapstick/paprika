<?php 
  if(!function_exists('paprika_festival_meta_cb')):
    function paprika_festival_meta_cb($post) {
      $posts = get_posts(array('post_type' => 'location'));
      wp_nonce_field( basename( __FILE__ ), 'festival_post_nonce' );
      $postMeta = get_post_meta($post->ID, 'location');
      error_log(print_r($postMeta, 1));

    ?>
      <label for="location">Location</label>
      <select name="location" id="location">
      <?php
        foreach($posts as $post) {
      ?>
          <option value="<?php echo $post->ID ?>" <?php echo (intval($postMeta[0]) === intval($post->ID) ? 'selected' : '') ?>><?php echo $post->post_title ?></option>
      <?php
        }
      ?>
      </select>
    <?php
    }
  endif;
  
  if (!function_exists('paprika_festival_metabox')):
    function paprika_festival_metabox() {
      add_meta_box('festival-meta-box', esc_html__('Festival Details'), 'paprika_festival_meta_cb', 'festival', 'side', 'low');
    }
  endif;
  
  if (!function_exists('paprika_save_festival_meta')):
    function paprika_save_festival_meta($post_id, $post) {
      if(!isset($_POST['festival_post_nonce']) || !wp_verify_nonce($_POST['festival_post_nonce'], basename(__FILE__))):
        return $post_id;
      endif;
      $fields = array(
        'location' => '',
      );
      $fields = paprika_sanitize_fields($fields, $_POST);
      foreach($fields as $key=>$field):
        if (strlen($field) > 0):
          paprika_update_meta_fields($key, $field, $post_id);
        endif;
      endforeach;
    }
  endif;