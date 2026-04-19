<?php
/**
 * Template Name: Informationen & Anfahrt
 */

get_header(); ?>

<main>
    <?php while (have_posts()) : the_post(); ?>
        
        <section class="info-section">
            <?php 
            // Abrufen der Adresse aus dem Meta-Feld
            $adresse = get_post_meta(get_the_ID(), '_urich_page_map_adresse', true);
            
            if (!empty($adresse)) : 
                // Link für Google Maps Routenplaner
                $google_maps_link = 'https://www.google.com/maps/dir/?api=1&destination=' . urlencode($adresse);
            ?>
                <div class="map-container">
                    <a href="<?php echo esc_url($google_maps_link); ?>" target="_blank" rel="noopener" class="map-link">
                        <img src="<?php echo get_template_directory_uri(); ?>/img/map-placeholder.jpg" alt="Anfahrt Andreas Urich Osteopathie" class="map-static-img">
                        <div class="map-button-overlay">
                            <span class="btn-submit">Route auf Google Maps planen</span>
                        </div>
                    </a>
                </div>
                <p class="map-hint">
                    Hinweis: Beim Klicken auf die Karte werden Sie zu Google Maps weitergeleitet. 
                    Dabei gelten die <a href="https://policies.google.com/privacy" target="_blank" rel="noopener">Datenschutzbestimmungen von Google</a>.
                </p>
            <?php endif; ?>
            
            <div class="arrival-description">
                <h2><?php the_title(); ?></h2>
                <?php the_content(); ?>
            </div>
        </section>

        <section class="services" style="padding-top: 0;">
            <div class="grid">
                <?php 
                $info_query = new WP_Query(array(
                    'post_type'      => 'info_karte', 
                    'posts_per_page' => -1, 
                    'orderby'        => 'menu_order', 
                    'order'          => 'ASC'
                ));
                
                if ($info_query->have_posts()) : 
                    while ($info_query->have_posts()) : $info_query->the_post(); ?>
                        
                        <div class="card">
                            <div class="card-content">
                                <h3><?php the_title(); ?></h3>
                                <?php the_content(); ?>
                            </div>
                        </div>

                    <?php endwhile; 
                    wp_reset_postdata(); 
                else : ?>
                    <p style="grid-column: 1/-1; text-align: center; opacity: 0.6;">
                        Aktuell sind keine Informationskarten hinterlegt.
                    </p>
                <?php endif; ?>
            </div>
        </section>

    <?php endwhile; ?>
</main>

<?php get_footer(); ?>
