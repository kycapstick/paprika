<?php 
    if ( ! function_exists('paprika_render_artist_block') ) {
    function paprika_render_artist_block($block) {
        $fields = array( 
            'post', 
        );
        $attributes = pg_get_attributes($block, $fields);
        $post = get_post($attributes->post);
        $thumbnail = get_the_post_thumbnail($post->ID);
        ob_start();
        ?>
        <div class="flex">
            <div class="col-4">
                <?php echo $thumbnail ?>
            </div>
            <div class="col-8">
                <?php if (pg_is_valid('string', $post->post_title)): ?>
                    <h2><?php echo $post->post_title ?></h2>
                <?php endif; ?>
                <?php if (pg_is_valid('string', $post->post_content)): ?>
                    <?php echo wpautop($post->post_content); ?>
                <?php endif; ?>
            </div>

        </div>
        <?php
            return ob_get_clean();
    }
}