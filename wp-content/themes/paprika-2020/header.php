<?php 
	wp_head();
	$hero_text = get_field('hero_text');
	$hero_text = stripos($hero_text, '\n' ) !== false ? explode('\n', $hero_text) : null;
	$hero_subtitle = get_field('hero_subtitle');
	$header_class = paprika_custom_colors();
?>
<body <?php body_class()?> >
<?php $logo = get_custom_logo(); ?>
    <header class="header <?php echo $header_class ?>">
		<div class="container">
			<nav class="header__nav">
				<div class="header__nav__logo">
					<a href="#">
						<?php echo $logo; ?>
					</a>
				</div>
				<div class="header__nav__menu">
					<?php 
						wp_nav_menu(array(
							'menu' => 'main',
						))
					?>
				</div>
			</nav>
			<div class="header__hero">
				<?php if (!empty($hero_text)): ?>
					<h1 class="hero-text">
						<?php foreach($hero_text as $hero_string): ?>
							<?php echo $hero_string ?>
							</br>
						<?php endforeach ?>
					</h1>
					<p>
						<?php echo $hero_subtitle ?>
					</p> 
					<?php else: ?>
						<div class="header__banner">
							<div class="header__banner__bar">
							</div>
							<div class="header__title">
								<?php 
									if (is_archive() ):
								?>	
									<?php $archive_title = explode(': ', get_the_archive_title()) ?>
									<h1 class="header__text"><?php echo $archive_title[1]; ?></h1>
								<?php
									elseif (!is_single()): 
								?>
									<h1 class="header__text"><?php echo is_singular('festival') ? 'Festival ' . get_the_title() : get_the_title(); ?></h1>
								<?php endif; ?>
							</div>
						</div>
				<?php endif; ?>
			</div>
			<?php if (is_single()): ?>
				<?php 
					global $post;
					$referer = wp_get_referer(); 
					if (pg_is_valid('string', $referer)) {
						$reference_id = url_to_postid($referer);
						$post_title = get_the_title($reference_id);
						if ($post_title === $post->post_title) {
							$post_title = 'Archives';
						}
					}
				?>
				<div class="header__subhero">
					<?php if (pg_is_valid('url', $referer) && isset($post_title) && pg_is_valid('string', $post_title)):?>
						<a class="breadcrumb header__link" href="<?php echo $referer ?>">Back to <?php echo $post_title
						?> </a>
					<?php endif; ?>
				</div>
			<?php endif;?>
		</div>
    </header>