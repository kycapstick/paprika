<?php 
get_header();
$color_class = paprika_custom_colors();
?>
<main class="page-404 <?php echo $color_class ?>">
    <div class="container">
        <h2>Page Not Found</h2>
        <p>Looks like we couldn't find that page for you.</p>
        <div>
            <a class="btn btn--dark" href="<?php echo get_home_url() ?>">Go Home</a>
        </div>
    </div>
    </main>
<?php
get_footer();
?>