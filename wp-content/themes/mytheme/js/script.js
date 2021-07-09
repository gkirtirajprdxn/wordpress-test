var page = 2;
jQuery(function($) {
  // Loadmore button
  $('body').on('click', '.loadmore', function() {
    var category = $('.js-filter-form select').find('option:selected').val();
    var data = {
      'type': 'news',
      'action': 'load_posts_by_ajax',
      'page': page,
      'security': blog.security,
      'posts_per_page': 6,
      'category': category,  // from news.php
    };
    $.ajax({
      url: blog.ajaxurl,
      data: data,
      type: 'POST',
      success: function(result) {
        $('.blog-posts').append(result);
        page++;
        var totalPages = $('#totalpages').val();
        if(page == parseInt(totalPages) + 1) {
          console.log(totalPages);
          $('.loadmore').hide();
          $('.no-posts-msg').show();
        }
      },
      error: function(error) {
        console.warn(error);
      }
    });
  });
  
  // Filter posts
  $(document).on('change', '.js-filter-form', function(e) {
    e.preventDefault();
    page = 2; // reset page value to 2
    var category = $(this).find('option:selected').val();
    $.ajax({
      url: blog.ajaxurl,
      data: { action: 'filter_posts_by_ajax', category: category },
      type: 'POST',
      success: function(result) {
        $('#article').html(result)
      },
      error: function(error) {
        console.warn(error);
      }
    });
  });
});