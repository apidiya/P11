console.log('ajax-load-more.js loaded');

jQuery(function($) {
    // Écouter les changements de valeur des filtres
    $('#category, #format, #orderby').on('change', function() {
        var orderby = $('#orderby').val();
        var category = $('#category').val();
        var format = $('#format').val();
        var data = {
            'action': 'filter_posts_by_ajax',
            'paged' : page,
            'orderby': orderby,
            'category': category,
            'format': format,
            'security': ajax_params.nonce,
        };
        $.post(ajax_params.ajax_url, data, function(response) {
            $('#more_posts').html(response); // remplacer les posts par les nouveaux posts une fois qu'ils sont filtrés
        });
    });
});

    // Charger plus de posts
    $('#load_more').click(function() {
        var data = {
            'action': 'load_more_photos',
            'paged': $('.photo_block').length / 12 + 1, // calculez la page actuelle en fonction du nombre de photos déjà chargées
            'security': ajax_params.nonce,
        };
    
        $.post(ajax_params.ajax_url, data, function(response) {
            $('#more_photos').append(response); // ajoutez les nouvelles photos à la page
        });
    });