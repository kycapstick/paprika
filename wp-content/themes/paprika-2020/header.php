<?php 
	wp_head();
?>
<body <?php body_class()?> >
    <header class="header">
		<div class="container">
			<nav class="header__nav">
				<div class="header__nav__logo">
					<a href="#">
						Logo
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
		</div>
    </header>