<?php 
    if ( ! function_exists('paprika_render_image_text_block') ) {
    function paprika_render_image_text_block($block) {
        $paragraphs = [];
        foreach ($block['innerBlocks'] as $innerBlock):
            switch( $innerBlock['blockName'] ) {

                case 'core/image':
                    $image = $innerBlock['innerHTML'];
                break;

                case 'core/paragraph':
                    array_push($paragraphs, $innerBlock['innerHTML']);
                break;
            }
        endforeach;
        ob_start();
        ?>
        <div>
            <div class="flex">
                <div class="col-4">
                    <?php echo $image ?>
                </div>
                <div class="col-8">
                    <h2><?php echo get_the_title() ?></h2>
                    <?php foreach($paragraphs as $paragraph ):
                        echo $paragraph;
                    endforeach; ?>
                </div>
            </div>

        </div>
        <?php
            return ob_get_clean();
    }
}