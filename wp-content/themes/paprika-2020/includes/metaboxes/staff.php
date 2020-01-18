<?php 
  if (!function_exists('paprika_staff_metabox')):
    function paprika_staff_metabox() {
      add_meta_box('staff-meta-box', esc_html__('Staff Details'), 'paprika_staff_meta_cb', 'staff', 'side', 'low');
    }
  endif;

  if (!function_exists('paprika_staff_meta_cb')):
    function paprika_staff_meta_cb($post) {
      $postMeta = get_post_meta($post->ID);
      wp_nonce_field( basename( __FILE__ ), 'staff_post_nonce' );
      ?>
      <div>
        <label for="name">Name</label>
        <input 
          type="text" 
          name="name" 
          id="name" 
          value="<?php echo ($postMeta['name'][0] ?? '') ?>""
        >
      </div>
      <div>
        <label for="email">Email</label>
        <input 
          type="email" 
          name="email"
          id="email"
          value="<?php echo ($postMeta['email'][0] ?? '') ?>"
        >
      </div>
      <?php
    }
  endif;

  if (!function_exists('paprika_save_staff_meta')):
    function paprika_save_staff_meta($post_id, $post) {
      $fields = array(
        'name' => '',
        'email' => '',
      );
      $fields = paprika_sanitize_fields($fields, $_POST);
      foreach($fields as $key=>$field):
        if (strlen($field) > 0):
          paprika_update_meta_fields($key, $field, $post_id);
        endif;
      endforeach;
    }
  endif;