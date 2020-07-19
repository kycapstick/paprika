<?php 
    if ( ! function_exists('paprika_render_homepage_cards') ) {
    function paprika_render_homepage_cards($block) {
        $titleObjects = [];
        $images = [];
        $attributeFields = array(
            'customColor0',
            'customColor1'
        );
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
        $attributes = pg_get_attributes($block, $attributeFields);
        ob_start(); 
        ?>
            <?php if (pg_is_valid('array', $titleObjects) || pg_is_valid('array', $images) )?>
            <div class="homepage-cards container <?php echo isset($attributes->custom_color) && strlen($attributes->custom_color) > 0 ? 'page-' . $attributes->custom_color : null; ?>">
                <div class="flex">
                    <?php for ($i = 0; $i < 2; $i = $i + 1): ?>
                        <?php 
                            if ($i === 0) {
                                $custom_class = isset($attributes->customColor0) && strlen($attributes->customColor0) > 0 ? 'page-'. $attributes->customColor0 : 'page-about'; 
                            } else {
                                $custom_class = isset($attributes->customColor1) && strlen($attributes->customColor1) > 0 ? 'page-'. $attributes->customColor1 : 'page-about'; 
                            }
                        ?>
                        <div class="col-6 homepage-cards__card <?php echo $custom_class ?>">
                            <?php
                                if (pg_is_valid('string', $titleObjects[$i]->link)):
                            ?>
                                <a href="<?php echo $titleObjects[$i]->link ?>">
                            <?php
                                endif; 
                                if (pg_is_valid('string', $titleObjects[$i]->title)):
                            ?>
                                <p class="homepage-cards__title card__title card__title--dark">
                                    <?php echo $titleObjects[$i]->title ?>
                                </p>
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