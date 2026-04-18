<?php get_header(); ?>

<main>
    <section class="hero">
        <div class="hero-content">
            <h1><?php echo get_theme_mod('urich_hero_title', 'Bewegung ist <span>Leben</span>.'); ?></h1>
            <p><?php echo get_theme_mod('urich_hero_text', 'Erleben Sie eine Therapie, die nicht nur Symptome behandelt, sondern die Ursachen Ihrer Beschwerden tiefgreifend versteht.'); ?></p>
            <a href="<?php echo esc_url(get_theme_mod('urich_hero_btn_link', 'https://www.appointmed.com/booking/2393840-andreas-urich-osteopathie-und-private-physiotherapie')); ?>" class="btn-submit" target="_blank">Termin vereinbaren</a>
        </div>
        <div class="hero-image">
            <img src="<?php echo get_template_directory_uri(); ?>/img/praxis-urich.jpg" alt="<?php bloginfo('name'); ?>" class="img-hero-style">
        </div>
    </section>

    <section id="leistungen" class="services">
        <h2>Spezialisierungen</h2>
        <div class="grid">
            <?php 
            // Abfrage der Leistungen
            $args = array(
                'post_type'      => 'leistung',
                'posts_per_page' => 3, // Zeigt die ersten 3 Leistungen an
                'orderby'        => 'date',
                'order'          => 'ASC'
            );
            $leistungen_query = new WP_Query($args);

            if ($leistungen_query->have_posts()) : 
                while ($leistungen_query->have_posts()) : $leistungen_query->the_post(); ?>
                    
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
                wp_reset_postdata();
            else : ?>
                <p>Noch keine Leistungen angelegt.</p>
            <?php endif; ?>
        </div>
    </section>

    </main>

<?php get_footer(); ?>