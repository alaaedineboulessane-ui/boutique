<?php

require_once __DIR__ . '/../models/UserModel.php';

class AuthController
{
    public function register()
    {
        $error = '';

        if (!empty($_POST)) {

            $nom = trim($_POST['nom'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';

            if (
                !empty($nom) &&
                !empty($email) &&
                !empty($password) &&
                filter_var($email, FILTER_VALIDATE_EMAIL) &&
                strlen($password) >= 6 &&
                preg_match('/[0-9]/', $password)
            ) {

                $userModel = new UserModel();

                if ($userModel->register($nom, $email, $password)) {

                    header("Location: index.php?page=login");
                    exit;

                } else {

                    $error = "Erreur lors de l'inscription.";
                }

            } else {

                $error = "Données invalides.";
            }
        }

        require __DIR__ . '/../views/registerView.php';
    }

    public function login()
    {
        session_start();

        $error = '';

        if (!empty($_POST)) {

            $email = trim($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';

            if (!empty($email) && !empty($password)) {

                $userModel = new UserModel();
                $user = $userModel->getUserByEmail($email);

                if (
                    $user &&
                    password_verify($password, $user['mot_de_passe_hash'])
                ) {

                    $_SESSION['user_id'] = $user['id'];

                    $_SESSION['user'] = [
                        'id' => $user['id'],
                        'nom' => $user['nom'],
                        'email' => $user['email'],
                        'role' => $user['role']
                    ];

                    if ($user['role'] === 'admin') {

                        header("Location: index.php?page=admin");

                    } else {

                        header("Location: index.php");
                    }

                    exit;

                } else {

                    $error = "Email ou mot de passe incorrect";
                }

            } else {

                $error = "Veuillez remplir tous les champs";
            }
        }

        require __DIR__ . '/../views/loginView.php';
    }

    public function logout()
    {
        session_start();
        session_destroy();

        header("Location: index.php?page=login");
        exit;
    }
}