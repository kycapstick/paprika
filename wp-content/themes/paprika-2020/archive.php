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
            ?>
                    <div class="post__content">
                        <div class="continer">
                            <a href="<?php echo get_permalink($post->ID); ?>" class="post__link">
                                <article class="post__card">
                                    <h2><?php echo get_the_title($post->ID) ?></h2>
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
                                        echo wpautop( $content );
                                    ?>
                                    <div class="post__button">
                                        <button class="btn btn--dark btn--no-brdr">Read More</button>
                                    </div>
                                </article> 
                            </a>
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
            <aside class="post__aside col-3">
                <div>
                <h3 class="card__header">Recent Posts</h3>
                <?php 
                    $recent_args = array('numberposts' => 5);
                    $recent_posts = get_posts($recent_args);
                    if (!empty($recent_posts)):
                        ?>
                        <ul>
                            <?php foreach($recent_posts as $recent_post): ?>
                                <li>
                                    <a class="post__recent__link" href="<?php echo get_the_permalink($recent_post->ID) ?>"><?php echo $recent_post->post_title ?></a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                </div>
                <div>
                    <h3 class="card__header">Archives</h3>
                    <ul class="post__archive">
                        <?php
                            wp_get_archives('type=yearly');
                        ?>
                    </ul>
                </div>
            </aside>
        </div>
    </div>

<?php 
    get_footer();
?>