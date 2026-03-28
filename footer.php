<footer>
    <div class="footer-grid">
        <div>
            <h4 class="footer-title">Andreas Urich</h4>
            <p>Praxis für Osteopathie<br>Industriestraße 9<br>97241 Bergtheim</p>
        </div>
        <div>
            <h4 class="footer-title">Kontakt</h4>
            <p>E-Mail: info@osteopathie-urich.de<br>Tel: 0123 / 456 789</p>
        </div>
    </div>
    <div class="footer-bottom">
        <p>&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?></p>
        <p>
            <a href="#impressum" class="footer-link-reset">Impressum</a> | 
            <a href="#datenschutz" class="footer-link-reset">Datenschutz</a>                
        </p>
    </div>
</footer>

<script>
    const navToggle = document.getElementById('nav-toggle');
    const navToggleLabel = document.querySelector('.nav-toggle-label');

    navToggle.addEventListener('change', function() {
        if (this.checked) {
            navToggle.setAttribute('aria-expanded', 'true');
            navToggleLabel.setAttribute('aria-label', 'Menü schließen');
        } else {
            navToggle.setAttribute('aria-expanded', 'false');
            navToggleLabel.setAttribute('aria-label', 'Menü öffnen');
        }
    });
</script>

<?php wp_footer(); ?>
</body>
</html>