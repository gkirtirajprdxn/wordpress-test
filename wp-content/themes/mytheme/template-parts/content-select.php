<!-- <h2><?php /*_e( 'Posts by Category', 'textdomain' ); ?></h2>
<form action="<?php echo esc_url(home_url('/')); ?>" method="get" id="category-select" class="category-select">
  <?php $args = array(
        'show_option_none' => __( 'Select category', 'textdomain' ),
        'show_count'       => 1,
        'orderby'          => 'name',
        'echo'             => 0,
    );

    $select  = wp_dropdown_categories( $args );
    $replace = "<select$1 onchange='return this.form.submit()'>";
    $select  = preg_replace( '#<select([^>]*)>#', $replace, $select );

    echo $select;*/ ?>

    <noscript>
        <input type="submit" value="View" />
    </noscript>
</form> -->

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