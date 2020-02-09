<?php 
get_header();
?>
<main class="container">
<?php
	if ( have_posts() ) : 
		while ( have_posts() ) : the_post(); 
			$time_slots = get_post_meta($post->ID, 'timeSlots', true);
			uksort($time_slots, 'paprika_sort_order');
			$festival_id = get_post_meta($post->ID, 'festival', true);
			$festival = get_post($festival_id);
			$program_id = get_post_meta($post->ID, 'program', true);
			$program = get_post($program_id);
		?>
			<h1><?php the_title(); ?> </h1>
			<p>Part of 
				<a href="<?php echo get_post_permalink($program_id)?>">
					<?php echo $program->post_title ?>
				</a>
			</p>
			<p>
				<?php 
					echo wpautop(the_content());
				?>
			</p>
			<?php 
				if (isset($time_slots) && is_array($time_slots) && count($time_slots) > 0):
			?>
				<h2>Schedule</h2>
				<p>Part of the 
					<a href="<?php echo get_post_permalink($festival_id) ?>">
						<?php echo $festival->post_title?> Festival
					</a>	
				</p>
				<ul>
					<?php 
						foreach($time_slots as $date_id => $time_slot):
							$date = get_post($date_id);
							if ($date->post_status === 'publish'):
							?>
							<li>
								<a href="<?php echo get_post_permalink($date_id) ?>"><?php echo $date->post_title ?> at <?php echo $time_slot['name'] ?>
								</a>
								<?php 
									if (intval($time_slot['showCount']) > 1): 
										$other_shows = array_filter($time_slot['shows'], function($item) use($post) {
											return intval($item) !== intval($post->ID);
										});
								?>
										<?php 
										if (is_array($other_shows) && count($other_shows) > 0):
										?>
									<span>
											Paired with 
											<?php
											foreach($other_shows as $index => $other_show):
												$show = get_post($other_show);
												?>
												<a href="<?php echo get_post_permalink($other_show) ?>">
													<?php echo $show->post_title ?>
												</a>
												<?php
											endforeach;
											?>
												</span>
											<?php
										endif; 
										?>
									</span>
								<?php endif; ?>
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
    endwhile; 
endif; 
?>
</main>
<?php
get_footer();
?>