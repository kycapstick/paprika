<?php 
    if (!function_exists('paprika_render_schedule')) {
        function paprika_render_schedule($block) {
            global $post;
            $date_ids = get_post_meta($post->ID, 'dates', true);
            ob_start();
        ?>
            <div class="schedule-block">
                <div class="container">
                    <?php if (isset($date_ids) && is_array($date_ids)): ?>
                        <form>
                            <fieldset>
                                <div class="flex">
                                    <div class="schedule__toggle">
                                                <input 
                                                    type="radio" 
                                                    class="schedule__toggle__single"
                                                    name="date" 
                                                    value="all" 
                                                    id="all_dates"
                                                    checked
                                                />
                                                <label class="btn btn--small btn--schedule btn--dark" for="all_dates">
                                                    All
                                                </label>                                        
                                        </div>
                                    <?php 
                                        $shows = array();
                                        foreach($date_ids as $date_id):
                                            if (!isset($first_date)) {
                                                $first_date = $date_id;
                                            }
                                            $date = get_post($date_id);
                                            $time_slots = get_post_meta($date_id, 'timeSlot', true);
                                            $shows = paprika_get_shows_with_dates($time_slots, $shows, $date_id);
                                            if ($date->post_status === 'publish'):
                                                ?>
                                            <div class="schedule__toggle">
                                                <input 
                                                    type="radio" 
                                                    class="schedule__toggle__single"
                                                    name="date" 
                                                    value="<?php echo $date_id ?>" 
                                                    id="<?php echo 'date-' . $date_id ?>"
                                                />
                                                <label class="btn btn--small btn--schedule btn--dark" for="<?php echo 'date-' . $date_id ?>">
                                                    <?php echo gmdate('M d', strtotime($date->post_title)) ?>
                                                </label>                                        
                                            </div>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </div>
                            </fieldset>
                        </form>
                    <?php endif; ?>
                    <?php if (isset($shows) && !empty($shows)): ?>
                        <ul class="flex schedule__list">
                            <?php foreach($shows as $show_id=>$show_details): ?>
                                <?php $show = get_post($show_id); ?>
                                    <?php if (!empty($show)): ?>
                                        <li class="schedule__list__item col-4">
                                            <?php include(get_template_directory() . ("/includes/template-parts/show-card.php")); ?>
                                        </li>
                                <?php endif;?>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                </div>
            </div>
        <?php
            return ob_get_clean();
        }
    }