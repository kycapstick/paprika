<?php 
get_header();
?>
<main>
  <?php
  if ( have_posts() ) : 
    while ( have_posts() ) : the_post(); 
      $date_ids = get_post_meta($post->ID, 'dates', true);
      $programs = get_post_meta($post->ID, 'programs', true);
      usort($programs, 'paprika_sort_order');
  ?>
        <p>
            <?php 
                echo wpautop(the_content());
            ?>
        </p>
        <h3>Programs</h3>
    <?php 
		if (isset($programs) && is_array($programs)):
			?>
			<ul class="flex">
			<?php
      foreach($programs as $program_id) {
        $artists = paprika_get_program_artists($program_id);
        $mentors = paprika_get_program_mentors($program_id);
        $program = get_post($program_id);
      ?>
					<li class="text-center">
						<div>
						<h4>
              <a href="<?php echo get_post_permalink($program->ID) ?>">
                <?php echo str_replace(get_the_title(), '', $program->post_title) ?>
              </a>
            </h4>
					<?php
						if (isset($mentors) && is_array($mentors)):
					?>
							<p>Mentor<?php echo (count($mentors) > 1 ? 's' : '') ?></p>
							<ul>
							<?php
							foreach($mentors as $mentor_id) {
								$mentor = get_post($mentor_id);
							?>
								<li>
									<a href="<?php echo get_post_permalink($mentor_id) ?>"><?php echo $mentor->post_title?></a>
								</li>
							<?php
							}
							?>
							</ul>
							<?php
						endif;
						if (isset($artists) && is_array($artists)):
							?>
							<p>Artist<?php echo (count($artists) > 1 ? 's' : '') ?></p>
							<ul>
							<?php
							foreach($artists as $artist_id) {
								$artist = get_post($artist_id);
							?>
								<li>
									<a href="<?php echo get_post_permalink($artist_id) ?>"><?php echo $artist->post_title?></a>
								</li>
							<?php
							}
							?>
							
							</ul>
						</div>
					</li>
          <?php
        endif;
			} 
			?>
			</ul>
			<?php
    endif;
    if (isset($date_ids) && is_array($date_ids)):
		?>
			<h3>Schedule</h3>
			<ul class="schedule">
			<?php 
				foreach($date_ids as $date_id):
					$date = get_post($date_id);
					$time_slots = get_post_meta($date_id, 'timeSlot', true);
			?>
				<li class="col-3">
					<a class="center block title"href="<?php echo get_post_permalink($date_id) ?>">
						<?php echo $date->post_title ?>
					</a>
        <?php 
          if (isset($time_slots) && is_array($time_slots)):
        ?>
          <?php 
            foreach($time_slots as $time_slot):
          ?>
          <div class="flex">
            <?php if (isset($time_slot['name'])): ?>
            <p class="no-margin">
              <?php echo $time_slot['name'] ?>
            </p>
            <?php 
              endif;
              if (isset($time_slot['shows']) && is_array($time_slot['shows'])):
                ?>
                <ul class="grow">
                  <li>
                    <ul class="flex no-margin">
                      <?php
                      foreach($time_slot['shows'] as $show_id):
                        $program_id = get_post_meta($show_id, 'program', true);
                        $program_title = str_replace($post->post_title, '', get_the_title($program_id));
                          $show = get_post($show_id);
                          if (isset($show) && !empty($show)):
                      ?>
                        <li class="col-6 text-center">
                          <a href="<?php echo get_post_permalink($show_id); ?>"><?php echo $show->post_title ?></a>
                        </li>
                      <?php  
                        endif;
                      endforeach;
                    ?>
                  </ul>
                </li>
                <li class="text-center"><?php echo $program_title ?></li>
                </ul>
                <?php
              endif;
            ?>
          </div>
          <?php
              endforeach;
          ?>
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
    endwhile; 
  endif; 
  ?>
</main>
<?php
get_footer();
?>

