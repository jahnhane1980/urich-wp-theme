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
                // Wandelt die Adresse in ein URL-konformes Format für Google Maps um
                $map_url = 'https://maps.google.com/maps?q=' . urlencode($adresse) . '&t=m&z=15&output=embed&iwloc=near';
            ?>
                <div class="map-container">
                    <iframe src="<?php echo esc_url($map_url); ?>" allowfullscreen="" loading="lazy"></iframe>
                </div>
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
                            <div class="card-body">
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