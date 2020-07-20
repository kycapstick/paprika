<?php 
    if ( ! function_exists('paprika_render_mason_reverse') ) {
    function paprika_render_mason_reverse($block) {
        $fields = array( 
            'title',
            'link', 
        );
        $images = [];
        $titleObjects = [];
        foreach ($block['innerBlocks'] as $innerBlock):
            switch( $innerBlock['blockName'] ) {
                case 'core/image':
                    array_push($images, $innerBlock['innerHTML']);
                break;
                case 'paprika/card-title':
                    $attributes = pg_get_attributes($innerBlock, $fields);
                    array_push($titleObjects, $attributes);
                break;
            }
        endforeach;
        ob_start();
        ?>
        <?php if (pg_is_valid('array', $titleObjects) || pg_is_valid('array', $images) )?>
            <div class="mason-block mason-reverse">
                <div class="container">
                    <div class="flex">
                        <div class="col-7">
                            <?php if (pg_is_valid('string', $titleObjects[0]->link)): ?>
                                <a href="<?php echo $titleObjects[0]->link ?>">
                            <?php endif; ?>
                                <div>
                                    <?php
                                        if (pg_is_valid('string', $titleObjects[0]->title)):
                                    ?>
                                    <h3 class="subtitle mason-block__title">
                                        <?php echo $titleObjects[0]->title ?>
                                    </h3>
                                    <?php endif; ?>
                                    <?php 
                                        if (pg_is_valid('string', $images[0])):
                                            echo $images[0];
                                        endif;
                                    ?>
                                </div>
                            <?php if (pg_is_valid('string', $titleObjects[0]->link)): ?>
                                </a>
                            <?php endif; ?>
                        </div>
                        <div class="col-5">
                            <?php if (pg_is_valid('string', $titleObjects[1]->link)): ?>
                                <a href="<?php echo $titleObjects[1]->link ?>">
                            <?php endif; ?>
                                    <div>
                                        <?php
                                            if (pg_is_valid('string', $titleObjects[1]->title)):
                                        ?>
                                        <h3 class="subtitle mason-block__title">
                                            <?php echo $titleObjects[1]->title ?>
                                        </h3>
                                        <?php endif; ?>
                                        <?php 
                                            if (pg_is_valid('string', $images[1])):
                                                echo $images[1];
                                            endif;
                                        ?>
                                    </div>
                                <?php if (pg_is_valid('string', $titleObjects[1]->link)): ?>
                                </a>
                                <?php endif; ?>
                        </div>
                </div>
            </div>
        </div>
        <?php
            return ob_get_clean();
    }
}