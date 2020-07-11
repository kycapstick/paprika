<?php 
    if ( ! function_exists('paprika_render_donor_two_up') ) {
    function paprika_render_donor_two_up($block) {
        $titleObjects = [];
        $paragraphs = [];
        $lists = [];
        $buttons = [];
        $finePrints = [];
        $fields = array(
            'title',
            'tier'
        );
        $finePrintFields = array(
            'copy',
        );
        foreach ($block['innerBlocks'] as $innerBlock):
            switch( $innerBlock['blockName'] ) {

                case 'core/list':
                    array_push($lists, $innerBlock['innerHTML']);
                break;

                case 'core/paragraph':
                    array_push($paragraphs, $innerBlock['innerHTML']);
                break;

                case 'paprika/donor-title':
                    $attributes = pg_get_attributes($innerBlock, $fields);
                    array_push($titleObjects, $attributes);
                break;

                case 'paprika/fine-print':
                    $finePrintAttributes = pg_get_attributes($innerBlock, $finePrintFields);
                    array_push($finePrints, $finePrintAttributes);
                break;
            }
        endforeach;
        ob_start();
        ?>
            <?php if (pg_is_valid('array', $titleObjects) )?>
            <div class="donor-block--two-up">
                <div class="container">
                    <div class="flex">
                        <?php for ($i = 0; $i < 2; $i = $i + 1): ?>
                            <div class="col-6 donor-block__card">
                                <?php 
                                    if (pg_is_valid('string', $titleObjects[$i]->tier)):
                                ?>
                                    <p class="copy--large donor-block__price subtitle">
                                        <span><?php echo $titleObjects[$i]->tier ?></span>
                                    </p>
                                <?php
                                    endif;
                                    if (pg_is_valid('string', $titleObjects[$i]->title)):
                                ?>
                                    <p class="card__title donor-block__title"><?php echo $titleObjects[$i]->title ?></p>
                                <?php
                                    endif; 
                                    if (pg_is_valid('string', $paragraphs[$i]) && strlen($paragraphs[$i]) > 9) {
                                        echo $paragraphs[$i];
                                    }
                                    if (isset($lists[$i]) && strlen($lists[$i]) > 9) {
                                        echo $lists[$i];
                                    }
                                    if (pg_is_valid('string', $finePrints[$i]->copy)) {
                                    ?>
                                        <div class="donor-block__fp copy copy--light">
                                            <?php 
                                                echo wpautop($finePrints[$i]->copy);
                                            ?>
                                        </div>
                                        <?php
                                    }
                                ?>
                            </div>
                        <?php endfor; ?>
                    </div>
                </div>
            </div>
        <?php
            return ob_get_clean();
    }
}