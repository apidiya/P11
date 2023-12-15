console.log(" modale.js est lancé ")

/* au clic de la souris affichage de la modale */

$(document).ready(function() {
    const boutonContact = $('#menu-item-29');
    const modaleOverlay = $('.popup-overlay');

    function openModal() {
        modaleOverlay.css('display', 'flex');
    }

    function closeModal() {
        modaleOverlay.css('display', 'none');
    }

    if (boutonContact.length) {
        boutonContact.on('click', function(event) {
            event.preventDefault();
            openModal();
        });
    }

    $(window).on('click', function(event) {
        if ($(event.target).is(modaleOverlay)) {
            closeModal();
        }
    });
});