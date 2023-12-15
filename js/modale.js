console.log(" modale.js est lancé ")

// Attends que le document soit prêt
$(document).ready(function() {
    // Sélectionne le bouton de contact et l'overlay de la modale
    const boutonContact = $('#menu-item-29');
    const modaleOverlay = $('.popup-overlay');

    // Fonction pour ouvrir la modale
    function openModal() {
        modaleOverlay.fadeIn(300); 
        modaleOverlay.css('display', 'flex');
    }

    // Fonction pour fermer la modale
    function closeModal() {
        modaleOverlay.css('display', 'none');
    }

    // Vérifie si le bouton de contact existe
    if (boutonContact.length) {
        // Ajoute un gestionnaire d'événement au clic sur le bouton de contact
        boutonContact.on('click', function(event) {
            event.preventDefault();
            openModal();
        });
    }

    // Ajoute un gestionnaire d'événement au clic sur la fenêtre
    $(window).on('click', function(event) {
        // Vérifie si l'élément cliqué est l'overlay de la modale
        if ($(event.target).is(modaleOverlay)) {
            closeModal();
        }
    });
});