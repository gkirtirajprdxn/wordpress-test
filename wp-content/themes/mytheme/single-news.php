<?php
get_header();
?>
    
  <article class="content">
  <?php 
  if (have_posts()) {
    while (have_posts()) {
      the_post();
      get_template_part('template-parts/content', 'article');
    }
  }
  ?>
  </article>

  <div class="random-posts">
    <h2>Random Posts</h2>
    <?php
      $args = array(
          'post_type' => 'news',
          'post_status' => 'publish',
          'orderby' => 'rand',
          'post__not_in' => array(get_the_ID()),
          'posts_per_page' => 3
      );
      $query = new WP_Query( $args );
      if ( $query->have_posts() ) :
        while ( $query->have_posts() ) : $query->the_post();
          get_template_part('template-parts/content', 'archive');
        endwhile;
      endif; ?>
  </div>
	    
<?php
get_footer();
?>



