<?php 
    if ( ! function_exists('paprika_render_alumni_block') ) {
    function paprika_render_alumni_block($block) {
        $alumni = array();
        foreach ($block['innerBlocks'] as $innerBlock):
            $alumnus = null;
            switch( $innerBlock['blockName'] ) {

                case 'paprika/alumnus':
                    $alumnus = paprika_render_alumnus_block($innerBlock);
                    array_push($alumni, $alumnus);
                break;
            }
        endforeach;
        ob_start();
        ?>
            <div class="alumni-block">
                <div class="container">
                    <div class="flex">
                        <?php foreach ($alumni as $alumnus) {
                            echo $alumnus;
                        }
                    ?>
                    </div>
                </div>
            </div>
        <?php
            return ob_get_clean();
    }
}