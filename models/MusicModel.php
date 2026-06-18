<?php

class Music
{
    public static function create(
        $titre,
        $artiste_id,
        $categorie_id,
        $prix,
        $chemin_fichier,
        $chemin_image = null
    ) {
        global $pdo;

        $stmt = $pdo->prepare("
            INSERT INTO musique (
                titre,
                artiste_id,
                categorie_id,
                prix,
                chemin_fichier,
                chemin_image
            ) VALUES (?, ?, ?, ?, ?, ?)
        ");

        return $stmt->execute([
            $titre,
            $artiste_id,
            $categorie_id,
            $prix,
            $chemin_fichier,
            $chemin_image
        ]);
    }

    public static function all()
    {
        global $pdo;

        $stmt = $pdo->query("
            SELECT
                m.id,
                m.titre,
                a.nom AS artiste,
                a.bio AS artiste_bio,
                c.nom AS categorie,
                c.description AS categorie_description,
                m.prix,
                m.chemin_fichier,
                m.chemin_image
            FROM musique m
            INNER JOIN artiste a ON m.artiste_id = a.id
            INNER JOIN categorie c ON m.categorie_id = c.id
            WHERE m.actif = 1
            ORDER BY m.id DESC
        ");

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}