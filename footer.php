<?php wp_footer(); ?>

<footer>
    <nav class="footer-nav">
      <?php
        wp_nav_menu( array(
          'theme_location' => 'footer-menu', 
          'container' => false, // pas de conteneur div
          'menu_class' => 'footer-menu', // classe CSS pour personnaliser
        ) );
      ?>
    </nav>
   <!--chargement du template modale.php  -->
    <?php get_template_part('templates_part/modale'); ?>
</footer>
