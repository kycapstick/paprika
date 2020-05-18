<?php
  if (!function_exists('paprika_render_mentor_select')):
    function paprika_render_mentor_select($post) {
      $mentors = get_posts(array('post_type' => 'artist', 'orderby'=>'title','order'=>'ASC', 'numberposts'=> -1));
      $mentors = array_filter($mentors, 'paprika_filter_mentors');
      $mentorCount = get_post_meta($post->ID, 'mentorCount', true);
      $metaMentors = get_post_meta($post->ID, 'mentors', true);
      $count_nonce = wp_create_nonce("update_count_nonce");
      $array_nonce = wp_create_nonce("update_array_nonce");

      ob_start();
  ?>
    <fieldset>
      <legend class="custom-title">Mentors</legend>
      <label for="mentorCount">Number of Mentors:</label>
      <input class="custom-input" type="number" id="mentorCount" name="mentorCount" value="<?php echo ($mentorCount[0] ?? '') ?>"> 
      <button id="update-mentor-count" data-selector="mentorCount" data-nonce="<?php echo $count_nonce ?>" data-id="<?php echo $post->ID ?>">Update Mentor Count</button>

      <?php 
      if (isset($mentorCount) && intval($mentorCount) > 0):
      ?>
    
        <?php 
          for ($i = 0; $i < intval($mentorCount[0]); $i = $i + 1):
            ?>
            <div>
              <label for="mentor<?php echo $i ?>">Mentor <?php echo $i + 1 ?></label>
              <select class="custom-input mentors" name="mentors[<?php echo $i ?>]" id="mentor<?php echo $i + 1 ?>">
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
          <button id="update-mentors-array" data-selector="mentors" data-nonce="<?php echo $array_nonce ?>" data-type="<?php echo $post->post_type ?>" data-id="<?php echo $post->ID ?>" data-count_selector="mentorCount">Update Mentors</button>

          </fieldset>
          <?php 
        endif;
        ?>
  <?php
    return ob_get_clean(); 
  }
endif;