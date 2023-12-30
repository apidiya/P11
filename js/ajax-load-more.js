console.log('ajax-load-more.js loaded');

jQuery(function($){
    var page = 2;
    $('#load-more-button').on('click', function(){
        $.ajax({
            url : ajax_params.ajax_url,
            type : 'post',
            data : {
                action : 'load_more_photos',
                page : page
            },
            success : function(response){
                if(response){
                    $('.photo-suggestions').append(response);
                    page++;
                } else {
                    $('#load-more-button').hide();
                }
            }
        });
    });
});
