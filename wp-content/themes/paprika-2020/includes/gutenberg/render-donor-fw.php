<?php 
    if ( ! function_exists('paprika_render_donor_fw') ) {
    function paprika_render_donor_fw($block) {
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
                    $list = $innerBlock['innerHTML'];
                break;

                case 'core/paragraph':
                    $paragraph = $innerBlock['innerHTML'];
                break;

                case 'paprika/donor-title':
                    $attributes = pg_get_attributes($innerBlock, $fields);
                break;

                case 'paprika/fine-print':
                    $finePrint = pg_get_attributes($innerBlock, $finePrintFields);
                break;
            }
        endforeach;
        ob_start();
        ?>
            <div class="flex">
                <div class="col-12">
                    <?php 
                        if (pg_is_valid('string', $attributes->tier)):
                    ?>
                        <h2 class="subtitle">
                            <?php echo $attributes->tier ?>
                        </h2>
                        <?php
                            endif;
                            if (pg_is_valid('string', $attributes->title)):
                        ?>
                            <p><?php echo $attributes->title ?></p>
                        <?php
                            endif; 
                            if (pg_is_valid('string', $paragraph) && strlen($paragraph) > 9) {
                                echo $paragraph;
                            }
                            if (isset($list) && strlen($list) > 9) {
                                echo $list;
                            }
                            if (pg_is_valid('string', $finePrint->copy)) {
                                echo wpautop($finePrint->copy);
                            }
                        ?>
                    </div>
            </div>
        <?php
            return ob_get_clean();
    }
}