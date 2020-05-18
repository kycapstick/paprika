<?php 

function paprika_head_metadata() {

  ?>

    <meta name="google" content="notranslate" />

  <?php

}
add_action( 'wp_head', 'paprika_head_metadata' );
