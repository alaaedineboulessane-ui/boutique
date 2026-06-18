<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

<link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;600;700&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

<link rel="stylesheet" href="./assets/css/index.css">
<link rel="stylesheet" href="./assets/css/login.css">
<link rel="stylesheet" href="./assets/css/admin.css">
<link rel="stylesheet" href="./assets/css/Catalog.css">
<link rel="stylesheet" href="./assets/css/cart.css">
<link rel="stylesheet" href="./assets/css/Collection.css">
<title>Wav</title>
</head>
<body>

<header>
    <nav class="navbar">
        <div class="logo">WAVEY</div>

        <ul class="nav-links">
            <li><a href="index.php?page=home">Accueil</a></li>
            <li><a href="index.php?page=catalogue">Catalogue</a></li>
            <li><a href="index.php?page=cart">Panier</a></li>
            <li><a href="index.php?page=collection">Collection</a></li>

            <?php if (isset($_SESSION['user'])): ?>

                <?php if ($_SESSION['user']['role'] === 'admin'): ?>
                    <li><a href="index.php?page=admin">Admin</a></li>
                <?php endif; ?>

                <li><a href="index.php?page=logout">Déconnexion</a></li>

            <?php else: ?>

                <li><a href="index.php?page=login">Connexion</a></li>
                <li><a href="index.php?page=register">Inscription</a></li>

            <?php endif; ?>

        </ul>
    </nav>
</header>