<?php 
    if ( ! function_exists('paprika_render_column') ) {
    function paprika_render_column($block) {
        $contents = array();
        foreach ($block['innerBlocks'] as $innerBlock):
            switch( $innerBlock['blockName'] ) {

                case 'core/heading':
                    array_push($contents, $innerBlock['innerHTML']);
                break;

                case 'core/paragraph':
                    array_push($contents, $innerBlock['innerHTML']);
                break;

                case 'core/list':
                    array_push($contents, $innerBlock['innerHTML']);
                break;

            }
        endforeach;
        ob_start();
        ?>
            <div class="col-6">
                <div class="column flex--middle flex flex--column">
                    <div>
                        <?php 
                            foreach($contents as $content) {
                                echo $content;
                            }
                        ?>
                    </div>
                </div>
            </div>
        <?php
            return ob_get_clean();
    }
}