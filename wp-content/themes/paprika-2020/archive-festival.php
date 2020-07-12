<?php 
    get_header();
?>

<div class="container">
        <div class="flex">
            <main class="col-9 post__list">
            <?php
                foreach($posts as $post):
                if (intval($post->ID) === 439) {
                    continue;
                }
                $author_name = get_the_author_meta('display_name', $post->post_author);
                $author_url = get_author_posts_url($post->post_author);
            ?>
                    <div class="post__content">
                        <div class="continer">
                            <article class="post__card">
                                <h2 class="post__card__title"><?php echo get_the_title($post->ID) ?></h2>
                                <p class="post__card__byline copy--light">Posted on <?php echo gmdate('F d, Y', strtotime( $post->post_date)); ?> by <a href="<?php echo $author_url; ?>"><?php echo $author_name ?></a></p>
                                <?php
                                    $content = $post->post_content;
                                    if (has_blocks($content)):
                                        $blocks = parse_blocks($content);
                                        $content = '';
                                        foreach($blocks as $block) {
                                            if ($block['blockName'] === 'core/paragraph') {
                                                $content = $block['innerHTML'];
                                                break;
                                            }
                                        }
                                    endif; 
                                    echo wp_kses_post( wpautop( wp_strip_all_tags( $content ) ) );
                                ?>
                                <div class="post__button">
                                    <a href="<?php echo get_permalink($post->ID); ?>" class="post__link btn btn--dark btn--no-brdr">Read More</a>
                                </div>
                            </article> 
                        </div>
                    </div>
                    <?php endforeach;?>
                    <div class="pagination__links">
                        <div class="container">
                            <?php 
                                next_posts_link( 'Older Entries' );
                                previous_posts_link( 'Next Entries &raquo;' ); 
                                ?>
                        </div>
                    </div>
            </main>
        </div>
    </div>

<?php 
    get_footer();
?>