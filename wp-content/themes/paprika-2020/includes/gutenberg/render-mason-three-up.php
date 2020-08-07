<?php 
    if ( ! function_exists('paprika_render_mason_three_up') ) {
    function paprika_render_mason_three_up($block) {
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
            <div class="mason-block mason-three-up">
                <div class="container">
                    <?php if (pg_is_valid('string', $titleObjects[0]->title) && !pg_is_valid('string', $titleObjects[1]->title)): ?>
                        <?php $single_title = true; ?>
                        <h3 class="mason-block__title">
                            <?php echo $titleObjects[0]->title ?>
                        </h3>
                    <?php endif; ?>
                    <div class="flex">
                        <?php 
                            for ($i = 0; $i < count($images); $i = $i + 1):  
                        ?>
                            <div class="col-4">
                                <?php if (isset($titleObjects[$i]) && pg_is_valid('string', $titleObjects[$i]->link)): ?>
                                    <a href="<?php echo $titleObjects[$i]->link ?>">
                                <?php endif; ?>
                                    <div>
                                        <?php  if (!isset($single_title) && isset($titleObjects[$i]) && pg_is_valid('string', $titleObjects[$i]->title)): ?>
                                            <h3 class="mason-block__title">
                                                <?php echo $titleObjects[$i]->title ?>
                                            </h3>
                                        <?php
                                            endif;
                                            if (pg_is_valid('string', $images[$i])):
                                                echo $images[$i];
                                            endif;
                                        ?>
                                    </div>
                                <?php if (isset($titleObjects[$i]) && pg_is_valid('string', $titleObjects[$i]->link)): ?>
                                    </a>
                                <?php endif; ?>
                            </div>
                        <?php endfor; ?>
                    </div>
                </div>
            </div>
        <?php
            return ob_get_clean();
    }
}