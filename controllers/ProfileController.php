<?php

class ProfileController
{
    public function index()
    {
        session_start();

        if (!isset($_SESSION['user'])) {
            header('Location: index.php?page=login');
            exit;
        }

        require __DIR__ . '/../views/profileView.php';
    }
}