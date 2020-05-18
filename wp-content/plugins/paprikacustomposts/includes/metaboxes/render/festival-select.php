<?php 
  if (!function_exists('paprika_render_festival')):
    function paprika_render_festival($post) {
      $postMeta = get_post_meta($post->ID);
      $festivals = get_posts(array('post_type' => 'festival', 'orderby'=>'title','order'=>'DESC', 'numberposts'=> -1));
      $nonce = wp_create_nonce("update_value_nonce");
      ob_start();      
    ?>
    <div>
        <label for="festival">Festival</label>
        <select class="custom-input" name="festival" id="festival">
        <?php
          foreach($festivals as $festival) {
        ?>
            <option value="<?php echo $festival->ID ?>" <?php echo (isset($postMeta['festival']) && intval($postMeta['festival'][0]) === intval($festival->ID) ? 'selected' : '') ?>><?php echo $festival->post_title ?></option>
        <?php
          }
        ?>
        </select>
        <button id="update-festival" data-selector="festival" data-nonce="<?php echo $nonce ?>" data-id="<?php echo $post->ID ?>">Update Festival</button>

      </div>
    <?php 
      return ob_get_clean();
    }
  endif;