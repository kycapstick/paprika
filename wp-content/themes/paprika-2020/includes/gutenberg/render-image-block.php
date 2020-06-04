<?php 
    if ( ! function_exists('paprika_render_image_block') ) {
    function paprika_render_image_block($block) {
        $fields = array(
            'imageUrl', 
            'imageId', 
            'imageAlt', 
            'title' 
        );
        $attributes = pg_get_attributes($block, $fields);
        ob_start();
            if (pg_is_valid('string', $attributes->title)):
        ?>
            <h2 class="subtitle">
                <?php echo $attributes->title ?>
            </h2>
        <?php
            endif;
            return ob_get_clean();
    }
}