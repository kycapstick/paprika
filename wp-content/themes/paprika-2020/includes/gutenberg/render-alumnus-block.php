<?php 
    if ( ! function_exists('paprika_render_alumnus_block') ) {
    function paprika_render_alumnus_block($block) {
        $fields = array(
            'title',
            'subtitle'
        );
        $titleObject = null;
        foreach ($block['innerBlocks'] as $innerBlock):
            switch( $innerBlock['blockName'] ) {

                case 'core/paragraph':
                    $paragraph = $innerBlock['innerHTML'];
                break;

                case 'core/image':
                    $image = $innerBlock['innerHTML'];
                break;

                case 'paprika/card-title-copy':
                    $titleObject = pg_get_attributes($innerBlock, $fields);
                break;
            }
        endforeach;
        ob_start();
        ?>
            <?php if (isset($titleObject) ): ?>
                    <div class="col-3">
                        <?php 
                            if (pg_is_valid('string', $image)):
                                echo $image;
                            endif;
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
                        ?>
                    </>
            </div>
            <?php 
                return ob_get_clean();
                endif;      
            ?>
        <?php
    }
}