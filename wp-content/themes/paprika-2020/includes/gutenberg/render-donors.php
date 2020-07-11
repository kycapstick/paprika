<?php 
    if ( ! function_exists('paprika_render_donors_block') ) {
    function paprika_render_donors_block($block) {
        $cards = array();
        foreach ($block['innerBlocks'] as $innerBlock):
            $two_up = null;
            switch( $innerBlock['blockName'] ) {

                case 'paprika/donor-two-up':
                    $two_up = paprika_render_donor_two_up($innerBlock);
                    array_push($cards, $two_up);
                break;

                case 'paprika/cta':
                    $cta = paprika_render_cta($innerBlock);
                break;
            }
        endforeach;
        ob_start();
        ?>
        <div class="donor-block">
            <?php foreach ($cards as $card) {
                echo $card;
                }
            ?>
            <?php
                if (isset($cta) && pg_is_valid('string', $cta)) {
                    echo $cta;
                } 
            ?>
        </div>
        <?php
            return ob_get_clean();
    }
}