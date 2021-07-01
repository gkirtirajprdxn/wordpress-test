<?php 
/**
* The main template file For Homepage
*
* Template Name:Home
*
* @package WordPress
* @subpackage macd
* @since 1.0
* @version 1.0
*/

get_header();

if (have_posts()) {
  while(have_posts()) {

    the_post();

  }
} 

get_footer(); ?>
