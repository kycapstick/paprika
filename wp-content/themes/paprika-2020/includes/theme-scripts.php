<?php 
	if (!function_exists('add_theme_scripts')):
		function add_theme_scripts() {
			wp_enqueue_style('main', get_template_directory_uri() . '/dist/main.css', array());
			wp_enqueue_script('main_scripts', get_template_directory_uri() . '/dist/main.js', array('jquery'), true);
		}
	endif;

	add_action( 'wp_enqueue_scripts', 'add_theme_scripts' );

	if (!function_exists('paprika_add_admin_scripts')):
		function paprika_add_admin_scripts() {
			wp_enqueue_style('admin', get_template_directory_uri() . '/dist/admin.css', array());
			wp_register_script('admin_scripts', get_template_directory_uri() . '/dist/admin.js', array('jquery'), true);
			wp_localize_script( 'admin_scripts', 'myAjax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' )));
			wp_enqueue_script('jquery');
			wp_enqueue_script('admin_scripts');
		}
	endif;

	add_action( 'admin_enqueue_scripts', 'paprika_add_admin_scripts' );

	function paprika_theme_setup() {
		add_theme_support( 'align-wide' );
	}
	add_action( 'after_setup_theme', 'paprika_theme_setup' );
