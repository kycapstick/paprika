<?php 
  if(!function_exists('paprika_program_meta_cb')):
    function paprika_program_meta_cb($post) {
      $festivals = get_posts(array('post_type' => 'festival', 'orderby'=>'title','order'=>'DESC', 'numberposts'=> -1));
      $artists = get_posts(array('post_type' => 'artist', 'orderby'=>'title','order'=>'ASC', 'numberposts'=> -1));
      $mentors = array_filter($artists, 'paprika_filter_mentors');
      wp_nonce_field( basename( __FILE__ ), 'program_post_nonce' );
      $postMeta = get_post_meta($post->ID);
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
      <div>
        <label for="mentor">Mentor</label>
        <select name="mentor" id="mentor">
          <option value="0">-- Select --</option>
        <?php
          foreach($mentors as $mentor) {
        ?>
            <option value="<?php echo $mentor->ID ?>" <?php echo (isset($postMeta['mentor'][0]) && intval($postMeta['mentor'][0]) === intval($mentor->ID) ? 'selected' : '') ?>><?php echo $mentor->post_title ?></option>
        <?php
          }
        ?>
        </select>
      </div>
      
    <?php
      echo paprika_render_artists_select($post);
    }
  endif;
  
  if (!function_exists('paprika_program_metabox')):
    function paprika_program_metabox() {
      add_meta_box('program-meta-box', esc_html__('Festival Details'), 'paprika_program_meta_cb', 'program', 'side', 'low');
    }
  endif;
  
  if (!function_exists('paprika_save_program_meta')):
    function paprika_save_program_meta($post_id, $post) {
      if(!isset($_POST['program_post_nonce']) || !wp_verify_nonce($_POST['program_post_nonce'], basename(__FILE__))):
        return $post_id;
      endif;
      $fields = array(
        'festival' => '',
        'artistCount' => 0,
        'mentor' => '',
      );
      $fields = paprika_sanitize_fields($fields, $_POST);
      paprika_update_mentor_program($fields['mentor'], $post_id);
      foreach($fields as $key=>$field):
        if (strlen($field) > 0):
          paprika_update_meta_fields($key, $field, $post_id);
        endif;
      endforeach;
      if (isset($_POST['artists'])):  
        $artists = paprika_update_artists_with_count($_POST['artists'], $_POST['artistCount']);
        paprika_update_artist_program($artists, $post_id);
        update_post_meta($post_id, 'artists', $artists);
      endif;
    }
  endif;