<?php

class CollectionController
{
    public function index()
    {
        session_start();

        if (!isset($_SESSION['user_id'])) {
            header('Location: index.php?page=login');
            exit;
        }

        global $pdo;

        $stmt = $pdo->prepare("
            SELECT
                m.id,
                m.titre,
                m.prix,
                m.chemin_fichier,
                m.chemin_image
            FROM collection c
            INNER JOIN musique m ON c.musique_id = m.id
            WHERE c.utilisateur_id = ?
            ORDER BY m.id DESC
        ");

        $stmt->execute([$_SESSION['user_id']]);

        $musiques = $stmt->fetchAll(PDO::FETCH_ASSOC);

        require __DIR__ . '/../views/collectionView.php';
    }
}