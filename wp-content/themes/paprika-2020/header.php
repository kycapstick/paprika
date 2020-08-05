<?php 
	wp_head();
	$hero_text = get_field('hero_text');
	$hero_text = stripos($hero_text, '\n' ) !== false ? explode('\n', $hero_text) : $hero_text;
	$hero_subtitle = get_field('hero_subtitle');
	$header_class = paprika_custom_colors();
	$subtitle_object = isset($post) ? get_post_meta($post->ID, 'subtitle', true) : array();
?>
<body <?php body_class()?> >
<?php $logo = get_custom_logo(); ?>
	<header class="header <?php echo $header_class ?>">
	<div class="header__nav__container">
		<div class="container">
			<nav class="header__nav">
				<div class="header__nav__logo">
					<?php echo $logo; ?>
				</div>
				<div class="header__nav__menu">
					<button class="header__trigger">
						<span class="header__trigger__bar"></span>
						<span class="header__trigger__bar"></span>
						<span class="header__trigger__bar"></span>
					</button>
					<div class="header-menu">
						<div class="container flex">
								<div class="col-6 menu__container">
									<?php 
										wp_nav_menu(array(
											'menu' => 'main',
										))
									?>
									<?php 
										$donations_url = get_option('donations'); 
										if (isset($donations_url) && strlen($donations_url) > 0): 
									?>
										<a class="btn btn--donations btn--dark" href="<?php echo $donations_url?>" class="btn">Donate</a>
									<?php endif; ?>
									
								</div>

						</div>
					</div>
				</div>
			</nav>
			</div>
		</div>
		<div class="header__hero">
			<div class="container">
				<?php if (!empty($hero_text)): ?>
					<h1 class="hero-text">
						<?php if (is_array($hero_text)): ?>
							<?php foreach($hero_text as $hero_string): ?>
								<?php echo $hero_string ?>
								</br>
							<?php endforeach ?>
						<?php else: ?>
							<?php echo $hero_text; ?>
						<?php endif; ?>
					</h1>
					<p class="copy--right">
						<?php echo $hero_subtitle ?>
					</p> 
					<?php else: ?>
						<div class="header__banner <?php echo is_single() && !is_singular('festival') && !is_singular('program') ? 'header__banner__single' : null ?>">
							<div class="header__banner__bar">
							</div>
							<div class="header__title">
								<?php 
									if (is_archive()):
								?>	
									<?php $archive_title = explode(': ', get_the_archive_title()) ?>
									<h1 class="header__text"><?php echo $archive_title[1]; ?></h1>
								<?php
									elseif (is_singular('festival') || is_singular('program') || !is_single() || is_404()): 
										$title = html_entity_decode(get_the_title(),ENT_QUOTES,'UTF-8');										if (is_singular('program')) {
											$title = preg_replace("/\b[0-9]{4}/", "", $title);
										}
										if (is_singular('festival')) {
											$title = 'Festival ' . $title;
										}
										if (is_404()) {
											$title = '404';
										}
								?>
									<h1 class="header__text"><?php echo esc_html($title); ?></h1>
								<?php endif; ?>
							</div>
						</div>
				<?php endif; ?>
				<?php if (!empty($subtitle_object) && (!empty($subtitle_object['subtitle']) || !empty($subtitle_object['subtitle_link'])) ): ?>
					<div class="header__subheader">
						<?php if (!empty($subtitle_object['subtitle']) ): ?>
							<p class="copy--bold breadcrumb">
								<?php echo $subtitle_object['subtitle'] ?>
							</p>
						<?php endif; ?>
						<?php if( !empty($subtitle_object['subtitle_link']) && !empty($subtitle_object['subtitle_text'])): ?>
							<a href="<?php echo $subtitle_object['subtitle_link'] ?>" class="btn btn--light">
								<?php echo $subtitle_object['subtitle_text'] ?>
							</a>
						<?php endif; ?>
					</div>
				<?php endif ?>
				<?php if ((is_single() && !is_singular('festival')) || (is_page())): ?>
					<?php 
						global $post;
						$referer = wp_get_referer(); 
						if (is_singular('show')) {
							$reference_id = get_post_meta($post->ID, 'program', true);
							$referer = get_post_permalink($reference_id);
							$post_title = html_entity_decode(get_the_title($reference_id),ENT_QUOTES,'UTF-8');
						} elseif (is_singular('program')) {
							$reference_id = get_post_meta($post->ID, 'festival', true);
							$referer = get_post_permalink($reference_id);
							$post_title = html_entity_decode(get_the_title($reference_id),ENT_QUOTES,'UTF-8');
							$post_title = 'Festival ' . $post_title;
						} elseif (is_page()) {
							if ($post->post_parent) {
								$referer = get_post_permalink($post->post_parent);
								$post_title = get_the_title($post->post_parent);
							}							
						} elseif (pg_is_valid('string', $referer)) {
							$reference_id = url_to_postid($referer);
							$post_title = html_entity_decode(get_the_title($reference_id),ENT_QUOTES,'UTF-8');
							$post_type = get_post_type($reference_id);
							if ($post_title === $post->post_title) {
								$post_title = 'Archives';
							}
						} 
						?>
						<?php if (pg_is_valid('url', $referer) && isset($post_title) && pg_is_valid('string', $post_title)):?>
							<div class="header__subhero">
								<a class="breadcrumb header__link" href="<?php echo $referer ?>">
									Back to <?php echo $post_type === 'festival' ? 'Festival ' . $post_title : $post_title ?> 
								</a>
							</div>
						<?php endif; ?>
				<?php endif;?>
			</div>
		</div>
    </header>