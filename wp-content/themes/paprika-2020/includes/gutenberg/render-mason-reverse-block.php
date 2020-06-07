<?php 
    if ( ! function_exists('paprika_render_mason_reverse') ) {
    function paprika_render_mason_reverse($block) {
        $fields = array( 
            'title',
            'secondaryTitle',
            'link', 
            'secondaryLink'
        );
        $images = [];
        foreach ($block['innerBlocks'] as $innerBlock):
            switch( $innerBlock['blockName'] ) {

                case 'core/image':
                    array_push($images, $innerBlock['innerHTML']);
                break;
            }
        endforeach;
        $attributes = pg_get_attributes($block, $fields);
        ob_start();
        ?>
            <?php if (pg_is_valid('string', $attributes->title) || pg_is_valid('array', $images) )?>
            <div class="flex">
                <div class="col-7">
                    <?php
                        if (pg_is_valid('url', $attributes->link)):
                    ?>
                        <a href="<?php echo $attributes->link ?>">
                    <?php
                        endif; 
                        if (pg_is_valid('string', $attributes->title)):
                    ?>
                        <h2 class="subtitle">
                            <?php echo $attributes->title ?>
                        </h2>
                    <?php
                        endif;
                        if (pg_is_valid('string', $images[0])):
                            echo $images[0];
                        endif;
                        if (pg_is_valid('url', $attributes->link)):
                    ?>
                        </a>
                    <?php
                        endif;  
                    ?>
                </div>
                <div class="col-5">
                    <?php
                        if (pg_is_valid('url', $attributes->secondaryLink)):
                    ?>
                        <a href="<?php echo $attributes->secondaryLink ?>">
                    <?php
                        endif;
                        if (pg_is_valid('string', $attributes->secondaryTitle)):
                    ?>
                        <h2 class="subtitle">
                            <?php echo $attributes->secondaryTitle ?>
                        </h2>
                    <?php
                        endif;
                        if (pg_is_valid('string', $images[1])):
                            echo $images[1];
                        endif;
                    if (pg_is_valid('url', $attributes->secondaryLink)):
                ?>
                    </a>
                <?php
                    endif; 
                ?>
                </div>
            </div>
        <?php
            return ob_get_clean();
    }
}