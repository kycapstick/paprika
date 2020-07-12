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
                    <div class="alumni__single">
                        <?php if (pg_is_valid('string', $image)){
                                echo $image;
                        } ?>
                        <?php if (pg_is_valid('string', $titleObject->title)): ?>
                            <p class="card__title alumni__name">
                                <?php echo $titleObject->title ?>
                            </p>
                        <?php endif; ?>
                        <?php if (pg_is_valid('string', $titleObject->subtitle)): ?>
                            <p class="alumni__role copy--light copy--italic"><?php echo $titleObject->subtitle ?></p>
                        <?php endif; ?>
                        <?php 
                            if (pg_is_valid('string', $paragraph) && strlen($paragraph) > 9) {
                                echo $paragraph;
                            }
                        ?>
                    </div>
                </div>
            <?php 
                return ob_get_clean();
                endif;      
            ?>
        <?php
    }
}