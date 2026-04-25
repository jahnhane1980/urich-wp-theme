<?php
/**
 * Urich Theme Functions
 */

function urich_theme_scripts() {
    // Google Fonts externe Einbindung ENTFERNT (DSGVO-konform über lokale Dateien in style-theme.css gelöst)

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

// Customizer Einstellungen für die Startseite (Hero) und Header
function urich_customize_register( $wp_customize ) {
    
    // --- Startseite Hero ---
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

    // --- NEU: Header & Logos ---
    $wp_customize->add_section( 'urich_header_section' , array(
        'title'      => __( 'Header & Logos', 'urich-theme' ),
        'priority'   => 31,
    ) );

    $wp_customize->add_setting( 'urich_logo_text' , array(
        'default'   => 'Osteopathie Andreas Urich',
        'transport' => 'refresh',
    ) );
    $wp_customize->add_control( 'urich_logo_text_control', array(
        'label'    => __( 'Text neben dem Logo', 'urich-theme' ),
        'section'  => 'urich_header_section',
        'settings' => 'urich_logo_text',
        'type'     => 'text',
    ) );

    $wp_customize->add_setting( 'urich_second_logo' , array(
        'default'   => get_template_directory_uri() . '/img/VOD_Logo_sw_crop.png',
        'transport' => 'refresh',
    ) );
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'urich_second_logo_control', array(
        'label'    => __( 'Zweites Logo (rechts)', 'urich-theme' ),
        'section'  => 'urich_header_section',
        'settings' => 'urich_second_logo',
    ) ) );
}
add_action( 'customize_register', 'urich_customize_register' );

/**
 * CPTs Registrierungen (Angebote, Lebenslauf, Preise, Erstattung, Info-Karten)
 */
function urich_register_all_cpts() {
    // Angebote
    register_post_type('leistung', array(
        'labels' => array('name' => 'Angebote', 'singular_name' => 'Angebot', 'menu_name' => 'Angebote'),
        'public' => true, 'show_in_menu' => true, 'menu_icon' => 'dashicons-heart', 
        'supports' => array('title', 'editor', 'thumbnail'), 'show_in_rest' => true, 'publicly_queryable' => false,
    ));

    // Lebenslauf
    register_post_type('timeline', array(
        'labels' => array('name' => 'Lebenslauf', 'singular_name' => 'Station', 'menu_name' => 'Lebenslauf'),
        'public' => true, 'show_in_menu' => true, 'menu_icon' => 'dashicons-calendar-alt', 
        'supports' => array('title', 'editor'), 'show_in_rest' => true, 'publicly_queryable' => false,
    ));

    // Preise
    register_post_type('preis_eintrag', array(
        'labels' => array('name' => 'Preise', 'singular_name' => 'Preiseintrag', 'menu_name' => 'Preise'),
        'public' => true, 'show_in_menu' => true, 'menu_icon' => 'dashicons-money-alt', 
        'supports' => array('title'), 'show_in_rest' => true,
    ));

    // Erstattung
    register_post_type('erstattung', array(
        'labels' => array('name' => 'Erstattungstexte', 'singular_name' => 'Erstattung Info', 'menu_name' => 'Erstattung'),
        'public' => true, 'show_in_menu' => true, 'menu_icon' => 'dashicons-info', 
        'supports' => array('title', 'editor'), 'show_in_rest' => true,
    ));

    // Info-Karten
    register_post_type('info_karte', array(
        'labels' => array('name' => 'Info-Karten', 'singular_name' => 'Info-Karte', 'menu_name' => 'Info-Karten'),
        'public' => true, 'show_in_menu' => true, 'menu_icon' => 'dashicons-info-outline', 
        'supports' => array('title', 'editor', 'page-attributes'), 'show_in_rest' => true,
    ));

    // NEU: Rechtstexte (Impressum / Datenschutz)
    register_taxonomy('recht_kategorie', array('recht_block'), array(
        'hierarchical'      => true,
        'labels'            => array('name' => 'Kategorien (z.B. Impressum)', 'singular_name' => 'Kategorie'),
        'show_ui'           => true,
        'show_admin_column' => true,
        'show_in_rest'      => true, 
    ));

    register_post_type('recht_block', array(
        'labels' => array('name' => 'Rechtstexte', 'singular_name' => 'Rechts-Block', 'menu_name' => 'Rechtstexte'),
        'public' => false, 'show_ui' => true, 'show_in_menu' => true, 'menu_icon' => 'dashicons-portfolio', 
        'supports' => array('title', 'editor', 'page-attributes'), 'show_in_rest' => true,
    ));
}
add_action('init', 'urich_register_all_cpts');

/**
 * BEDINGTE Meta-Boxen
 */
function urich_conditional_meta_boxes($post_type, $post) {
    if ($post_type === 'page' && $post) {
        $template = get_post_meta($post->ID, '_wp_page_template', true);
        if ($template === 'template-kosten.php') {
            add_meta_box('urich_page_hinweis_meta', 'Wichtiger Hinweis (Block am Seitenende)', 'urich_page_hinweis_callback', 'page', 'normal', 'high');
        }
        if ($template === 'template-informationen.php') {
            add_meta_box('urich_page_map_meta', 'Adresse für Google Maps', 'urich_page_map_callback', 'page', 'normal', 'high');
        }
    }
}
add_action('add_meta_boxes', 'urich_conditional_meta_boxes', 10, 2);

function urich_page_hinweis_callback($post) {
    wp_nonce_field('urich_save_page_hinweis', 'urich_page_hinweis_nonce');
    $hinweis = get_post_meta($post->ID, '_urich_page_hinweis', true);
    echo '<label style="display:block; margin-bottom:5px;">Text für den Wichtigen Hinweis:</label>';
    echo '<textarea name="urich_page_hinweis_field" style="width:100%; height:100px;">' . esc_textarea($hinweis) . '</textarea>';
}
function urich_save_page_hinweis($post_id) {
    if (!isset($_POST['urich_page_hinweis_nonce']) || !wp_verify_nonce($_POST['urich_page_hinweis_nonce'], 'urich_save_page_hinweis')) return;
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (isset($_POST['urich_page_hinweis_field'])) update_post_meta($post_id, '_urich_page_hinweis', wp_kses_post($_POST['urich_page_hinweis_field']));
}
add_action('save_post', 'urich_save_page_hinweis');

function urich_page_map_callback($post) {
    wp_nonce_field('urich_save_page_map', 'urich_page_map_nonce');
    $adresse = get_post_meta($post->ID, '_urich_page_map_adresse', true);
    echo '<label style="display:block; margin-bottom:5px;">Vollständige Adresse:</label>';
    echo '<input type="text" name="urich_page_map_adresse" value="' . esc_attr($adresse) . '" style="width:100%;">';
}
function urich_save_page_map($post_id) {
    if (!isset($_POST['urich_page_map_nonce']) || !wp_verify_nonce($_POST['urich_page_map_nonce'], 'urich_save_page_map')) return;
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (isset($_POST['urich_page_map_adresse'])) update_post_meta($post_id, '_urich_page_map_adresse', sanitize_text_field($_POST['urich_page_map_adresse']));
}
add_action('save_post', 'urich_save_page_map');

/**
 * Meta-Boxen für Lebenslauf & Preise
 */
function urich_standard_meta_boxes() {
    add_meta_box('urich_timeline_date_meta', 'Zeitraum', 'urich_timeline_date_callback', 'timeline', 'normal', 'high');
    add_meta_box('urich_preis_details', 'Preis-Details', 'urich_preis_callback', 'preis_eintrag', 'normal', 'high');
}
add_action('add_meta_boxes', 'urich_standard_meta_boxes');

function urich_timeline_date_callback($post) {
    wp_nonce_field('urich_timeline_save_date_data', 'urich_timeline_date_meta_nonce');
    $value = get_post_meta($post->ID, '_urich_timeline_date', true);
    echo '<label style="display:block; margin-bottom:5px;">Zeitraum (z.B. "2015 - 2019"):</label>';
    echo '<input type="text" name="urich_timeline_date_field" value="' . esc_attr($value) . '" style="width:100%;" />';
}
function urich_timeline_save_date_data($post_id) {
    if (!isset($_POST['urich_timeline_date_meta_nonce']) || !wp_verify_nonce($_POST['urich_timeline_date_meta_nonce'], 'urich_timeline_save_date_data')) return;
    if (isset($_POST['urich_timeline_date_field'])) update_post_meta($post_id, '_urich_timeline_date', sanitize_text_field($_POST['urich_timeline_date_field']));
}
add_action('save_post', 'urich_timeline_save_date_data');

function urich_preis_callback($post) {
    wp_nonce_field('urich_save_preis_meta', 'urich_preis_nonce');
    $dauer = get_post_meta($post->ID, '_preis_dauer', true);
    $betrag = get_post_meta($post->ID, '_preis_betrag', true);
    echo '<p><label>Dauer:</label><br><input type="text" name="preis_dauer" value="' . esc_attr($dauer) . '" class="widefat"></p>';
    echo '<p><label>Preis:</label><br><input type="text" name="preis_betrag" value="' . esc_attr($betrag) . '" class="widefat"></p>';
}
function urich_save_preis_meta($post_id) {
    if (!isset($_POST['urich_preis_nonce']) || !wp_verify_nonce($_POST['urich_preis_nonce'], 'urich_save_preis_meta')) return;
    if (isset($_POST['preis_dauer'])) update_post_meta($post_id, '_preis_dauer', sanitize_text_field($_POST['preis_dauer']));
    if (isset($_POST['preis_betrag'])) update_post_meta($post_id, '_preis_betrag', sanitize_text_field($_POST['preis_betrag']));
}
add_action('save_post', 'urich_save_preis_meta');


/* ==========================================================================
   RECHTSTEXTE: SORTIERUNG, FILTERUNG & DRAG AND DROP (V3)
   ========================================================================== */

/**
 * 1. Spalten definieren (Kategorie-Spalte sortierbar machen)
 */
function urich_recht_block_columns($columns) {
    $columns['menu_order'] = 'Reihenfolge';
    return $columns;
}
add_filter('manage_recht_block_posts_columns', 'urich_recht_block_columns');

function urich_recht_block_column_content($column, $post_id) {
    if ($column === 'menu_order') {
        $order = get_post_field('menu_order', $post_id);
        echo '<strong>' . $order . '</strong>';
        echo '<span class="drag-handle dashicons dashicons-menu" style="cursor:move; margin-left:10px; color:#999; font-size:20px;"></span>';
    }
}
add_action('manage_recht_block_posts_custom_column', 'urich_recht_block_column_content', 10, 2);

function urich_recht_block_sortable_columns($columns) {
    $columns['menu_order'] = 'menu_order';
    $columns['taxonomy-recht_kategorie'] = 'taxonomy-recht_kategorie'; // Jetzt nach Kategorie sortierbar!
    return $columns;
}
add_filter('manage_edit-recht_block_sortable_columns', 'urich_recht_block_sortable_columns');

/**
 * 2. Kategorie-Filter (Dropdown) über der Liste hinzufügen
 */
function urich_recht_block_filter_list() {
    global $typenow;
    if ($typenow == 'recht_block') {
        $taxonomy = 'recht_kategorie';
        wp_dropdown_categories(array(
            'show_option_all' => 'Alle Kategorien anzeigen',
            'taxonomy'        => $taxonomy,
            'name'            => $taxonomy,
            'orderby'         => 'name',
            'selected'        => (isset($_GET[$taxonomy])) ? $_GET[$taxonomy] : '',
            'hierarchical'    => true,
            'depth'           => 3,
            'show_count'      => true,
            'hide_empty'      => false,
        ));
    }
}
add_action('restrict_manage_posts', 'urich_recht_block_filter_list');

/**
 * 3. Drag & Drop Scripte (Vollständiger Fix für Sichtbarkeit & Funktionalität)
 */
function urich_recht_block_order_scripts($hook) {
    global $post_type;
    if ($hook == 'edit.php' && $post_type == 'recht_block') {
        wp_enqueue_script('jquery-ui-sortable');
        
        ?>
        <script type="text/javascript">
            jQuery(document).ready(function($) {
                var $list = $('#the-list');

                if($list.length > 0) {
                    $list.sortable({
                        items: 'tr',
                        cursor: 'move',
                        handle: '.drag-handle', // Greift nur am Icon
                        placeholder: 'ui-state-highlight',
                        axis: 'y',
                        helper: function(e, ui) {
                            ui.children().each(function() {
                                $(this).width($(this).width());
                            });
                            return ui;
                        },
                        start: function(e, ui) {
                            ui.placeholder.height(ui.item.height());
                        },
                        update: function(event, ui) {
                            var post_ids = [];
                            $list.find('tr').each(function(){
                                var id_attr = $(this).attr('id');
                                if(id_attr) {
                                    post_ids.push(id_attr.replace('post-', ''));
                                }
                            });

                            $.ajax({
                                url: ajaxurl,
                                type: 'POST',
                                data: {
                                    action: 'urich_update_recht_order',
                                    post_ids: post_ids
                                },
                                success: function(response) {
                                    ui.item.children('td').css('background-color', '#fff9e6').animate({
                                        backgroundColor: '#ffffff'
                                    }, 800);
                                }
                            });
                        }
                    });
                }

                // CSS für den Griff und den Platzhalter
                $("<style>")
                    .prop("type", "text/css")
                    .html(
                        ".drag-handle:hover { color: #f38400 !important; transform: scale(1.2); transition: 0.2s; }" +
                        ".ui-state-highlight { background: #e6f0ff !important; border: 2px dashed #f38400 !important; visibility: visible !important; display: table-row !important; }" +
                        ".wp-list-table .ui-sortable-helper { background: #fff; box-shadow: 0 5px 20px rgba(0,0,0,0.1); display: table !important; }"
                    )
                    .appendTo("head");
            });
        </script>
        <?php
    }
}
add_action('admin_enqueue_scripts', 'urich_recht_block_order_scripts');

/**
 * 4. Ajax Handler zum Speichern
 */
function urich_save_recht_block_order() {
    if (!isset($_POST['post_ids']) || !current_user_can('edit_posts')) {
        wp_send_json_error();
    }
    $post_ids = $_POST['post_ids'];
    $menu_order = 0;
    foreach ($post_ids as $id) {
        wp_update_post(array('ID' => intval($id), 'menu_order' => $menu_order));
        $menu_order++;
    }
    wp_send_json_success();
}
add_action('wp_ajax_urich_update_recht_order', 'urich_save_recht_block_order');