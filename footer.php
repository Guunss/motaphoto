</main>

<footer>
    <?php
    wp_nav_menu(array(
        "menu" => "menu-footer",
        "menu_class" => "footer-menu"
    ));
    ?>
</footer>

<!-- modale de contact -->
<?php get_template_part('/template_parts/modale'); ?>

<!-- lightbox -->
<div id="lightbox" class="lightbox">
    <button class="lightbox-close">Fermer</button>
    <button class="lightbox-next">Suivant</button>
    <button class="lightbox-prev">Précédent</button>
    <div class="lightbox-container">
        <img class="lightbox-photo" src="https://picsum.photos/300/300" />
    </div>
    <div class="infos-photo">
        <div class="ref-photo"></div>
        <div class="categorie"></div>
    </div>
</div>

</body>
<?php wp_footer(); ?>

</html>