<?php require __DIR__ . '/../includes/header.php'; ?>

<main id="collection-page">

    <section class="collection-hero">
        <h1>Ma Collection</h1>
        <p>Retrouve toutes tes musiques achetées</p>
    </section>

    <?php if (empty($musiques)): ?>

        <div class="collection-empty">
            <p>Aucune musique achetée pour le moment.</p>
        </div>

    <?php else: ?>

        <div class="collection-grid">

            <?php foreach ($musiques as $musique): ?>

                <div class="collection-item">

                    <div class="collection-cover">
                        <img
                            src="<?= htmlspecialchars($musique['chemin_image']) ?>"
                            alt="<?= htmlspecialchars($musique['titre']) ?>"
                        >
                    </div>

                    <div class="collection-info">

                        <h2><?= htmlspecialchars($musique['titre']) ?></h2>

                        <p class="collection-price">
                            <?= number_format($musique['prix'], 2) ?> €
                        </p>

                        <audio controls>
                            <source
                                src="<?= htmlspecialchars($musique['chemin_fichier']) ?>"
                                type="audio/mpeg">
                        </audio>

                    </div>

                </div>

            <?php endforeach; ?>

        </div>

    <?php endif; ?>

</main>

<?php require __DIR__ . '/../includes/footer.php'; ?>