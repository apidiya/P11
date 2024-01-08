<!DOCTYPE html>
<html <?php language_attributes(); ?>> <!-- langue dynamique -->

<head>
    <meta charset="<?php bloginfo('charset'); ?>"> <!-- encodage dynamique du site -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fite=no" />

    <!-- injection des styles, scripts, méta-infos etc... -->
    <?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>

<header class="header">
    <div class="header_container">
        <div class="logo">
            <a href="<?php echo home_url('/'); ?>">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/logo.png" alt="Logo">
            </a>
        </div>
        <nav class="nav-links-container" id="nav-links">
            <?php
                wp_nav_menu(array(
                    'theme_location' => 'header-menu',
                    'menu_class' => 'header-menu', // classe CSS pour customiser mon menu
                ));
            ?>
        </nav>
    </div>
</header>
