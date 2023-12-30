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

    // Affichage des images miniature (script JQuery)
    wp_enqueue_script('singleMiniature', get_stylesheet_directory_uri() . '/js/singleMiniature.js', array('jquery'), '1.0.0', true);

    // Affichage des photos Charger plus avec AJAX
    wp_enqueue_script('loadmore', get_stylesheet_directory_uri() . '/js/ajax-load-more.js', array('jquery'), '1.0.0', true);
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

// fonction pour gérer la requête AJAX et renvoyer les photos supplémentaires
function load_more_photos() {
    $paged = $_POST['page'] + 1;
    $query_vars = json_decode(stripslashes($_POST['query']), true);
    $query_vars['paged'] = $paged;
    $query_vars['posts_per_page'] = 12;
    $query_vars['orderby'] = 'date';

    $photos = new WP_Query($query_vars);
    if ($photos->have_posts()) {
        ob_start();
        while ($photos->have_posts()) {
            $photos->the_post();
            get_template_part('template-parts/photo_block', null);
        }
        wp_reset_postdata();

        $output = ob_get_clean(); // Get the buffer and clean it
        echo $output; // Echo the output
    }
    else {
        ob_clean(); // Clean any previous output
        echo 'no_posts';
    }
        die();

}
add_action('wp_ajax_nopriv_load_more', 'load_more_photos');
add_action('wp_ajax_load_more', 'load_more_photos');

?>