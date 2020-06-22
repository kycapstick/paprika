<?php 
    get_header();
    $hero_text = get_field('hero_text');
    $hero_text = explode('\n', $hero_text);
    $hero_subtitle = get_field('hero_subtitle');
?>
<div class="homepage">
    <div class="homepage__hero container">
        <h1 class="hero-text">
            <?php foreach($hero_text as $hero_string): ?>
                <?php echo $hero_string ?>
                </br>
            <?php endforeach ?>
        </h1>
        <p>
            <?php echo $hero_subtitle ?>
        </p> 
    </div>
    <div class="container">
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
</div>
<?php 
    get_footer();
?>