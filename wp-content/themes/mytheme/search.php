<?php
/* Template Name: Custom Search */
get_header(); 

if($_GET['search_text'] && !empty($_GET['search_text'])) {
  $text = $_GET['search_text'];
}
?>

<article>
  <div class="blog-posts">
  <?php
    $args = array(
      'post_type' => 'news',
      'posts_per_page' => -1,
      's' => $text
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
</article>

<?php get_footer(); ?>