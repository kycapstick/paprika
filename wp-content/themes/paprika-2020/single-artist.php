<?php 
  get_header();
  $mentor_programs = get_post_meta($post->ID, 'mentor', true);
  $artist_programs = get_post_meta($post->ID, 'artist', true);
  $title = get_post_meta($post->ID, 'title', true);
?>
<main class="container">
  <div class="flex middle">
    <?php if (has_post_thumbnail($post->ID)): ?>
    <figure class="col-4">
      <?php echo get_the_post_thumbnail($post->ID) ?>
    </figure>
    <?php endif; ?>
    <div class="<?php echo (has_post_thumbnail($post->ID) ? 'col-8' : "") ?>">
      <h1><?php echo $post->post_title ?></h1>
      <?php echo wpautop($post->post_content) ?>
      <?php 
        if (isset($mentor_programs) && is_array($mentor_programs)):
      ?>
      <h3><?php echo (isset($title) && strlen($title) > 0 ? $title : 'Mentor' ) ?></h3>
        <ul>
          <?php 
            foreach ($mentor_programs as $program_id): 
              $program = get_post($program_id);
              if ($program->post_status === 'publish'):

          ?>
            <li>
              <a href="<?php echo get_post_permalink($program_id) ?>"><?php echo $program->post_title ?></a>
            </li>
          <?php 
            endif;
            endforeach; 
          ?>
        </ul>
      <?php 
        endif;
      ?>
      <?php 
        if (isset($artist_programs) && is_array($artist_programs)):
      ?>
        <h3>Artist</h3>
        <ul>
          <?php 
            foreach ($artist_programs as $program_id): 
              $program = get_post($program_id);
              if ($program->post_status === 'publish'):
          ?>
            <li>
              <a href="<?php echo get_post_permalink($program_id) ?>"><?php echo $program->post_title ?></a>
            </li>
          <?php 
            endif;
            endforeach; 
          ?>
        </ul>
      <?php 
        endif;
      ?>
    </div>
  </div>
</main>
<?php 
  get_footer();
?>