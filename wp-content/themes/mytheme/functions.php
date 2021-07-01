<?php
/**
 * My Theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package My_Theme
 */

function pioneer_scripts() {
  wp_enqueue_style( 'pioneer-style', get_template_directory_uri() . '/style.css', array(), '1.0.0', 'all' );

  wp_enqueue_script( 'jquery-3.5.1', 'https://code.jquery.com/jquery-3.5.1.min.js', array(), '1.0.0', true );
  wp_enqueue_script( 'customjs', get_template_directory_uri() . '/js/script.js', array('jquery-3.5.1'), '1.0.0', true );
}
add_action( 'wp_enqueue_scripts', 'pioneer_scripts' );

function pioneer_setup() {
  load_theme_textdomain( 'pioneer' );
  /* Add menu support */
  add_theme_support('menus');
  /* Add excerpt for pages */
  add_post_type_support( 'page', 'excerpt' );
  /* Add excerpt for resources */
  add_post_type_support( 'macd-resource', 'excerpt' );
  /* Add default posts and comments RSS feed links to head. */
  add_theme_support( 'automatic-feed-links' );
  add_theme_support( 'title-tag' );
  /* Enable support for Post Thumbnails on posts and pages. */
  add_theme_support( 'post-thumbnails' );
  add_theme_support('html5', array('search-form'));
  /* Add theme support for Custom Logo. */
  add_theme_support( 'custom-logo', array(
    'width'       => 500,
    'height'      => 500,
    'flex-height' => true,
    'flex-width'  => true,
  ) );
  // register menus
  register_nav_menus( array(
    'primary' => esc_html__( 'Primary Navigation', 'pioneer' ),
  ) );
}
add_action( 'after_setup_theme', 'pioneer_setup' );

/* Disable content editor for CPT */
function remove_default_content_editor() {
  remove_post_type_support( 'macd-resource', 'editor' );
}
add_action('admin_init', 'remove_default_content_editor');

/* Action for upload SVG file */
function cc_mime_types($mimes) {
  $mimes['svg'] = 'image/svg+xml';
  return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');

add_filter('use_block_editor_for_post', '__return_false');

//Register nav menus
function pioneer_menus() {
  $locations = array(
    'primary' => "Primary Menus",
    'footer' => "Footer Menu Items"
  );

  register_nav_menus($locations);
}
add_action('init', 'pioneer_menus');