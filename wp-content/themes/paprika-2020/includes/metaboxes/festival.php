<?php 
  if(!function_exists('paprika_festival_meta_cb')):
    function paprika_festival_meta_cb($post) {
      paprika_console_log(get_post_meta($post->ID, 'location', true));
      $locations = get_posts(array('post_type' => 'location'));
      wp_nonce_field( basename( __FILE__ ), 'festival_post_nonce' );
      $meta_location = get_post_meta($post->ID, 'location', true);
    ?>
      <p class="custom-title">Details</p>
      <label for="location">Location</label>
      <select class="custom-input" name="location" id="location">
      <?php
        foreach($locations as $location) {
      ?>
          <option value="<?php echo $location->ID ?>" <?php echo (is_array($meta_location) && intval($meta_location[0]) === intval($location->ID) ? 'selected' : '') ?>><?php echo $location->post_title ?></option>
      <?php
        }
      ?>
      </select>
    <?php
      echo paprika_render_dates_select($post);

    }
  endif;
  
  if (!function_exists('paprika_festival_metabox')):
    function paprika_festival_metabox() {
      add_meta_box('festival-meta-box', esc_html__('Festival Details'), 'paprika_festival_meta_cb', 'festival', 'normal', 'low');
    }
  endif;
  
  if (!function_exists('paprika_save_festival_meta')):
    function paprika_save_festival_meta($post_id, $post) {
      if(!isset($_POST['festival_post_nonce']) || !wp_verify_nonce($_POST['festival_post_nonce'], basename(__FILE__))):
        return $post_id;
      endif;
      $fields = array(
        'location' => '',
        'dateCount' => 0,
      );
      $fields = paprika_sanitize_fields($fields, $_POST);
      foreach($fields as $key=>$field):
        if (strlen($field) > 0):
          paprika_update_meta_fields($key, $field, $post_id);
        endif;
      endforeach;
      if (isset($_POST['dates'])):
        $dates = paprika_update_dates_with_count($_POST['dates'], $_POST['dateCount']);
        $dates = array_unique($dates);
        update_post_meta($post_id, 'dates', $dates);
      endif;
    }
  endif;