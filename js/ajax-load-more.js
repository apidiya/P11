(function($) {
    var nextPage = 1; // commence à 2 car la première page est déjà chargée
    var nberphotos = 12;

    function filterAndLoadPosts() {
        var orderby = $('#orderby').val();
        var category = $('#category').val();
        var format = $('#format').val();
        var data = {
            'action': 'filter_posts_by_ajax',
            'paged': nextPage, // utilisez la variable nextPage pour la pagination
            'orderby': orderby,
            'category': category,
            'format': format,
            'security': ajax_params.nonce,
            'nberphotos': nberphotos,
        };

        $.post(ajax_params.ajax_url, data, function(response) {
            var $response = $(response);
            var photoCount = $response.find(".photo-template").length;
            console.log(photoCount);
            // Si la réponse est vide, masquer le bouton
        if (!response.trim() || photoCount < nberphotos) {
        $('#load_more').hide();
        }
            if (nextPage === 1) {
                $('#more_posts').html(response); // remplacer les posts par les nouveaux posts une fois qu'ils sont filtrés
                $('#more_photos').html(""); // remplacer les photos par les nouvelles photos une fois qu'elles sont filtrées
            } else {
                $('#more_photos').append(response); // ajoutez les nouvelles photos à la page
            }

            
        });
    }

    // Appeler la fonction au démarrage de la page
    filterAndLoadPosts();

    // Écouter les changements de valeur des filtres
    $('#category, #format, #orderby').on('change', function() {
        nextPage = 1; // Réinitialiser nextPage à 1 lorsqu'un filtre est modifié
        filterAndLoadPosts();

    } );

    


    // Charger plus de posts
    $('#load_more').click(function() {
        nextPage++; // Incrémenter nextPage avant l'exécution de la fonction
        filterAndLoadPosts();
    });
})(jQuery);