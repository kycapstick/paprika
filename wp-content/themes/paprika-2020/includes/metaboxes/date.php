<?php 
  if(!function_exists('paprika_date_meta_cb')):
    function paprika_date_meta_cb($post) {
      wp_nonce_field( basename( __FILE__ ), 'date_post_nonce' );
      
      $post_meta = get_post_meta($post->ID);
      $show_count = get_post_meta($post->ID, 'showCount', true);
      $time_slots = get_post_meta($post->ID, 'timeSlot', true);
      paprika_console_log($time_slots);

      $shows = get_posts(array('post_type' => 'show', 'orderby'=>'title','order'=>'ASC', 'numberposts'=> -1));
      if (isset($post_meta['festival'][0])):
        $shows = paprika_filter_by_festival($post_meta['festival'][0], $shows);
      endif;
      ?>
      <p class="custom-title">Details</p>
      <?php
      echo paprika_render_festival($post_meta);

      if (isset($post_meta['festival'][0])):
      ?>
        <label for="timeSlotCount">Number of Time Slots</label>
        <input
          class="custom-input" 
          name="timeSlotCount" 
          id="timeSlotCount" 
          type="number"
          value="<?php echo ($post_meta['timeSlotCount'][0] ?? '') ?>"
        >
      <?php
      endif;
      if (isset($post_meta['timeSlotCount'][0]) && intval($post_meta['timeSlotCount'][0]) > 0):
        for ($i = 0; $i < intval($post_meta['timeSlotCount'][0]); $i = $i + 1):
          ?>
            <p class="custom-title">Time Slot <?php echo $i + 1?></p>
            <div>
              <label for="<?php echo 'timeSlot'.$i.'[name]' ?>">Time</label>
              <input 
                class="custom-input"
                id="<?php echo 'timeSlot'.$i.'[name]' ?>" 
                name="<?php echo 'timeSlot['.$i.'][name]' ?>"
                type="text" 
                value="<?php echo ($time_slots[$i]['name'] ?? '')?>">
            </div>
            <?php
              if (isset($time_slots[$i]['name'])):
            ?>
            <div>
              <label for="<?php echo 'timeSlot'.$i.'ShowCount' ?>">Number of Shows</label>
              <input 
                class="custom-input"
                type="number" 
                id="<?php echo 'timeSlot'.$i.'ShowCount' ?>" 
                name="<?php echo 'timeSlot['.$i.'][showCount]'?>"
                value="<?php echo ($time_slots[$i]['showCount'] ?? '') ?>"
              >
            </div>
            <?php 
              if (isset($time_slots[$i]['showCount']) && intval($time_slots[$i]['showCount']) > 0):
                for ($j = 0; $j < intval($time_slots[$i]['showCount']); $j = $j + 1):
            ?> 
                  <div>
                    <label for="<?php echo 'timeSlot'.$i.'Show'.$j ?>">Show <?php echo $j + 1 ?></label>
                    <select class="custom-input" name="<?php echo 'timeSlot['.$i.'][shows]['.$j.']' ?>" id="<?php echo 'timeSlot'.$i.'Show'.$j ?>">
                      <?php 
                        foreach ($shows as $show):
                      ?>
                        <option 
                          value="<?php echo $show->ID?>"
                          <?php 
                            echo (intval($time_slots[$i]['shows'][$j]) === intval($show->ID) ? 'selected' : '');
                          ?>
                        >
                          <?php echo $show->post_title ?>
                        </option>
                      <?php 
                        endforeach;
                      ?>
                    </select>
                  </div>
            <?php
                endfor;
              endif;
            endif;
        endfor;
      endif;

    ?>

    <?php
    }
  endif;
  
  if (!function_exists('paprika_date_metabox')):
    function paprika_date_metabox() {
      add_meta_box('date-meta-box', esc_html__('Date Details'), 'paprika_date_meta_cb', 'date', 'normal', 'low');
    }
  endif;
  
  if (!function_exists('paprika_save_date_meta')):
    function paprika_save_date_meta($post_id, $post) {
      if(!isset($_POST['date_post_nonce']) || !wp_verify_nonce($_POST['date_post_nonce'], basename(__FILE__))):
        return $post_id;
      endif;
      $fields = array(
        'festival' => '',
        'timeSlotCount' => 0,
      );
      $fields = paprika_sanitize_fields($fields, $_POST);
      foreach($fields as $key=>$field):
        if (strlen($field) > 0):
          paprika_update_meta_fields($key, $field, $post_id);
        endif;
      endforeach;
      if (isset($_POST['showCount'])):  
        update_post_meta($post_id, 'showCount', $_POST['showCount']);
      endif;
      if (isset($_POST['timeSlot'])):
        $sanitized_time_slots = array();
        foreach($_POST['timeSlot'] as $index => $time_slot):
          $sanitized_time_slots[$index]['name'] = sanitize_text_field($time_slot['name']);
          $sanitized_time_slots[$index]['showCount'] = sanitize_text_field($time_slot['showCount']);
          $sanitized_time_slots[$index]['shows'] = $time_slot['shows'];
        endforeach;
        update_post_meta($post_id, 'timeSlot', $sanitized_time_slots);
      endif;
    }
  endif;