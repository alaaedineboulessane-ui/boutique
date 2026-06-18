<?php require __DIR__ . '/../includes/header.php'; ?>

<main id="profile-page">

    <div class="profile-card">

        <div class="profile-avatar">
            <?= strtoupper(substr($_SESSION['user']['nom'] ?? 'U', 0, 1)) ?>
        </div>

        <h1>Mon Profil</h1>

        <p class="profile-subtitle">
            Gérez vos informations personnelles
        </p>

        <div class="profile-info">

            <div class="profile-row">
                <span>Nom</span>
                <strong>
                    <?= htmlspecialchars($_SESSION['user']['nom'] ?? 'Non renseigné') ?>
                </strong>
            </div>

            <div class="profile-row">
                <span>Email</span>
                <strong>
                    <?= htmlspecialchars($_SESSION['user']['email'] ?? 'Non renseigné') ?>
                </strong>
            </div>

            <div class="profile-row">
                <span>Rôle</span>
                <strong>
                    <?= htmlspecialchars($_SESSION['user']['role'] ?? 'Utilisateur') ?>
                </strong>
            </div>

        </div>

        <div class="profile-actions">

            <a href="index.php?page=collection" class="profile-btn">
                🎵 Ma collection
            </a>


            <a href="index.php?page=logout" class="profile-btn logout-btn">
                🚪 Déconnexion
            </a>

        </div>

    </div>

</main>

<?php require __DIR__ . '/../includes/footer.php'; ?>