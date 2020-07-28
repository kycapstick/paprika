<?php 
    if ( ! function_exists('paprika_render_artist_block') ) {
    function paprika_render_artist_block($block, $reverse = false) {
        global $post;
        $fields = array( 
            'title', 
        );
        $postFields = array(
            'post',
        );
        foreach ($block['innerBlocks'] as $innerBlock):
            switch( $innerBlock['blockName'] ) {

                case 'paprika/artist-select':
                    $postObject = pg_get_attributes($innerBlock, $postFields);
                break;
            }
        endforeach;
        $attributes = pg_get_attributes($block, $fields);
        $post_object = get_post($postObject->post);
        $thumbnail = get_the_post_thumbnail($post_object->ID);
        ob_start();
        ?>
            <?php if (intval($post_object->ID) !== intval($post->ID)): ?>
                <div class="artist-block <?php echo $reverse ? 'artist-block--reverse' : null; ?>">
                    <div class="container">
                        <div>
                            <div class="flex">
                                <?php if ($reverse === false): ?>
                                    <div class="col-4">
                                        <figure class="artist-block__photo">                                
                                            <?php echo $thumbnail ?>
                                            <p class="artist-block__name card__title card__title--dark"><?php echo $post_object->post_title ?></p>
                                        </figure>
                                    </div>
                                    <div class="col-8">
                                        <?php if (pg_is_valid('string', $post_object->post_title)): ?>
                                            <h3 class="artist-block__title"><?php echo $attributes->title ?></h3>
                                        <?php endif; ?>
                                        <?php if (pg_is_valid('string', $post_object->post_content)): ?>
                                            <?php echo wpautop($post_object->post_content); ?>
                                        <?php endif; ?>
                                    </div>
                                <?php else: ?>
                                    <div class="col-4 artist-block__photo__container--mobile">
                                        <figure class="artist-block__photo">                                
                                            <?php echo $thumbnail ?>
                                            <p class="artist-block__name card__title card__title--dark"><?php echo $post_object->post_title ?></p>
                                        </figure>
                                    </div>
                                    <div class="col-8 artist-block__copy">
                                        <?php if (pg_is_valid('string', $post_object->post_title)): ?>
                                            <h3 class="artist-block__title"><?php echo $attributes->title ?></h3>
                                        <?php endif; ?>
                                        <?php if (pg_is_valid('string', $post_object->post_content)): ?>
                                            <?php echo wpautop($post_object->post_content); ?>
                                        <?php endif; ?>
                                    </div>
                                    <div class="col-4 artist-block__photo__container--tablet">
                                        <figure class="artist-block__photo">                                
                                            <?php echo $thumbnail ?>
                                            <p class="artist-block__name card__title card__title--dark"><?php echo $post_object->post_title ?></p>
                                        </figure>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        <?php
            return ob_get_clean();
    }
}