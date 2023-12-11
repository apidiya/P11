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

sfgfdsgfgddffgf