<?php 
    if ( ! function_exists('paprika_render_location') ) {
    function paprika_render_location($block) {
        $fields = array( 
            'title', 
        );
        $postFields = array(
            'post',
        );
        foreach ($block['innerBlocks'] as $innerBlock):
            switch( $innerBlock['blockName'] ) {

                case 'paprika/location-select':
                    $postObject = pg_get_attributes($innerBlock, $postFields);
                break;
            }
        endforeach;
        $attributes = pg_get_attributes($block, $fields);
        if (isset($postObject)) {
            $location_post = get_post($postObject->post);
            $thumbnail = get_the_post_thumbnail($location_post->ID);
        }
        $class_name = paprika_custom_colors();
    
        ob_start();
        ?>
        <div class="location-block">
            <div class="container default-block <?php echo $class_name ?>">
                <h2><?php echo $attributes->title ?></h2>
                <?php     
                    if (has_blocks($location_post->post_content)) {
                        $blocks = parse_blocks($location_post->post_content); 
                        foreach ($blocks as $block) {
                            echo $block['innerHTML'];
                        }
                    }
                ?>
            </div>
        </div>
        <?php
            return ob_get_clean();
    }
}