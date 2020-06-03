<?php 
    if ( ! function_exists('paprika_render_cta') ) {
    function paprika_render_cta($block) {
        $fields = array(
            'title',
            'copy',
        );
        $attributes = pg_get_attributes($block, $fields);
        foreach ($block['innerBlocks'] as $innerBlock):
            switch( $innerBlock['blockName'] ) {

                case 'core/button':
                    $button = $innerBlock['innerHTML']; 
                break;
            }
        endforeach;
        ob_start();
            if (pg_is_valid('string', $attributes->title)):
        ?>
            <h2 class="subtitle">
                <?php echo $attributes->title ?>
            </h2>
        <?php
            endif;
            if (pg_is_valid('string', $attributes->copy)):
        ?>
            <p>
                <?php echo $attributes->copy; ?>
            </p>
        <?php
            endif;
            if (isset($button)) {
                echo $button;
            }
            return ob_get_clean();
    }
}