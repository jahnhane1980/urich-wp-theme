<?php
/**
 * Template Name: Kosten & Abrechnung
 */

get_header(); ?>

<main>
    <?php while (have_posts()) : the_post(); ?>
        
        <section class="pricing-section">
            <div class="pricing-content">
                <h1><?php the_title(); ?></h1>
                
                <div class="intro-text">
                    <?php 
                    if ( get_the_content() ) {
                        the_content(); 
                    } else {
                        echo '<p>Transparenz ist mir wichtig. Hier finden Sie eine Übersicht der Behandlungskosten.</p>';
                    }
                    ?>
                </div>
                
                <table class="price-table">
                    <thead>
                        <tr>
                            <th>Leistung</th>
                            <th>Dauer</th>
                            <th>Preis</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $preis_query = new WP_Query(array(
                            'post_type'      => 'preis_eintrag', 
                            'posts_per_page' => -1, 
                            'orderby'        => 'menu_order', 
                            'order'          => 'ASC'
                        ));
                        
                        if ($preis_query->have_posts()) : 
                            while ($preis_query->have_posts()) : $preis_query->the_post(); 
                                $dauer = get_post_meta(get_the_ID(), '_preis_dauer', true);
                                $betrag = get_post_meta(get_the_ID(), '_preis_betrag', true);
                                ?>
                                <tr>
                                    <td><?php the_title(); ?></td>
                                    <td><?php echo esc_html($dauer); ?></td>
                                    <td class="price-value"><?php echo esc_html($betrag); ?></td>
                                </tr>
                            <?php endwhile; 
                            wp_reset_postdata(); 
                        else : ?>
                            <tr>
                                <td colspan="3">Aktuell sind keine Preise hinterlegt.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
                <p>Die Abrechnung erfolgt auf Grundlage der Gebührenordnung für Heilpraktiker (GebüH).</p>
            </div>
        </section>

        <section class="pricing-section" style="padding-top: 0;">
            <div class="pricing-content">
                <h2>Kostenerstattung</h2>
                <div class="insurance-grid">
                    <?php 
                    $erstattung_query = new WP_Query(array(
                        'post_type'      => 'erstattung', 
                        'posts_per_page' => -1, 
                        'orderby'        => 'menu_order', 
                        'order'          => 'ASC'
                    ));
                    
                    if ($erstattung_query->have_posts()) : 
                        while ($erstattung_query->have_posts()) : $erstattung_query->the_post(); ?>
                            <div class="insurance-card">
                                <h3><?php the_title(); ?></h3>
                                <div class="card-body">
                                    <?php the_content(); ?>
                                </div>
                            </div>
                        <?php endwhile; 
                        wp_reset_postdata(); 
                    else: ?>
                        <p>Aktuell sind keine Informationen zur Kostenerstattung hinterlegt.</p>
                    <?php endif; ?>
                </div>
            </div>
        </section>

        <?php 
        $wichtiger_hinweis = get_post_meta(get_the_ID(), '_urich_page_hinweis', true);
        if ( !empty($wichtiger_hinweis) ) : 
        ?>
            <section class="pricing-section" style="padding-top: 0;">
                <div class="legal-container">
                    <div class="info-card">
                        <h3>Wichtiger Hinweis</h3>
                        <div class="card-body">
                            <?php 
                            // Erlaubt Umbrüche und wandelt Text in <p> Tags um
                            echo wpautop($wichtiger_hinweis); 
                            ?>
                        </div>
                    </div>
                </div>
            </section>
        <?php endif; ?>

    <?php endwhile; ?>
</main>

<?php get_footer(); ?>