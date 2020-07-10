<?php 
    if ( ! function_exists('paprika_render_two_up_columns') ) {
    function paprika_render_two_up_columns($block) {
        $columns = array();
        foreach ($block['innerBlocks'] as $innerBlock):
            switch( $innerBlock['blockName'] ) {

                case 'paprika/column':
                    $column = paprika_render_column($innerBlock);
                    array_push($columns, $column);
                break;

            }
        endforeach;
        ob_start();
        ?>
            <?php if (pg_is_valid('array', $columns) && count($columns) >= 2 )?>
            <div class="two-columns">
                <div class="container">
                    <div class="flex">
                        <?php 
                            for ($i = 0; $i < 2; $i = $i + 1):
                                    echo $columns[$i];
                            endfor; 
                        ?>
                    </div>
                </div>
            </div>
        <?php
            return ob_get_clean();
    }
}