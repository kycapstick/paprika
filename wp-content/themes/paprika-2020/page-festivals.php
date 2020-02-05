<?php 
get_header();
$args = array(
  'post_type' => 'festival',
  'post_status' => 'publish',
  'posts_per_page' => '-1',
  'orderby' => 'title',
  'order' => 'DESC'
);

$posts = new WP_Query($args);
?> 
<main class="container">
  <h1>Festivals</h1>
  <?php
  while ($posts->have_posts() ):
    $posts->the_post();
		$programs = get_post_meta($post->ID, 'programs', true);
		$location_id = get_post_meta($post->ID, 'location', true);
		$date_ids = get_post_meta($post->ID, 'dates', true);
    ?>
    <h2>Festival <?php echo the_title(); ?></h2>
		<div>
			<h3>Location</h3>
			<?php 
				$location = get_post($location_id);
			?>
			<a href="<?php echo get_post_permalink($location_id) ?>"><?php echo $location->post_title ?></a>
		</div>
    <h3>Programs</h3>
    <?php 
		if (isset($programs) && is_array($programs)):
			?>
			<ul class="flex">
			<?php
      foreach($programs as $program_id) {
        $program = get_post($program_id);
        $artists = paprika_get_program_artists($program_id);
        $mentors = paprika_get_program_mentors($program_id);
      ?>
					<li>
						<div>
						<h4><?php echo $program->post_title ?></h4>
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
			<ul class="flex">
			<?php 
				foreach($date_ids as $date_id):
					$date = get_post($date_id);
					$time_slots = get_post_meta($date_id, 'timeSlot', true);
			?>
				<li class="col-3">
					<p><?php echo $date->post_title ?></p>
					<ul>
						<?php 
							if (isset($time_slots) && is_array($time_slots)): 
								foreach($time_slots as $time_slot):
						?>
							<li class="flex middle">
									<p><?php echo $time_slot['name']?></p>
									<?php 
										if (isset($time_slot['shows']) && is_array($time_slot['shows'])):
											?>
											<ul class="offset">
											<?php
											foreach($time_slot['shows'] as $show_id):
												$show = get_post($show_id);
									?>

												<li>
													<a href="<?php echo get_post_permalink($show_id) ?>"><?php echo $show->post_title ?></a>

												</li>
												<?php 
													endforeach;
												?>
										</ul>
									<?php 
										endif; 
									?>
							</li>
						<?php 
								endforeach;
							endif; 
						?>
					</ul>
				</li>
			<?php
				endforeach;
			?>
		</ul>
		<?php
		endif;
  endwhile;
  ?>

</main>

<?php 
  get_footer();
?>