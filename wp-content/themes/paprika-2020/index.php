<?php 
get_header();
?>
<main>
<?php
if ( have_posts() ) : 
    while ( have_posts() ) : the_post(); 
        $meta = get_post_meta($post->ID);
        ?>
        <h1><?php the_title(); ?> </h1>
        <?php 
        var_dump($meta);
    endwhile; 
endif; 
?>
</main>
<?php
get_footer();
?>