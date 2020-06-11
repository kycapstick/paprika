<?php 
    if ( ! function_exists('paprika_render_media_quote') ) {
    function paprika_render_media_quote($block) {
        $fields = array(
            'title',
            'subtitle'
        );
        foreach ($block['innerBlocks'] as $innerBlock):
            switch( $innerBlock['blockName'] ) {

                case 'core/button':
                    $button = $innerBlock['innerHTML'];
                break;

                case 'core/paragraph':
                    $paragraph = $innerBlock['innerHTML'];
                break;

                case 'paprika/media-title-copy':
                    $titleObject = pg_get_attributes($innerBlock, $fields);
                break;
            }
        endforeach;
        ob_start();
        ?>
            <?php if (pg_is_valid('object', $titleObject) ): ?>
            <div class="flex">
                <div class="col-12">
                    <?php 
                        if (pg_is_valid('string', $titleObject->title)):
                        ?>
                            <h2 class="subtitle">
                                <?php echo $titleObject->title ?>
                            </h2>
                        <?php
                            endif;
                            if (pg_is_valid('string', $titleObject->subtitle)):
                        ?>
                            <p><?php echo $titleObject->subtitle ?></p>
                        <?php
                            endif; 
                            if (pg_is_valid('string', $paragraph) && strlen($paragraph) > 9) {
                                echo $paragraph;
                            }
                        if (pg_is_valid('string', $button) && strlen($button) > 74):
                            echo $button;
                        endif;
                    ?>
                </div>
            </div>
            <?php endif; ?>
        <?php
            return ob_get_clean();
    }
}