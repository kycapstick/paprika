<?php 
    if ( ! function_exists('paprika_render_content') ) {
        function paprika_render_content($block) {
            if (!isset($block['blockName'])) {
                return;
            }
            ob_start();
            ?>
                <div class="container container--no-margin">
                    <?php echo $block['innerHTML'] ?>
                </div>
            <?php
            return ob_get_clean();
        }
    }