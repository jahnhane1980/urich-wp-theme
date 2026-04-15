<?php
/**
 * Template Name: Über Mich
 */
get_header(); ?>

<main>
    <?php while (have_posts()) : the_post(); ?>
        <section class="hero">
            <div class="hero-content">
                <h1><?php the_title(); ?></h1>
                <div class="hero-intro-text">
                    <?php the_content(); ?>
                </div>
            </div>
            <div class="hero-image">
                <?php if (has_post_thumbnail()) : the_post_thumbnail('full', array('class' => 'img-hero-style')); endif; ?>
            </div>
        </section>
    <?php endwhile; ?>

    <section class="timeline-section">
        <div class="contact-container">
            <h2 style="text-align:center; margin-bottom: 4rem; color: var(--color-secondary);">Mein Werdegang</h2>
            
            <div class="timeline">
                <?php 
                $timeline_query = new WP_Query(array('post_type' => 'timeline', 'posts_per_page' => -1, 'order' => 'ASC'));
                if ($timeline_query->have_posts()) : 
                    while ($timeline_query->have_posts()) : $timeline_query->the_post(); ?>
                        <div class="timeline-item">
                            <div class="timeline-date"><?php the_title(); ?></div>
                            <div class="timeline-content">
                                <?php the_content(); ?>
                            </div>
                        </div>
                    <?php endwhile; wp_reset_postdata(); 
                endif; ?>
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>