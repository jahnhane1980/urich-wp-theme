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

// Customizer Einstellungen für die Startseite (Hero)
function urich_customize_register( $wp_customize ) {
    $wp_customize->add_section( 'urich_hero_section' , array(
        'title'      => __( 'Startseite Hero', 'urich-theme' ),
        'priority'   => 30,
    ) );

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
 * CPT "Leistung" (Angebote)
 */
function urich_register_leistungen_cpt() {
    $labels = array('name' => 'Angebote', 'singular_name' => 'Angebot', 'menu_name' => 'Angebote');
    $args = array(
        'labels' => $labels, 'public' => true, 'show_in_menu' => true,
        'menu_icon' => 'dashicons-heart', 'supports' => array('title', 'editor', 'thumbnail'),
        'show_in_rest' => true,
    );
    register_post_type('leistung', $args);
}
add_action('init', 'urich_register_leistungen_cpt');

/**
 * CPT "Lebenslauf" (timeline)
 */
function urich_register_timeline_cpt() {
    $labels = array('name' => 'Lebenslauf', 'singular_name' => 'Station', 'menu_name' => 'Lebenslauf');
    $args = array(
        'labels' => $labels, 'public' => true, 'show_in_menu' => true,
        'menu_icon' => 'dashicons-calendar-alt', 'supports' => array('title', 'editor'),
        'show_in_rest' => true,
    );
    register_post_type('timeline', $args);
}
add_action('init', 'urich_register_timeline_cpt');

/**
 * CPT "Preise" (preis_eintrag) für die Kosten-Tabelle
 */
function urich_register_preis_cpt() {
    $labels = array('name' => 'Preise', 'singular_name' => 'Preiseintrag', 'menu_name' => 'Preise');
    $args = array(
        'labels' => $labels, 'public' => true, 'show_in_menu' => true,
        'menu_icon' => 'dashicons-money-alt', 'supports' => array('title'), 
        'show_in_rest' => true,
    );
    register_post_type('preis_eintrag', $args);
}
add_action('init', 'urich_register_preis_cpt');

/**
 * Meta Boxen für Preise (Dauer & Betrag)
 */
function urich_preis_add_meta_boxes() {
    add_meta_box('urich_preis_details', 'Preis-Details', 'urich_preis_callback', 'preis_eintrag', 'normal', 'high');
}
add_action('add_meta_boxes', 'urich_preis_add_meta_boxes');

function urich_preis_callback($post) {
    wp_nonce_field('urich_save_preis_meta', 'urich_preis_nonce');
    $dauer = get_post_meta($post->ID, '_preis_dauer', true);
    $betrag = get_post_meta($post->ID, '_preis_betrag', true);
    ?>
    <p><label>Dauer (z.B. "ca. 60 Min"):</label><br><input type="text" name="preis_dauer" value="<?php echo esc_attr($dauer); ?>" class="widefat"></p>
    <p><label>Preis (z.B. "90,00 €"):</label><br><input type="text" name="preis_betrag" value="<?php echo esc_attr($betrag); ?>" class="widefat"></p>
    <?php
}

function urich_save_preis_meta($post_id) {
    if (!isset($_POST['urich_preis_nonce']) || !wp_verify_nonce($_POST['urich_preis_nonce'], 'urich_save_preis_meta')) return;
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (isset($_POST['preis_dauer'])) update_post_meta($post_id, '_preis_dauer', sanitize_text_field($_POST['preis_dauer']));
    if (isset($_POST['preis_betrag'])) update_post_meta($post_id, '_preis_betrag', sanitize_text_field($_POST['preis_betrag']));
}
add_action('save_post', 'urich_save_preis_meta');

/**
 * CPT "Kostenerstattung" (erstattung) für die Infokarten
 */
function urich_register_erstattung_cpt() {
    $labels = array('name' => 'Erstattungstexte', 'singular_name' => 'Erstattung Info', 'menu_name' => 'Erstattung');
    $args = array(
        'labels' => $labels, 'public' => true, 'show_in_menu' => true,
        'menu_icon' => 'dashicons-info', 'supports' => array('title', 'editor'),
        'show_in_rest' => true,
    );
    register_post_type('erstattung', $args);
}
add_action('init', 'urich_register_erstattung_cpt');