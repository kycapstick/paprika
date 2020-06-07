<?php 
    if ( ! function_exists('paprika_render_news') ) {
    function paprika_render_news($block) {
        $fields = array(
            'post',
        );
        $attributes = pg_get_attributes($block, $fields);
        $post = get_post($attributes->post);
        ob_start();      
        ?>
                <h2><?php echo $post->post_title ?></h2>
                <p><?php echo substr( $post->post_content, 0, 500) ?></p>
            <?php
            return ob_get_clean();
    }
}