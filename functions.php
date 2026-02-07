<?php

//ajout support logo dans le thème
add_theme_support( 'custom-logo');

 //chargement des styles et des scripts
function enqueue_assets() {

    wp_enqueue_style('default-style', get_stylesheet_uri() );     
    wp_enqueue_style('theme-style', get_template_directory_uri() .'/assets/css/main.css') ;
    wp_enqueue_script('js-mota', get_template_directory_uri() .'/assets/js/script.js') ;
    wp_localize_script('js-mota', 'ajaxInfo', array(
        'ajaxUrl' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('more-photos')
    ));

}
add_action('wp_enqueue_scripts', 'enqueue_assets');

// custom image sizes 
function motaphoto_sizes() {
    // miniatures hover navigation
    add_image_size( 'custom-thumbnail', 81, 71, true);
    
    // photo for photo-container
    add_image_size( 'custom-medium', 564, 495, true) ;
}
add_action( 'after_setup_theme', 'motaphoto_sizes' );


function more_photos() {
    check_ajax_referer('more-photos'); // on controle le nonce

    $paged = isset($_POST['page']) ? intval($_POST['page']) : 1;
    $tri = isset($_POST['tri']) ? intval($_POST['tri']) : null;

    // Ajout du filtre de catégorie si présent
    if (isset($_POST['categorie'])) {
        $categorie = $_POST['categorie'];
        $tax_query_categorie[] = array(
            'taxonomy' => 'categorie',
            'field' => 'slug',
            'terms' => $categorie,
        );
    }
    // Ajout du filtre de format si présent
    if (isset($_POST['format'])) {
        $format = $_POST['format'];
        $tax_query_format[] = array(
            'taxonomy' => 'format',
            'field' => 'slug',
            'terms' => $format,
        );
    }

    if (isset($tax_query_format) and isset($tax_query_categorie)) {
        $tax_query = array(
            'relation' => 'AND',
            $tax_query_format,
            $tax_query_categorie
        );
    } else if (isset($tax_query_format)) {
        $tax_query = $tax_query_format;
    } else if (isset($tax_query_categorie)) {
        $tax_query = $tax_query_categorie;
    }

    // requête pour récupérer les posts de type 'photo'
    $photos = new WP_Query(array(
        'post_type' => 'photo',
        'posts_per_page' => 8,
        'orderby' => 'date',
        'order' => $tri,
        'paged' => $paged,
        'tax_query' => $tax_query
    ));

    $maxPhotos = $photos->found_posts;
    ob_start();
    if ($photos->have_posts()) {
        while ($photos->have_posts()) {
            $photos->the_post();
            get_template_part('template_parts/part_photo');
        }
        wp_reset_postdata();
    } 

    // requête pour récupérer les posts de type 'photo'
    $max_photos = 

    $output = ob_get_clean();
    wp_send_json_success(array(
        'html' => $output,
        'max_photos' => $maxPhotos
    ));

}
add_action('wp_ajax_nopriv_more_photos', 'more_photos');
add_action('wp_ajax_more_photos', 'more_photos');


?>