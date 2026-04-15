<?php
/**
 * Template Name: Rechtliches (Impressum/Datenschutz)
 */

get_header(); ?>

<main>
    <div class="legal-container" style="padding: 8rem 7% 4rem;">
        <?php while (have_posts()) : the_post(); ?>
            
            <h1><?php the_title(); ?></h1>

            <div class="info-card">
                <div class="card-body">
                    <?php 
                    // Der normale WordPress-Editor liefert den Text
                    the_content(); 
                    ?>
                </div>
            </div>

        <?php endwhile; ?>
    </div>
</main>

<?php get_footer(); ?>