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
                <p>Année : <?php echo get_the_date('Y'); ?></p>
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
    </section>


    <!-- section autres photos -->

    <section class="suggested-photo-container">
        <h3>Vous aimerez AUSSI</h3>
    </section>

    
<?php endwhile ?>

<?php get_footer(); ?>