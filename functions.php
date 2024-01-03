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

// Désactivation des paragraphes automatiques dans Contact Form 7
add_filter('wpcf7_autop_or_not', '__return_false');

/** Proper ob_end_flush() for all levels
 * This replaces the WordPress `wp_ob_end_flush_all()` function with a replacement that doesn't cause PHP notices. */
 remove_action( 'shutdown', 'wp_ob_end_flush_all', 1 );
add_action( 'shutdown', function() {
    while ( @ob_end_flush() );
} );

// Ajout de jQuery d'un CDN et des scripts JS personnalisés
function script_JS_Custom() {
    // Ajout de jQuery
    wp_enqueue_script('jquery-cdn', 'https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js', array(), '3.7.1', true);

    // Gestion de la Modale (script jQuery)
    wp_enqueue_script('modale', get_stylesheet_directory_uri() . '/js/modale.js', array('jquery'), '1.0.0', true);

    // Affichage des images miniature (script JQuery)
    wp_enqueue_script('singleMiniature', get_stylesheet_directory_uri() . '/js/singleMiniature.js', array('jquery'), '1.0.0', true);
    
    // Affichage des images suppplémentaires "charger plus" avec script AJAX
    wp_enqueue_script('ajax-load-more', get_template_directory_uri() . '/js/ajax-load-more.js', array('jquery'), '1.0.0', true);
    // Passer l'objet ajax_params à votre script
    wp_localize_script('ajax-load-more', 'ajax_params', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('load_more_posts'),
        'excluded_posts' => $post_ids,
        'orderby' => $orderby,
        'category' => $category,
        'format' => $format,
    ));
}
add_action('wp_enqueue_scripts', 'script_JS_Custom');

// ------- partie AJAX ------------

// Fonction de rappel AJAX pour filtrer les posts
function filter_posts_by_ajax_callback() {
    // check_ajax_referer('filter_posts', 'security');
    $paged = isset($_POST['paged']) ? $_POST['paged'] : 1;
    $orderby = $_POST['orderby'];
    $category = $_POST['category'];
    $format = $_POST['format'];
    $args = array(
        'post_type' => 'photo',
        'posts_per_page' => 12,
        'paged' => $paged,
        'orderby' => $orderby,
        'category' => $category,
        'format' => $format,
    );

    // Ajoutez l'ordre à la requête en fonction de la valeur de 'orderby'
    if ($orderby == 'date_desc') {
        $args['orderby'] = 'date';
        $args['order'] = 'DESC';
    } elseif ($orderby == 'date_asc') {
        $args['orderby'] = 'date';
        $args['order'] = 'ASC';
    }
    
    $my_posts = new WP_Query($args);
    if ($my_posts->have_posts()) :
        while ($my_posts->have_posts()) : $my_posts->the_post();
            get_template_part('templates_part/photo_block');
        endwhile;
    endif;
    wp_die();
}
add_action('wp_ajax_filter_posts_by_ajax', 'filter_posts_by_ajax_callback');
add_action('wp_ajax_nopriv_filter_posts_by_ajax', 'filter_posts_by_ajax_callback');


// Fonction de rappel AJAX pour charger plus de posts
function load_posts_by_ajax_callback() {
    // check_ajax_referer('load_more_posts', 'security');
    $paged = isset($_POST['page']) ? $_POST['page'] : 1;
    $paged = $_POST['page'];
    $excluded_posts = $_POST['excluded_posts'];
    $orderby = $_POST['orderby'];
    $category = $_POST['category'];
    $format = $_POST['format'];
    $args = array(
        'post_type' => 'photo',
        'posts_per_page' => 12,
        'paged' => $paged,
        'post__not_in' => $excluded_posts,
        'orderby' => $orderby,
        'category' => $category,
        'format' => $format,
    );
    $my_posts = new WP_Query($args);
    if ($my_posts->have_posts()) :
        while ($my_posts->have_posts()) : $my_posts->the_post();
            get_template_part('templates_part/photo_block');
        endwhile;
    else :
        echo 'no more posts';
    endif;
    wp_die();
}
add_action('wp_ajax_load_posts_by_ajax', 'load_posts_by_ajax_callback');
add_action('wp_ajax_nopriv_load_posts_by_ajax', 'load_posts_by_ajax_callback');

?>