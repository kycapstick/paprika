<?php 

if (!function_exists('paprika_custom_post_types')):
  function paprika_custom_post_types() {
    register_post_type('festival',
      array(
        'labels' => array(
          'name' => __('Festivals'),
          'singular_name' => __('Festival')
        ),
        'public' => true,
        'has_archive' => true,
        'menu_icon' => 'dashicons-tickets-alt',
        'supports'	=> array( 'thumbnail' , 'excerpt', 'title', 'editor'),
        'capability_type' => 'post',
        'show_in_rest' => true,
      )
    );
    register_post_type('program',
      array(
        'labels' => array(
          'name' => __('Programs'),
          'singular_name' => __('Program')
        ),
        'public' => true,
        'has_archive' => true,
        'menu_icon' => 'dashicons-admin-customizer',
        'supports'	=> array( 'thumbnail' , 'excerpt', 'title', 'editor'),
        'capability_type' => 'post',
        'taxonomies' => array('category'),
        'register_meta_box_cb' => 'paprika_program_metabox',
        'show_in_rest' => true,
      )
    );
    register_post_type('staff',
      array(
        'labels' => array(
          'name' => __('Staff'),
          'singular_name' => __('Staff')
        ),
        'public' => true,
        'has_archive' => false,
        'menu_icon' => 'dashicons-admin-users',
        'supports'	=> array( 'thumbnail' , 'excerpt', 'title', 'editor'),
        'capability_type' => 'post',
        'taxonomies' => array('category'),
        'register_meta_box_cb' => 'paprika_staff_metabox',
        'show_in_rest' => true,
      )
    );
    register_post_type('artist',
      array(
        'labels' => array(
          'name' => __('Artist'),
          'singular_name' => __('Artist')
        ),
        'public' => true,
        'has_archive' => false,
        'menu_icon' => 'dashicons-groups',
        'supports'	=> array( 'thumbnail', 'excerpt', 'title', 'editor'),
        'capability_type' => 'post',
        'taxonomies' => array('category'),
        'register_meta_box_cb' => 'paprika_artist_metabox',
        'show_in_rest' => true,
      )
    );
  }
  add_action('init', 'paprika_custom_post_types');
endif;