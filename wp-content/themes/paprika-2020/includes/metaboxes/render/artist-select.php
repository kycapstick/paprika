<?php
  if (!function_exists('paprika_render_artists_select')):
    function paprika_render_artists_select($post) {
      $artists = get_posts(array('post_type' => 'artist', 'orderby'=>'title','order'=>'ASC', 'numberposts'=> -1));
      $artists = array_filter($artists, 'paprika_filter_artists');
      $artistCount = get_post_meta($post->ID, 'artistCount', true);
      $metaArtists = get_post_meta($post->ID, 'artists', true);
      $festival = get_post_meta($post->ID, 'festival', true);
      $count_nonce = wp_create_nonce("update_count_nonce");
      $array_nonce = wp_create_nonce("update_array_nonce");
      ob_start();
  ?>
    <input type="hidden" name="post_id" value="<?php echo $post->ID ?>">
    <fieldset>
    <legend class="custom-title">Artists</legend>
      <label for="artistCount">Number of Artists:</label>
      <input class="custom-input" type="number" id="artistCount" name="artistCount" value="<?php echo ($artistCount[0] ?? '') ?>"> 
      <button id="update-artist-count" data-selector="artistCount" data-nonce="<?php echo $count_nonce ?>" data-id="<?php echo $post->ID ?>">Update Artist Count</button>
      <?php 
        if (isset($artistCount[0])):
      ?>

        <?php 
          for ($i = 0; $i < intval($artistCount[0]); $i = $i + 1):
            ?>
            <div>
              <label for="artist<?php echo $i ?>">Artist <?php echo $i + 1 ?></label>
              <select class="custom-input artists" name="artists[<?php echo $i ?>]" id="artist<?php echo $i + 1 ?>">
                <?php 
                  foreach($artists as $index=>$artist): 
                    if (intval(get_post_meta($artist->ID, 'festival', true)) !== intval($festival)):
                      continue;
                    endif;
                  ?>
                  <option 
                    value="<?php echo $artist->ID ?>"
                    <?php echo (isset($metaArtists[$i]) && intval($artist->ID) === intval($metaArtists[$i]) ? 'selected' : '') ?>
                  >
                    <?php echo $artist->post_title ?>
                  </option>
                <?php endforeach; ?>
              </select>

            </div>
            <?php 
          endfor;
          ?>
            <button id="update-artists-array" data-selector="artists" data-nonce="<?php echo $array_nonce ?>" data-type="<?php echo $post->post_type ?>" data-id="<?php echo $post->ID ?>" data-count_selector="artistCount">Update Artists</button>
          </fieldset>
          <?php
        endif;
        ?>

  <?php
    return ob_get_clean();
  }
endif;