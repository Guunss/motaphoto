<?php
// Récupération des informations de la photo associée au post
$photo_post = get_the_post_thumbnail(get_the_ID(), 'full');
$reference_photo = get_field('ref-photo');
$annee = get_the_date('Y');
$titre_post = get_the_title();
$titre_slug = sanitize_title($titre_post);
$lien_post = get_site_url() . '/photo/' . $titre_slug;
$photo_post_full = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'full');

$categories = get_the_terms(get_the_ID(), 'categorie');
if ($categories && !is_wp_error($categories)) {
    $noms_categories = array();
    foreach ($categories as $categorie) {
        $noms_categories[] = $categorie->name;
    }
    $liste_categories = join(', ', $noms_categories);
}
?>
<div class="photo-container">
    <div class="photo-image">
        <?php echo $photo_post; ?>
    </div>
    <div class="photo-actions">
        <button class="btn-lightbox" data-img="<?php echo $photo_post_full[0]; ?> "
            data-photo-ref="<?php echo $reference_photo; ?>" data-photo-cat="<?php echo $liste_categories; ?>">
            <img src="<?php echo get_stylesheet_directory_uri() . '/assets/images/icon-fullscreen.svg' ?>" />
        </button>
        <button class="btn-infos" data-lien-post="<?php echo $lien_post ; ?>">
            <img src="<?php echo get_stylesheet_directory_uri() . '/assets/images/icon-eye.svg' ?>" />
        </button>
    </div>
    <div class="photo-infos">
        <p class="description-photo">Titre : <?php echo $titre_post ?></p>
        <p class="description-photo">Référence : <?php echo $reference_photo ?></p>
        <p class="description-photo">Année : <?php echo $annee ?></p>
        </acticle>
    </div>

</div>