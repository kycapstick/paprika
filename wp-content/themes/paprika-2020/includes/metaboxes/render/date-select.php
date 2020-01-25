<?php
  if (!function_exists('paprika_render_timeslots_select')):
    function paprika_render_dates_select($post) {
      $dates = get_posts(array('post_type' => 'date', 'orderby'=>'title','order'=>'ASC', 'numberposts'=> -1));
      $dates = paprika_filter_by_festival($post->ID, $dates);
      $dateCount = get_post_meta($post->ID, 'dateCount', true);
      $metaDates = get_post_meta($post->ID, 'dates', true);
      ob_start();
  ?>
    <div>
      <label for="dateCount">Number of Days:</label>
      <input type="number" id="dateCount" name="dateCount" value="<?php echo ($dateCount ?? '') ?>"> 
    </div>    
    <div>
      <?php 
        if (isset($dateCount)):
      ?>
      <fieldset>
        <legend>Dates</legend>
        <?php 
          for ($i = 0; $i < intval($dateCount); $i = $i + 1):
            ?>
            <div>
              <label for="date<?php echo $i ?>">Date <?php echo $i + 1 ?></label>
              <select name="dates[<?php echo $i ?>]" id="date<?php echo $i + 1 ?>">
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
          </fieldset>
          <?php
        endif;
        ?>

      </div>
  <?php
    return ob_get_clean();
  }
endif;