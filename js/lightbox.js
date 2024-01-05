console.log('lightbox.js chargé');

// Vous devrez remplir cette fonction avec la logique pour ouvrir la lightbox avec l'image correcte
function openLightbox(imageUrl, title) {
    var lightbox = document.getElementById('lightbox');
    var lightboxImg = lightbox.querySelector('.lightbox-content');
    var lightboxTitle = lightbox.querySelector('.lightbox-title');
    lightboxImg.src = imageUrl;
    lightboxTitle.textContent = title;
    lightbox.style.display = 'flex';
}

// Logique pour fermer la lightbox
function closeLightbox() {
    var lightbox = document.getElementById('lightbox');
    lightbox.style.display = 'none';
}

// Logique pour gérer le clic sur l'icône
document.querySelectorAll('.overlay-fullscreen a').forEach(function(icon) {
    icon.addEventListener('click', function(event) {
        event.preventDefault();
        var imageUrl = this.href;
        var title = this.querySelector('img').alt;
        openLightbox(imageUrl, title);
    });
});

// Logique pour gérer la navigation entre les images
var images = Array.from(document.querySelectorAll('.overlay-fullscreen a'));
var currentIndex = 0;

document.querySelector('.lightbox-prev').addEventListener('click', function(event) {
    currentIndex = (currentIndex - 1 + images.length) % images.length;
    var imageUrl = images[currentIndex].href;
    var title = images[currentIndex].querySelector('img').alt;
    openLightbox(imageUrl, title);
});

document.querySelector('.lightbox-next').addEventListener('click', function(event) {
    currentIndex = (currentIndex + 1) % images.length;
    var imageUrl = images[currentIndex].href;
    var title = images[currentIndex].querySelector('img').alt;
    openLightbox(imageUrl, title);
});