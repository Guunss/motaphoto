<?php
    // Récupération des informations de la photo associée au post
    $photo_post = get_the_post_thumbnail(get_the_ID(), 'full');   
    $reference_photo = get_field('reference');
    $date_post = get_the_date('Y');
    $titre_post = get_the_title();
    $titre_slug = sanitize_title($titre_post);
    $lien_post = get_site_url().'/photo/'. $titre_slug;
    $photo_post_full = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'full');

?>
<div class="photo-container">
    <div class="photo-image">        
        <?php echo $photo_post; ?>
    </div>
  
</div>