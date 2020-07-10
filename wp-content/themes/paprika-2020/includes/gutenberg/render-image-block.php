<?php 
    if ( ! function_exists('paprika_render_fw_image') ) {
    function paprika_render_fw_image($block) {
        $fields = array( 
            'title'
        );
        foreach ($block['innerBlocks'] as $innerBlock):
            switch( $innerBlock['blockName'] ) {

                case 'core/image':
                    $image = $innerBlock['innerHTML'];
                break;
            }
        endforeach;
        $attributes = pg_get_attributes($block, $fields);
        ob_start();
            if (pg_is_valid('string', $attributes->title)):
        ?>
            <div class="image-block">
                <div class="container">
                    <h2 class="subtitle">
                        <?php echo $attributes->title ?>
                    </h2>
                <?php
                    endif;
                    if (pg_is_valid('string', $image)):
                        ?>
                        <?php 
                            echo $image;
                        ?>
                        <?php 
                    endif;
                    ?>
                </div>
            </div>
            <?php
            return ob_get_clean();
    }
}