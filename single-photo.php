<?php
/**
 * Template pout affichage d'une photo
 */

get_header();

// identifiant photo dans l'URL
$slug = get_query_var('photo');

// critères recherche
$args = [
  'post_type' => 'photo',
  'name' => $slug,
  'posts_per_page' => 1
];

// Requête database wordpress 
$custom_query = new WP_Query($args);
if ($custom_query->have_posts()):
  while ($custom_query->have_posts()):
    $custom_query->the_post();
    $reference = get_field('ref-photo');
    $categories = wp_get_post_terms(get_the_ID(), 'categorie');
    $formats = wp_get_post_terms(get_the_ID(), 'format');
    $types = wp_get_post_terms(get_the_ID(), 'type-photo');
    $annee = get_the_date('Y');

    ?>
    <div class="contenu-page-photo">
      <section class="photo-container">
        <acticle class="infos">
          <h2><?php echo the_title() ?></h2>
          <p class="description-photo">Référence : <span id="photo-ref"><?php echo $reference ?></span></p>
          <p class="description-photo">Catégorie :
            <?php foreach ($categories as $categorie) {
              echo esc_html($categorie->name);
            } ?>
          </p>
          <p class="description-photo">Format : <?php foreach ($formats as $format) {
            echo esc_html($format->name);
          } ?></p>
          <p class="description-photo">Type : <?php foreach ($types as $type) {
            echo esc_html($type->name);
          } ?></p>
          <p class="description-photo">Année : <?php echo $annee ?></p>
        </acticle>
        <article class="photo">
          <?php the_post_thumbnail('full') ?>
        </article>

        <?php
  endwhile;
  wp_reset_postdata();
endif;

?>

  </section>
  <section class="interaction">
	    <div id="contact">
      <p>Cette photo vous intéresse ?</p>
      <a class="show-modale-contact" href="#">Contact</a>
    </div>

    <div class="navigation">
      <?php
        $postPrecedent = get_previous_post();
        $postSuivant = get_next_post();
      ?>
      <div class="tooltips">
        <span id="tooltip-precedent"><?php echo get_the_post_thumbnail($postPrecedent->ID, 'custom-thumbnail'); ?></span>
        <span id="tooltip-suivant"><?php echo get_the_post_thumbnail($postSuivant->ID, 'custom-thumbnail'); ?></span>
      </div>
      <div class="links">
        <?php if (!empty($postPrecedent)): ?>
          <a href="<?php echo get_permalink($postPrecedent) ?>" class="fleche-btn precedent"><img
              src="<?php echo get_stylesheet_directory_uri() . '/assets/images/fleche-gauche.png' ?>"
              alt="fleche navigation image précédente"></a>
        <?php endif; ?>
        <?php if (!empty($postSuivant)): ?>
          <a href="<?php echo get_permalink($postSuivant) ?>" class="fleche-btn suivant"><img
              src="<?php echo get_stylesheet_directory_uri() . '/assets/images/fleche-droite.png' ?>"
              alt="fleche navigation image suivante"></a>
        <?php endif; ?>
      </div>
    </div>

  </section>
  <section class="suggestions"></section>

</div>
<?php get_footer(); ?>