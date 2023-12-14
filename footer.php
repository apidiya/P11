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
</footer>
