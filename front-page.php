<?php get_header(); ?>

<!-- Hero -->
<section class="hero">
<?php
                // arguments de la requête
                $args = array(
                    'post_type' => 'photo',
                    'posts_per_page' => 1, 
                    'orderby' => 'rand',
                );

                // création d' une nouvelle instance de WP_Query
                $query = new WP_Query($args);

                // boucle sur les résultats
                if ($query->have_posts()) {
                    while ($query->have_posts()) {
                        $query->the_post();
                        ?>
                         <img src="<?php
                                $photo = get_field('photo');
                                echo $photo['url'];
                                ?>" alt="photographie">
                        <?php
                    }
                }
                // réinitialisation de la requête
                wp_reset_postdata();
                ?>
<h1>PHOTOGRAPHE EVENT</h1>
</section>

<div class="page-container">
<!-- Filtrage des photos -->
    <div class="filters">
        <form action=""> 
            <!-- Filtre par Catégorie -->
            <div class="filter1">
                <select name="categoryfilter" id="category">
                    <option value="">Catégories</option>
                    <?php
                    // récupération des catégories
                    $categories = get_terms('categorie');
                    // récupération de la catégorie actuellement sélectionnée
                    $selected_category = isset($_GET['categoryfilter']) ? $_GET['categoryfilter'] : '';
                    // boucle sur les catégories
                    foreach ($categories as $category) {
                        ?>
                        <option value="<?php echo $category->slug; ?>" <?php echo $selected_category == $category->slug ? 'selected' : ''; ?>><?php echo $category->name; ?></option>
                        <?php
                    }
                    ?>
                </select>
            </div>

            <!-- Filtre par Format -->
            <div class="filter1">
                <select name="formats" id="format">
                    <option value="">Formats</option>
                    <?php
                    $formats = get_terms('format');
                    // récupération du format actuellement sélectionné
                    $selected_format = isset($_GET['formats']) ? $_GET['formats'] : '';
                    foreach ($formats as $format) {
                        ?>
                        <option value="<?php echo $format->slug; ?>" <?php echo $selected_format == $format->slug ? 'selected' : ''; ?>><?php echo $format->name; ?></option>
                        <?php
                    }
                    ?>
                </select>
            </div>

            <!-- Filtre par Ancienneté -->
            <div class="filter2">
                <select name="orderby" id="orderby">
                    <option value="">Trier par</option>
                    <option value="date_desc" <?php echo isset($_GET['orderby']) && $_GET['orderby'] == 'date_desc' ? 'selected' : ''; ?>>des plus récentes aux plus anciennes</option>
                    <option value="date_asc" <?php echo isset($_GET['orderby']) && $_GET['orderby'] == 'date_asc' ? 'selected' : ''; ?>>des plus anciennes aux plus récentes</option>
                </select>
            </div>

            <input type="submit" value="Appliquer">
            <input type="hidden" name="action" value="myfilter">
        </form>
    </div>

<!-- Affichage des photos -->
<div class="photo-suggestions">
    <!-- récupération des photos de même catégorie avec WP_query -->
    <?php
    // récupération des valeurs des filtres
    $categoryfilter = isset($_GET['categoryfilter']) ? $_GET['categoryfilter'] : '';
    $formats = isset($_GET['formats']) ? $_GET['formats'] : '';
    $orderby = isset($_GET['orderby']) ? $_GET['orderby'] : '';
    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

    // arguments de base de la requête
    $args = array(
        'post_type' => 'photo',
        'posts_per_page' => 12,
        'paged' => $paged,
    );

    // construction de la tax_query en fonction des filtres définis
    $tax_query = array('relation' => 'AND');
    if (!empty($categoryfilter)) {
        $tax_query[] = array(
            'taxonomy' => 'categorie',
            'field'    => 'slug',
            'terms'    => $categoryfilter,
        );
    }
    if (!empty($formats)) {
        $tax_query[] = array(
            'taxonomy' => 'format',
            'field'    => 'slug',
            'terms'    => $formats,
        );
    }

    // si au moins un filtre a été défini, ajoutez la tax_query aux arguments de la requête
    if (count($tax_query) > 1) {
        $args['tax_query'] = $tax_query;
    }

    // ajout du filtre de tri à la requête
    if ($orderby == 'date_desc') {
        $args['orderby'] = 'date';
        $args['order'] = 'DESC';
    } elseif ($orderby == 'date_asc') {
        $args['orderby'] = 'date';
        $args['order'] = 'ASC';
    }

    // création d' une nouvelle instance de WP_Query
    $query = new WP_Query($args);

    // boucle sur les résultats
    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            $post_ids[] = get_the_ID(); // Ajoutez l'ID du post à un tableau
            get_template_part('templates_part/photo_block');
            
        }
    }

    // Passez les IDs des posts à votre script JavaScript
    wp_localize_script('ajax-load-more', 'ajax_params', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        // 'nonce' => wp_create_nonce('load_more_posts'),
        'excluded_posts' => $post_ids, // Ajoutez le tableau d'IDs de posts
        'paged' => $paged,
        'orderby' => $orderby,
        'category' => $category,
        'format' => $format,
    ));

    // réinitialisation de la requête
    wp_reset_postdata();
    ?>

    <div id="more_posts">
        <button id="load_more">Charger plus</button>
    </div>
</div>
<!-- footer -->
<?php get_footer(); ?>
