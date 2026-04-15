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
                    <?php the_content(); ?>
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
                        $preis_query = new WP_Query(array('post_type' => 'preis_eintrag', 'posts_per_page' => -1, 'orderby' => 'menu_order', 'order' => 'ASC'));
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
                            <?php endwhile; wp_reset_postdata(); 
                        endif; ?>
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
                    $erstattung_query = new WP_Query(array('post_type' => 'erstattung', 'posts_per_page' => -1, 'orderby' => 'menu_order', 'order' => 'ASC'));
                    if ($erstattung_query->have_posts()) : 
                        while ($erstattung_query->have_posts()) : $erstattung_query->the_post(); ?>
                            <div class="insurance-card">
                                <h3><?php the_title(); ?></h3>
                                <div class="card-body">
                                    <?php the_content(); ?>
                                </div>
                            </div>
                        <?php endwhile; wp_reset_postdata(); 
                    endif; ?>
                </div>
            </div>
        </section>

        <section class="pricing-section" style="padding-top: 0;">
            <div class="legal-container">
                <div class="info-card">
                    <h3>Wichtiger Hinweis</h3>
                    <div class="card-body">
                        <p>Sollten Sie einen Termin nicht wahrnehmen können, sagen Sie diesen bitte mindestens 24 Stunden vorher ab. Nicht rechtzeitig abgesagte Termine können in Rechnung gestellt werden.</p>
                    </div>
                </div>
            </div>
        </section>

    <?php endwhile; ?>
</main>

<?php get_footer(); ?>