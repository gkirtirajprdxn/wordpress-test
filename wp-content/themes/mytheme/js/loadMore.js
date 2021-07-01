var page = 2;

jQuery(function($) {
  $('body').on('click', '.loadmore', function() {
    var data = {
      'type': 'news',
      'action': 'load_posts_by_ajax',
      'page': page,
      'security': blog.security,
      'posts_per_page': ppp,  // from archive-news.php
    };
    // console.log(ppp);

    $.post(blog.ajaxurl, data, function(response) {
      if($.trim(response) != '') {
        $('.blog-posts').append(response);
        page++;
      } else {
        $('.loadmore').hide();
        $('.no-posts-msg').show();
      }

      if(page == totalPages + 1) {
        $('.loadmore').hide();
        $('.no-posts-msg').show();
      }
      // console.log(page);
      // console.log(totalPages+1);
    });
    // $.ajax({
    //   url: blog.ajaxurl,
    //   data: {
    //     'type': 'news',
    //     'action': 'load_posts_by_ajax',
    //     'page': page,
    //     'security': blog.security,
    //     'posts_per_page': ppp,  // from archive-news.php
    //   },
    //   type: 'news',
    //   success: function(result) {
    //     $('.blog-posts').html(result);
    //     console.log(result);
    //   },
    //   error: function(error) {
    //     console.warn(error);
    //   }
    // });
  });
});