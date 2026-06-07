<?php require __DIR__.'/../includes/header.php'; ?>

<section id="admin-page">

    <aside class="admin-sidebar">

        <h2 class="admin-logo">Retro Admin</h2>

        <ul class="admin-menu">
            <li><a href="#">Ajouter musique</a></li>
            <li><a href="index.php?page=catalogue">Catalogue</a></li>
            <li><a href="#">Utilisateurs</a></li>
        </ul>

    </aside>

    <main class="admin-main">

        <div class="admin-header-box">
            <h1>Gestion du catalogue</h1>
            <p>Administration des contenus musicaux</p>
        </div>

        <section class="admin-card-box">

            <h2 class="admin-section-title">
                Ajouter une musique
            </h2>

            <form
                action="index.php?page=store-music"
                method="POST"
                enctype="multipart/form-data"
                class="admin-form"
            >

                <input
                    type="text"
                    name="titre"
                    placeholder="Titre"
                    required
                >

                <input
                    type="text"
                    name="artiste"
                    placeholder="Artiste"
                    required
                >

                <input
                    type="text"
                    name="categorie"
                    placeholder="Catégorie"
                    required
                >

                <input
                    type="file"
                    name="audio"
                    required
                >

                <button
                    type="submit"
                    class="admin-submit-btn"
                >
                    Ajouter
                </button>

            </form>

        </section>

        <section class="admin-card-box">

            <h2 class="admin-section-title">
                Catalogue
            </h2>

            <table class="admin-table">

                <thead>
                    <tr>
                        <th>Titre</th>
                        <th>Artiste</th>
                        <th>Catégorie</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>

                    <?php if(!empty($musiques)): ?>

                        <?php foreach($musiques as $musique): ?>

                            <tr>

                                <td>
                                    <?= htmlspecialchars($musique['titre']) ?>
                                </td>

                                <td>
                                    <?= htmlspecialchars($musique['artiste']) ?>
                                </td>

                                <td>
                                    <?= htmlspecialchars($musique['categorie']) ?>
                                </td>

                                <td class="admin-actions">

                                    <button
                                        class="admin-edit-btn"
                                    >
                                        Modifier
                                    </button>

                                    <button
                                        class="admin-delete-btn"
                                    >
                                        Supprimer
                                    </button>

                                </td>

                            </tr>

                        <?php endforeach; ?>

                    <?php endif; ?>

                </tbody>

            </table>

        </section>

    </main>

</section>

<?php require __DIR__.'/../includes/footer.php'; ?>