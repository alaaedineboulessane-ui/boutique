<?php require __DIR__ . '/../includes/header.php'; ?>

<main id="catalog-page">

    <section id="catalog-hero">

        <div id="catalog-hero-content">
            <h1 id="catalog-main-title">Catalogue Musical</h1>

            <p id="catalog-main-subtitle">
                Explorez notre collection de musiques numériques
                et enrichissez votre bibliothèque personnelle.
            </p>
        </div>

    </section>

    <section id="catalog-library">

        <div id="catalog-grid">

            <?php foreach ($musiques as $musique): ?>

                <article class="catalog-item-card">

                    <div class="catalog-cover">
                        <img
                            src="<?= htmlspecialchars($musique['chemin_image'] ?? '') ?>"
                            alt="<?= htmlspecialchars($musique['titre']) ?>"
                            onerror="this.src='https://via.placeholder.com/300x300?text=No+Image';"
                        >
                    </div>

                    <div class="catalog-item-content">

                        <h2 class="catalog-track-title">
                            <?= htmlspecialchars($musique['titre']) ?>
                        </h2>

                        <p class="catalog-track-artist">
                            <?= htmlspecialchars($musique['artiste']) ?>
                        </p>

                        <p class="catalog-track-category">
                            <?= htmlspecialchars($musique['categorie']) ?>
                        </p>

                        <div class="catalog-track-price">
                            <?= number_format($musique['prix'], 2) ?> €
                        </div>

                        <div class="catalog-actions">

                            <button class="catalog-preview-btn">
                                ▶ Écouter
                            </button>

                            <button
                                class="catalog-cart-btn"
                                onclick="addToCart(<?= $musique['id'] ?>)">
                                🛒 Ajouter
                            </button>

                        </div>

                    </div>

                </article>

            <?php endforeach; ?>

        </div>

    </section>

</main>

<?php require __DIR__ . '/../includes/footer.php'; ?>