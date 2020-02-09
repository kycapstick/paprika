<?php
  get_header();
  $mentors = get_post_meta($post->ID, 'mentors', true);
  $artists = get_post_meta($post->ID, 'artists', true);
  $festival_id = get_post_meta($post->ID, 'festival', true);
  $festival = get_post($festival_id);
?>
  <main class="container">
    <h1><?php echo $post->post_title ?></h1>
    <p>Part of 
      <a href="<?php echo get_post_permalink($festival_id) ?>">
        Festival <?php echo $festival->post_title ?>
      </a> 
    </p>
    <?php 
      echo wpautop($post->post_content);
      if (isset($mentors) && is_array($mentors)):
    ?>
    <h2>Facilitator<?php echo (count($mentors) > 1 ? 's' : '')?></h2>
    <ul>
    <?php
      foreach($mentors as $mentor_id):
        $mentor = get_post($mentor_id);
    ?>
      <li>
        <a href="<?php echo get_post_permalink($mentor_id)?>"><?php echo $mentor->post_title ?></a>
      </li>
    <?php
      endforeach;
    ?>
    </ul>
    <?php 
      endif;
    ?>
    <?php 
      if (isset($artists) && is_array($artists)): 
    ?>
    <h2>Artist<?php echo (count($artists) > 1 ? 's' : '')?></h2>
    <ul class="flex">
    <?php 
      foreach ($artists as $artist_id):
        $artist = get_post($artist_id);
        $shows = get_post_meta($artist_id, 'show', true);
        ?>  
          <li class="col-<?php echo 12 / count($artists) ?>">
            <a href="<?php echo get_post_permalink($artist->ID)?>">
              <?php 
                echo $artist->post_title;
                echo get_the_post_thumbnail($artist_id);
              ?>
            </a>
              <?php 
              if (isset($shows) && is_array($shows) && count($shows) > 0):
              ?>
              <p>Show<?php echo (count($shows) > 1 ? 's' : '') ?>:
              <?php
              foreach($shows as $show_id):
                $show = get_post($show_id);
              ?>
                <a href="<?php echo get_post_permalink($show_id)?>"><?php echo $show->post_title ?></a>
              <?php
                endforeach; 
              ?>
                </p>
              <?php
              endif;
            ?>
          </li>
        <?php
      endforeach;
    ?>
    </ul>
    <?php 
    endif;
    ?>
   
  </main>
<?php 
  get_footer();
?>
