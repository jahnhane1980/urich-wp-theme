<?php
/**
 * Urich Theme Functions
 */

function urich_theme_scripts() {
    // Haupt-Stylesheet laden (style.css)
    wp_enqueue_style('urich-main-style', get_stylesheet_uri());
    
    // Die Design-Datei aus dem CSS-Ordner laden
    wp_enqueue_style('urich-theme-design', get_template_directory_uri() . '/css/style-theme.css', array(), '1.0');
}

add_action('wp_enqueue_scripts', 'urich_theme_scripts');

// Support für automatische Title-Tags (SEO-Best-Practice)
add_theme_support('title-tag');

// Support für Beitragsbilder (falls später für Blog/News benötigt)
add_theme_support('post-thumbnails');

// Menü-Positionen registrieren
function urich_register_menus() {
    register_nav_menus(array(
        'primary' => __('Hauptmenü', 'urich-theme'),
        'footer'  => __('Footer-Menü', 'urich-theme'), // Neu hinzugefügt
    ));
}
add_action('init', 'urich_register_menus');