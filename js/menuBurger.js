console.log('menuBurger.js');

$(document).ready(function () {
    const header = $('header');
    const menuBurger = $('.burgerMenu');
    const nav = $('.nav-links-container');
    const menuLinks = $('.header-menu li a');

    menuBurger.on('click', function () {
        const isOpen = header.hasClass('open');

        header.toggleClass('open', !isOpen);
        menuBurger.toggleClass('open', !isOpen);
        nav.toggleClass('open', !isOpen);

    });
});
