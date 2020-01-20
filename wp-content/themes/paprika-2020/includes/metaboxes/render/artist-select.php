<?php
  if (!function_exists('paprika_render_artists_select')):
    function paprika_render_artists_select($post) {
      $artists = get_posts(array('post_type' => 'artist', 'orderby'=>'title','order'=>'ASC'));
      $artists = array_filter($artists, 'paprika_filter_artists');
      $artistCount = get_post_meta($post->ID, 'artistCount', true);
      $metaArtists = get_post_meta($post->ID, 'artists', true);
      ob_start();
  ?>
    <div>
      <label for="artistCount">Number of Artists:</label>
      <input type="number" id="artistCount" name="artistCount" value="<?php echo ($artistCount[0] ?? '') ?>"> 
    </div>    
    <div>
      <?php 
        if (isset($artistCount[0])):
      ?>
      <fieldset>
        <legend>Artists</legend>
        <?php 
          for ($i = 0; $i < intval($artistCount[0]); $i = $i + 1):
            ?>
            <div>
              <label for="artist<?php echo $i ?>">Artist <?php echo $i + 1 ?></label>
              <select name="artists[<?php echo $i ?>]" id="artist<?php echo $i + 1 ?>">
                <?php foreach($artists as $index=>$artist): ?>
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
          </fieldset>
          <?php
          else: 
            ?>
          <fieldset>
        <legend>Artists</legend>
            <div>
              <label for="artist0">Artist 1</label>
              <select name="artists[0]" id="artist0">
                <?php foreach($artists as $index=>$artist): ?>
                  <option 
                    value="<?php echo $artist->ID ?>"
                  >
                    <?php echo $artist->post_title ?>
                  </option>
                <?php endforeach; ?>
              </select>
            </div>
          </fieldset>
          <?php 
        endif;
        ?>

      </div>
  <?php
    return ob_get_clean(); 
  }
endif;