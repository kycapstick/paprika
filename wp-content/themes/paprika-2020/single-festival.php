<?php 
get_header();
?> 
<main>
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
