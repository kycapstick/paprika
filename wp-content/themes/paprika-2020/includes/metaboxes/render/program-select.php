<?php 
  if (!function_exists('paprika_render_program_select')):
    function paprika_render_program_select($post_meta) {
      $programs = get_posts(array('post_type' => 'program', 'orderby'=>'title','order'=>'DESC', 'numberposts'=> -1));
      if (isset($post_meta['festival'][0])):
        $programs = paprika_filter_by_festival($post_meta['festival'][0], $programs);
      endif;
      ob_start();
    ?>
    <div>
      <p class="custom-title">Programs</p>
        <label for="program">Program</label>
        <select class="custom-input"name="program" id="program">
        <?php
          foreach($programs as $program) {
        ?>
            <option value="<?php echo $program->ID ?>" <?php echo (isset($post_meta['program']) && intval($post_meta['program'][0]) === intval($program->ID) ? 'selected' : '') ?>><?php echo $program->post_title ?></option>
        <?php
          }
        ?>
        </select>
      </div>
    <?php 
      return ob_get_clean();
    }
  endif;