<?php
  if (!function_exists('paprika_render_timeslots_select')):
    function paprika_render_dates_select($post) {
      $dates = get_posts(array('post_type' => 'date', 'orderby'=>'title','order'=>'ASC', 'numberposts'=> -1));
      $dates = paprika_filter_by_festival($post->ID, $dates);
      $dateCount = get_post_meta($post->ID, 'dateCount', true);
      $metaDates = get_post_meta($post->ID, 'dates', true);
      $nonce = wp_create_nonce("update_count_nonce");
      $array_nonce = wp_create_nonce("update_array_nonce");
      ob_start();
  ?>
    <div>
      <label for="dateCount">Number of Days:</label>
      <input class="custom-input" type="number" id="dateCount" name="dateCount" value="<?php echo ($dateCount ? $dateCount : '') ?>">
      <button id="update-date-count" data-selector="dateCount" data-nonce="<?php echo $nonce ?>" data-id="<?php echo $post->ID ?>">Update Date Count</button>
    </div>    
    <div>
      <?php 
        if (isset($dateCount)):
      ?>
      <fieldset>
        <legend class="custom-title">Dates</legend>
        <?php 
          for ($i = 0; $i < intval($dateCount); $i = $i + 1):
            ?>
            <div>
              <label for="date<?php echo $i ?>">Date <?php echo $i + 1 ?></label>
              <select class="custom-input dates" name="dates[<?php echo $i ?>]" id="date<?php echo $i + 1 ?>">
                <?php 
                  foreach($dates as $index=>$date): 
                  ?>
                  <option 
                    value="<?php echo $date->ID ?>"
                    <?php echo (isset($metaDates[$i]) && intval($date->ID) === intval($metaDates[$i]) ? 'selected' : '') ?>
                  >
                    <?php echo $date->post_title ?>
                  </option>
                <?php endforeach; ?>
              </select>
            </div>
            <?php 
          endfor;
          ?>
          <button id="update-dates-array" data-selector="dates" data-nonce="<?php echo $array_nonce ?>" data-type="<?php echo $post->post_type ?>" data-id="<?php echo $post->ID ?>" data-count_selector="dateCount">Update Dates</button>
          </fieldset>
          <?php
        endif;
        ?>

      </div>
  <?php
    return ob_get_clean();
  }
endif;