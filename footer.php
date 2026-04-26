<section id="kontakt" class="contact">
    <div class="contact-container">
        <h2>Persönliche Anfrage</h2>
        <?php 
        echo do_shortcode('[contact-form-7 id="33" title="Kontaktformular 1"]'); 
        ?>
    </div>
</section>

<footer>
    <div class="footer-grid">
        <?php if ( is_active_sidebar( 'footer-1' ) ) : ?>
            <?php dynamic_sidebar( 'footer-1' ); ?>
        <?php else : ?>
            <div>
                <h4 class="footer-title">Footer Links</h4>
                <p>Bitte fügen Sie unter <em>Design &gt; Widgets</em> ein Widget in den Bereich <strong>"Footer Links"</strong> ein.</p>
            </div>
        <?php endif; ?>

        <?php if ( is_active_sidebar( 'footer-2' ) ) : ?>
            <?php dynamic_sidebar( 'footer-2' ); ?>
        <?php else : ?>
            <div>
                <h4 class="footer-title">Footer Rechts</h4>
                <p>Bitte fügen Sie unter <em>Design &gt; Widgets</em> ein Widget in den Bereich <strong>"Footer Rechts"</strong> ein.</p>
            </div>
        <?php endif; ?>
    </div>
    
    <div class="footer-bottom">
        <p>&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?></p>
        <div class="footer-nav">
            <?php 
            wp_nav_menu( array(
                'theme_location' => 'footer',
                'container'      => false,
                'menu_class'     => 'footer-links-container',
                'fallback_cb'    => false,
                'depth'          => 1,
            ) );
            ?>
        </div>
    </div>
</footer>

<script>
    const navToggle = document.getElementById('nav-toggle');
    const navToggleLabel = document.querySelector('.nav-toggle-label');

    if (navToggle) {
        navToggle.addEventListener('change', function() {
            if (this.checked) {
                navToggle.setAttribute('aria-expanded', 'true');
                navToggleLabel.setAttribute('aria-label', 'Menü schließen');
            } else {
                navToggle.setAttribute('aria-expanded', 'false');
                navToggleLabel.setAttribute('aria-label', 'Menü öffnen');
            }
        });
    }
</script>

<?php wp_footer(); ?>
</body>
</html>