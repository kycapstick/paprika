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
        'supports'	=> array( 'thumbnail', 'title', 'editor'),
        'register_meta_box_cb' => 'paprika_festival_metabox',
        'capability_type' => 'post',
        'show_in_rest' => true,
      )
    );
    register_post_type('location',
      array(
        'labels' => array(
          'name' => __('Locations'),
          'singular_name' => __('Location')
        ),
        'public' => true,
        'has_archive' => false,
        'menu_icon' => 'dashicons-admin-home',
        'supports'	=> array( 'thumbnail', 'title', 'editor'),
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
        'supports'	=> array( 'thumbnail', 'title', 'editor'),
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
        'supports'	=> array( 'thumbnail', 'title', 'editor'),
        'capability_type' => 'post',
        'taxonomies' => array('category'),
        'register_meta_box_cb' => 'paprika_artist_metabox',
        'show_in_rest' => true,
      )
    );
    register_post_type('show',
      array(
        'labels' => array(
          'name' => __('Shows'),
          'singular_name' => __('Show')
        ),
        'public' => true,
        'has_archive' => true,
        'menu_icon' => 'dashicons-tickets-alt',
        'supports'	=> array( 'thumbnail', 'title', 'editor'),
        'register_meta_box_cb' => 'paprika_show_metabox',
        'capability_type' => 'post',
        'show_in_rest' => true,
      )
    );
    register_post_type('date',
      array(
        'labels' => array(
          'name' => __('Dates'),
          'singular_name' => __('Date')
        ),
        'public' => true,
        'menu_icon' => 'dashicons-calendar-alt',
        'supports'	=> array( 'thumbnail', 'title', 'editor'),
        'register_meta_box_cb' => 'paprika_date_metabox',
        'capability_type' => 'post',
        'show_in_rest' => true,
      )
    );
  }
  add_theme_support( 'post-thumbnails' );
  add_action('init', 'paprika_custom_post_types');
endif;