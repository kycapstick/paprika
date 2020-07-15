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
        $news_class = paprika_custom_colors();

    
        ob_start();
        ?>
        <div class="news-block <?php echo $news_class ?>">
            <div class="container">
                <div class="news-block__subheader">
                    <p class="subheader"><?php echo $attributes->title ?></p>
                </div>
                <div>  
                    <h2 class="subtitle news-block__title"><?php echo (isset($post) ? $post->post_title : null ) ?></h2>
                    <?php 
                        $content = isset($post) ? strip_tags($post->post_content) : null;
                    ?>
                    <p class="news-block__copy copy">
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