<div class="categories">
  <form class="js-filter-form" >
    <select name="categories">
    <?php 
      $cat_args = array(
        'exclude' => array(1),
        'option_all' => 'All'
      );
      $categories = get_categories( $cat_args ); ?>
      <option class="js-filter-item" value="all">All</option>
      <?php foreach($categories as $cat) : ?>
        <option class="js-filter-item" value="<?= $cat->cat_ID ?>"><?= $cat->name ?></option>
      <?php endforeach; ?>
    </select>
  </form>
</div>