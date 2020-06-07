<?php 
    if ( ! function_exists('paprika_render_homepage_cards') ) {
    function paprika_render_homepage_cards($block) {
        $fields = array( 
            'title',
            'secondTitle',
            'thirdTitle',
            'fourthTitle',
            'link', 
            'secondLink',
            'thirdLink',
            'fourthLink'
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
                <div class="col-6">
                    <?php
                        if (pg_is_valid('string', $attributes->link)):
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
                        if (pg_is_valid('string', $attributes->link)):
                    ?>
                        </a>
                    <?php
                        endif;  
                    ?>
                </div>
                <div class="col-6">
                    <?php
                        if (pg_is_valid('string', $attributes->secondLink)):
                    ?>
                        <a href="<?php echo $attributes->secondLink ?>">
                    <?php
                        endif;
                        if (pg_is_valid('string', $attributes->secondTitle)):
                    ?>
                        <h2 class="subtitle">
                            <?php echo $attributes->secondTitle ?>
                        </h2>
                    <?php
                        endif;
                        if (pg_is_valid('string', $images[1])):
                            echo $images[1];
                        endif;
                    if (pg_is_valid('string', $attributes->secondLink)):
                ?>
                    </a>
                <?php
                    endif; 
                ?>
                </div>
                <div class="col-6">
                    <?php
                        if (pg_is_valid('string', $attributes->thirdLink)):
                    ?>
                        <a href="<?php echo $attributes->thirdLink ?>">
                    <?php
                        endif; 
                        if (pg_is_valid('string', $attributes->thirdTitle)):
                    ?>
                        <h2 class="subtitle">
                            <?php echo $attributes->thirdTitle ?>
                        </h2>
                    <?php
                        endif;
                        if (pg_is_valid('string', $images[2])):
                            echo $images[2];
                        endif;
                        if (pg_is_valid('string', $attributes->thirdLink)):
                    ?>
                        </a>
                    <?php
                        endif;  
                    ?>
                </div>
                <div class="col-6">
                    <?php
                        if (pg_is_valid('string', $attributes->fourthLink)):
                    ?>
                        <a href="<?php echo $attributes->fourthLink ?>">
                    <?php
                        endif;
                        if (pg_is_valid('string', $attributes->fourthTitle)):
                    ?>
                        <h2 class="subtitle">
                            <?php echo $attributes->fourthTitle ?>
                        </h2>
                    <?php
                        endif;
                        if (pg_is_valid('string', $images[3])):
                            echo $images[3];
                        endif;
                    if (pg_is_valid('string', $attributes->fourthLink)):
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