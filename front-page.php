<?php get_header(); ?>

<main>
    <section class="hero">
        <div class="hero-content">
            <h1>Bewegung ist <span>Leben</span>.</h1>
            <p>Erleben Sie eine Therapie, die nicht nur Symptome behandelt, sondern die Ursachen Ihrer Beschwerden tiefgreifend versteht.</p>
            <a href="https://www.appointmed.com/" class="btn-submit" target="_blank">Termin vereinbaren</a>
        </div>
        <div class="hero-image">
            <img src="<?php echo get_template_directory_uri(); ?>/img/praxis-urich.jpg" alt="Andreas Urich Osteopathie" class="img-hero-style">
        </div>
    </section>

    <section id="leistungen" class="services">
        <h2>Spezialisierungen</h2>
        <div class="grid">
            <div class="card">
                <img src="<?php echo get_template_directory_uri(); ?>/img/parietale-osteopathie.png" alt="Strukturelle Osteopathie" class="card-img" loading="lazy">
                <div class="card-content">
                    <h3>Strukturell</h3>
                    <p>Präzise Arbeit an Wirbelsäule und Gelenken zur Wiederherstellung Ihrer Mobilität.</p>
                </div>
            </div>
            <div class="card">
                <img src="<?php echo get_template_directory_uri(); ?>/img/viszerale-osteopathie.png" alt="Organische Osteopathie" class="card-img" loading="lazy">
                <div class="card-content">
                    <h3>Organisch</h3>
                    <p>Viszeral-therapeutische Ansätze zur Unterstützung der inneren Vitalfunktionen.</p>
                </div>
            </div>
            <div class="card">
                <img src="<?php echo get_template_directory_uri(); ?>/img/kraniosakrale-osteopathie.png" alt="Neurologische Osteopathie" class="card-img" loading="lazy">
                <div class="card-content">
                    <h3>Neurologisch</h3>
                    <p>Sanfte Techniken zur Entspannung des Nervensystems und Regulation von Stress.</p>
                </div>
            </div>
        </div>
    </section>

    <section id="kontakt" class="contact">
        <div class="contact-container">
            <h2>Persönliche Anfrage</h2>
            <?php 
            /* Platzhalter für Plugin (z.B. Contact Form 7). 
               Im fertigen Theme würde hier stehen: 
               echo do_shortcode('[contact-form-7 id="123" title="Kontakt"]'); 
            */
            ?>
            <p style="text-align:center; opacity:0.7;">[Hier wird das Kontakt-Formular-Plugin eingebunden]</p>
        </div>
    </section>
</main>

<?php get_footer(); ?>