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

// echo "Home Page";

get_template_part('template-parts/content', 'archive');

get_footer(); ?>
