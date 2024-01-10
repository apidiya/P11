// Script de la modale de contact

console.log(" modale.js est lancé ")

// Fonction pour ouvrir et fermer la modale
$(document).ready(function() {
    // Sélectionne le bouton de contact et l'overlay de la modale
    const boutonContact = $('#menu-item-29');
    const boutonContact2 = $('#boutonContact');
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
            document.querySelector(".refphoto").value=""
        });
    }


    // même boucle pour le bouton contact de la page infos d'une photo
    if (boutonContact2.length) {
        boutonContact2.on('click', function(event) {
            event.preventDefault();
            openModal();
            let refc=document.querySelector(".ref-val")
            let refmodale=document.querySelector(".refphoto")
            if (refc) {
                refmodale.value=refc.textContent
            }
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

