<?php get_header(); ?>
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
                <div class="filters">
                    <form action="" method="get"> 
                        <div class="filter1">
                            <select name="category" id="category">
                                <option value="">Catégories</option>
                                <?php
                                // récupération des catégories
                                $categories = get_terms('categorie');
                                // boucle sur les catégories
                                foreach ($categories as $category) {
                                    ?>
                                    <option value="<?php echo $category->slug; ?>"><?php echo $category->name; ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                            <select name="formats" id="format">
                                <option value="">Formats</option>
                                <?php
                                // récupération des catégories
                                $formats = get_terms('format');
                                // boucle sur les catégories
                                foreach ($formats as $format) {
                                    ?>
                                    <option value="<?php echo $format->slug; ?>"><?php echo $format->name; ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="filter2">
                            <select name="category" id="category">
                                <option value="">Trier par </option>
                                <option value="">des plus récentes aux plus anciennes</option>
                                <option value="">des plus anciennes au plus récentes</option>
                            </select>
                        </div>
                    </form>
                    
                </div>

        <div class="photo-suggestions">
                <!-- récupération des photos de même catégorie avec WP_query -->
                <?php
                // arguments de la requête
                $args = array(
                    'post_type' => 'photo',
                    'posts_per_page' => 12, 
                );

                // création d' une nouvelle instance de WP_Query
                $query = new WP_Query($args);

                // boucle sur les résultats
                if ($query->have_posts()) {
                    while ($query->have_posts()) {
                        $query->the_post();
                        ?>
                        <?php get_template_part('templates_part/photo_block'); ?>
                        <?php
                    }
                }
                // réinitialisation de la requête
                wp_reset_postdata();
                ?>
         </div>
</div>

<?php get_footer(); ?>
