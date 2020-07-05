<?php 
    get_header();
    $hero_text = get_field('hero_text');
    $hero_text = explode('\n', $hero_text);
    $hero_subtitle = get_field('hero_subtitle');
?>
<div class="homepage">
    <?php 
        if ( have_posts() ) :
            /* Start the Loop */
            while ( have_posts() ) :
                the_post();
                the_content();
            endwhile;
        endif;
    ?>
</div>
<?php 
    get_footer();
?>