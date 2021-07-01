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
