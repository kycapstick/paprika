<?php 
    if ( ! function_exists('paprika_render_content') ) {
        function paprika_render_content($block) {
            ob_start();
            ?>
                <div class="container">
                    <?php echo $block['innerHTML'] ?>
                </div>
            <?php
            return ob_get_clean();
        }
    }