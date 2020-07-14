<?php 
    get_header();
?>

<div class="container festivals">
        <div class="flex">
            <main class="col-9">
            <?php
                foreach($posts as $post):
                    $programs = get_post_meta($post->ID, 'programs', true);
                    $dates = get_post_meta($post->ID, 'dates', true);
                    $shows = paprika_get_shows_by_dates($dates);
            ?>
                    <div class="festivals__content">
                        <div class="continer">
                            <div class="flex festivals__articles">
                                <div class="col-3 festivals__card">
                                    <div class="festivals__card__wrapper">
                                        <a href="<?php echo get_permalink($post->ID); ?>" class="festivals__card__link">
                                            <h2 class="festivals__card__title"><?php echo get_the_title($post->ID) ?></h2>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-9 festivals__contents">
                                    <?php if (!empty($programs) ): ?>
                                        <h3>Programs</h3>
                                        <ul class="flex festivals__list">
                                            <?php foreach($programs as $program): ?>
                                                <li class="col-4">
                                                    <?php 
                                                        $title = get_the_title($program);
                                                        $title = preg_replace("/\b[0-9]{4}/", "", $title)
                                                    ?>
                                                    <a class="festivals__link" href="<?php echo get_post_permalink($program)?>"><?php echo $title; ?></a>
                                                </li>
                                            <?php endforeach; ?>
                                        </ul>
                                    <?php endif; ?>
                                    <?php if (!empty($shows) ): ?>
                                        <h3>Shows</h3>
                                        <ul class="flex festivals__list">
                                            <?php foreach($shows as $show_id=>$show): ?>
                                                <li class="col-4">
                                                    <a class="festivals__link" href="<?php echo get_post_permalink($show_id)?>"><?php echo get_the_title($show_id); ?></a>
                                                </li>
                                            <?php endforeach; ?>
                                        </ul>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach;?>
            </main>
            <aside class="festival__aside col-3">
                <div>
                    <h3 class="card__header">Quick Links</h3>
                    <ul class="festivals__archive">
                        <?php foreach($posts as $post): ?>
                            <li class="archive__item">
                                <a class="archive__link"href="<?php echo get_post_permalink($post->ID); ?>"><?php echo get_the_title($post->ID); ?></a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </aside>
        </div>
    </div>

<?php 
    get_footer();
?>