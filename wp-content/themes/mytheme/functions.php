<?php
/**
 * My Theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package My_Theme
 */

function test_scripts() {
  wp_enqueue_style( 'test-style', get_template_directory_uri() . '/style.css', array(), '1.0.0', 'all' );
  wp_enqueue_script( 'jquery-3.5.1', 'https://code.jquery.com/jquery-3.5.1.min.js', array(), '1.0.0', true );
  wp_enqueue_script( 'customjs', get_template_directory_uri() . '/js/script.js', array('jquery-3.5.1'), '1.0.0', true );

  // Register the AJAX script
  wp_enqueue_script( 'custom-script', get_stylesheet_directory_uri(). '/js/loadMore.js', array('jquery'), false, true );
 
  // Localize the script with new data
  $script_data_array = array(
    'ajaxurl' => admin_url( '/admin-ajax.php' ),
    'security' => wp_create_nonce( 'load_more_posts' ),
  );
  wp_localize_script( 'custom-script', 'blog', $script_data_array );
  wp_localize_script( 'custom-customjs', 'blog', $script_data_array );

  // Enqueued script with localized data.
  // wp_enqueue_script( 'custom-script' );
}
add_action( 'wp_enqueue_scripts', 'test_scripts' );

function test_setup() {
  load_theme_textdomain( 'test' );
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
    'primary' => esc_html__( 'Primary Navigation', 'test' ),
  ) );
}
add_action( 'after_setup_theme', 'test_setup' );

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
function test_menus() {
  $locations = array(
    'primary' => "Primary Menus",
    'footer' => "Footer Menu Items"
  );

  register_nav_menus($locations);
}
add_action('init', 'test_menus');

// Custom Post Type (News)
function create_custom_post_type() {
  $supports = array(
    'title', // post title
    'editor', // post content
    'author', // post author
    'thumbnail', // featured images
    'excerpt', // post excerpt
    'custom-fields', // custom fields
    'comments', // post comments
    'revisions', // post revisions
    'post-formats', // post formats
    'page-attributes' // page attributes 
  );

  $labels = array(
    'name' => _x('News', 'plural'),
    'singular_name' => _x('News', 'singular'),
    'menu_name' => _x('News', 'admin menu'),
    'name_admin_bar' => _x('News', 'admin bar'),
    'add_new' => _x('Add New', 'add new'),
    'add_new_item' => __('Add New news'),
    'new_item' => __('New news'),
    'edit_item' => __('Edit news'),
    'view_item' => __('View news'),
    'all_items' => __('All news'),
    'search_items' => __('Search news'),
    'not_found' => __('No news found.'),
  );

  $args = array(
    'labels' => $labels,
    'supports' => $supports,
    'public' => true,
    'taxonomies' => array( 'category', 'post_tag' ),
    'show_ui' => true,
    'show_in_menu' => true,
    'show_in_nav_menus' => true,
    'show_in_admin_bar' => true,
    'can_export' => true,
    'capability_type' => 'post',
    'show_in_rest' => true,
    'query_var' => true,
    'rewrite' => array('slug' => 'news'),
    'has_archive' => true,
    'hierarchical' => true,
    'menu_position' => 6,
    'menu_icon' => 'dashicons-megaphone',
  );

  register_post_type('news', $args);
}
add_action('init', 'create_custom_post_type');

//Excerpt Length
function custom_excerpt_length($length) {
  $length = 50;
  return $length;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

//filter post by category Fn
function filter_posts_by_ajax_callback() {
  $category = $_POST['category'];
  echo $category;
  $args = array(
    'post_type' => 'news',
    'posts_per_page' => 6
  );

  if(isset($category)) {
    $args['category__in'] = array($category);
  }

  $the_query = new WP_Query( $args );
  if ($the_query -> have_posts()) {
    while($the_query -> have_posts()) {
      $the_query -> the_post(); 
      get_template_part('template-parts/content', 'archive');
    }
  } 
  wp_reset_postdata();
  wp_die();
}
add_action('wp_ajax_filter_posts_by_ajax', 'filter_posts_by_ajax_callback');
add_action('wp_ajax_nopriv_filter_posts_by_ajax', 'filter_posts_by_ajax_callback');

//Load More Fn
function load_posts_by_ajax_callback() {
  check_ajax_referer('load_more_posts', 'security');

  $posts_per_page = (isset($_POST["posts_per_page"])) ? $_POST["posts_per_page"] : 1;
  $paged = (isset($_POST["page"])) ? $_POST['page'] : 2;

  $args = array(
      'post_type' => 'news',
      'post_status' => 'publish',
      'posts_per_page' => $posts_per_page,
      'paged' => $paged,
  );
  $query = new WP_Query( $args );
  ?>

  <?php if ( $query->have_posts() ) : ?>
      <?php while ( $query->have_posts() ) : $query->the_post(); ?>
          <?php get_template_part('template-parts/content', 'archive'); ?>
      <?php endwhile; ?>
      <?php
  endif;

  wp_die();
}
add_action('wp_ajax_load_posts_by_ajax', 'load_posts_by_ajax_callback');
add_action('wp_ajax_nopriv_load_posts_by_ajax', 'load_posts_by_ajax_callback');
