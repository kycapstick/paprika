<?php 
    if ( ! function_exists('paprika_render_content') ) {
        function paprika_render_content($block) {
            $class_name = paprika_custom_colors();
            ob_start();

            ?>
                <div class="container container--no-margin default-block <?php echo $class_name ?>">
                    <?php echo $block['innerHTML'] ?>
                </div>
            <?php
            return ob_get_clean();
        }
    }