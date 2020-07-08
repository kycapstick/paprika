<?php 
	wp_head();
	$hero_text = get_field('hero_text');
	$hero_text = stripos($hero_text, '\n' ) !== false ? explode('\n', $hero_text) : null;
    $hero_subtitle = get_field('hero_subtitle');
?>
<body <?php body_class()?> >
<?php $logo = get_custom_logo(); ?>
    <header class="header">
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
						<div class="page__banner">
							<h1 class="hero-text"><?php echo get_the_title(); ?></h1>
						</div>
				<?php endif; ?>
			</div>
			<div class="header__subhero">
			</div>
		</div>
    </header>