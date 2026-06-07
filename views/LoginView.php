<?php require __DIR__ . '/../includes/header.php'; ?>

<div class="auth-neon-bg"></div>

<section class="auth-wrapper">

    <div class="auth-disc"></div>

    <div class="auth-panel">

        <h1 class="auth-title">Connexion</h1>
        <p class="auth-subtitle">Retrouvez votre musique.</p>

        <?php if (!empty($error)): ?>
            <p><?= htmlspecialchars($error) ?></p>
        <?php endif; ?>

        <form action="index.php?page=login"
              method="POST"
              class="auth-form">

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
                Se connecter
            </button>

        </form>

    </div>

</section>

<?php require __DIR__ . '/../includes/footer.php'; ?>