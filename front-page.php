<?php
get_header();
?>

<section class="hero">
    <h1>Photographe Event</h1>
    <div class="hero-img">
        <img src="<?php echo wp_get_attachment_image_src(38, 'full', false)[0] ?>" />

    </div>
</section>

<section id="filters">
    <!-- Custom Dropdown Structure -->
    <div class="liste-deroulante" data-taxomony="categorie">
        <div class="select-button">
            <span class="selected-value">Catégories</span>
            <span class="arrow"></span>
        </div>
        <div class="placeholder">Catégories</div>
        <ul class="select-dropdown hidden">
            <li>&nbsp;</li>
            <?php
            $categories = get_terms('categorie');
            if (!empty($categories)) {
                foreach ($categories as $categorie) {
                    echo '<li data-slug="'. esc_html($categorie->slug) .'">' . esc_html($categorie->name) . '</li>';
                }
            }
            ?>
        </ul>
    </div>
    <!-- Custom Dropdown Structure -->
    <div class="liste-deroulante" data-taxomony="format">
        <div class="select-button">
            <span class="selected-value">Formats</span>
            <span class="arrow"></span>
        </div>
        <div class="placeholder">Formats</div>
        <ul class="select-dropdown hidden">
            <li>&nbsp;</li>
            <?php
            $formats = get_terms('format');
            if (!empty($formats)) {
                foreach ($formats as $format) {
                    echo '<li data-slug="'. esc_html($format->slug) .'">' . esc_html($format->name) . '</li>';
                }
            }
            ?>
        </ul>
    </div>
</section>

<section class="album">
    <div id="all-photos">

        <?php

        // requête pour récupérer les posts de type 'photo'
        $photos = new WP_Query(array(
            'post_type' => 'photo',
            'posts_per_page' => 8,
            'orderby' => 'date',
            'order' => 'ASC',
            'paged' => 1,
        ));

        // Vérifie si des posts ont été trouvés
        if ($photos->have_posts()) {
            // Boucle à travers les posts trouvés
            while ($photos->have_posts()) {
                $photos->the_post();
                // Inclut le template partiel pour chaque photo
                get_template_part('template_parts/part_photo');
            }
            // Réinitialise les données de post
            wp_reset_postdata();
        } else {
            // Message affiché si aucun post n'a été trouvé
            echo 'aucune photo avec le ou les filtres selectionnés';
        }

        ?>
    </div>
    <?php $nb_photos = wp_count_posts('photo')->publish;
    if ($nb_photos > 8) { ?>
        <div class="actions">
            <a href="#" id="chargerPlusBtn">Charger plus</a>
        </div>
    <?php } ?>

</section>

<?php
get_footer();
?>