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

// Shortcode für verschlüsselte E-Mail
function urich_antispam_email_shortcode() {
    $email = 'info@osteopathie-urich.de'; 
    $encoded = antispambot($email);
    return '<a href="mailto:' . $encoded . '">' . $encoded . '</a>';
}
add_shortcode('email', 'urich_antispam_email_shortcode');

// Customizer Einstellungen für die Startseite (Hero) - VOLLSTÄNDIG
function urich_customize_register( $wp_customize ) {
    $wp_customize->add_section( 'urich_hero_section' , array(
        'title'      => __( 'Startseite Hero', 'urich-theme' ),
        'priority'   => 30,
    ) );

    // Hero Titel
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

    // Hero Untertext
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

/**
 * CPT "Leistung" - Für das Backend als "Angebote" gelabelt
 */
function urich_register_leistungen_cpt() {
    $labels = array(
        'name'               => 'Angebote',
        'singular_name'      => 'Angebot',
        'menu_name'          => 'Angebote',
        'add_new'            => 'Neues Angebot',
        'add_new_item'       => 'Neues Angebot hinzufügen',
        'edit_item'          => 'Angebot bearbeiten',
        'all_items'          => 'Alle Angebote',
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => false, 
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => false,
        'capability_type'    => 'post',
        'has_archive'        => false,
        'hierarchical'       => false,
        'menu_icon'          => 'dashicons-heart',
        'supports'           => array('title', 'editor', 'thumbnail'),
        'show_in_rest'       => true,
    );
    register_post_type('leistung', $args);
}
add_action('init', 'urich_register_leistungen_cpt');

/**
 * CPT "Lebenslauf" (intern: timeline) - Für die Über-Mich Seite
 */
function urich_register_timeline_cpt() {
    $labels = array(
        'name'               => 'Lebenslauf',
        'singular_name'      => 'Station',
        'menu_name'          => 'Lebenslauf',
        'add_new'            => 'Neue Station',
        'add_new_item'       => 'Neue Station hinzufügen',
    );
    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => false,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'menu_icon'          => 'dashicons-calendar-alt',
        'supports'           => array('title', 'editor'), 
        'show_in_rest'       => true,
    );
    register_post_type('timeline', $args);
}
add_action('init', 'urich_register_timeline_cpt');

/**
 * Meta Box für den Zeitraum (Datum) im CPT "timeline" hinzufügen
 */
function urich_timeline_add_meta_box() {
    add_meta_box(
        'urich_timeline_date_meta',      // HTML 'id' Attribut
        'Zeitraum',                      // Titel der Meta Box
        'urich_timeline_date_callback',  // Callback-Funktion
        'timeline',                      // CPT (Screen)
        'normal',                        // Kontext
        'high'                           // Priorität
    );
}
add_action('add_meta_boxes', 'urich_timeline_add_meta_box');

/**
 * HTML-Ausgabe für die Zeitraum Meta Box
 */
function urich_timeline_date_callback($post) {
    // Nonce-Feld für die Sicherheitsüberprüfung beim Speichern generieren
    wp_nonce_field('urich_timeline_save_date_data', 'urich_timeline_date_meta_nonce');

    // Aktuellen Wert aus der Datenbank abrufen, falls vorhanden
    $value = get_post_meta($post->ID, '_urich_timeline_date', true);

    echo '<label for="urich_timeline_date_field" style="display:block; margin-bottom:5px;">Geben Sie den Zeitraum ein (z.B. "2015 - 2019" oder "seit 2020"):</label>';
    echo '<input type="text" id="urich_timeline_date_field" name="urich_timeline_date_field" value="' . esc_attr($value) . '" style="width:100%;" />';
}

/**
 * Eingegebene Daten der Meta Box beim Speichern des Beitrags sichern
 */
function urich_timeline_save_date_data($post_id) {
    // Überprüfe Nonce
    if (!isset($_POST['urich_timeline_date_meta_nonce'])) {
        return;
    }
    if (!wp_verify_nonce($_POST['urich_timeline_date_meta_nonce'], 'urich_timeline_save_date_data')) {
        return;
    }

    // Ignoriere Autosaves
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    // Benutzerberechtigungen prüfen
    if (isset($_POST['post_type']) && 'timeline' == $_POST['post_type']) {
        if (!current_user_can('edit_page', $post_id)) {
            return;
        }
    } else {
        if (!current_user_can('edit_post', $post_id)) {
            return;
        }
    }

    // Sicherstellen, dass das Feld im POST-Request existiert
    if (!isset($_POST['urich_timeline_date_field'])) {
        return;
    }

    // Daten bereinigen und in der Datenbank speichern (bzw. aktualisieren)
    $my_data = sanitize_text_field($_POST['urich_timeline_date_field']);
    update_post_meta($post_id, '_urich_timeline_date', $my_data);
}
add_action('save_post', 'urich_timeline_save_date_data');