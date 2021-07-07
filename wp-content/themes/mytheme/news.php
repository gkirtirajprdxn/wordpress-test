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

<article>
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
  </div>

  <input type="hidden" id="totalpages" value="<?= $query->max_num_pages ?>">
  <button id="more_posts" class="loadmore">Load More</button>
  <div class="no-posts-msg">
      <h4>No Posts to Load!</h4>
  </div>
</article>


<script>
    // ppp : posts_per_page
    var ppp = <?php echo json_encode($args['posts_per_page']); ?>;
    var totalPages = <?php echo json_encode($query->max_num_pages) ?>;
    // console.log(totalPages);
</script>

<?php get_footer(); ?>