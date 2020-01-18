<?php 
  if(!function_exists('paprika_festival_meta_cb')):
    function paprika_festival_meta_cb($post) {
      $posts = get_posts(array('post_type' => 'festival'));
      wp_nonce_field( basename( __FILE__ ), 'program_post_nonce' );
      $postMeta = get_post_meta($post->ID, 'festival');
      error_log(print_r($postMeta, TRUE));
    ?>
      <label for="festival">Festival</label>
      <select name="festival" id="festival">
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
  
  if (!function_exists('paprika_program_metabox')):
    function paprika_program_metabox() {
      add_meta_box('festival-meta-box', esc_html__('Festival Details'), 'paprika_festival_meta_cb', 'program', 'side', 'low');
    }
  endif;
  
  if (!function_exists('paprika_save_program_meta')):
    function paprika_save_program_meta($post_id, $post) {
      if(!isset($_POST['program_post_nonce']) || !wp_verify_nonce($_POST['program_post_nonce'], basename(__FILE__))):
        return $post_id;
      endif;
      $fields = array(
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