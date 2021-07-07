var page = 2;

jQuery(function($) {
  $('body').on('click', '.loadmore', function() {
    var data = {
      'type': 'news',
      'action': 'load_posts_by_ajax',
      'page': page,
      'security': blog.security,
      'posts_per_page': ppp,  // from news.php
    };
    // console.log(ppp);
    
    $.ajax({
      url: blog.ajaxurl,
      data: data,
      type: 'POST',
      success: function(result) {
        $('.blog-posts').append(result);
        page++;
        if(page == totalPages + 1) {
          $('.loadmore').hide();
          $('.no-posts-msg').show();
        }
      },
      error: function(error) {
        console.warn(error);
        $('.loadmore').hide();
        $('.no-posts-msg').show();
      }
    });
    // OR
    // $.post(blog.ajaxurl, data, function(response) {
    //   if($.trim(response) != '') {
    //     $('.blog-posts').append(response);
    //     page++;
    //   } else {
    //     $('.loadmore').hide();
    //     $('.no-posts-msg').show();
    //   }

    //   if(page == totalPages + 1) {
    //     $('.loadmore').hide();
    //     $('.no-posts-msg').show();
    //   }
    //   // console.log(page);
    //   // console.log(totalPages+1);
    // });
  });
});