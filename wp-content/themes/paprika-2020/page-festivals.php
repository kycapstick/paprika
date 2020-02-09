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
    <h2 class="center"><a href="<?php echo the_permalink() ?>"> Festival <?php echo the_title(); ?> </a></h2>
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
				if (isset($program)):
      ?>
					<li>
						<h4>
							<a href="<?php echo get_post_permalink($program_id) ?>">
								<?php echo str_replace(get_the_title(), '', $program->post_title) ?>
							</a>
						</h4>
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
			<h3>Dates</h3>
			<ul class="flex">
			<?php 
				foreach($date_ids as $date_id):
					$date = get_post($date_id);
					$time_slots = get_post_meta($date_id, 'timeSlot', true);
			?>
				<li class="col-3">
					<a href="<?php echo get_post_permalink($date_id) ?>">
						<?php echo str_replace(get_the_title(), '', $date->post_title) ?>
					</a>
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