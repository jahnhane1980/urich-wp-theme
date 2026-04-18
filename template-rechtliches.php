<?php
/**
 * Template Name: Rechtliches (Impressum/Datenschutz)
 */

get_header(); 

// Hole den URL-Namen der aktuellen Seite (z.B. "impressum" oder "datenschutz")
$current_page_slug = get_post_field('post_name', get_post());
?>

<main>
    <section class="info-section">
        <div class="legal-container">
            
            <?php while (have_posts()) : the_post(); ?>
                <h1><?php the_title(); ?></h1>
                
                <?php 
                // Falls du einen kurzen Einleitungstext auf der Seite selbst schreiben möchtest
                if (get_the_content()) {
                    echo '<div class="legal-intro" style="margin-bottom:3rem; text-align:center;">';
                    the_content();
                    echo '</div>';
                }
                ?>
            <?php endwhile; ?>

            <?php 
            // Abfrage: Hole alle Rechts-Blöcke, die in der Kategorie liegen, die genauso heißt wie diese Seite
            $recht_query = new WP_Query(array(
                'post_type'      => 'recht_block',
                'posts_per_page' => -1,
                'orderby'        => 'menu_order', // Steuerung der Reihenfolge über das Attribut im Backend
                'order'          => 'ASC',
                'tax_query'      => array(
                    array(
                        'taxonomy' => 'recht_kategorie',
                        'field'    => 'slug',
                        'terms'    => $current_page_slug, 
                    ),
                ),
            ));

            if ($recht_query->have_posts()) : 
                while ($recht_query->have_posts()) : $recht_query->the_post(); ?>
                    
                    <div class="info-card">
                        <h3><?php the_title(); ?></h3>
                        <div class="card-body">
                            <?php the_content(); ?>
                        </div>
                    </div>

                <?php endwhile; 
                wp_reset_postdata(); 
            else : ?>
                <p style="text-align:center; opacity: 0.6;">Für diesen Bereich wurden noch keine Rechtstexte hinterlegt.</p>
            <?php endif; ?>

        </div>
    </section>
</main>

<?php get_footer(); ?>