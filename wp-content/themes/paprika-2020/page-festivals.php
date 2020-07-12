<?php 
get_header();
?> 
<main>
	<h1>Festivals</h1>
	<?php
		if ( have_posts() ) : 
			while ( have_posts() ) : the_post(); 
				$meta = get_post_meta($post->ID);
			?>
			<?php 
				echo the_content();
			?>
		<?php 
			endwhile; 
			endif; 
		$args = array(
			'post_type' => 'festival',
			'post_status' => 'publish',
			'posts_per_page' => '-1',
			'orderby' => 'title',
			'order' => 'DESC'
		);

	$posts = new WP_Query($args);
	
	while ($posts->have_posts() ):
		$posts->the_post();
		$programs = get_post_meta($post->ID, 'programs', true);
		usort($programs, 'paprika_sort_order');
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
			<ul class="flex mason">
			<?php
			foreach($programs as $program_id) {
				$program = get_post($program_id);
				if (isset($program) && $program->post_status === 'publish'):
			?>
				<li>
						<a href="<?php echo get_post_permalink($program_id) ?>">
						<?php 
              if (get_the_post_thumbnail($program_id)):
                echo get_the_post_thumbnail($program_id);
              else:  
            ?>
						<h4>							
								<?php echo str_replace(get_the_title(), '', $program->post_title) ?>
						</h4>
							<?php endif; ?>
							</a>

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
					if ($date->post_status === 'publish'):
			?>
				<li class="col-3">
					<a href="<?php echo get_post_permalink($date_id) ?>">
						<?php echo str_replace(get_the_title(), '', $date->post_title) ?>
					</a>
				</li>
			<?php
				endif;
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