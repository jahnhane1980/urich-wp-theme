<?php
/**
 * Template Name: Angebote Übersicht
 */

get_header(); ?>

<main>
    <?php
    // Der "normale" Loop für die Seite selbst (liefert Titel, Text und Bild für den Header)
    while (have_posts()) : the_post(); ?>
        
        <section class="hero">
            <div class="hero-content">
                <h1><?php the_title(); ?></h1>
                <div class="hero-intro-text">
                    <?php the_content(); ?>
                </div>
            </div>
            <div class="hero-image">
                <?php if (has_post_thumbnail()) : ?>
                    <?php the_post_thumbnail('full', array('class' => 'img-hero-style')); ?>
                <?php else : ?>
                    <img src="<?php echo get_template_directory_uri(); ?>/img/praxis-urich.jpg" alt="<?php the_title(); ?>" class="img-hero-style">
                <?php endif; ?>
            </div>
        </section>

    <?php endwhile; ?>

    <section id="angebots-grid" class="services">
        <div class="grid">
            <?php 
            // Abfrage der einzelnen Angebote (CPT leistung)
            $args = array(
                'post_type'      => 'leistung',
                'posts_per_page' => -1, // Zeigt alle vorhandenen Angebote an
                'orderby'        => 'menu_order', // Falls du eine Reihenfolge festlegen willst
                'order'          => 'ASC'
            );
            $angebote_query = new WP_Query($args);

            if ($angebote_query->have_posts()) : 
                while ($angebote_query->have_posts()) : $angebote_query->the_post(); ?>
                    
                    <div class="card">
                        <?php if (has_post_thumbnail()) : ?>
                            <?php the_post_thumbnail('full', array('class' => 'card-img', 'loading' => 'lazy')); ?>
                        <?php endif; ?>
                        <div class="card-content">
                            <h3><?php the_title(); ?></h3>
                            <?php the_content(); ?>
                        </div>
                    </div>

                <?php endwhile;
                wp_reset_postdata(); // Wichtig, um den Haupt-Loop nicht zu stören
            else : ?>
                <p style="grid-column: 1/-1; text-align: center; opacity: 0.6;">
                    Aktuell sind keine speziellen Angebote hinterlegt.
                </p>
            <?php endif; ?>
        </div>
    </section>
</main>

<?php get_footer(); ?>