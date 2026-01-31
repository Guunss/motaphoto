<?php

//ajout support logo dans le thème
add_theme_support( 'custom-logo');

 //chargement des styles et des scripts
function enqueue_assets() {

    wp_enqueue_style('default-style', get_stylesheet_uri() ); 
    
    wp_enqueue_style('theme-style', get_template_directory_uri() .'/assets/css/main.css') ;

    wp_enqueue_script('js-mota', get_template_directory_uri() .'/assets/js/script.js') ;

}
add_action('wp_enqueue_scripts', 'enqueue_assets');

// custom image sizes 
function motaphoto_sizes() {
    // miniatures hover navigation
    add_image_size( 'custom-thumbnail', 81, 71, true); 
}
add_action( 'after_setup_theme', 'motaphoto_sizes' );



?>