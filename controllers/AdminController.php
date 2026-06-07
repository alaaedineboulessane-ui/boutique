<?php

require_once __DIR__ . '/../Models/MusicModel.php';

class AdminController
{
    public function dashboard()
    {
        session_start();

        if (
            !isset($_SESSION['user']) ||
            $_SESSION['user']['role'] !== 'admin'
        ) {
            header('Location: index.php?page=login');
            exit;
        }

        $musiques = Music::all();

        require __DIR__ . '/../Views/admin.php';
    }

    public function addMusicPage()
    {
        session_start();

        if (
            !isset($_SESSION['user']) ||
            $_SESSION['user']['role'] !== 'admin'
        ) {
            header('Location: index.php?page=login');
            exit;
        }

        global $pdo;

        $artistes = $pdo->query(
            "SELECT * FROM artiste ORDER BY nom"
        )->fetchAll(PDO::FETCH_ASSOC);

        $categories = $pdo->query(
            "SELECT * FROM categorie ORDER BY nom"
        )->fetchAll(PDO::FETCH_ASSOC);

        require __DIR__ . '/../Views/add_music.php';
    }

    public function storeMusic()
    {
        session_start();

        if (
            !isset($_SESSION['user']) ||
            $_SESSION['user']['role'] !== 'admin'
        ) {
            header('Location: index.php?page=login');
            exit;
        }

        if (
            empty($_POST['titre']) ||
            empty($_POST['artiste_id']) ||
            empty($_POST['categorie_id']) ||
            empty($_POST['prix']) ||
            empty($_FILES['audio'])
        ) {
            header('Location: index.php?page=admin');
            exit;
        }

        $titre = trim($_POST['titre']);
        $artiste_id = (int) $_POST['artiste_id'];
        $categorie_id = (int) $_POST['categorie_id'];
        $prix = (float) $_POST['prix'];

        $allowed = ['mp3', 'wav', 'ogg'];

        $fileName = $_FILES['audio']['name'];
        $tmpName = $_FILES['audio']['tmp_name'];
        $error = $_FILES['audio']['error'];

        $extension = strtolower(
            pathinfo($fileName, PATHINFO_EXTENSION)
        );

        if (
            $error !== 0 ||
            !in_array($extension, $allowed)
        ) {
            header('Location: index.php?page=admin');
            exit;
        }

        $newName = uniqid() . '_' . $fileName;

        $uploadDir = __DIR__ . '/../public/uploads/music/';
        $uploadPath = $uploadDir . $newName;

        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        if (move_uploaded_file($tmpName, $uploadPath)) {
            $dbPath = 'uploads/music/' . $newName;

            Music::create(
                $titre,
                $artiste_id,
                $categorie_id,
                $prix,
                $dbPath
            );
        }

        header('Location: index.php?page=admin');
        exit;
    }
}