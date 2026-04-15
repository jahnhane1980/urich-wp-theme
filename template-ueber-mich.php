<?php
/**
 * Template Name: Über Mich
 */

get_header(); ?>

<main>
    <?php while (have_posts()) : the_post(); ?>
        
        <div class="about-container">
            <aside class="profile-side">
                <?php if (has_post_thumbnail()) : ?>
                    <?php the_post_thumbnail('full', array('class' => 'profile-img')); ?>
                <?php else : ?>
                    <img src="<?php echo get_template_directory_uri(); ?>/img/praxis-urich.jpg" alt="<?php the_title(); ?>" class="profile-img">
                <?php endif; ?>

                <h1>
                    <?php 
                    $title = get_the_title();
                    // Optional: Den Nachnamen in ein Span packen für das Styling
                    $title_parts = explode(' ', $title);
                    if (count($title_parts) > 1) {
                        $last_name = array_pop($title_parts);
                        echo implode(' ', $title_parts) . ' <span>' . $last_name . '</span>';
                    } else {
                        echo $title;
                    }
                    ?>
                </h1>
                
                <div class="profile-text">
                    <?php the_content(); ?>
                </div>
            </aside>

            <div class="timeline-container">
                
                <?php 
                $timeline_query = new WP_Query(array(
                    'post_type'      => 'timeline',
                    'posts_per_page' => -1,
                    'orderby'        => 'menu_order', // Falls Reihenfolge über Attribute gesteuert wird
                    'order'          => 'ASC'
                ));

                if ($timeline_query->have_posts()) : 
                    while ($timeline_query->have_posts()) : $timeline_query->the_post(); 
                        
                        // Das neue Meta-Feld abrufen
                        $station_date = get_post_meta(get_the_ID(), '_urich_timeline_date', true);
                        ?>
                        
                        <div class="cv-item">
                            <?php if ($station_date) : ?>
                                <span class="cv-date"><?php echo esc_html($station_date); ?></span>
                            <?php endif; ?>
                            
                            <h3><?php the_title(); ?></h3>
                            
                            <div class="cv-content">
                                <?php the_content(); ?>
                            </div>
                        </div>

                    <?php endwhile; 
                    wp_reset_postdata(); 
                else : ?>
                    <p style="opacity: 0.5;">Noch keine Stationen im Lebenslauf hinterlegt.</p>
                <?php endif; ?>

            </div>
        </div>

    <?php endwhile; ?>
</main>

<?php get_footer(); ?>