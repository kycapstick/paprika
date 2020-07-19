<?php 
get_header();
$color_class = paprika_custom_colors();
?>
<main <?php echo $color_class ?>>
<?php
if ( have_posts() ) : 
    while ( have_posts() ) : the_post(); 
        $meta = get_post_meta($post->ID);
        ?>
        <?php 
            echo the_content();
        ?>
        <?php 
    endwhile; 
endif; 
?>
</main>
<?php
get_footer();
?>