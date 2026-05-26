<?php

require_once __DIR__ . '/../models/UserModel.php';

class AuthController {

    public function register() {
        $error = '';
        if (!empty($_POST)) {
            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';
            $nom = $_POST['nom'] ?? '';
            $prenom = $_POST['prenom'] ?? '';

            if (!empty($username) && !empty($nom) && !empty($prenom) && !empty($password)
                && strlen($username) >= 3 && strlen($password) >= 6 && preg_match('/[0-9]/', $password)) {

                $userModel = new UserModel();
                if ($userModel->register($nom, $prenom, $username, $password)) {
                    header("Location: index.php");
                    exit;
                } else {
                    $error = "Erreur lors de l'inscription, veuillez réessayer.";
                }
            } else {
                $error = "Données invalides : remplissez tous les champs correctement.";
            }
        }
        require __DIR__ . '/../views/registerView.php';
    }

    public function login() {
        $error = '';
        if (!empty($_POST)) {
            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';

            if (!empty($username) && !empty($password)) {
                $userModel = new UserModel();
                $user = $userModel->getUserByUsername($username);
                if ($user && password_verify($password, $user['password'])) {
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['username'] = $user['username'];
                    header("Location: index.php");
                    exit;
                } else {
                    $error = "Identifiant ou mot de passe incorrect";
                }
            } else {
                $error = "Veuillez remplir tous les champs";
            }
        }
        require __DIR__ . '/../views/loginView.php';
    }
}