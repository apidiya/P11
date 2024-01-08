/* Navigation menu burger mobile */
console.log("Navigation menu burger mobile : son js est chargé");

function toggleMenu() {
    var x = document.getElementById("nav-links");
    if (x.style.display === "block") {
        x.style.display = "none";
    } else {
        x.style.display = "block";
    }
}