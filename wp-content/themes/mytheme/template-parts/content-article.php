<div class="container">
    <header class="content-header">
        <div class="meta"><span class="date"><?php the_date(); ?></span>
    </header>
    <?php
    the_post_thumbnail('large');
    $post_content = get_field('post_content');?>
    <div class="post-content">
      <?php echo $post_content; ?>
    </div>
</div>