<?php 
    if ( ! function_exists('paprika_render_show_block') ) {
    function paprika_render_show_block($block) {
        $team_members = [];
        $paragraphs = [];
        $fields = array(
            'title',
            'post_id',
        );
        $member_fields = array(
            'title',
            'fullName'
        );
        $attributes = pg_get_attributes($block, $fields);
        foreach ($block['innerBlocks'] as $innerBlock):
            switch( $innerBlock['blockName'] ) {

                case 'core/paragraph':
                    array_push($paragraphs, $innerBlock['innerHTML']);
                break;

                case 'paprika/team-member':
                    $member_attributes = pg_get_attributes($innerBlock, $member_fields);
                    array_push($team_members, $member_attributes);
                break;
            }
        endforeach;
        $post_id = get_the_id();
		$time_slots = get_post_meta($post_id, 'timeSlots', true);
		if (is_array($time_slots) && !empty($time_slots)) {
			uksort($time_slots, 'paprika_sort_order');
		}
        $festival_id = get_post_meta($post_id, 'festival', true);
		$festival = get_post($festival_id);
		$color_classes = paprika_custom_colors();
        ob_start();
        ?>
		<div class="show-block <?php echo $color_classes ?>">
			<div class="container">
				<div class="flex">
					<div class="col-9">
						<div class="show-block__team">
							<h3><?php echo $attributes->title ?></h3>
							<ul>
								<?php foreach ($team_members as $member): ?>
									<li class="show-block__team__member">
										<span class="copy--bold"><?php echo $member->title ?>:</span>
										<span><?php echo $member->fullName ?></span>
									</li>
								<?php endforeach ?>
							</ul>
							<?php if (!empty($paragraphs)) {
								foreach($paragraphs as $paragraph) {
									echo $paragraph;
								}	
							}?>
						</div>
					</div>
                <div class="col-3">
					<?php 
						if (isset($time_slots) && is_array($time_slots) && count($time_slots) > 0):
					?>
					<h3 class="card__header">Schedule</h3>
					<p class="show-block__subheader">Part of the 
						<a href="<?php echo get_post_permalink($festival_id) ?>">
							<?php echo $festival->post_title?> Festival
						</a>	
					</p>
					<ul class="show-block__schedule">
						<?php 
							foreach($time_slots as $date_id => $time_slot):
								$date = get_post($date_id);
								if ($date->post_status === 'publish'):
							?>
							<li class="show-block__date">
								<p><?php echo gmdate('M d', strtotime($date->post_title)) ?> at <?php echo $time_slot['name'] ?></p>
								<?php 
									if (intval($time_slot['showCount']) > 1): 
										$other_shows = array_filter($time_slot['shows'], function($item) use($post_id) {
											return intval($item) !== intval($post_id);
										});
								?>
										<?php 
										if (is_array($other_shows) && count($other_shows) > 0):
										?>
											<?php $last_show = array_pop($other_shows); ?>
											<p class="copy--light show-block__date__alt">Paired with 
												<?php
													foreach($other_shows as $index => $other_show):
														$show = get_post($other_show);
														?>
															<a href="<?php echo get_post_permalink($other_show) ?>">
																<?php echo $show->post_title ?>,
															</a>
														<?php
													endforeach;
												?>
												and 
												<?php $show = get_post($last_show); ?>
													<a href="<?php echo get_post_permalink($last_show) ?>">
														<?php echo $show->post_title ?>.
													</a>
												</p>
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
				$ticket_link = get_post_meta($festival_id, 'tickets', true); 
				if (isset($ticket_link) && strlen($ticket_link) > 0 && filter_var($ticket_link, FILTER_VALIDATE_URL)): 
			?>
				<a href="<?php echo $ticket_link ?>" class="btn btn--light">Buy Tickets</a>
				<?php endif; ?>
            </div>
            </div>
			</div>
		</div>
        <?php
            return ob_get_clean();
    }
}