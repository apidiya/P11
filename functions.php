<?php function enqueue_custom_styles() {
    wp_enqueue_style( 'custom-style', get_template_directory_uri() . '/sass/style.css' );
}
add_action( 'wp_enqueue_scripts', 'enqueue_custom_styles' );
?>

<?php add_theme_support('title-tag'); ?>
<?php
function register_menus() {
    register_nav_menus(
        array(
            'header' => 'mon header',
            'footer' => 'mon footer'
        )
    );
}
add_action('init', 'register_menus');
?>

