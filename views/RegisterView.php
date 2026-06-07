<?php require __DIR__ . '/../includes/header.php'; ?>

<div class="auth-neon-bg"></div>

<section class="auth-wrapper">

    <div class="auth-disc"></div>

    <div class="auth-panel">

        <h1 class="auth-title">Inscription</h1>
        <p class="auth-subtitle">Rejoins l’univers Wavey.</p>

        <form action="index.php?page=register" method="POST" class="auth-form">

            <div class="auth-field">
                <input
                    type="text"
                    name="nom"
                    placeholder="Nom"
                    required
                >
            </div>

            <div class="auth-field">
                <input
                    type="email"
                    name="email"
                    placeholder="Adresse e-mail"
                    required
                >
            </div>

            <div class="auth-field">
                <input
                    type="password"
                    name="password"
                    placeholder="Mot de passe"
                    required
                >
            </div>

            <button type="submit" class="auth-submit">
                Créer mon compte
            </button>

        </form>

        <?php if (!empty($error)) : ?>
            <p style="color:#ff4d4d; text-align:center; margin-top:15px;">
                <?= htmlspecialchars($error) ?>
            </p>
        <?php endif; ?>

    </div>

</section>

<?php require __DIR__ . '/../includes/footer.php'; ?>