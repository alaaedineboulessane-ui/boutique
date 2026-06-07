<?php


class MusicController
{
    public function addToCart()
    {
        session_start();

        if (!isset($_SESSION['user_id'])) {
            http_response_code(401);

            echo json_encode([
                'message' => 'Connexion requise'
            ]);

            exit;
        }

        $data = json_decode(file_get_contents('php://input'), true);

        $musiqueId = (int)($data['musique_id'] ?? 0);

        if ($musiqueId <= 0) {
            http_response_code(400);

            echo json_encode([
                'message' => 'Musique invalide'
            ]);

            exit;
        }

        global $pdo;

        $stmt = $pdo->prepare(
            "SELECT id
             FROM panier
             WHERE utilisateur_id = ?
             AND statut = 'actif'
             LIMIT 1"
        );

        $stmt->execute([$_SESSION['user_id']]);

        $panier = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$panier) {

            $stmt = $pdo->prepare(
                "INSERT INTO panier (utilisateur_id)
                 VALUES (?)"
            );

            $stmt->execute([$_SESSION['user_id']]);

            $panierId = $pdo->lastInsertId();

        } else {

            $panierId = $panier['id'];
        }

        $stmt = $pdo->prepare(
            "SELECT prix
             FROM musique
             WHERE id = ?"
        );

        $stmt->execute([$musiqueId]);

        $musique = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$musique) {

            http_response_code(404);

            echo json_encode([
                'message' => 'Musique introuvable'
            ]);

            exit;
        }

        $stmt = $pdo->prepare(
            "REPLACE INTO panier_item
             (panier_id, musique_id, quantite, prix_unitaire)
             VALUES (?, ?, 1, ?)"
        );

        $stmt->execute([
            $panierId,
            $musiqueId,
            $musique['prix']
        ]);

        echo json_encode([
            'message' => 'Ajouté au panier'
        ]);
    }
}