console.log("Affichage modale Contact : son js est chargé");

$(document).ready(function() {
    const lienContact = $('#menu-item-29');
    const boutonContact = $('#boutonContact');
    const modalOverlay = $('.popup-overlay');
    const referencePhoto = $('#referencePhoto');

    const openModal = function() {
        modalOverlay.css('display', 'flex');

        if (boutonContact.attr('data-reference') && boutonContact.attr('data-reference').trim() !== "") {
            referencePhoto.val(boutonContact.attr('data-reference'));
        }
    };

    const closeModal = function() {
        modalOverlay.css('display', 'none');
    };

    lienContact.on('click', function(event) {
        event.preventDefault();
        openModal();
    });

    boutonContact.on('click', function(event) {
        event.preventDefault();
        openModal();
    });

    $(window).on('click', function(event) {
        if (event.target === modalOverlay[0]) {
            closeModal();
        }
    });
});

