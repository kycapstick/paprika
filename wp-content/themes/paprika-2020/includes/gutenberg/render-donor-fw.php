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
        <div class="donor-block">
            <div class="container">
                <div class="flex flex-center">
                    <div class="col-8 donor-block__card">
                        <?php 
                            if (pg_is_valid('string', $attributes->tier)):
                        ?>
                            <p class="copy--large donor-block__price subtitle">
                                <span>
                                    <?php echo $attributes->tier ?>
                                </span>
                            </p>
                            <?php
                                endif;
                                if (pg_is_valid('string', $attributes->title)):
                            ?>
                                <p class="card__title donor-block__title"><?php echo $attributes->title ?></p>
                            <?php
                                endif; 
                                if (pg_is_valid('string', $paragraph) && strlen($paragraph) > 9) {
                                    echo $paragraph;
                                }
                                if (isset($list) && strlen($list) > 9) {
                                    echo $list;
                                }
                                if (pg_is_valid('string', $finePrint->copy)) {
                                ?>
                                    <div class="donor-block__fp copy copy--light">
                                        <?php
                                            echo wpautop($finePrint->copy);
                                        ?>
                                    </div>
                                <?php
                                }                                
                            ?>
                        </div>
                </div>
            </div>
        </div>
        <?php
            return ob_get_clean();
    }
}