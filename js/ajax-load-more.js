console.log('ajax-load-more.js loaded');

var nextPage = 2; // commence à 2 car la première page est déjà chargée

jQuery(function($) {
    // Écouter les changements de valeur des filtres
    $('#category, #format, #orderby').on('change', function() {
        var orderby = $('#orderby').val();
        var category = $('#category').val();
        var format = $('#format').val();
        var data = {
            'action': 'filter_posts_by_ajax',
            'paged' : nextPage, // utilisez la variable nextPage pour la pagination
            'orderby': orderby,
            'category': category,
            'format': format,
            'security': ajax_params.nonce,
        };
        $.post(ajax_params.ajax_url, data, function(response) {
            $('#more_posts').html(response); // remplacer les posts par les nouveaux posts une fois qu'ils sont filtrés
        });
    });

    // Charger plus de posts
    $('#load_more').click(function() {
        var data = {
            'action': 'load_more_photos',
            'paged': nextPage, // utilisez la variable nextPage pour la pagination
            'security': ajax_params.nonce,
        };

        $.post(ajax_params.ajax_url, data, function(response) {
            // Si la réponse est vide ou contient moins de 12 photos, cacher le bouton
            if (!response || $(response).find('.photo_block').length < 12) {
                $('#load_more').hide();
            }
            $('#more_photos').append(response); // ajoutez les nouvelles photos à la page
            nextPage++; // incrémente la page pour la prochaine fois
        });
    });
});