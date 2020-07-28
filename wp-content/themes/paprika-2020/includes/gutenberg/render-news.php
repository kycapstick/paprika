<?php 
    if ( ! function_exists('paprika_render_news') ) {
    function paprika_render_news($block) {
        global $post;
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
            $post_object = get_post($postObject->post);
            $thumbnail = get_the_post_thumbnail($post_object->ID);
        }
        $news_class = paprika_custom_colors();

    
        ob_start();
        ?>
            <?php if  (intval($post_object->ID) !== intval($post->ID)): ?>
                <div class="news-block <?php echo $news_class ?>">
                    <div class="container">
                        <div class="news-block__subheader">
                            <svg width="16" height="20" viewBox="0 0 16 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M1 3C1 2.46957 1.21071 1.96086 1.58579 1.58579C1.96086 1.21071 2.46957 1 3 1H13C13.5304 1 14.0391 1.21071 14.4142 1.58579C14.7893 1.96086 15 2.46957 15 3V19L8 15.5L1 19V3Z" stroke="#ED007E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            <p class="copy"><?php echo $attributes->title ?></p>
                        </div>
                        <div> 
                            <h2 class="subtitle news-block__title"><?php echo (isset($post_object) ? $post_object->post_title : null ) ?></h2>
                            <?php 
                                if (has_blocks($post_object->post_content)) {
                                    $blocks = parse_blocks($post_object->post_content);
                                    foreach($blocks as $block) {
                                        if ( $block['blockName'] === 'core/paragraph' ) {
                                            $content = strip_tags($block['innerHTML']);
                                            break;
                                        }
                                    }
                                } else {
                                    $content = isset($post_object) ? strip_tags($post_object->post_content) : null;
                                }
                            ?>
                            <p class="news-block__copy copy">
                                <?php
                                    echo (isset($content) ? $content : null ); 
                                ?>
                            </p>
                            <a href="<?php echo get_post_permalink($post_object->ID, true) ?>" class="btn btn--light">Learn More</a>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        <?php
            return ob_get_clean();
    }
}