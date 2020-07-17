<?php 
    if ( ! function_exists('paprika_render_two_up_cards') ) {
    function paprika_render_two_up_cards($block) {
        $titleObjects = [];
        $images = [];
        $buttons = [];
        $paragraphs = [];
        $fields = array(
            'title',
            'subtitle'
        );
        foreach ($block['innerBlocks'] as $innerBlock):
            switch( $innerBlock['blockName'] ) {

                case 'core/image':
                    array_push($images, $innerBlock['innerHTML']);
                break;

                case 'core/button':
                    array_push($buttons, $innerBlock['innerHTML']);
                break;

                case 'core/paragraph':
                    array_push($paragraphs, $innerBlock['innerHTML']);
                break;

                case 'paprika/card-title-copy':
                    $attributes = pg_get_attributes($innerBlock, $fields);
                    array_push($titleObjects, $attributes);
                break;
            }
        endforeach;
        $card_classes = paprika_custom_colors();
        ob_start();
        ?>
            <?php if (pg_is_valid('array', $titleObjects) || pg_is_valid('array', $images) )?>
            <div class="container two-up-cards">
                <div class="flex <?php echo $card_classes ?>">
                    <?php for ($i = 0; $i < 2; $i = $i + 1): ?>
                        <div class="col-6 two-up-cards__card">
                            <?php 
                                if (pg_is_valid('string', $images[$i])):
                                    echo $images[$i];
                                endif;
                            ?>
                            <div class="two-up-cards__copy">
                                <?php
                                    if (pg_is_valid('string', $titleObjects[$i]->title)):
                                ?>
                                    <h3 class="two-up-cards__title card__header">
                                        <?php echo $titleObjects[$i]->title ?>
                                    </h3>
                                <?php
                                    endif;
                                    if (pg_is_valid('string', $titleObjects[$i]->subtitle)):
                                ?>
                                    <p class="two-up-cards__subtitle copy--light"><?php echo $titleObjects[$i]->subtitle ?></p>
                                <?php
                                    endif; 
                                    if (pg_is_valid('string', $paragraphs[$i]) && strlen($paragraphs[$i]) > 9) {
                                        echo $paragraphs[$i];
                                    }
                                    if (pg_is_valid('string', $buttons[$i]) && strlen($buttons[$i]) > 74):
                                        echo $buttons[$i];
                                    endif;
                                ?>
                            </div>
                        </div>
                    <?php endfor; ?>
                </div>
            </div>
        <?php
            return ob_get_clean();
    }
}