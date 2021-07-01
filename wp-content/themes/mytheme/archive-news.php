<?php 
/**
 *
 * Template Name:News
 *
 * @package WordPress
 * @subpackage macd
 * @since 1.0
 * @version 1.0
 */

get_header(); ?>

<div class="categories">
  <form class="js-filter-form">
    <select name="categories">
    <?php 
      $cat_args = array(
        'exclude' => array(1),
        'option_all' => 'All'
      );
      $categories = get_categories( $cat_args ); ?>
      <option>All</option>
      <?php foreach($categories as $cat) : ?>
        <option class="js-filter-item" value="<?= $cat->cat_ID ?>"><?= $cat->name ?></option>
      <?php endforeach; ?>
    </select>
  </form>
</div>

<article>
  <div class="js-filter blog-posts">
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
        // get_template_part('template-parts/content', 'select');
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
    // var total_posts = <?php //echo $total_posts; ?>;
    console.log(ppp);
</script>

<?php get_footer(); ?>