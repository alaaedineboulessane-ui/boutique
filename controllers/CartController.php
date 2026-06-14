<?php

require_once __DIR__ . '/../config/config.php';

class CartController
{
    public function index()
    {
        session_start();

        if (!isset($_SESSION['user_id'])) {
            header('Location: index.php?page=login');
            exit;
        }

        global $pdo;

        $stmt = $pdo->prepare(
            "SELECT
                m.id AS musique_id,
                m.titre,
                pi.prix_unitaire,
                pi.quantite
             FROM panier p
             INNER JOIN panier_item pi
                ON p.id = pi.panier_id
             INNER JOIN musique m
                ON pi.musique_id = m.id
             WHERE p.utilisateur_id = ?
             AND p.statut = 'actif'"
        );

        $stmt->execute([$_SESSION['user_id']]);

        $cart = $stmt->fetchAll(PDO::FETCH_ASSOC);

        require __DIR__ . '/../views/cartView.php';
    }




public function removeFromCart()
{
    session_start();
    global $pdo;

    if (!isset($_SESSION['user_id'])) {
        header('Location: index.php?page=login');
        exit;
    }

    $musiqueId = (int)($_POST['musique_id'] ?? 0);

    if ($musiqueId <= 0) {
        header('Location: index.php?page=cart');
        exit;
    }

    $stmt = $pdo->prepare("
        DELETE pi
        FROM panier_item pi
        INNER JOIN panier p ON p.id = pi.panier_id
        WHERE p.utilisateur_id = ?
        AND pi.musique_id = ?
        AND p.statut = 'actif'
    ");

    $stmt->execute([
        $_SESSION['user_id'],
        $musiqueId
    ]);

    header('Location: index.php?page=cart');
    exit;
}

public function checkout()
{
    session_start();

    if (!isset($_SESSION['user_id'])) {
        header('Location: index.php?page=login');
        exit;
    }

    global $pdo;

    $userId = $_SESSION['user_id'];


    $stmt = $pdo->prepare("
        SELECT id
        FROM panier
        WHERE utilisateur_id = ?
        AND statut = 'actif'
        LIMIT 1
    ");

    $stmt->execute([$userId]);
    $panier = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$panier) {
        header('Location: index.php?page=cart');
        exit;
    }

    $panierId = $panier['id'];


    $stmt = $pdo->prepare("
        UPDATE panier
        SET statut = 'valide'
        WHERE id = ?
    ");

    $stmt->execute([$panierId]);

    $stmt = $pdo->prepare("
        INSERT INTO collection (utilisateur_id, musique_id)
        SELECT p.utilisateur_id, pi.musique_id
        FROM panier p
        INNER JOIN panier_item pi ON p.id = pi.panier_id
        WHERE p.id = ?
    ");

    $stmt->execute([$panierId]);

    $stmt = $pdo->prepare("
        DELETE FROM panier_item
        WHERE panier_id = ?
    ");

    $stmt->execute([$panierId]);

    header('Location: index.php?page=collection');
    exit;
}
}

