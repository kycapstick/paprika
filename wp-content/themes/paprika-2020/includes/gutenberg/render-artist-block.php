<?php 
    if ( ! function_exists('paprika_render_artist_block') ) {
    function paprika_render_artist_block($block) {
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
        $post = get_post($postObject->post);
        $thumbnail = get_the_post_thumbnail($post->ID);
    
        ob_start();
        ?>
        <div>
            <h2><?php echo $attributes->title ?></h2>
            <div class="flex">
                <div class="col-4">
                    <?php echo $thumbnail ?>
                </div>
                <div class="col-8">
                    <?php if (pg_is_valid('string', $post->post_title)): ?>
                        <h2><?php echo $post->post_title ?></h2>
                    <?php endif; ?>
                    <?php if (pg_is_valid('string', $post->post_content)): ?>
                        <?php echo wpautop($post->post_content); ?>
                    <?php endif; ?>
                </div>
            </div>

        </div>
        <?php
            return ob_get_clean();
    }
}