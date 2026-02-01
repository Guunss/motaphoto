<?php
get_header();
?>

<section class="hero">
    <h1>Photographe Event</h1>
    <div class="hero-img">
        <img src="<?php echo wp_get_attachment_image_src(38, 'full', false)[0] ?>" />

    </div>
</section>

<?php
get_footer();
?>