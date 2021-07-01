<?php
/**
 * The main template file
 * 
 * Template Name:Blog
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package My_Theme
 */

get_header();

$args = array(
    'post_type' => 'post',
    'posts_per_page' => 4,
    'post_status' => 'publish'
);
$the_query = new WP_Query( $args );
if ($the_query -> have_posts()) {
  while($the_query -> have_posts()) {
    $the_query -> the_post();
    get_template_part('template-parts/content', 'archive');
  }
}

get_footer(); ?>