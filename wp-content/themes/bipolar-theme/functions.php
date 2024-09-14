<?php

add_theme_support('woocommerce');

if (!defined('ABSPATH')) {
	exit;
}

function disable_block_editor_features()
{
	// Remove block editor
	remove_theme_support('widgets-block-editor');
	// Disable the block editor
	add_filter('use_block_editor_for_post', '__return_false');
}

add_action('init', 'disable_block_editor_features');

register_nav_menus([
	'primary' => 'Menu Principal',
]);

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