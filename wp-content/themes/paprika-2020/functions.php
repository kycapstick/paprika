<?php 
  function add_theme_scripts() {
      wp_enqueue_style('main', get_template_directory_uri() . '/dist/main.css', array(), filemtime(get_template_directory() . '/dist/main.css'), false );
  }
  add_action( 'wp_enqueue_scripts', 'add_theme_scripts' );