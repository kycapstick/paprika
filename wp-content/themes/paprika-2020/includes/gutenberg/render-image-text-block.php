<?php 
    if ( ! function_exists('paprika_render_image_text_block') ) {
    function paprika_render_image_text_block($block) {
        $fields = array(
            'title',
        );
        $attributes = pg_get_attributes($block, $fields);
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
        $title = isset($attributes->title) && strlen($attributes->title) > 0 ? $attributes->title :  html_entity_decode(get_the_title(),ENT_QUOTES,'UTF-8');
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
                        <h2 class="image-text__title"><?php echo $title ?></h2>
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