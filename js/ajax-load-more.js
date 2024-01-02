// console.log('ajax-load-more.js loaded');

// var page = 2;
// jQuery(function($) {
//     $('body').on('click', '#load_more', function(e) {
//         e.preventDefault();
//         console.log(ajax_params.excluded_posts); // Affichez les IDs des posts à exclure
//         var data = {
//             'action': 'load_posts_by_ajax',
//             'page': page,
//             'security': ajax_params.nonce,
//             'excluded_posts': ajax_params.excluded_posts, // Ajoutez les IDs des posts à exclure
//             'orderby': ajax_params.orderby,
//             'category': ajax_params.category,
//             'format': ajax_params.format,
//         };
//         $.post(ajax_params.ajax_url, data, function(response) {
//             if(response != '') {
//                 $('#more_posts').append(response);
//                 page++;
//             } else {
//                 $('#load_more').hide();
//             }
//         });
//     });
// });

console.log('ajax-load-more.js loaded');

var page = 2;
jQuery(function($) {
    // Charger plus de posts
    $('body').on('click', '#load_more', function(e) {
        e.preventDefault();
        console.log(ajax_params.excluded_posts); // Affichez les IDs des posts à exclure
        var data = {
            'action': 'load_posts_by_ajax',
            'page': page,
            'security': ajax_params.nonce,
            'excluded_posts': ajax_params.excluded_posts, // Ajoutez les IDs des posts à exclure
            'orderby': ajax_params.orderby,
            'category': ajax_params.category,
            'format': ajax_params.format,
        };
        $.post(ajax_params.ajax_url, data, function(response) {
            if(response != '') {
                $('#more_posts').append(response);
                page++;
            } else {
                $('#load_more').hide();
            }
        });
    });

    // Appliquer les filtres
    $('select[name="orderby"], select[name="category"], select[name="format"]').on('change', function() {
        var orderby = $('select[name="orderby"]').val();
        var category = $('select[name="category"]').val();
        var format = $('select[name="format"]').val();
        var data = {
            'action': 'filter_posts_by_ajax',
            'orderby': orderby,
            'category': category,
            'format': format,
            'security': ajax_params.nonce,
        };
        $.post(ajax_params.ajax_url, data, function(response) {
            $('#more_posts').html(response); // Remplacez le contenu de #more_posts par les posts filtrés
        });
    });
});