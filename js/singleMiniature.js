// Script du caroussel miniature de la page single.php

console.log("singleMiniature.js est lancé");

window.addEventListener("DOMContentLoaded", () => {

// Single-page : Affichage de la photo miniature au survol des flèche

  // Flèche gauche
  const arrowLeft = document.getElementById("arrow-left");
  //Flèche droite
  const arrowRight = document.getElementById("arrow-right");
  //Image gauche
  const previousImage = document.getElementById("previous-image");
  //Image droite
  const nextImage = document.getElementById("next-image");


  if( previousImage != null && arrowLeft != null) {
  arrowLeft.addEventListener(
    'mouseenter',
    function(event) {
        previousImage.style.visibility = "visible";
        if ( nextImage != null) {
          nextImage.style.visibility = "hidden";
        }
      }
    )
  }

  if( nextImage != null && arrowRight != null) {
    arrowRight.addEventListener(
      'mouseenter',
      function(event) {
        nextImage.style.visibility = "visible";
        previousImage.style.visibility = "hidden";
      }
    )
  }


})