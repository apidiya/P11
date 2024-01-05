 <div class="suggested-photo">
    
        <img class="photo-template" src="<?php
                    $photo = get_field('photo');
                    echo $photo['url'];
                    ?>" alt="photographie">
    
    <div class="overlay">

        <div class="overlay-fullscreen">
            <?php
            $title = get_the_title();
            $categories = get_the_terms(get_the_ID(), 'categorie');
            $category_names = array();
            foreach ( (array) $categories as $category ) {
                $category_names[] = $category->name;
            }
            // contenu de l' affichage de la lightbox
            $photo_ref = get_field('reference'); 
            $caption = '<h2>' . $photo_ref . '</h2><p>' . implode(', ', $category_names) . '</p>';
            ?>
            <a href="<?php echo $photo['url']; ?>" class="fancybox" data-fancybox="gallery" data-caption="<?php echo esc_attr($caption); ?>">
                <img src="<?php echo get_template_directory_uri()?>/assets/images/Icon_fullscreen.png" alt="">
            </a>
        </div>

        <div class="overlay-single">
            <a href="<?php echo get_permalink(); ?>">
            <img src="<?php echo get_template_directory_uri()?>/assets/images/Icon_eye.png" alt=""></a>
        </div>

        <div class="overlay-text">
            <p class="overlay-title"><?php echo get_the_title() ?></p>
            <p class="overlay-category"><?php 
                $categories = get_the_terms(get_the_ID(), 'categorie'); // get_the_ID() récupère l'ID du post actuel dans la boucle WordPress.
                foreach ( (array) $categories as $category ) {
                echo $category->name . ' '; 
            }
            ?></p>  
        </div>
    </div>

</div>