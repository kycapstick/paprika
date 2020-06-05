<?php 
    if ( ! function_exists('paprika_render_mason') ) {
    function paprika_render_mason($block) {
        $fields = array( 
            'title' 
        );
        $images = [];
        foreach ($block['innerBlocks'] as $innerBlock):
            switch( $innerBlock['blockName'] ) {

                case 'core/image':
                    array_push($images, $innerBlock['innerHTML']);
                break;
            }
        endforeach;
        $attributes = pg_get_attributes($block, $fields);
        ob_start();
            if (pg_is_valid('string', $attributes->title)):
        ?>
            <h2 class="subtitle">
                <?php echo $attributes->title ?>
            </h2>
        <?php
            endif;
            if (pg_is_valid('array', $images)):
                ?>
                <div class="flex">
                <?php 
                    foreach($images as $image) {
                        echo $image;
                    }
                ?>
                </div>
                <?php 
            endif;
            return ob_get_clean();
    }
}