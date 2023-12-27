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
    
    <!-- section contact et carrousel miniature -->
    <section class="contact-carrousel">
        <div class="contact-btn">
            <h4>Cette photo vous intéresse ?</h4>
            <button id="boutonContact">Contact</button>
        </div> 

        <div class="interaction-photo__navigation">
            <?php
                $prevPost = get_previous_post();
                $nextPost = get_next_post();
            ?>
            <div class="arrows">
                <?php if (!empty($prevPost)) :                        
                        $prevLink = get_permalink($prevPost); ?>
                        <a id="arrow-left" href="<?= $prevLink; ?>">
                            <img class="arrow arrow-gauche" src="<?= get_template_directory_uri(); ?>/assets/images/left.png" alt="Flèche pointant vers la gauche" />
                        </a>
                        <?php endif;
                        if (!empty($nextPost)) :
                            $nextLink = get_permalink($nextPost); ?>
                            <a href="<?= $nextLink; ?>">
                                <img id="arrow-right" class="arrow arrow-droite" src="<?= get_template_directory_uri(); ?>/assets/images/right.png" alt="Flèche pointant vers la droite" />
                            </a>
                <?php endif; ?>
            </div>
            
            <div class="div-preview">
            <div class="preview">
                <?php if (!empty($prevPost)) :
                        $prevThumbnail = get_field( "photo" , $prevPost->ID );
                        $prevLink = get_permalink($prevPost); ?>
                        <a href="<?= $prevLink; ?>">
                        <img id="previous-image" class="previous-image" src="<?php echo $prevThumbnail["sizes"]["thumbnail"]; ?>" alt="Prévisualisation image précédente">
                        </a>
                <?php endif; ?>
            </div>

            <div class="preview">
                <?php if (!empty($nextPost)) :
                            $nextThumbnail = get_field( "photo" , $nextPost->ID );                  
                            $nextLink = get_permalink($nextPost);                            
                            ?>
                            <a href="<?= $nextLink; ?>">
                            <img id="next-image" class="next-image" src="<?php echo $nextThumbnail["sizes"]["thumbnail"]; ?>" alt="Prévisualisation image suivante">
                            </a>
                <?php endif ?>
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