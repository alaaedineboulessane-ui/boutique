<?php

class Music
{
    public static function create(
        $titre,
        $artiste_id,
        $categorie_id,
        $prix,
        $chemin_fichier,
        $chemin_image,
        $duree = null,
        $chemin_extrait = null,
        $date_publication = null
    ) {
        global $pdo;

        $stmt = $pdo->prepare(
            "INSERT INTO musique (
                titre,
                artiste_id,
                categorie_id,
                prix,
                duree,
                chemin_fichier,
                chemin_image,
                chemin_extrait,
                date_publication
            ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)"
        );

        return $stmt->execute([
            $titre,
            $artiste_id,
            $categorie_id,
            $prix,
            $duree,
            $chemin_fichier,
            $chemin_image,
            $chemin_extrait,
            $date_publication
        ]);
    }

    public static function all()
    {
        global $pdo;

        $stmt = $pdo->query(
            "SELECT
                m.id,
                m.titre,
                a.nom AS artiste,
                c.nom AS categorie,
                m.prix,
                m.duree,
                m.chemin_fichier,
                m.chemin_image,
                m.chemin_extrait,
                m.date_publication,
                m.actif
             FROM musique m
             INNER JOIN artiste a
                ON m.artiste_id = a.id
             INNER JOIN categorie c
                ON m.categorie_id = c.id
             WHERE m.actif = 1
             ORDER BY m.id DESC"
        );

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}