<!-- Template pour l' affichage d' une seul post et ses détails (ici uniquement pour les photos) -->

<?php get_header(); ?>

<?php while (have_posts()) : the_post() ?>
    <?php
    global $wp_query;
    ?>
    <div class="page-container">

    <!-- section détail photo -->
    <section class="main-content">
        <div class="content-body">
            <div class="title-type">
                <h1 class="pic-title"><?php echo get_the_title() ?></h1>
                <p>Référence : <span class="ref-val"><?php echo get_field('reference'); ?></span></p>
                <p>Catégorie : <?php 
                    $categories = get_the_terms(get_the_ID(), 'categorie'); // get_the_ID() récupère l'ID du post actuel dans la boucle WordPress.
                    foreach ( (array) $categories as $category ) {
                    echo $category->name . ' '; 
                }
                ?></p>
                <p>Format : <?php 
                    $formats = get_the_terms(get_the_ID(), 'format'); 
                    foreach ( (array) $formats as $format ) {
                    echo $format->name . ' ';
                }
                ?></p>
                <p>Type : <?php echo get_field('type'); ?></p>
                <p>Année : <?php echo get_field('annees'); ?></p>
            </div>

            <div class="photo-container">
                <img src="<?php
                            $photo = get_field('photo');
                            echo $photo['url'];
                            ?>" alt="photographie">
            </div>
        </div>
    </section>  
    
    <!-- section contact et carrousel -->
    <section class="contact-carrousel">
        <div class="contact-btn">
            <h4>Cette photo vous intéresse ?</h4>
            <button id="boutonContact">Contact</button>
        </div> 

        <?php
        // initializing variables
        $next_item = get_next_post();
        $previous_item = get_previous_post();
                
        $next_image = get_the_post_thumbnail($next_item->ID);
        $previous_image = get_the_post_thumbnail($previous_item->ID);
                
        $permalink_next = get_the_permalink($next_item->ID);
        $permalink_prev = get_the_permalink($previous_item->ID);
        ?>
        
        <div class="photo-navigation">
            <div class="image">
                <!-- La div où la miniature apparaîtra -->
            </div>

            <div class="arrows">
                <!-- left / previous -->
                <div class="arrow-left" data-prev-image="<?php echo get_the_post_thumbnail_url($previous_item->ID); ?>">
                    <?php if (!empty($previous_item)) : ?>
                        <a href="<?php echo $permalink_prev; ?>">
                            <img src="<?php echo get_template_directory_uri() . '/assets/images/larr.svg' ?>" alt="fleche gauche">
                        </a>
                    <?php endif; ?>
                </div>

                <!-- right / next -->
                <div class="arrow-right" data-next-image="<?php echo get_the_post_thumbnail_url($next_item->ID); ?>">
                    <?php if (!empty($next_item)) : ?>
                        <a href="<?php echo $permalink_next; ?>">
                            <img id="right-arrow" src="<?php echo get_template_directory_uri() . '/assets/images/rarr.svg' ?>" alt="fleche droite">
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        
    </section>

    <!-- section autres photos -->
    <section class="suggested-photo-container">
        <h3>Vous aimerez AUSSI</h3>
    </section>

<?php endwhile ?>
<?php get_footer(); ?>