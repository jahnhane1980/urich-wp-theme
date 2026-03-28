<?php get_header(); ?>

<main>
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <div class="container" style="padding: 8rem 7%;">
                <?php if (!is_front_page()) : ?>
                    <h1><?php the_title(); ?></h1>
                <?php endif; ?>
                
                <div class="entry-content">
                    <?php the_content(); ?>
                </div>
            </div>
        </article>
    <?php endwhile; else : ?>
        <p><?php _e('Keine Inhalte gefunden.', 'urich-theme'); ?></p>
    <?php endif; ?>
</main>

<?php get_footer(); ?>