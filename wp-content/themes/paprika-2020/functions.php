<?php 
  require_once( __DIR__ . '/includes/theme-scripts.php');

  require_once( __DIR__ . '/includes/utilities.php');

  require_once( __DIR__ . '/includes/custom-post-types.php');

  require_once( __DIR__ . '/includes/metaboxes/index.php');

  require_once( __DIR__ . '/includes/database/database.php');


add_action('admin_head', 'my_custom_fonts');

function my_custom_fonts() {
  echo '<style>
    .custom-input {
      display: block;
      width: 100%;
      margin: 10px 0;
    } 
    .custom-title {
      font-weight: bold;
      font-size: 1.2rem;
      margin: 10px 0;
      text-align: center;
    }
  </style>';
}


function paprika_head_metadata() {

  ?>

    <meta name="google" content="notranslate" />

  <?php

}
add_action( 'wp_head', 'paprika_head_metadata' );



