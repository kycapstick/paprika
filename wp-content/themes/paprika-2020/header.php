<?php 
	wp_head();
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
				<h1><?php echo the_title(); ?></h1>
			</div>
			<div class="header__subhero">
			</div>
		</div>
    </header>