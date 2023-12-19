<?php

// Ajout des styles personnalisés
function enqueue_custom_styles() {
    wp_enqueue_style('custom-style', get_template_directory_uri() . '/sass/style.css');
}
add_action('wp_enqueue_scripts', 'enqueue_custom_styles');

// Ajout du support pour la balise de titre
function theme_slug_setup() {
    add_theme_support('title-tag');
}
add_action('after_setup_theme', 'theme_slug_setup');

// Enregistrement des menus
function register_menus() {
    register_nav_menus(
        array(
            'header-menu' => 'menu header',
            'footer-menu' => 'menu footer'
        )
    );
}
add_action('init', 'register_menus');

// Ajout de jQuery d'un CDN et des scripts JS personnalisés
function script_JS_Custom() {
    // Ajout de jQuery
    wp_enqueue_script('jquery-cdn', 'https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js', array(), '3.7.1', true);

    // Gestion de la Modale (script jQuery)
    wp_enqueue_script('modale', get_stylesheet_directory_uri() . '/js/modale.js', array('jquery'), '1.0.0', true);
}
add_action('wp_enqueue_scripts', 'script_JS_Custom');

// Désactivation des paragraphes automatiques dans Contact Form 7
add_filter('wpcf7_autop_or_not', '__return_false');

/** Proper ob_end_flush() for all levels
 * This replaces the WordPress `wp_ob_end_flush_all()` function
 * with a replacement that doesn't cause PHP notices. */
 remove_action( 'shutdown', 'wp_ob_end_flush_all', 1 );
add_action( 'shutdown', function() {
    while ( @ob_end_flush() );
} );

?>