console.log("singleMiniature.js est lancé");

$(document).ready(function() {
    const miniPicture = $('#miniPicture');

    $('.arrow-left, .arrow-right').hover(
        function() {
            miniPicture.css({
                visibility: 'visible',
                opacity: 1
            }).html(`<a href="${$(this).data('target-url')}">
                        <img src="${$(this).data('thumbnail-url')}" alt="${$(this).hasClass('arrow-left') ? 'Photo précédente' : 'Photo suivante'}">
                    </a>`);
        },
        function() {
            miniPicture.css({
                visibility: 'hidden',
                opacity: 0
            });
        }
    );

    $('.arrow-left, .arrow-right').click(function() {
        window.location.href = $(this).data('target-url');
    });
});
