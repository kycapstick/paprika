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

                case 'core/button':
                    array_push($buttons, $innerBlock['innerHTML']);
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
            <div class="flex">
                <?php for ($i = 0; $i < 2; $i = $i + 1): ?>
                    <div class="col-6">
                        <?php 
                            if (pg_is_valid('string', $titleObjects[$i]->tier)):
                        ?>
                            <h2 class="subtitle">
                                <?php echo $titleObjects[$i]->tier ?>
                            </h2>
                        <?php
                            endif;
                            if (pg_is_valid('string', $titleObjects[$i]->title)):
                        ?>
                            <p><?php echo $titleObjects[$i]->title ?></p>
                        <?php
                            endif; 
                            if (pg_is_valid('string', $paragraphs[$i]) && strlen($paragraphs[$i]) > 9) {
                                echo $paragraphs[$i];
                            }
                            if (isset($lists[$i]) && strlen($lists[$i]) > 9) {
                                echo $lists[$i];
                            }
                            if (pg_is_valid('string', $finePrints[$i]->copy)) {
                                echo wpautop($finePrints[$i]->copy);
                            }
                            if (pg_is_valid('string', $buttons[$i]) && strlen($buttons[$i]) > 74):
                                echo $buttons[$i];
                            endif;
                        ?>
                    </div>
                <?php endfor; ?>
            </div>
        <?php
            return ob_get_clean();
    }
}