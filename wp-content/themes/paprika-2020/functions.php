<?php 
  require_once( __DIR__ . '/includes/theme-scripts.php');

  require_once( __DIR__ . '/includes/utilities.php');

  require_once( __DIR__ . '/includes/custom-post-types.php');

  require_once( __DIR__ . '/includes/metaboxes/index.php');

  require_once( __DIR__ . '/includes/database/database.php');


function paprika_head_metadata() {

  ?>

    <meta name="google" content="notranslate" />

  <?php

}
add_action( 'wp_head', 'paprika_head_metadata' );



