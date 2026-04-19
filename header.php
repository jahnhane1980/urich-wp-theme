<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php wp_title('|', true, 'right'); ?><?php bloginfo('name'); ?></title>
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<nav>
    <a href="<?php echo esc_url(home_url('/')); ?>" class="logo-container">
        <?php 
        // 1. Hauptlogo
        if ( has_custom_logo() ) {
            $custom_logo_id = get_theme_mod( 'custom-logo' );
            $logo_data = wp_get_attachment_image_src( $custom_logo_id , 'full' );
            
            if ( $logo_data ) {
                echo '<img src="' . esc_url( $logo_data[0] ) . '" alt="' . get_bloginfo( 'name' ) . '" class="logo-img">';
            } else {
                echo '<img src="' . get_template_directory_uri() . '/img/logo.png" alt="' . get_bloginfo('name') . '" class="logo-img">';
            }
        } else {
            echo '<img src="' . get_template_directory_uri() . '/img/logo.png" alt="' . get_bloginfo('name') . '" class="logo-img">';
        }

        // 2. Logo Text (Neu)
        $urich_logo_text = get_theme_mod('urich_logo_text', 'Osteopathie Andreas Urich');
        if ( !empty($urich_logo_text) ) {
            echo '<span class="logo-text">' . esc_html($urich_logo_text) . '</span>';
        }

        // 3. Zweites Logo (Neu)
        $urich_second_logo = get_theme_mod('urich_second_logo', get_template_directory_uri() . '/img/VOD_Logo_sw_crop.png');
        if ( !empty($urich_second_logo) ) {
            echo '<img src="' . esc_url($urich_second_logo) . '" alt="Zweites Logo" class="logo-secondary">';
        }
        ?>
    </a>
    
    <input type="checkbox" id="nav-toggle" class="nav-toggle" aria-haspopup="true" aria-expanded="false">
    <label for="nav-toggle" class="nav-toggle-label" aria-label="Menü öffnen" role="button">
        <span aria-hidden="true"></span>
        <span aria-hidden="true"></span>
        <span aria-hidden="true"></span>
    </label>
    
    <?php 
    wp_nav_menu( array(
        'theme_location' => 'primary',
        'menu_class'     => 'nav-links',
        'container'      => false,
        'fallback_cb'    => false,
    ) );
    ?>
</nav>