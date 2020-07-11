<?php 
    get_header();
    $author_name = get_the_author_meta('display_name', $post->post_author);
    $author_url = get_author_posts_url($post->post_author);
?>
<main class="single-post">
    <div class="container">
        <div class="container container--no-margin">
            <h1 class="subtitle single-post__title"><?php echo $post->post_title ?></h1>
            <p>Posted on <?php echo gmdate('F d, Y', strtotime( $post->post_date)); ?> by <a href="<?php echo $author_url; ?>"><?php echo $author_name ?></a></p>
        </div>
        <?php 
            $blocks = parse_blocks($post->post_content);
            foreach ($blocks as $block) {
                echo render_block($block);
        }
        ?>
    </div>
</main>
<?php 
    get_footer();
?>