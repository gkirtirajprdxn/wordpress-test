<?php 
/**
 *
 * Template Name:News
 * 
 *
 * @package WordPress
 * @subpackage macd
 * @since 1.0
 * @version 1.0
 */

get_header(); 

get_template_part('template-parts/content', 'select'); ?>

<article id="article">
  <div class="blog-posts">
  <?php
    $args = array(
      'post_type' => 'news',
      'posts_per_page' => 6,
      'paged' => 1,
    );
    $query = new WP_Query( $args );
    if ($query -> have_posts()) {
      while($query -> have_posts()) {
        $query -> the_post();
        get_template_part('template-parts/content', 'archive');
      }
    } 
    wp_reset_query(); ?>
    <input type="hidden" id="totalpages" value="<?= $query->max_num_pages; ?>">
  </div>
  <?php if($query->max_num_pages > 1) { ?>
  <button id="more_posts" class="loadmore">Load More</button>
  <div class="no-posts-msg">
      <h4>No Posts to Load!</h4>
  </div>
  <?php } ?>
</article>

<?php get_footer(); ?>