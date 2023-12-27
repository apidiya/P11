console.log("singleMiniature.js est lancé");

document.addEventListener('DOMContentLoaded', function () {
    var leftArrow = document.querySelector('.arrow-left');
    var rightArrow = document.querySelector('.arrow-right');
    var imageDiv = document.querySelector('.image');

    leftArrow.addEventListener('mouseover', function () {
        console.log("Survol sur flèche gauche");
        var prevImage = leftArrow.getAttribute('data-prev-image');
        if (prevImage) {
            imageDiv.style.display = 'block';
            imageDiv.innerHTML = '<img src="' + prevImage + '" alt="Image précédente">';
        }
    });

    leftArrow.addEventListener('mouseout', function () {
        console.log("Sortie de survol sur flèche gauche");
        imageDiv.style.display = 'none';
    });

    rightArrow.addEventListener('mouseover', function () {
        console.log("Survol sur flèche droite");
        var nextImage = rightArrow.getAttribute('data-next-image');
        if (nextImage) {
            imageDiv.style.display = 'block';
            imageDiv.innerHTML = '<img src="' + nextImage + '" alt="Image suivante">';
        }
    });

    rightArrow.addEventListener('mouseout', function () {
        console.log("Sortie de survol sur flèche droite");
        imageDiv.style.display = 'none';
    });
});
