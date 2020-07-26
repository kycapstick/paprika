<?php 
    get_header();
    $color_classes = paprika_custom_colors();
?>

<?php 
    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

    $args = array( 'posts_per_page' => 10, 'paged' => $paged,'post_type' => 'post' );
    $postslist = new WP_Query( $args );
    ?>
    <div class="container <?php echo $color_classes ?>">
        <div class="post__aside post__aside--mobile">
                <div>
                <h3 class="card__header">Recent Posts</h3>
                <?php 
                    $recent_args = array('numberposts' => 5);
                    $recent_posts = get_posts($recent_args);
                    if (!empty($recent_posts)):
                        ?>
                        <ul class="post__recent">
                            <?php foreach($recent_posts as $recent_post): ?>
                                <li class="archive__item">
                                    <a class="archive__link post__recent__link" href="<?php echo get_the_permalink($recent_post->ID) ?>"><?php echo $recent_post->post_title ?></a>
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
        </div>
        <div class="flex">
            <main class="col-9 post__list">
            <?php
            if ( $postslist->have_posts() ) :
                while ( $postslist->have_posts() ) : $postslist->the_post(); 
                if (intval(get_the_id()) === 439) {
                    continue;
                }
                    $author_name = get_the_author_meta('display_name', $post->post_author);
                    $author_url = get_author_posts_url($post->post_author);
            ?>
                    <div class="post__content">
                        <div class="continer">
                            <article class="post__card">
                                <?php $title = html_entity_decode(get_the_title(),ENT_QUOTES,'UTF-8'); ?>
                                <h2 class="post__card__title"><?php echo esc_html($title); ?></h2>
                                    <div class="post__card__byline">
                                        <svg width="20" height="18" viewBox="0 0 20 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M17 17H3C2.46957 17 1.96086 16.7893 1.58579 16.4142C1.21071 16.0391 1 15.5304 1 15V3C1 2.46957 1.21071 1.96086 1.58579 1.58579C1.96086 1.21071 2.46957 1 3 1H13C13.5304 1 14.0391 1.21071 14.4142 1.58579C14.7893 1.96086 15 2.46957 15 3V4M17 17C16.4696 17 15.9609 16.7893 15.5858 16.4142C15.2107 16.0391 15 15.5304 15 15V4M17 17C17.5304 17 18.0391 16.7893 18.4142 16.4142C18.7893 16.0391 19 15.5304 19 15V6C19 5.46957 18.7893 4.96086 18.4142 4.58579C18.0391 4.21071 17.5304 4 17 4H15M11 1H7M5 13H11M5 5H11V9H5V5Z" stroke="#e69f5e" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                        <p class="copy--light">
                                            Posted on <?php echo gmdate('F d, Y', strtotime( $post->post_date)); ?> by <a href="<?php echo $author_url; ?>"><?php echo $author_name ?></a>
                                        </p>
                                    
                                    </div>
                                <?php
                                    $content = get_the_content();
                                    $content = paprika_parse_content($content); 
                                    echo wp_kses_post( wpautop( wp_strip_all_tags( $content ) ) );
                                ?> 
                                <div class="post__button">
                                    <a href="<?php echo get_permalink(); ?>" class="post__link btn btn--dark btn--no-brdr">
                                        Read More
                                    </a>
                                </div>
                            </article> 
                        </div>
                    </div>
                    <?php 
                    endwhile;
                    ?>
                    <div class="pagination__links">
                        <div class="container">
                            <?php 
                                next_posts_link( 'Older Entries', $postslist->max_num_pages );
                                previous_posts_link( 'Next Entries &raquo;' ); 
                                ?>
                        </div>
                        
                    </div>
                    <?php 
                    wp_reset_postdata();
                endif;
                ?>
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