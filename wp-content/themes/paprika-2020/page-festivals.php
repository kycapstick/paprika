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
		?>
		<?php
  endwhile;
  ?>

</main>

<?php 
  get_footer();
?>