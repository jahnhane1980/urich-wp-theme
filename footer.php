<footer>
    <div class="footer-grid">
        <?php if ( is_active_sidebar( 'footer-1' ) ) : ?>
            <?php dynamic_sidebar( 'footer-1' ); ?>
        <?php else : ?>
            <div>
                <h4 class="footer-title">Andreas Urich</h4>
                <p>Praxis für Osteopathie<br>Industriestraße 9<br>97241 Bergtheim</p>
            </div>
        <?php endif; ?>

        <?php if ( is_active_sidebar( 'footer-2' ) ) : ?>
            <?php dynamic_sidebar( 'footer-2' ); ?>
        <?php else : ?>
            <div>
                <h4 class="footer-title">Kontakt</h4>
                <p>E-Mail: <?php echo antispambot('info@osteopathie-urich.de'); ?><br>Tel: 0123 / 456 789</p>
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