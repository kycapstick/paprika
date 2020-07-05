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
        <div class="news-block">
            <div class="container">
                <div class="news-block__subheader">
                    <svg class="news-block__marker" width="42" height="17" viewBox="0 0 92 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M11 0H92L83 17H0L11 0Z" fill="#A74482" fill-opacity="0.6"/>
                    </svg>
                    <p class="subheader"><?php echo $attributes->title ?></p>
                </div>
                <div>  
                    <h2 class="subtitle"><?php echo (isset($post) ? $post->post_title : null ) ?></h2>
                    <?php 
                        $content = isset($post) ? strip_tags($post->post_content) : null;
                    ?>
                    <p class="copy">
                        <?php
                            echo (isset($content) ? substr( $content, 0, 250) : null ); 
                        ?>
                    </p>
                    <a href="<?php echo get_post_permalink($post->ID, true) ?>" class="btn">Learn More</a>
                </div>
            </div>
        </div>
        <?php
            return ob_get_clean();
    }
}