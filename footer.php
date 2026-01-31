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


</body>
<?php wp_footer(); ?>

</html>