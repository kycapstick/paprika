<?php 
    if ( ! function_exists('paprika_render_news') ) {
    function paprika_render_news($block) {
        $fields = array( 
            'title', 
        );
        $postFields = array(
            'post',
        );
        foreach ($block['innerBlocks'] as $innerBlock):
            switch( $innerBlock['blockName'] ) {

                case 'paprika/news-select':
                    $postObject = pg_get_attributes($innerBlock, $postFields);
                break;
            }
        endforeach;
        $attributes = pg_get_attributes($block, $fields);
        if (isset($postObject)) {
            $post = get_post($postObject->post);
            $thumbnail = get_the_post_thumbnail($post->ID);
        }
    
        ob_start();
        ?>
        <div>
            <p><?php echo $attributes->title ?></p>
            <div>  
                <h2><?php echo (isset($post) ? $post->post_title : null ) ?></h2>
                <?php echo (isset($post) ? wpautop( $post->post_content) : null ) ?>
            </div>

        </div>
        <?php
            return ob_get_clean();
    }
}