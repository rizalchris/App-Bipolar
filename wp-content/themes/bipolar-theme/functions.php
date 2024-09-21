<?php

add_theme_support('woocommerce');

if (!defined('ABSPATH')) {
	exit;
}

//Disable Block Editor
function disable_block_editor()
{
	// Remove block editor
	remove_theme_support('widgets-block-editor');
	// Disable the block editor
	add_filter('use_block_editor_for_post', '__return_false');
}

add_action('init', 'disable_block_editor');

register_nav_menus([
	'primary' => 'Main Menu',
]);

//Global Styles
function theme_enqueue_styles()
{
	wp_enqueue_style('main', get_stylesheet_uri());
}

add_action('wp_enqueue_scripts', 'theme_enqueue_styles');

function disable_wp_emojis()
{
	// Remove the emoji script from the front-end
	remove_action('wp_head', 'print_emoji_detection_script', 7);
	remove_action('wp_print_styles', 'print_emoji_styles');


	add_action('admin_init', function () {
		remove_action('wp_head', 'print_emoji_detection_script', 7);
		remove_action('wp_print_styles', 'print_emoji_styles');
	});
}

add_action('init', 'disable_wp_emojis');

//ACF JSON
function my_acf_json_save_point( $path ) {
    $path = get_stylesheet_directory() . '/acf-json';
    return $path;
}
add_filter( 'acf/settings/save_json', 'my_acf_json_save_point' );

// Load ACF field groups from JSON
function my_acf_json_load_point( $paths ) {
    unset($paths[0]);

    $paths[] = get_stylesheet_directory() . '/acf-json';

    return $paths;
}
add_filter( 'acf/settings/load_json', 'my_acf_json_load_point' );

// Minify HTML output
function my_minify_html($buffer) {
    $buffer = preg_replace('/<!--(?!\[if)(?!<!)(?!>)(.*?)-->/s', '', $buffer);
    $buffer = preg_replace('/>\s+</', '><', $buffer);
    $buffer = trim($buffer);
    $buffer = preg_replace('/\s+/', ' ', $buffer);

    return $buffer;
}

function my_start_buffer() {
    ob_start('my_minify_html');
}
add_action('template_redirect', 'my_start_buffer');
