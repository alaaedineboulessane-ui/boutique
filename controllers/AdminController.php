<?php

require_once __DIR__ . '/../Models/MusicModel.php';

class AdminController
{
    public function dashboard()
    {
        session_start();

        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
            header('Location: index.php?page=login');
            exit;
        }

        $musiques = Music::all();

        require __DIR__ . '/../Views/admin.php';
    }

    public function storeMusic()
    {
        session_start();

        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
            header('Location: index.php?page=login');
            exit;
        }

        global $pdo;

        if (
            empty($_POST['titre']) ||
            empty($_POST['artiste']) ||
            empty($_POST['categorie']) ||
            empty($_POST['prix']) ||
            !isset($_FILES['audio']) ||
            $_FILES['audio']['error'] !== 0
        ) {
            header('Location: index.php?page=admin');
            exit;
        }

        $titre = trim($_POST['titre']);
        $artiste_nom = trim($_POST['artiste']);
        $categorie_nom = trim($_POST['categorie']);
        $prix = (float) $_POST['prix'];
        $image = trim($_POST['image'] ?? '');

        $stmt = $pdo->prepare("SELECT id FROM artiste WHERE nom = ?");
        $stmt->execute([$artiste_nom]);
        $artiste = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($artiste) {
            $artiste_id = $artiste['id'];
        } else {
            $stmt = $pdo->prepare("INSERT INTO artiste (nom) VALUES (?)");
            $stmt->execute([$artiste_nom]);
            $artiste_id = $pdo->lastInsertId();
        }

        $stmt = $pdo->prepare("SELECT id FROM categorie WHERE nom = ?");
        $stmt->execute([$categorie_nom]);
        $categorie = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($categorie) {
            $categorie_id = $categorie['id'];
        } else {
            $stmt = $pdo->prepare("INSERT INTO categorie (nom) VALUES (?)");
            $stmt->execute([$categorie_nom]);
            $categorie_id = $pdo->lastInsertId();
        }

        $fileName = $_FILES['audio']['name'];
        $tmpName = $_FILES['audio']['tmp_name'];

        $allowed = ['mp3', 'wav', 'ogg'];
        $extension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

        if (!in_array($extension, $allowed)) {
            header('Location: index.php?page=admin');
            exit;
        }

        $newName = uniqid() . '_' . $fileName;

        $uploadDir = __DIR__ . '/../../uploads/music/';

        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        if (!move_uploaded_file($tmpName, $uploadDir . $newName)) {
            die("Erreur upload audio");
        }

        $dbPath = 'uploads/music/' . $newName;

        Music::create(
            $titre,
            $artiste_id,
            $categorie_id,
            $prix,
            $dbPath,
            $image
        );

        header('Location: index.php?page=admin');
        exit;
    }

    public function deleteMusic()
    {
        session_start();

        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
            header('Location: index.php?page=login');
            exit;
        }

        global $pdo;

        $id = (int)($_POST['id'] ?? 0);

        if ($id <= 0) {
            header('Location: index.php?page=admin');
            exit;
        }

        $stmt = $pdo->prepare("DELETE FROM musique WHERE id = ?");
        $stmt->execute([$id]);

        header('Location: index.php?page=admin');
        exit;
    }
}