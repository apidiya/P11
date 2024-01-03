 <div class="suggested-photo">
    
        <img class="photo-template" src="<?php
                    $photo = get_field('photo');
                    echo $photo['url'];
                    ?>" alt="photographie">
    
    <div class="overlay">
        <div class="overlay-fullscreen">
        <a href="#">
            <img src="<?php echo get_template_directory_uri()?>/assets/images/Icon_fullscreen.png" alt=""></a>
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