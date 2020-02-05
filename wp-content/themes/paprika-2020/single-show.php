<?php 
get_header();
?>
<main class="container">
<?php
if ( have_posts() ) : 
    while ( have_posts() ) : the_post(); 
        $meta = get_post_meta($post->ID);
        ?>
        <h1><?php the_title(); ?> </h1>
        <p>
            <?php 
                echo wpautop(the_content());
            ?>
        </p>
        <?php 
    endwhile; 
endif; 
?>
</main>
<?php
get_footer();
?>