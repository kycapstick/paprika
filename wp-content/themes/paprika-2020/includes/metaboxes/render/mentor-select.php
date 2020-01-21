<?php
  if (!function_exists('paprika_render_mentor_select')):
    function paprika_render_mentor_select($post) {
      $mentors = get_posts(array('post_type' => 'artist', 'orderby'=>'title','order'=>'ASC', 'numberposts'=> -1));
      $mentors = array_filter($mentors, 'paprika_filter_mentors');
      $mentorCount = get_post_meta($post->ID, 'mentorCount', true);
      $metaMentors = get_post_meta($post->ID, 'mentors', true);
      ob_start();
  ?>
    <div>
      <label for="mentorCount">Number of Mentors:</label>
      <input type="number" id="mentorCount" name="mentorCount" value="<?php echo ($mentorCount[0] ?? '') ?>"> 
    </div>    
    <div>
      <?php 
      if (isset($mentorCount) && intval($mentorCount) > 0):
      ?>
      <fieldset>
        <legend>Mentors</legend>
        <?php 
          for ($i = 0; $i < intval($mentorCount[0]); $i = $i + 1):
            ?>
            <div>
              <label for="mentor<?php echo $i ?>">Mentor <?php echo $i + 1 ?></label>
              <select name="mentors[<?php echo $i ?>]" id="mentor<?php echo $i + 1 ?>">
                <?php foreach($mentors as $index=>$mentor): ?>
                  <option 
                    value="<?php echo $mentor->ID ?>"
                    <?php echo (isset($metaMentors[$i]) && intval($mentor->ID) === intval($metaMentors[$i]) ? 'selected' : '') ?>
                  >
                    <?php echo $mentor->post_title ?>
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