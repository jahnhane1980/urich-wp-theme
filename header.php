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
        <img src="<?php echo get_template_directory_uri(); ?>/img/logo.png" alt="<?php bloginfo('name'); ?>" class="logo-img">
    </a>
    
    <input type="checkbox" id="nav-toggle" class="nav-toggle" aria-haspopup="true" aria-expanded="false">
    <label for="nav-toggle" class="nav-toggle-label" aria-label="Menü öffnen" role="button">
        <span aria-hidden="true"></span>
        <span aria-hidden="true"></span>
        <span aria-hidden="true"></span>
    </label>
    
    <?php 
    // Später ersetzen wir das durch wp_nav_menu()
    ?>
    <ul class="nav-links">
        <li><a href="#ueber-mich">Über Mich</a></li>
        <li><a href="#angebote">Angebote</a></li>
        <li><a href="#informationen">Informationen</a></li>
        <li><a href="#kosten">Kosten</a></li>
        <li><a href="#kontakt">Kontakt</a></li>
    </ul>
</nav>