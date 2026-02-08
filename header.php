<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>

    <header>
        <div class="logo">
            <?php
            if (function_exists('the_custom_logo')) {
                the_custom_logo();
            }
            ?>
        </div>

        <div id="mobile-menu">
            <span class="trait"></span>
            <span class="trait"></span>
            <span class="trait"></span>
        </div>

        <nav id="menu">
            <?php
            wp_nav_menu(
                array(
                    'menu' => 'menu-principal',
                    'container' => 'div'
                )
            );
            ?>
        </nav>
    </header>
    <main>