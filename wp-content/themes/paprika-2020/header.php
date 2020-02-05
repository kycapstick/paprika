<?php 
  wp_head();
?>
  <body <?php body_class()?> >
    <header>
      <div class="container">
        <?php 
          wp_nav_menu(array(
            'menu' => 'main',
          ))
        ?>
      </div>
    </header>