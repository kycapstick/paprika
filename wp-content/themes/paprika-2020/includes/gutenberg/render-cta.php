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
        $cta_class = paprika_custom_colors();
        ob_start();
        ?>
        <div class="cta-block <?php echo $cta_class ?>">
            <div class="container">
                <?php
                    if (pg_is_valid('string', $attributes->title)):
                ?>
                    <h2 class="cta-block__title subtitle">
                        <?php echo esc_html( $attributes->title ) ?>
                    </h2>
                <?php
                    endif;
                    if (pg_is_valid('string', $attributes->copy)):
                ?>
                    <p class="cta-block__copy copy">
                        <?php echo $attributes->copy; ?>
                    </p>
                <?php
                    endif;
                    if (isset($button)) {
                        echo $button;
                    }
                ?>
            </div>
        </div>
        <?php
            return ob_get_clean();
    }
}