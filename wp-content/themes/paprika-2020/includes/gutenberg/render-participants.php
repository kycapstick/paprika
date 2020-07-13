<?php 
    if (!function_exists('paprika_render_participants')) {
        function paprika_render_participants($blocks) {
            global $post;
            $artists = get_post_meta($post->ID, 'artists', true);
            ob_start();
        ?>
        <div class="participants-block">
            <div class="container">
                <?php if (isset($artists) && is_array($artists)): ?>
                    <ul class="flex">
                        <?php 
                            foreach ($artists as $artist_id):
                                $artist = get_post($artist_id);
                                $shows = get_post_meta($artist_id, 'show', true);
                        ?>  
                            <li class="col-6 participants-block__column">
                                <?php if (isset($shows) && is_array($shows) && count($shows) > 0): ?>
                                    <?php $show = get_post($shows[0]); ?>
                                    <a href="<?php echo get_post_permalink($show->ID)?>">
                                        <div class="participants-block__photo">
                                            <p class="participants-block__name card__title card__title--dark"><?php echo $artist->post_title; ?></p>
                                            <?php 
                                                echo get_the_post_thumbnail($artist_id);
                                            ?>
                                            <div class="participants-block__overlay">
                                                <p class="participants-block__overlay__title copy--medium"><?php echo $show->post_title; ?></p>
                                            </div>
                                        </div>
                                    </a>
                                <?php endif; ?>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </div>
        </div>
        <?php
        return ob_get_clean();
    }
}