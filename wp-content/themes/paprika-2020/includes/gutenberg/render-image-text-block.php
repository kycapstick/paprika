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
        <div class="image-text">
            <div class="container">
                <div class="flex">
                    <div class="col-4">
                        <div class="image-text__image">
                            <?php echo $image ?>
                        </div>
                    </div>
                    <div class="col-8">
                        <h2 class="image-text__title"><?php echo get_the_title() ?></h2>
                        <?php foreach($paragraphs as $paragraph ):
                            echo $paragraph;
                        endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
        <?php
            return ob_get_clean();
    }
}