<?php

require_once __DIR__ . '/../Models/MusicModel.php';

class CatalogController
{
    public function catalog()
    {
        $musiques = Music::all();

        require __DIR__ . '/../views/catalogView.php';
    }
}