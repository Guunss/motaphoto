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
      <section class="photo-infos">
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
        <?php if (!empty($postPrecedent)) { ?>
          <span
            id="tooltip-precedent"><?php echo get_the_post_thumbnail($postPrecedent->ID, 'custom-thumbnail'); ?></span>
        <?php } ?>
        <?php if (!empty($postSuivant )) { ?>
          <span id="tooltip-suivant"><?php echo get_the_post_thumbnail($postSuivant->ID, 'custom-thumbnail'); ?></span>
        <?php } ?>
      </div>
      <div class="links">
        <?php if (!empty($postPrecedent)) { ?>
          <a href="<?php echo get_permalink($postPrecedent) ?>" class="fleche-btn precedent"><img
              src="<?php echo get_stylesheet_directory_uri() . '/assets/images/fleche-gauche.png' ?>"
              alt="fleche navigation image précédente"></a>
        <?php } ?>
        <?php if (!empty($postSuivant)) { ?>
          <a href="<?php echo get_permalink($postSuivant) ?>" class="fleche-btn suivant"><img
              src="<?php echo get_stylesheet_directory_uri() . '/assets/images/fleche-droite.png' ?>"
              alt="fleche navigation image suivante"></a>
        <?php } ?>
      </div>
    </div>

  </section>
  <section class="suggestions">
      <h3>Vous aimerez aussi</h3>
      <div class="photos">
        <?php
        // recup catégorie photo cette page
        $categories = wp_get_post_terms(get_the_ID(), 'categorie');
        if ($categories && !is_wp_error($categories)) {
          $ID_categories = wp_list_pluck($categories, 'term_id');

          $photos_siblings = new WP_Query(array(
            'post_type' => 'photo',
            'posts_per_page' => 2,
            'post__not_in' => array(get_the_ID()), //on ignore celle qui est affichée actuellement
            'orderby' => 'rand',
            'tax_query' => array(
              array(
                'taxonomy' => 'categorie',
                'field' => 'id',
                'terms' => $ID_categories,
              ),
            ),
          ));

          if ($photos_siblings->have_posts()) {
            while ($photos_siblings->have_posts()) {
              $photos_siblings->the_post();
              get_template_part('template_parts/part_photo');
            }
            wp_reset_postdata();
          } else {
            echo '<p>Oooh... tellement vide !</p>';
          }
        }
        ?>

      </div>
    </section>

</div>
<?php get_footer(); ?>