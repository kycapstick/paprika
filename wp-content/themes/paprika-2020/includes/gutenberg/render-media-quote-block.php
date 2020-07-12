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
            <div class="media-quote">
                <div class="container">
                    <?php if (pg_is_valid('object', $titleObject) ): ?>
                        <div class="flex">
                            <div class="col-12">
                                <?php  if (pg_is_valid('string', $titleObject->title)): ?>
                                    <h3 class="media-quote__title">
                                        <?php echo $titleObject->title ?>
                                    </h3>
                                <?php endif; ?>
                                <div class="flex">
                                    <div class="col-9">
                                        <?php if (pg_is_valid('string', $paragraph) && strlen($paragraph) > 9): ?>
                                            <div class="media-quote__copy">
                                                <?php echo $paragraph; ?>
                                            </div>
                                        <?php endif; ?>
                                        <?php if (pg_is_valid('string', $button) && strlen($button) > 74): ?>
                                            <div class="media-quote__btn">
                                                <?php echo $button; ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="col-3">
                                        <?php if (pg_is_valid('string', $titleObject->subtitle)): ?>
                                            <p class="media-quote__subtitle copy--light"><?php echo $titleObject->subtitle ?></p>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        <?php
            return ob_get_clean();
    }
}