console.log('ajax-load-more.js loaded');

var page = 2;
jQuery(function($) {
    // Écouter les changements de valeur des filtres
    $('#category, #format, #orderby').on('change', function() {
        var orderby = $('#orderby').val();
        var category = $('#category').val();
        var format = $('#format').val();
        var data = {
            'action': 'filter_posts_by_ajax',
            'paged' : 1,
            'orderby': orderby,
            'category': category,
            'format': format,
            // 'security': ajax_params.nonce,
        };
        $.post(ajax_params.ajax_url, data, function(response) {
            $('#more_posts').html(response);
        });
    });
});

    // Charger plus de posts
    $('body').on('click', '#load_more', function(e) {
        e.preventDefault();
        console.log(ajax_params.excluded_posts); // Affichez les IDs des posts à exclure
        var data = {
            'action': 'load_posts_by_ajax',
            'page': page,
            'excluded_posts': ajax_params.excluded_posts, // Ajoutez les IDs des posts à exclure
            'orderby': ajax_params.orderby,
            'category': ajax_params.category,
            'format': ajax_params.format,
            // 'security': ajax_params.nonce, // Nous passons le nonce vérifié à notre fichier functions.php afin de vérifier la requête
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