<?php
get_header();
?>

<section class="hero">
    <h1>Photographe Event</h1>
    <div class="hero-img">
        <img src="<?php echo wp_get_attachment_image_src(38, 'full', false)[0] ?>" />

    </div>
</section>

<section class="all-photos">


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

</section>

<?php
get_footer();
?>