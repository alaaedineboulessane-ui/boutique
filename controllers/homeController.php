<?php

require_once __DIR__ . '/../Models/MusicModel.php';

class HomeController
{
    public function showHome()
    {
        $musiques = Music::all();

        require __DIR__ . '/../views/AccueilView.php';
    }
}