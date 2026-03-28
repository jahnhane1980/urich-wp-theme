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
        // Prüfen, ob ein Custom Logo gesetzt wurde, sonst Fallback auf Standard-Bild
        if ( has_custom_logo() ) {
            $custom_logo_id = get_theme_mod( 'custom-logo' );
            $logo = wp_get_attachment_image_src( $custom_logo_id , 'full' );
            echo '<img src="' . esc_url( $logo[0] ) . '" alt="' . get_bloginfo( 'name' ) . '" class="logo-img">';
        } else {
            echo '<img src="' . get_template_directory_uri() . '/img/logo.png" alt="' . get_bloginfo('name') . '" class="logo-img">';
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
    // Dynamisches Hauptmenü aus WordPress
    wp_nav_menu( array(
        'theme_location' => 'primary',
        'menu_class'     => 'nav-links',
        'container'      => false,
        'fallback_cb'    => false,
    ) );
    ?>
</nav>