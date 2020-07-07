<?php 
get_header();
?>
<main class="container">
<?php
	if ( have_posts() ) : 
		while ( have_posts() ) : the_post(); 
			$festival_id = get_post_meta($post->ID, 'festival', true);
			$festival = get_post($festival_id);
			$program_id = get_post_meta($post->ID, 'program', true);
			$program = get_post($program_id);
		?>
			<p>
				<?php 
					echo the_content();
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