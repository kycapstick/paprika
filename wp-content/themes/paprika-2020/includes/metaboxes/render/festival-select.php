<?php 
  if (!function_exists('paprika_render_festival')):
    function paprika_render_festival($postMeta) {
      $festivals = get_posts(array('post_type' => 'festival', 'orderby'=>'title','order'=>'DESC', 'numberposts'=> -1));
      ob_start();
    ?>
    <div>
        <label for="festival">Festival</label>
        <select name="festival" id="festival">
        <?php
          foreach($festivals as $festival) {
        ?>
            <option value="<?php echo $festival->ID ?>" <?php echo (isset($postMeta['festival']) && intval($postMeta['festival'][0]) === intval($festival->ID) ? 'selected' : '') ?>><?php echo $festival->post_title ?></option>
        <?php
          }
        ?>
        </select>
      </div>
    <?php 
      return ob_get_clean();
    }
  endif;