<?php 

if ( ! defined( 'ABSPATH' ) ) {
	exit; 
}

add_theme_support( 'woocommerce' );

remove_theme_support( 'widgets-block-editor' );
add_filter('use_block_editor_for_post', '__return_false');

register_nav_menus( [
    'primary' => 'Menu Principal',
] );

function elementor_start_setup() {
	wp_enqueue_style( 'main', get_stylesheet_uri() );
}
add_action( 'after_setup_theme', 'elementor_start_setup' );

?>
