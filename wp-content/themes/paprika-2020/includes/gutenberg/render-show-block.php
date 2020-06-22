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
        uksort($time_slots, 'paprika_sort_order');
        $festival_id = get_post_meta($post_id, 'festival', true);
        $festival = get_post($festival_id);
        ob_start();
        ?>
        
            <div class="flex">
                <div class="col-6">
                    <h3><?php echo $attributes->title ?></h3>
                    <ul>
                        <?php foreach ($team_members as $member): ?>
                            <li>
                                <span><?php echo $member->title ?>:</span>
                                <span><?php echo $member->fullName ?></span>
                            </li>
                        <?php endforeach ?>
                    </ul>
                </div>
                <div class="col-6">
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
										$other_shows = array_filter($time_slot['shows'], function($item) use($post_id) {
											return intval($item) !== intval($post_id);
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
            </div>
            </div>
        <?php
            return ob_get_clean();
    }
}