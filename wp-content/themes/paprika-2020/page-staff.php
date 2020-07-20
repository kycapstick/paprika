<?php 
	get_header();
?>
	<main class="staff">
		<?php 
			$args = array(
				'post_type' => 'staff',
				'posts_per_page' => -1,
				"orderby" => 'meta_value_num',
				"meta_key" => 'order',
				"order" => 'ASC'
			);
			$staff_posts = new WP_Query($args);
			$color_classes = paprika_custom_colors();
			$count = 1;
			if ( $staff_posts->have_posts() ):
				while($staff_posts->have_posts()):
					$staff_posts->the_post();
					$name = get_post_meta($post->ID, 'name', true); 
					$email = get_post_meta($post->ID, 'email', true);
		?>
		<div class="staff__block <?php echo $color_classes ?>">
			<div class="container">
				<div class="flex">
					<?php 
						if ($count % 2 !== 0):
							if (has_post_thumbnail($post->ID)): ?>
								<div class="col-4 staff__photo__container staff__photo__container--mobile">
									<figure class="staff__photo">
										<?php echo get_the_post_thumbnail($post->ID) ?>
										<p class="staff__name card__title card__title--dark"><?php echo $name ?></p>
									</figure>
								</div>
							<?php endif; ?>
							<div class="<?php echo (has_post_thumbnail($post->ID) ? 'col-8' : "") ?>">
								<h2 class="page__header staff__title "><?php echo $post->post_title ?></h2>
								<a class="block-link programs" href="mailto:<?php echo $email ?>"><?php echo $email ?></a>
								<?php echo wpautop($post->post_content) ?>
							</div>
					<?php else: ?>
							<?php if (has_post_thumbnail($post->ID)): ?>
								<figure class="col-4 staff__photo__container--mobile">
									<div class="staff__photo staff__photo--reverse">
										<?php echo get_the_post_thumbnail($post->ID) ?>
										<p class="staff__name card__title card__title--dark staff__name--reverse"><?php echo $name ?></p>
									</div>
								</figure>
							<?php endif; ?>
							<div class="<?php echo (has_post_thumbnail($post->ID) ? 'col-8' : "") ?>">
								<h2 class="page__header staff__title "><?php echo $post->post_title ?></h2>
								<a class="block-link programs" href="mailto:<?php echo $email ?>"><?php echo $email ?></a>
								<?php echo wpautop($post->post_content) ?>
							</div>
							<?php if (has_post_thumbnail($post->ID)): ?>
								<figure class="col-4 staff__photo__container">
									<div class="staff__photo staff__photo--reverse">
										<?php echo get_the_post_thumbnail($post->ID) ?>
										<p class="staff__name card__title card__title--dark staff__name--reverse"><?php echo $name ?></p>
									</div>
								</figure>
							<?php endif; ?>
					<?php endif; ?>
				</div>
			</div>
		</div>
        <?php
			$count = $count + 1;
			endwhile;
		endif;
	?>
	</main>
<?php
	get_footer();
?>