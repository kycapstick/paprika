<?php
  if (!function_exists('paprika_render_shows_select')):
    function paprika_render_shows_select($post) {
      $shows = get_posts(array('post_type' => 'show', 'orderby'=>'title','order'=>'ASC', 'numberposts'=> -1));
      $showCount = get_post_meta($post->ID, 'showCount', true);
      $metashows = get_post_meta($post->ID, 'shows', true);
      $festival = get_post_meta($post->ID, 'festival', true);
      ob_start();
  ?>
    <div>
      <label for="showCount">Number of shows:</label>
      <input type="number" id="showCount" name="showCount" value="<?php echo ($showCount[0] ?? '') ?>"> 
    </div>    
    <div>
      <?php 
        if (isset($showCount[0])):
      ?>
      <fieldset>
        <legend>shows</legend>
        <?php 
          for ($i = 0; $i < intval($showCount[0]); $i = $i + 1):
            ?>
            <div>
              <label for="show<?php echo $i ?>">show <?php echo $i + 1 ?></label>
              <select name="shows[<?php echo $i ?>]" id="show<?php echo $i + 1 ?>">
                <?php 
                  foreach($shows as $index=>$show): 
                    if (intval(get_post_meta($show->ID, 'festival', true)) !== intval($festival)):
                      continue;
                    endif;
                  ?>
                  <option 
                    value="<?php echo $show->ID ?>"
                    <?php echo (isset($metashows[$i]) && intval($show->ID) === intval($metashows[$i]) ? 'selected' : '') ?>
                  >
                    <?php echo $show->post_title ?>
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