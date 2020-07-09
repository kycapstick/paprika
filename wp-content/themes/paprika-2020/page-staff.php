<?php 
  get_header();
?>
	<main class="container">
		<?php 
			$args = array(
				'post_type' => 'staff',
				'posts_per_page' => -1,
				"orderby" => 'meta_value_num',
				"meta_key" => 'order',
				"order" => 'ASC'
			);
			$staff_posts = new WP_Query($args);
			if ( $staff_posts->have_posts() ):
				while($staff_posts->have_posts()):
					$staff_posts->the_post();
					$name = get_post_meta($post->ID, 'name', true); 
					$email = get_post_meta($post->ID, 'email', true);
		?>
		<div class="flex middle">
			<?php if (has_post_thumbnail($post->ID)): ?>
					<figure class="col-4">
						<?php echo get_the_post_thumbnail($post->ID) ?>
						<p></p>
					</figure>
            <?php endif; ?>
			<div class="<?php echo (has_post_thumbnail($post->ID) ? 'col-8' : "") ?>">
				<p class="staff__title"><?php echo $post->post_title ?></p>
				<a class="block-link" href="mailto:<?php echo $email ?>"><?php echo $email ?></a>

				<?php echo wpautop($post->post_content) ?>
			</div>
		</div>
        <?php
			endwhile;
		endif;
	?>
	</main>
<?php
	get_footer();
?>