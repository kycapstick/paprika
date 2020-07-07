<?php 
    if ( ! function_exists('paprika_render_homepage_cards') ) {
    function paprika_render_homepage_cards($block) {
        $titleObjects = [];
        $images = [];
        $fields = array(
            'title',
            'link'
        );
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
            <div class="homepage-cards container">
                <div class="flex">
                    <?php for ($i = 0; $i < 2; $i = $i + 1): ?>
                        <div class="col-6 homepage-cards__card">
                            <?php
                                if (pg_is_valid('string', $titleObjects[$i]->link)):
                            ?>
                                <a href="<?php echo $titleObjects[$i]->link ?>">
                            <?php
                                endif; 
                                if (pg_is_valid('string', $titleObjects[$i]->title)):
                            ?>
                                <h2 class="homepage-cards__title">
                                    <?php echo $titleObjects[$i]->title ?>
                                </h2>
                            <?php
                                endif;
                                if (pg_is_valid('string', $images[$i])):
                                    echo $images[$i];
                                endif;
                                if (pg_is_valid('string', $titleObjects[$i]->link)):
                            ?>
                                </a>
                            <?php
                                endif;  
                            ?>
                        </div>
                    <?php endfor; ?>
                </div>
            </div>
        <?php
            return ob_get_clean();
    }
}