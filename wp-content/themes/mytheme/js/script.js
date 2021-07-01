// (function($) {
//   $(document).ready(function(){
//     $(document).on('change', '.js-filter-form', function(e) {
//       e.preventDefault();
//       var category = $(this).find('option:selected').val();
//       console.log(category);
//       $.ajax({
//         url: blog.ajaxurl,
//         data: { action: 'filter_posts_by_ajax', category: category },
//         type: 'news',
//         success: function(result) {
//           $('.js-filter').html(result)
//         },
//         error: function(error) {
//           console.warn(error);
//         }
//       });
//     });
//   });
// })(jQuery);

var page = 2;

jQuery(function($) {
  $('body').on('click', '.loadmore', function() {
    var data = {
      'action': 'load_posts_by_ajax',
      'page': page,
      'security': blog.security,
      'posts_per_page': ppp,  // from index.php
    };

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
  });
});