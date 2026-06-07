<?php require __DIR__ . '/../includes/header.php'; ?>

<main>

<section class="hero" aria-labelledby="hero-title">
    <div class="hero-content">
        <h1 id="hero-title">La musique vous appartient.</h1>

        <p>
            Une boutique musicale rétro inspirée des anciennes plateformes d'achat.
            Écoutez, découvrez et achetez vos morceaux préférés.
        </p>

        <a href="index.php?page=catalogue" class="btn">
            Découvrir le catalogue
        </a>
    </div>

    <div class="hero-visual" aria-hidden="true">
        <div class="vinyl"></div>
        <div class="cassette">
            <div class="tape left"></div>
            <div class="tape right"></div>
        </div>
    </div>
</section>

<section class="about" aria-labelledby="about-title">
    <h2 id="about-title">Une expérience musicale rétro</h2>

    <p>
        Redécouvrez le plaisir d’acheter votre musique et d’en devenir pleinement propriétaire.
        Une plateforme simple, nostalgique et pensée pour les passionnés.
    </p>
</section>

<section class="music-section" aria-labelledby="music-title">
    <h2 id="music-title">Musiques du jour</h2>

    <div class="cards">

        <article class="card">
            <div class="album" id="kh" role="img" aria-label="Cover Wave of Darkness I"></div>

            <h3>Wave of Darkness I</h3>
            <span>Yoko Shimomura</span>
            <p>1.99€</p>

            <audio id="audio-kh" src="./mp3/WaveOfDarkness.mp3"></audio>

            <div class="actions">
                <button aria-label="Lire la musique"
                        onclick="playSound('audio-kh')">▶</button>

                <button aria-label="Ajouter au panier"
                        onclick="addToCart('Wave of Darkness I', 1.99)">🛒</button>

                <button aria-label="Afficher les informations"
                        onclick="showInfo('Wave of Darkness I', 'Yoko Shimomura')">ℹ</button>
            </div>
        </article>

        <article class="card">
            <div class="album" id="stellar" role="img" aria-label="Cover The song of the sirens"></div>

            <h3>The song of the sirens</h3>
            <span>Shift Up, Mother Vibes</span>
            <p>2.49€</p>

            <audio id="audio-stellar" src="./mp3/SongOfSirens.mp3"></audio>

            <div class="actions">
                <button aria-label="Lire la musique"
                        onclick="playSound('audio-stellar')">▶</button>

                <button aria-label="Ajouter au panier"
                        onclick="addToCart('The song of the sirens', 2.49)">🛒</button>

                <button aria-label="Afficher les informations"
                        onclick="showInfo('The song of the sirens', 'Shift Up, Mother Vibes')">ℹ</button>
            </div>
        </article>

        <article class="card">
            <div class="album" id="makoto" role="img" aria-label="Cover Full Moon Full Life"></div>

            <h3>Full Moon Full Life</h3>
            <span>Azumi Takahashi</span>
            <p>1.49€</p>

            <audio id="audio-makoto" src="/sounds/makoto.mp3"></audio>

            <div class="actions">
                <button aria-label="Lire la musique"
                        onclick="playSound('audio-makoto')">▶</button>

                <button aria-label="Ajouter au panier"
                        onclick="addToCart('Full Moon Full Life', 1.49)">🛒</button>

                <button aria-label="Afficher les informations"
                        onclick="showInfo('Full Moon Full Life', 'Azumi Takahashi')">ℹ</button>
            </div>
        </article>

    </div>
</section>

<section class="features" aria-labelledby="features-title">


    <div class="feature">
        <h3>Nostalgie</h3>
        <p>Un univers inspiré des anciennes boutiques musicales numériques.</p>
    </div>

    <div class="feature">
        <h3>Propriété</h3>
        <p>Achetez vos morceaux et gardez-les définitivement.</p>
    </div>

    <div class="feature">
        <h3>Simplicité</h3>
        <p>Une navigation fluide et intuitive sur tous les supports.</p>
    </div>
</section>

</main>

<script src="./assets/javascript/index.js"></script>

<?php require __DIR__ . '/../includes/footer.php'; ?>