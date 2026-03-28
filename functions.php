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

// Theme Support
add_theme_support('title-tag');
add_theme_support('post-thumbnails');
add_theme_support('custom-logo', array(
    'height'      => 65,
    'width'       => 250,
    'flex-height' => true,
    'flex-width'  => true,
));

// Menü-Positionen registrieren
function urich_register_menus() {
    register_nav_menus(array(
        'primary' => __('Hauptmenü', 'urich-theme'),
        'footer'  => __('Footer-Menü', 'urich-theme'),
    ));
}
add_action('init', 'urich_register_menus');

// Widget-Bereiche registrieren
function urich_widgets_init() {
    register_sidebar( array(
        'name'          => __( 'Footer Links', 'urich-theme' ),
        'id'            => 'footer-1',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="footer-title">',
        'after_title'   => '</h4>',
    ) );
    register_sidebar( array(
        'name'          => __( 'Footer Rechts', 'urich-theme' ),
        'id'            => 'footer-2',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="footer-title">',
        'after_title'   => '</h4>',
    ) );
}
add_action( 'widgets_init', 'urich_widgets_init' );

// Customizer Einstellungen für die Startseite
function urich_customize_register( $wp_customize ) {
    // Sektion Startseite
    $wp_customize->add_section( 'urich_hero_section' , array(
        'title'      => __( 'Startseite Hero', 'urich-theme' ),
        'priority'   => 30,
    ) );

    // Hero Überschrift
    $wp_customize->add_setting( 'urich_hero_title' , array(
        'default'   => 'Bewegung ist <span>Leben</span>.',
        'transport' => 'refresh',
    ) );
    $wp_customize->add_control( 'urich_hero_title_control', array(
        'label'    => __( 'Hero Überschrift', 'urich-theme' ),
        'section'  => 'urich_hero_section',
        'settings' => 'urich_hero_title',
        'type'     => 'textarea',
    ) );

    // Hero Text
    $wp_customize->add_setting( 'urich_hero_text' , array(
        'default'   => 'Erleben Sie eine Therapie, die nicht nur Symptome behandelt, sondern die Ursachen Ihrer Beschwerden tiefgreifend versteht.',
        'transport' => 'refresh',
    ) );
    $wp_customize->add_control( 'urich_hero_text_control', array(
        'label'    => __( 'Hero Untertext', 'urich-theme' ),
        'section'  => 'urich_hero_section',
        'settings' => 'urich_hero_text',
        'type'     => 'textarea',
    ) );

    // Hero Button Link
    $wp_customize->add_setting( 'urich_hero_btn_link' , array(
        'default'   => 'https://www.appointmed.com/booking/2393840-andreas-urich-osteopathie-und-private-physiotherapie',
        'transport' => 'refresh',
    ) );
    $wp_customize->add_control( 'urich_hero_btn_link_control', array(
        'label'    => __( 'Button Link (Termin)', 'urich-theme' ),
        'section'  => 'urich_hero_section',
        'settings' => 'urich_hero_btn_link',
        'type'     => 'url',
    ) );
}
add_action( 'customize_register', 'urich_customize_register' );